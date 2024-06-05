<?php


namespace App\Services;

use App\Helpers\ImageUploadHelper;
use App\Models\Partner;
use App\Models\Producer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProducerService
{
    use ImageUploadHelper;

    public function index(Request $request)
    {
        $producers = null;
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        try {
            $producers = Producer::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })->paginate($perPage);
        } catch (QueryException $e) {
            session()->flash('error', 'Unable to load producers.' . $e);
        }
        return $producers;
    }


    public function validate(Request $request, $producer)
    {
        $request->validate([
            'name' => ['required', 'max:256'],
            'link' => ['required', 'max:256', 'url'],
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'max:2028', 'image']
            ]);
            $path = $this->uploadImage($request, 'image', 'assets/producers');
            $producer->src = $path;
        }

        $producer->name = $request->name;
        $producer->link = $request->link;

    }

}
