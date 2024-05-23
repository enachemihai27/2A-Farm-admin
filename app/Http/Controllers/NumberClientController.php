<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Models\Client;
use App\Models\NumberClient;
use Illuminate\Http\Request;

class NumberClientController extends Controller
{
    use ImageUploadHelper;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $numbers = NumberClient::all();

        if($request->expectsJson()){
            return response()->json($numbers);
        }else {
            return view('numbers.index', compact('numbers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Client::all();
        return view('numbers.create', compact('companies'));
    }


    public function validateUploadAndSave(Request $request, $number){

        $request->validate([
            'company_id' => ['required', 'integer'],
            'number' => ['required', 'integer'],
            'text' => ['required']
        ]);



        if($request->hasFile('icon')) {
            $request->validate([
                'icon' => ['required', 'max:2028', 'image']
            ]);
            $path = $this->uploadImage($request, 'icon', 'uploads');
            $number->icon = $path;
        }


        $number->client_id = $request->company_id;
        $number->number = $request->number;
        $number->text = $request->text;

        $number->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $number = new NumberClient();

        $this->validateUploadAndSave($request, $number);


        return redirect()->route('numbers.index');

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
        $number = NumberClient::findOrFail($id);
        $companies = Client::all();
        return view('numbers.edit', compact('number', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $number = NumberClient::findOrFail($id);

        $this->validateUploadAndSave($request, $number);


        return redirect()->route('numbers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $number = NumberClient::findOrFail($id);

        $number->delete();

        return redirect()->back();
    }
}
