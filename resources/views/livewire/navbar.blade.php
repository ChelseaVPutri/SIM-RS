<nav class="bg-linear-to-r from-[#26619C] to-[#2A9D8F] w-full sticky top-0 shadow-md">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        {{-- Nama Aplikasi --}}
        <div class="flex items-center gap-4">
            <div class="flex h-10 w-10 items-center">
                <h1 class="font-display text-xl font-bold text-white">SI-SHIFTRS</h1>
            </div>
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
