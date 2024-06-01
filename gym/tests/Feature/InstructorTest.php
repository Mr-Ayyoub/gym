<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\ClassType;
use App\Models\ScheduledClass;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstructorTest extends TestCase
{
    use RefreshDatabase;
    public function test_instructor_is_redirected_to_instructor_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirectToRoute('instructor.dashboard');

        $this->followRedirects($response)->assertSeeText("Hello, instructor");
    }

    public function test_instructor_can_schedule_class()
    {
        //Given
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);
        ClassType::factory()->create();

        //When
        $response = $this->actingAs($user)
            ->post('instructor/schedule', [
                'class_type_id' => ClassType::first()->id,
                'date' => '2025-01-13',
                'time' => '14:40:00',
            ]);

        //Then
        $this->assertDatabaseHas('scheduled_classes', [
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2025-01-13 14:40:00',
        ]);
        $response->assertRedirectToRoute('schedule.index');
    }

    public function test_instructor_can_cancel_class()
    {
        //Given
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);
        ClassType::factory()->create();
        $scheduledClass = ScheduledClass::factory()->create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => now()->addDays(3)->second(1),
        ]);

        //When
        $response = $this->actingAs($user)
            ->delete("instructor/schedule/$scheduledClass->id");

        //Then
        $this->assertDatabaseMissing('scheduled_classes', [
            'id' => $scheduledClass->id,
        ]);
        $response->assertRedirectToRoute('schedule.index');
    }


    public function test_instructor_cannot_cancel_class_less_than_two_hours_before()
    {
        $user = User::factory()->create([
            'email' => 'mario@gmail.com',
            'role' => 'instructor'
        ]);
        ClassType::factory()->create();
        $scheduledClass = ScheduledClass::factory()->create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => now()->addHour(),
        ]);

        $response = $this->actingAs($user)
            ->get('instructor/schedule');

        $response->assertDontSeeText('Cancel');

        $response = $this->actingAs($user)
            ->delete("instructor/schedule/$scheduledClass->id");

        $this->assertDatabaseHas('scheduled_classes', [
            'id' => $scheduledClass->id,
        ]);
    }
}