<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Mockery\Exception;

class EventController extends Controller
{
    use ImageUploadHelper;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = null;
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        try {
            $events = Event::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })->paginate($perPage);
        } catch (Exception $e) {
            session()->flash('error', 'Unable to load events.' . $e);
        }

        if ($request->expectsJson()) {
            return response()->json($events, 200);
        } else {
            return view('events.index', compact('events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }


    private function validateAndSave(Request $request, $event)
    {
        $request->validate([
            'title' => ['required', 'max:256'],
            'description' => 'required'
        ]);

        if ($request->hasFile('picture')) {
            $request->validate([
                'picture' => ['required', 'max:2028', 'image']
            ]);
            $path = $this->uploadImage($request, 'picture', 'uploads');
            $event->picture = $path;
        }

        $event->title = $request->title;
        $event->client_id = 1;
        $event->description = $request->description;


        $event->save();

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $event = new Event();
            $this->validateAndSave($request, $event);

            session()->flash('success', 'Event created successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Unable to created record.' . $e);
        }
        return redirect()->route('events.index');
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
        } catch (Exception $e) {
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
            $this->validateAndSave($request, $event);

            session()->flash('success', 'Event updated successfully.');

        } catch (Exception $e) {
            session()->flash('error', 'Record not found or could not be updated.' . $e);
        }
        return redirect()->route('events.index');


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

        } catch (Exception $e) {
            session()->flash('error', 'Record not found or could not be deleted.' . $e);
        }

        return redirect()->back();
    }
}
