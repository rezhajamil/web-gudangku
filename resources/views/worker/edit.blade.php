@extends('layouts.app')
@section('content')
    <div class="w-full max-w-full px-3 mx-auto shadow-3xl shrink-0 md:w-8/12 md:flex-0">
        <form action="{{ route('pegawai.update', $worker->id) }}" method="POST" enctype="multipart/form-data"
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            @csrf
            @method('put')
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <div class="flex items-center">
                    <p class="mb-0">Edit Pegawai</p>
                    <button type="submit"
                        class="inline-block px-8 py-2 mb-4 ml-auto text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Simpan</button>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="name" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Nama
                                Pegawai*</label>
                            <input type="text" name="name" value="{{ old('name', $worker->name) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('name')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="email" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Email
                                Pegawai*</label>
                            <input type="email" name="email" value="{{ old('email', $worker->email) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('email')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="phone" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Telepon
                                Pegawai*</label>
                            <input type="number" name="phone" value="{{ old('phone', $worker->phone) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('phone')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="address" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Alamat
                                Pegawai</label>
                            <input type="text" name="address" value="{{ old('address', $worker->address) }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('address')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="avatar" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Foto
                                Pegawai</label>
                            <input type="file" name="avatar" accept="image/*" id="avatar"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            @error('avatar')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="" id="image-preview">
                            <img src="{{ $worker->avatar ? asset('storage/' . $worker->avatar) : asset('images/avatar.png') }}"
                                class="object-contain w-full h-24 mb-8" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#avatar").change(function() {
                previewImages(this);
            });
        });

        function previewImages(input) {
            var preview = $('#image-preview');
            // console.log(input.files);

            if (input.files) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var cover = Math.floor(Math.random() * 51);
                        // console.log(e.target.result);
                        // console.log(input.files);
                        preview.html(
                            `<img src="${e.target.result}" class="object-contain w-full h-24 mb-8"/>`
                        );
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
@endsection
