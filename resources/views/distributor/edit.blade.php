@extends('layouts.app')
@section('content')
    <div class="w-full max-w-full px-3 mx-auto shrink-0 md:w-8/12 md:flex-0">
        <form action="{{ route('distributor.update', $distributor->id) }}" method="POST"
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            @csrf
            @method('PUT')
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <div class="flex items-center">
                    <p class="mb-0 ">Edit {{ $distributor->name }}</p>
                    <button type="submit"
                        class="inline-block px-8 py-2 mb-4 ml-auto text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer bg-cyan-500 tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Update</button>
                </div>
            </div>
            <div class="flex-auto p-6">
                <p class="text-sm leading-normal uppercase">Informasi Distributor</p>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="name" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Nama
                                Distributor</label>
                            <input type="text" name="name" value="{{ old('name', $distributor->name) }}"
                                class="focus:shadow-primary-outline uppercase text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('name')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="phone" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Telepon
                                Distributor</label>
                            <input type="number" name="phone" value="{{ old('phone', $distributor->phone) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('phone')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-12/12 md:flex-0">
                        <div class="mb-4">
                            <label for="address" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Alamat
                                Distributor</label>
                            <input type="text" name="address" value="{{ old('address', $distributor->address) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('address')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
