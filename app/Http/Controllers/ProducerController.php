<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Services\ProducerService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
        //
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
