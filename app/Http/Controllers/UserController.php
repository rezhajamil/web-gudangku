<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = User::where('role', 'company')->orderBy('name')->get();

        return view('user.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function change_status($id)
    {
        $user = User::find($id);

        $user->status = !$user->status;
        $user->save();

        return redirect()->route('user.index')->with('success', "Berhasil Ubah Status " . ucwords($user->name));
    }

    public function edit_profile()
    {
        $user = auth()->user();

        return view('user.edit', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['string',],
            'phone' => ['required', 'numeric'],
            'avatar' => ['image',],
        ]);

        $user = User::find($id);

        if ($request->avatar && $request->hasFile('avatar')) {
            $folder = auth()->user()->role == 'company' ? 'company-logo' : (auth()->user()->role == 'worker' ? 'workers' : 'admin');
            $url = $request->avatar->store($folder);
            Storage::delete($user->url);
        } else {
            $url = $user->avatar;
        }
        // ddd($url);

        $user->name = ucwords($request->name);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->avatar = $url;
        $user->save();

        return redirect()->route('edit_profile')->with('success', "Berhasil Mengubah Data Profile");
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('edit_profile')->with('success', "Berhasil Ganti Password ");
    }
}
