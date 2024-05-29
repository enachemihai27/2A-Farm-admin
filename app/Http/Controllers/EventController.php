<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Mockery\Exception;

class EventController extends Controller
{


    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $events = $this->eventService->getAll($request);
            if ($request->expectsJson()) {
                return response()->json($events, 200);
            }
        }catch (QueryException $e){
            return response()->json('error', 'Unable to load record.' . $e);
        }
    }

    public function privateIndex(Request $request)
    {
        try {
            $events = $this->eventService->getAll($request);
            return view('events.index', compact('events'));
        }catch (QueryException $e){
            session()->flash('error', 'Unable to load records.' . $e);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $event = new Event();
            $this->eventService->validate($request, $event);
            $event->save();
            session()->flash('success', 'Event created successfully.');
        } catch (QueryException  $e) {
            session()->flash('error', 'Unable to created record.' . $e);
        }
        return redirect()->route('events.privateIndex');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            return response()->json($event, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['msg' => 'Record not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = null;
        try {
            $event = Event::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Record not found.' . $e);
        }
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $this->eventService->validate($request, $event);
            $event->save();
            session()->flash('success', 'Event updated successfully.');
        } catch (ModelNotFoundException|QueryException $e) {
            session()->flash('error', 'Record not found or could not be updated.' . $e);
        }
        return redirect()->route('events.privateIndex');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            File::delete(public_path($event->picture));

            session()->flash('success', 'Event deleted successfully.');

        } catch (QueryException|ModelNotFoundException $e) {
            session()->flash('error', 'Record not found or could not be deleted.' . $e);
        }

        return redirect()->back();
    }
}
