@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="relative w-6/12 p-4 mx-auto text-white bg-teal-500 rounded-lg shadow-lg">{{ session('success') }}</div>
    @endif
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3 shadow-3xl">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div
                        class="flex justify-between p-6 pb-0 mb-2 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-lg uppercase">Data Pegawai</h6>
                        <div class="flex px-4 gap-x-2">
                            <button id="print"
                                class="p-1 font-bold text-white ease-in-out bg-teal-500 rounded-md hover:bg-teal-700 aspect-square"><i
                                    class="fa-solid fa-print"></i></button>
                            <a href="{{ route('pegawai.create') }}"
                                class="inline-block p-1 font-bold text-center text-white ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700 aspect-square"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-between px-6 mt-6 gap-x-4 gap-y-8">
                        <div class="flex flex-wrap items-end gap-y-2 gap-x-4">
                            <input type="text" name="search" id="search" placeholder="Search..."
                                class="px-2 rounded-lg">
                            <div class="flex flex-col">
                                <select name="search_by" id="search_by" class="h-full px-6 py-2 rounded-lg">
                                    <option value="" selected disabled>Cari Berdasarkan</option>
                                    <option value="name">Nama Pegawai</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <div class="px-4 py-6 overflow-x-auto" id="table-data">

                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-2 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            No</th>
                                        <th
                                            class="px-2 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Profil Pegawai</th>
                                        <th
                                            class="px-2 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Telepon</th>
                                        <th
                                            class="px-2 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Alamat</th>
                                        <th
                                            class="px-2 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Status</th>
                                        <th
                                            class="px-2 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 action">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workers as $key => $worker)
                                        <tr>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-sm w-fit">
                                                    {{ $key + 1 }}
                                                </p>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $worker->avatar ? asset('storage/' . $worker->avatar) : asset('images/avatar.png') }}"
                                                            class="inline-flex items-center justify-center w-12 h-12 mr-4 text-sm text-white transition-all duration-200 ease-in-out rounded"
                                                            alt="{{ $worker->name }}" />
                                                    </div>
                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 text-sm leading-normal">{{ $worker->name }}
                                                        </h6>
                                                        <p class="mb-0 text-slate-400">
                                                            {{ $worker->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-sm">
                                                    {{ $worker->phone }}
                                                </p>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b shadow-transparent">
                                                <p class="mb-0 text-sm">
                                                    {{ $worker->address }}
                                                </p>
                                            </td>
                                            <td
                                                class="p-2 text-sm leading-normal text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                @if ($worker->status)
                                                    <span
                                                        class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap align-baseline font-bold uppercase leading-none text-white">
                                                        Aktif
                                                    </span>
                                                @else
                                                    <span
                                                        class="bg-gradient-to-tl from-slate-600 !to-slate-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap align-baseline font-bold uppercase leading-none text-white">
                                                        Tidak Aktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td
                                                class="p-2 space-y-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent action">
                                                <a href="{{ route('pegawai.edit', $worker->id) }}"
                                                    class="block px-1 text-sm font-semibold leading-tight text-slate-400">
                                                    Edit</a>
                                                <a href="{{ route('pegawai.edit_password', $worker->id) }}"
                                                    class="block px-1 text-sm font-semibold leading-tight text-orange-400">
                                                    Ganti Password</a>
                                                <form action="{{ route('pegawai.change_status', $worker->id) }}"
                                                    method="POST" class="m-0">
                                                    @csrf
                                                    @method('put')
                                                    @if ($worker->status)
                                                        <button type="submit""
                                                            class="block px-1 text-sm font-semibold leading-tight text-red-400">
                                                            Non Aktifkan</button>
                                                    @else
                                                        <button type="submit""
                                                            class="block px-1 text-sm font-semibold leading-tight text-teal-400">
                                                            Aktifkan</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search").on("input", function() {
                find();
            });

            $("#search_by").on("input", function() {
                find();
            });

            $('#print').click(function() {
                print();
            })

            const find = () => {
                let search = $("#search").val();
                let searchBy = $('#search_by').val();
                let pattern = new RegExp(search, "i");
                $(`.${searchBy}`).find('p').each(function() {
                    let label = $(this).text();
                    if (pattern.test(label)) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }

            const print = () => {

                let start_date = $("#start_date").attr('text');
                let end_date = $("#end_date").attr('text');

                // Select the HTML table element
                var table = $('#table-data').clone();
                table.prepend(
                    `<span class='px-6 my-8 text-lg font-bold'>Laporan Data Pegawai</span>`
                )
                // Remove the column with the 'action' class
                table.find('.action').remove();

                // Convert the table to PDF
                html2pdf()
                    .from(table[0])
                    .save(`Laporan Data Pegawai.pdf`);
            }
        })
    </script>
@endsection
