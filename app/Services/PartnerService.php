<?php


namespace App\Services;

use App\Helpers\ImageUploadHelper;
use App\Models\Partner;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PartnerService
{
    use ImageUploadHelper;

    public function index(Request $request)
    {
        $partners = null;
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        try {
            $partners = Partner::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })->paginate($perPage);
        } catch (QueryException $e) {
            session()->flash('error', 'Unable to load partners.' . $e);
        }
        return $partners;
    }


    public function validate(Request $request, $partner)
    {
        $request->validate([
            'name' => ['required', 'max:256'],
            'link' => ['required', 'max:256', 'url'],
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'max:2028', 'image']
            ]);
            $path = $this->uploadImage($request, 'image', 'assets/partners');
            $partner->src = $path;
        }

        $partner->name = $request->name;
        $partner->link = $request->link;

    }

}
