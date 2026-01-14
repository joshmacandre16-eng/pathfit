<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TrainingScheduleController extends Controller
{
    public function index()
    {
        $trainingSchedules = TrainingSchedule::with('coach')->get();
        return view('admin.training-schedule.index', compact('trainingSchedules'));
    }

    public function create()
    {
        $coaches = User::where('role', 'Coach')->get();
        return view('admin.training-schedule.create', compact('coaches'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'coach_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        TrainingSchedule::create($request->all());

        return redirect()->route('admin.training-schedule.index')->with('success', 'Training schedule created successfully');
    }

    public function show(TrainingSchedule $trainingSchedule)
    {
        return view('admin.training-schedule.show', compact('trainingSchedule'));
    }

    public function edit(TrainingSchedule $trainingSchedule)
    {
        $coaches = User::where('role', 'Coach')->get();
        return view('admin.training-schedule.edit', compact('trainingSchedule', 'coaches'));
    }

    public function update(Request $request, TrainingSchedule $trainingSchedule)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'coach_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $trainingSchedule->update($request->all());

        return redirect()->route('admin.training-schedule.index')->with('success', 'Training schedule updated successfully');
    }

    public function destroy(TrainingSchedule $trainingSchedule)
    {
        $trainingSchedule->delete();
        return redirect()->route('admin.training-schedule.index')->with('success', 'Training schedule deleted successfully');
    }

    public function coachIndex()
    {
        $trainingSchedules = TrainingSchedule::where('coach_id', auth()->id())->with('coach')->get();
        return view('coach.training-schedules.index', compact('trainingSchedules'));
    }

    public function coachCreate()
    {
        return view('coach.training-schedules.create');
    }

    public function coachStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        TrainingSchedule::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'coach_id' => auth()->id(),
        ]);

        return redirect()->route('coach.training-schedules.index')->with('success', 'Training schedule created successfully');
    }

    public function coachShow(TrainingSchedule $trainingSchedule)
    {
        // Ensure the training schedule belongs to the authenticated coach
        if ($trainingSchedule->coach_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('coach.training-schedules.show', compact('trainingSchedule'));
    }

    public function coachEdit(TrainingSchedule $trainingSchedule)
    {
        // Ensure the training schedule belongs to the authenticated coach
        if ($trainingSchedule->coach_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('coach.training-schedules.edit', compact('trainingSchedule'));
    }

    public function coachUpdate(Request $request, TrainingSchedule $trainingSchedule)
    {
        // Ensure the training schedule belongs to the authenticated coach
        if ($trainingSchedule->coach_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $trainingSchedule->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('coach.training-schedules.index')->with('success', 'Training schedule updated successfully');
    }
}
