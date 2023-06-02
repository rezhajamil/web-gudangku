<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = User::where('role', 'worker')->where('company_id', auth()->user()->id)->orderBy('name')->get();

        return view('worker.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('worker.create');
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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['string',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'avatar' => ['image',],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ddd($request->avatar && $request->hasFile('avatar'));

        if ($request->avatar && $request->hasFile('avatar')) {
            $url = $request->avatar->store('workers');
        } else {
            $url = '';
        }
        // ddd($url);

        $worker = User::create([
            'name' => ucwords($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'avatar' => $url,
            'role' => 'worker',
            'company_id' => auth()->user()->id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($worker));

        return redirect()->route('pegawai.index')->with('success', "Berhasil Menambahkan $request->name Sebagai Pegawai");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = User::find($id);

        return view('worker.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['string',],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
            'avatar' => ['image',],
        ]);

        $worker = User::find($id);

        if ($request->avatar && $request->hasFile('avatar')) {
            $url = $request->avatar->store('workers');
            Storage::delete($worker->url);
        } else {
            $url = $worker->avatar;
        }
        // ddd($url);

        $worker->name = ucwords($request->name);
        $worker->address = $request->address;
        $worker->phone = $request->phone;
        $worker->email = $request->email;
        $worker->avatar = $url;
        $worker->save();

        return redirect()->route('pegawai.index')->with('success', "Berhasil Mengubah Data $request->namei");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function edit_password($id)
    {
        $worker = User::find($id);

        return view('worker.edit_password', compact('worker'));
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $worker = User::find($id);
        $worker->password = Hash::make($request->password);
        $worker->save();

        return redirect()->route('pegawai.index')->with('success', "Berhasil Ganti Password " . ucwords($worker->name));
    }

    public function change_status($id)
    {
        $worker = User::find($id);

        $worker->status = !$worker->status;
        $worker->save();

        return redirect()->route('pegawai.index')->with('success', "Berhasil Ubah Status " . ucwords($worker->name));
    }
}
