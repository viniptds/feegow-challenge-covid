<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Models\Vaccine;
use App\Models\Worker;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = Worker::select()->with('vaccines')->get();
        return view('workers.index')->with('workers', $workers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request)
    {
        $data = $request->validated();

        $worker = new Worker($data);

        $worker->save();

        return redirect(route('workers'))->with('worker', $worker);
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        $vaccines = Vaccine::all();
        // TODO: verify if all vaccines should be present or use ->where('due_date', '>=', date('Y-m-d'))->get();

        return view('workers.show', ['worker' => $worker, 'vaccines' => $vaccines]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();

        return response()->json([
            'status' => true,
            'redirect' => route('workers')
        ]);
    }
}
