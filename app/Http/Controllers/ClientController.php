<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $client = Client::first();
            if ($request->expectsJson()) {
                return response()->json($client);
            }
        } catch (QueryException $e) {
            return response()->json('error', 'Unable to load record.' . $e);
        }

    }

    public function privateIndex(Request $request)
    {
        try {
            $client = Client::first();
            return view('client.index', compact('client'));
        } catch (QueryException $e) {
            session()->flash('error', 'Unable to load records.' . $e);
        }
    }

    public function validateAndSave(Request $request, $client): void
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'max:200', 'email'],
            'primary_phone_number' => ['required'],
            'order_number' => ['required', 'max:200'],
            'cui' => ['required', 'max:200'],
            'video_url' => ['url']

        ]);


        $client->name = $request->name;
        $client->email = $request->email;
        $client->primary_phone_number = $request->primary_phone_number;
        $client->secondary_phone_number = $request->secondary_phone_number;
        $client->address = $request->address;
        $client->order_number = $request->order_number;
        $client->CUI = $request->cui;

        $client->video_url = $request->video_url;

        $client->save();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $client = Client::findOrFail($id);
        $this->validateAndSave($request, $client);
        return redirect()->route('client.privateIndex');
    }
}
