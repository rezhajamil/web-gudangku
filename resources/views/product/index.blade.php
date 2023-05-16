@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="relative w-6/12 p-4 mx-auto text-white bg-teal-500 rounded-lg shadow-lg">{{ session('success') }}d</div>
    @endif
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div
                        class="flex justify-between p-6 pb-0 mb-2 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-lg uppercase">Data Barang</h6>
                        <div class="flex px-4 gap-x-2">
                            <button id="print"
                                class="p-1 font-bold text-white ease-in-out bg-teal-500 rounded-md hover:bg-teal-700 aspect-square"><i
                                    class="fa-solid fa-print"></i></button>
                            <a href="{{ route('product.create') }}"
                                class="inline-block p-1 font-bold text-center text-white ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700 aspect-square"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 px-6">
                        <form action="{{ route('product.index') }}" method="GET" class="flex items-center gap-x-3">
                            <input type="date" name="start_date" id="start_date"
                                class="p-2 rounded-lg focus:ring-blue-500">
                            <span class="font-semibold">s/d</span>
                            <input type="date" name="end_date" id="end_date" class="p-2 rounded-lg focus:ring-blue-500">
                            <button type="submit"
                                class="p-2 text-white transition-all bg-blue-500 rounded-lg hover:bg-blue-700"><i
                                    class="mr-2 fa-solid fa-calendar-days"></i>Filter Tanggal</button>
                        </form>
                        <div class="flex flex-wrap items-end gap-x-4">
                            <input type="text" name="search" id="search" placeholder="Search..."
                                class="px-2 rounded-lg">
                            <div class="flex flex-col">
                                <select name="search_by" id="search_by" class="h-full px-6 py-2 rounded-lg">
                                    <option value="" selected disabled>Cari Berdasarkan</option>
                                    <option value="code">Kode</option>
                                    <option value="name">Nama</option>
                                    <option value="brand">Brand</option>
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
                                            Kode</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Brand</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Nama</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Stok</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Harga Jual</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 font-semibold text-left capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 action">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $key => $product)
                                        <tr class="">
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-bold leading-tight text-left">
                                                    {{ $key + 1 }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent code">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    {{ $product->code }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent brand">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    {{ $product->brand }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent name">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    {{ $product->name }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent stock">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    {{ $product->stock }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent price">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                                            </td>
                                            <td
                                                class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                @if ($product->status)
                                                    <span
                                                        class="bg-gradient-to-tl w-full from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Aktif</span>
                                                @else
                                                    <span
                                                        class="bg-gradient-to-tl w-full from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Tidak
                                                        Aktif</span>
                                                @endif
                                            </td>
                                            <td
                                                class="flex flex-col px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent action">
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="block text-xs font-semibold leading-tight text-slate-400">
                                                    Edit </a>
                                                <a href="{{ route('product.change_status', ['id' => $product->id]) }}"
                                                    class="block mt-1 text-xs font-semibold leading-tight text-indigo-400">
                                                    Change Status </a>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="post"
                                                    class="m-0">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-xs font-semibold leading-tight text-red-400">
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
                table.prepend("<span class='px-6 my-8 text-lg font-bold'>Laporan Stok Barang</span>")
                // Remove the column with the 'action' class
                table.find('.action').remove();

                // Convert the table to PDF
                html2pdf()
                    .from(table[0])
                    .save('Laporan Stok Barang.pdf');
            }
        })
    </script>
@endsection
