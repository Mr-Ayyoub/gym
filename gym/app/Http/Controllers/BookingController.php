<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledClass;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->upcoming()
            ->oldest('date_time')->get();

        return view('member.upcoming')->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $scheduledClasses = ScheduledClass::upcoming()
            ->notBooked()
            ->with(['instructor'])
            ->oldest('date_time')
            ->paginate(15);

        return view('member.book')->with('scheduledClasses', $scheduledClasses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'scheduled_class_id' => [
                'required',
                'exists:scheduled_classes,id',
                Rule::unique('bookings')
                    ->where(function ($query) use ($request) {
                        return $query->where('user_id', auth()->id())
                            ->where('scheduled_class_id', $request->input('scheduled_class_id'));
                    }),
            ],
        ]);

        auth()->user()->bookings()->attach($attributes['scheduled_class_id']);

        return to_route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        auth()->user()->bookings()->detach($id);

        return to_route('bookings.index');
    }
}