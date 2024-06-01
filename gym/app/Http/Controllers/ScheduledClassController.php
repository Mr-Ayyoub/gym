<?php

namespace App\Http\Controllers;

use App\Events\ClassCanceled;
use App\Models\ClassType;
use App\Models\ScheduledClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduledClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduledClasses = auth()->user()->scheduledClasses()
            ->upcoming()
            ->oldest('date_time')->get();

        return view('instructor.upcoming', [
            'scheduledClasses' => $scheduledClasses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instructor.schedule', [
            'classTypes' => ClassType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'date_time' => $request->input('date') . ' ' . $request->input('time'),
            'instructor_id' => auth()->id(),
        ]);

        $attributes = $request->validate([
            'instructor_id' => 'required',
            'date_time' => [
                'required',
                'date_format:"Y-m-d H:i:s"',
                'after:now',
                Rule::unique('scheduled_classes', 'date_time'),
            ],
            'class_type_id' => [
                'required',
                Rule::exists('class_types', 'id'),
            ],
        ]);

        ScheduledClass::create($attributes);

        return to_route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduledClass $schedule)
    {
        // if (auth()->id() !== $schedule->instructor_id) {
        //     abort(403);
        // }
        // using policy
        if (auth()->user()->cannot('delete', $schedule)) {
            abort(403);
        }

        ClassCanceled::dispatch($schedule);

        // $schedule->members()->detach(); //not needed due to cascadeOnDelete constraint
        $schedule->delete();

        return to_route('schedule.index');
    }
}
