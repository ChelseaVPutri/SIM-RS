<nav class="bg-linear-to-r from-primary-blue to-primary-green w-full sticky top-0 shadow-md z-50">
    <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
        {{-- Nama Aplikasi - Start --}}
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center bg-white/20 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" class="text-white">
                    <path fill="currentColor" d="M10.5 17h3v-3.5H17v-3h-3.5V7h-3v3.5H7v3h3.5zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zM5 5v14z"/>
                </svg>
            </div>
            <h1 class="font-display text-xl font-bold text-white">MediShift</h1>
        </div>
        {{-- Nama Aplikasi - End --}}

        {{-- Button - Start --}}
        <div class="flex items-center gap-4">
            <div class="group relative">
                {{-- Hamburger Button --}}
                <button class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                {{-- Menu List --}}
                <div class="absolute right-0 mt-2 w-56 origin-top-right scale-95 transform rounded-lg bg-white opacity-0 shadow-lg ring-opacity-5 transition-all duration-200 ease-in-out group-hover:scale-100 group-hover:opacity-100" role="menu">
                    <div class="py-1">
                        {{-- Dashboard --}}
                        <a href="{{ route('manajer-dashboard') }}" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-[#111318] hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M15 20v-7h7v7zm-4-9V4h11v7zm-9 9v-7h11v7zm0-9V4h7v7zm11-2h7V6h-7zm-9 9h7v-3H4zm13 0h3v-3h-3zM4 9h3V6H4zm3 0"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        {{-- Tambah Jadwal --}}
                        <a href="" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-[#111318] hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-gray-700">
                                <path fill="currentColor" d="M17 22v-3h-3v-2h3v-3h2v3h3v2h-3v3zM5 20q-.825 0-1.412-.587T3 18V6q0-.825.588-1.412T5 4h1V2h2v2h6V2h2v2h1q.825 0 1.413.588T19 6v6.1q-.5-.075-1-.075t-1 .075V10H5v8h7q0 .5.075 1t.275 1z"/>
                            </svg>
                            <span>Tambah Jadwal</span>
                        </a>

                        {{-- Daftar Pegawai --}}
                        <a href="{{ route('daftar-pegawai') }}" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-[#111318] hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM8.125 16H15.9q-.25-.5-1.388-.875T12 14.75t-2.512.375T8.125 16M4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12m0-2q.425 0 .713-.288T13 9t-.288-.712T12 8t-.712.288T11 9t.288.713T12 10m0-1"/>
                            </svg>
                            <span>Daftar Pegawai</span>
                        </a>

                        {{-- Keluar --}}
                        <a wire:click="logout" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-[#111318] hover:bg-gray-100 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M13.53 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72H20a.75.75 0 0 0 0-1.5h-8.19l1.72-1.72a.75.75 0 0 0 0-1.06" opacity=".5"/>
                                <path fill="currentColor" d="M9.768 3.25h2.464c.813 0 1.469 0 2 .043c.546.045 1.026.14 1.47.366a3.75 3.75 0 0 1 1.64 1.639c.226.444.32.924.365 1.47c.043.531.043 1.187.043 2V9a.75.75 0 0 1-1.5 0v-.2c0-.852 0-1.447-.038-1.91c-.038-.453-.107-.714-.207-.911a2.25 2.25 0 0 0-.983-.984c-.198-.1-.459-.17-.913-.207c-.462-.037-1.056-.038-1.909-.038H9.8c-.852 0-1.447 0-1.91.038c-.453.037-.714.107-.911.207a2.25 2.25 0 0 0-.984.984c-.1.197-.17.458-.207.912c-.037.462-.038 1.057-.038 1.909v6.4c0 .852 0 1.447.038 1.91c.037.453.107.714.207.912c.216.423.56.767.984.983c.197.1.458.17.912.207c.462.037 1.057.038 1.909.038h2.4c.853 0 1.447 0 1.91-.038c.453-.038.714-.107.912-.207c.423-.216.767-.56.983-.983c.1-.198.17-.459.207-.913c.037-.462.038-1.057.038-1.909V15a.75.75 0 0 1 1.5 0v.232c0 .813 0 1.469-.043 2c-.045.546-.14 1.026-.366 1.47a3.75 3.75 0 0 1-1.639 1.64c-.444.226-.924.32-1.47.365c-.531.043-1.187.043-2 .043H9.768c-.813 0-1.469 0-2-.043c-.546-.045-1.026-.14-1.47-.366a3.75 3.75 0 0 1-1.64-1.639c-.226-.444-.32-.924-.365-1.47c-.043-.531-.043-1.187-.043-2V8.768c0-.813 0-1.469.043-2c.045-.546.14-1.026.366-1.47a3.75 3.75 0 0 1 1.639-1.64c.444-.226.924-.32 1.47-.365c.531-.043 1.187-.043 2-.043"/>
                            </svg>
                            <span>Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Button - End --}}
    </div>
</nav>
