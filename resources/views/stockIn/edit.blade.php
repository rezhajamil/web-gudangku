@extends('layouts.app')
@section('content')
    <div class="w-full max-w-full px-3 mx-auto shadow-3xl shrink-0 md:w-8/12 md:flex-0">
        <form action="{{ route('stock_in.update', $transaction->id) }}" method="POST"
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            @csrf
            @method('put')
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <div class="flex items-center">
                    <p class="mb-0 ">Edit Barang Masuk</p>
                    <button type="submit"
                        class="inline-block px-8 py-2 mb-4 ml-auto text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Simpan</button>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="product"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Barang</label>
                            <select name="product" id="product"
                                class="focus:shadow-primary-outline uppercase text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                <option value="" selected disabled>Piilih Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('product', $transaction->product_id) == $product->id ? 'selected' : '' }}>
                                        {{ $product->brand }} | {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="distributor"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Distributor</label>
                            <select name="distributor" id="distributor"
                                class="focus:shadow-primary-outline uppercase text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                <option value="" selected disabled>Piilih Distributor</option>
                                @foreach ($distributors as $distributor)
                                    <option value="{{ $distributor->id }}"
                                        {{ old('distributor', $transaction->distributor_id) == $distributor->id ? 'selected' : '' }}>
                                        {{ $distributor->name }}</option>
                                @endforeach
                            </select>
                            @error('distributor')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                        <div class="mb-4">
                            <label for="amount"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Jumlah</label>
                            <input type="number" name="amount" value="{{ old('amount', $transaction->amount) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('amount')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                        <div class="mb-4">
                            <label for="price" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Harga
                                Satuan</label>
                            <input type="number" name="price" value="{{ old('price', $transaction->price) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('price')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                        <div class="mb-4">
                            <label for="date"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Tanggal</label>
                            <input type="date" name="date" value="{{ old('date', $transaction->date) }}"
                                class="focus:shadow-primary-outline uppercase text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('date')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
