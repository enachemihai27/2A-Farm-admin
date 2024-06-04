<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Services\PartnerService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{


    public PartnerService $partnerService;

    /**
     * @param PartnerService $partnerService
     */
    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $partners = Partner::all();
            $partners->makeHidden(['id', 'created_at', 'updated_at']);
            return response()->json($partners);
        }catch (QueryException $e){
            return response()->json('error', 'Unable to load record.' . $e);
        }
    }

    public function privateIndex(Request $request)
    {
        try {
            $partners = $this->partnerService->index($request);
            return view('partners.index', compact('partners'));
        }catch (QueryException $e){
            session()->flash('error', 'Unable to load records.' . $e);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $partner = new Partner();
            $this->partnerService->validate($request, $partner);
            $partner->save();
            session()->flash('success', 'Partner created successfully.');
        } catch (QueryException  $e) {
            session()->flash('error', 'Unable to created record.' . $e);
        }
        return redirect()->route('partners.privateIndex');
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
        $partner = null;
        try {
            $partner = Partner::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Record not found.' . $e);
        }
        return view('partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $partner = Partner::findOrFail($id);
            $this->partnerService->validate($request, $partner);
            $partner->save();
            session()->flash('success', 'Partner updated successfully.');
        } catch (ModelNotFoundException|QueryException $e) {
            session()->flash('error', 'Record not found or could not be updated.' . $e);
        }
        return redirect()->route('partners.privateIndex');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $partner = Partner::findOrFail($id);
            $partner->delete();
            File::delete(public_path($partner->src));

            session()->flash('success', 'Partner deleted successfully.');

        } catch (QueryException|ModelNotFoundException $e) {
            session()->flash('error', 'Record not found or could not be deleted.' . $e);
        }

        return redirect()->back();
    }
}
