<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Services\ProducerService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProducerController extends Controller
{


    protected ProducerService $producerService;

    /**
     * @param ProducerService $producerService
     */
    public function __construct(ProducerService $producerService)
    {
        $this->producerService = $producerService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $producers = Producer::all();
            $producers->makeHidden(['id', 'created_at', 'updated_at']);
            return response()->json($producers);
        }catch (QueryException $e){
            return response()->json('error', 'Unable to load record.' . $e);
        }
    }

    public function privateIndex(Request $request)
    {
        try {
            $producers = $this->producerService->index($request);
            return view('producers.index', compact('producers'));
        }catch (QueryException $e){
            session()->flash('error', 'Unable to load records.' . $e);
        }

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('producers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $producer = new Producer();
            $this->producerService->validate($request, $producer);
            $producer->save();
            session()->flash('success', 'Producator creat cu succes.');
        } catch (QueryException  $e) {
            session()->flash('error', 'Unable to created record.' . $e);
        }
        return redirect()->route('producers.privateIndex');
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
        $producer = null;
        try {
            $producer = Producer::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Record not found.' . $e);
        }
        return view('producers.edit', compact('producer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $producer = Producer::findOrFail($id);
            $this->producerService->validate($request, $producer);
            $producer->save();
            session()->flash('success', 'Producator editat cu succes.');
        } catch (ModelNotFoundException|QueryException $e) {
            session()->flash('error', 'Record not found or could not be updated.' . $e);
        }
        return redirect()->route('producers.privateIndex');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $producer = Producer::findOrFail($id);
            $producer->delete();
            File::delete(public_path($producer->src));

            session()->flash('success', 'Producator sters cu succes.');

        } catch (QueryException|ModelNotFoundException $e) {
            session()->flash('error', 'Record not found or could not be deleted.' . $e);
        }

        return redirect()->back();
    }
}
