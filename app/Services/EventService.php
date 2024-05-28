<?php


namespace App\Services;

use App\Helpers\ImageUploadHelper;
use App\Models\Event;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class EventService
{
    use ImageUploadHelper;

    public function getAll(Request $request)
    {
        $events = null;
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        try {
            $events = Event::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })->paginate($perPage);
        } catch (QueryException $e) {
            session()->flash('error', 'Unable to load events.' . $e);
        }
        return $events;
    }


    public function validate(Request $request, $event)
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
        $event->description = $request->description;

    }

}
