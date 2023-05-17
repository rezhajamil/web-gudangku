<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('home') }}">
            @if (auth()->user()->role == 'company')
                <div class="flex items-center gap-x-2">
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="" class="w-8 h-8">
                    <div>
                        <span
                            class="block ml-1 text-lg font-semibold transition-all duration-200 ease-nav-brand">GUDANGKU</span>
                        <span
                            class="block ml-1 text-sm transition-all duration-200 ease-nav-brand">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            @else
                @if (auth()->user()->role == 'worker')
                    <div class="flex items-center gap-x-2">
                        <img src="{{ asset('storage/' .auth()->user()->with(['company'])->company->avatar) }}"
                            alt="" class="w-8 h-8">
                        <div>
                            <span
                                class="block ml-1 text-lg font-semibold transition-all duration-200 ease-nav-brand">GUDANGKU</span>
                            <span
                                class="block ml-1 text-sm transition-all duration-200 ease-nav-brand">{{ auth()->user()->with(['company'])->company->name }}</span>
                        </div>
                    </div>
                @else<div class="flex items-center gap-x-2">
                        <span
                            class="block ml-1 text-lg font-semibold transition-all duration-200 ease-nav-brand">GUDANGKU</span>
                    </div>
                @endif
            @endif
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent " />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="py-2.7 bg-blue-500/13 text-sm cursor-pointer ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                    href="{{ route('home') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i> --}}
                        <i class="mr-2 font-semibold text-blue-600 fa-solid fa-desktop"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-blue-500/20 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('product.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                        <i class="mr-2 font-semibold text-orange-600 fa-solid fa-box-open"></i>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(1) == 'product') text-orange-600 font-bold @endif">Data
                        Barang</span>
                </a>
            </li>

            @if (auth()->user()->role == 'company')
                <li class="mt-0.5 w-full">
                    <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-blue-500/20 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('distributor.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                            <i class="mr-2 font-semibold text-teal-600 fa-solid fa-warehouse"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(1) == 'distributor') text-teal-600 font-bold @endif">Data
                            Distributor</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-blue-500/20 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('user.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                            <i class="mr-2 font-semibold text-indigo-600 fa-solid fa-users"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(1) == 'user') text-indigo-600 font-bold @endif">Data
                            Pegawai</span>
                    </a>
                </li>
            @endif
            <li class="mt-0.5 w-full">
                <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-blue-500/20 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('stock_in.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                        <i class="mr-2 font-semibold text-green-600 fa-solid fa-arrows-down-to-line"></i>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(1) == 'stock_in') text-green-600 font-bold @endif">Barang
                        Masuk</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-blue-500/20 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('stock_out.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                        <i class="mr-2 font-semibold text-red-600 fa-solid fa-arrows-up-to-line"></i>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(1) == 'stock_out') text-red-600 font-bold @endif">Barang
                        Keluar</span>
                </a>
            </li>
        </ul>
    </div>

</aside>
