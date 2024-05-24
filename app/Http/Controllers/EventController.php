<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Models\Client;
use App\Models\Event;
use App\Models\Job;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use ImageUploadHelper;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $events = Event::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(5);


        if($request->expectsJson()){
            return response()->json($events);
        }else {
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



    private function validateAndSave(Request $request, $event){
        $request->validate([
            'title' => ['required', 'max:256'],
            'description' => 'required'
        ]);

        if($request->hasFile('picture')) {
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

        $event = new Event();

        $this->validateAndSave($request, $event);

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $this->validateAndSave($request, $event);

        return redirect()->route('events.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return redirect()->back();
    }
}
