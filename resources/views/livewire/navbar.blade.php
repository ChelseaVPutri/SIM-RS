<nav class="bg-linear-to-r from-primary-blue to-primary-green w-full sticky top-0 shadow-md">
    <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
        {{-- Nama Aplikasi --}}
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center bg-white/20 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" class="text-white">
                    <path fill="currentColor" d="M10.5 17h3v-3.5H17v-3h-3.5V7h-3v3.5H7v3h3.5zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zM5 5v14z"/>
                </svg>
            </div>
            <h1 class="font-display text-xl font-bold text-white">MediShift</h1>
        </div>

        {{-- Button --}}
        <div class="flex items-center gap-4">
            <div class="group relative">
                {{-- Hamburger Button --}}
                <button class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                {{-- Menu List --}}
                <div class="absolute right-0 mt-2 w-56 origin-top-right scale-95 transform rounded-lg bg-white opacity-0 shadow-lg ring-opacity-5 transition-all duration-200 ease-in-out group-hover:scale-100 group-hover:opacity-100" role="menu">
                    <div class="py-1">
                        <a href="" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-[#111318] hover:bg-gray-100">
                            <span>Tambah Jadwal</span>
                        </a>
                        <a href="" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-[#111318] hover:bg-gray-100">
                            <span>Daftar Pegawai</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
