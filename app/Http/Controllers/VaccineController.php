<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaccineRequest;
use App\Http\Requests\UpdateVaccineRequest;
use App\Models\Vaccine;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vaccines = Vaccine::all();
        return view('vaccines.index', ['vaccines' => $vaccines]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vaccines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVaccineRequest $request)
    {
        $data = $request->validated();

        $vaccine = new Vaccine($data);
        $vaccine->save();

        return redirect(route('vaccines'))->with('vaccine', $vaccine);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccine $vaccine)
    {
        return view('vaccines.show', ['vaccine' => $vaccine]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();

        return response()->json([
            'status' => true,
            'redirect' => route('vaccines')
        ]);
    }
}
