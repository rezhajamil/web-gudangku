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
                        <h6 class="text-lg uppercase">Data Distributor</h6>
                        <div class="flex px-4 gap-x-2">
                            <button id="print"
                                class="p-1 font-bold text-white ease-in-out bg-teal-500 rounded-md hover:bg-teal-700 aspect-square"><i
                                    class="fa-solid fa-print"></i></button>
                            <a href="{{ route('distributor.create') }}"
                                class="inline-block p-1 font-bold text-center text-white ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700 aspect-square"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 px-6">
                        <div class="flex flex-wrap items-end gap-x-4">
                            <input type="text" name="search" id="search" placeholder="Search..."
                                class="px-2 rounded-lg">
                            <div class="flex flex-col">
                                <select name="search_by" id="search_by" class="h-full px-6 py-2 rounded-lg">
                                    <option value="" selected disabled>Cari Berdasarkan</option>
                                    <option value="name">Nama</option>
                                    <option value="phone">Telepon</option>
                                    <option value="address">Alamat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <div class="px-0 py-6 overflow-x-auto" id="table-data">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Nama</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Telepon</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Alamat</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 action">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($distributors as $key => $distributor)
                                        <tr class="">
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-sm font-bold leading-tight text-left">
                                                    {{ $key + 1 }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent name">
                                                <p class="mb-0 text-sm font-semibold leading-tight text-left">
                                                    {{ $distributor->name }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent phone">
                                                <p class="mb-0 text-sm font-semibold leading-tight text-left">
                                                    {{ $distributor->phone }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent address">
                                                <p class="mb-0 text-sm font-semibold leading-tight text-left">
                                                    {{ $distributor->address }}</p>
                                            </td>
                                            <td
                                                class="flex flex-col px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent action">
                                                <a href="{{ route('distributor.edit', $distributor->id) }}"
                                                    class="block text-sm font-semibold leading-tight text-slate-400">
                                                    Edit </a>
                                                <form action="{{ route('distributor.destroy', $distributor->id) }}"
                                                    method="post" class="m-0">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-sm font-semibold leading-tight text-red-400">
                                                        Delete </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="7" class="w-full py-4 text-lg font-semibold text-center">Tidak Ada
                                            Data
                                        </td>
                                    @endforelse
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

                // Select the HTML table element
                var table = $('#table-data').clone();
                table.prepend("<span class='px-6 my-8 text-lg font-bold'>Laporan Distributor</span>")
                // Remove the column with the 'action' class
                table.find('.action').remove();

                // Convert the table to PDF
                html2pdf()
                    .from(table[0])
                    .save('Laporan Distributor.pdf');
            }
        })
    </script>
@endsection
