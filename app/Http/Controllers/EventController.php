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


        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $companies = Client::all();

        return view('events.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:256'],
            'company_id' => ['required', 'integer'],
            'description' => 'required'
        ]);

        $event = new Event();



        if($request->hasFile('picture')) {
            $request->validate([
                'picture' => ['required', 'max:2028', 'image']
            ]);
            $path = $this->uploadImage($request, 'picture', 'uploads');
            $event->picture = $path;
        }

        $event->title = $request->title;
        $event->client_id = $request->company_id;
        $event->description = $request->description;


        $event->save();


        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
