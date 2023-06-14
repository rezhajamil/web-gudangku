<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributors = Distributor::where('company_id', auth()->user()->id)->orderBy('name')->get();

        return view('distributor.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('distributors', 'name')],
            'phone' => ['required', 'numeric'],
            'address' => ['required',],
        ]);

        $distributor = Distributor::create([
            'company_id' => auth()->user()->id,
            'name' => ucwords($request->name),
            'phone' => $request->phone,
            'address' => ucwords($request->address),
        ]);

        return redirect()->route('distributor.index')->with('success', 'Berhasil Menambahkan Distributor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        return view('distributor.edit', compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'name' => ['required', Rule::unique('distributors', 'name')->ignore($distributor->id)],
            'phone' => ['required', 'numeric'],
            'address' => ['required',],
        ]);

        $distributor = Distributor::where('id', $distributor->id)->update([
            'name' => ucwords($request->name),
            'phone' => $request->phone,
            'address' => ucwords($request->address),
        ]);

        return redirect()->route('distributor.index')->with('success', "Berhasil Merubah Data " . ucwords($request->name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        $distributor->delete();
        return redirect()->route('distributor.index')->with('success', "Berhasil Menghapus Data " . ucwords($distributor->name));
    }
}
