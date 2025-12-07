<div class="flex-1 w-full max-w-8xl mx-auto px-4 py-8">
    
    {{-- Page Header Title - Start --}}
    <div class="mb-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-[#111318] sm:text-3xl">
                Daftar Perawat Aktif
            </h2>
        </div>
    </div>
    {{-- Page Header Title - End --}}

    {{-- Status Card - Start --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        {{-- Total Perawat --}}
        <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm flex items-center gap-4">
            {{-- Logo --}}
            <div class="p-3 rounded-full bg-blue-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-blue-500">
                    <path fill="currentColor" d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM8.125 16H15.9q-.25-.5-1.388-.875T12 14.75t-2.512.375T8.125 16M4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12m0-2q.425 0 .713-.288T13 9t-.288-.712T12 8t-.712.288T11 9t.288.713T12 10m0-1"/>
                </svg>
            </div>

            {{-- Text --}}
            <div>
                <p class="text-sm font-medium text-gray-500">
                    Total Perawat
                </p>
                <p class="text-lg font-bold text-gray-900">
                    {{ $total_pegawai_count }}
                </p>
            </div>
        </div>

        {{-- Status Aktif --}}
        <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm flex items-center gap-4">
            {{-- Logo --}}
            <div class="p-3 rounded-full bg-green-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" class="text-green-600">
                    <path fill="currentColor" d="M17.55 12L14 8.45l1.425-1.4l2.125 2.125l4.25-4.25l1.4 1.425zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m-8 8v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm2-2h12v-.8q0-.275-.137-.5t-.363-.35q-1.35-.675-2.725-1.012T9 15t-2.775.338T3.5 16.35q-.225.125-.363.35T3 17.2zm6-8q.825 0 1.413-.587T11 8t-.587-1.412T9 6t-1.412.588T7 8t.588 1.413T9 10m0-2"/>
                </svg>
            </div>

            {{-- Text --}}
            <div>
                <p class="text-sm font-medium text-gray-500">
                    Perawat Aktif
                </p>
                <p class="text-lg font-bold text-gray-900">
                    {{ $total_pegawai_aktif_count }}
                </p>
            </div>
        </div>

        {{-- Sedang Cuti --}}
        <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm flex items-center gap-4">
            {{-- Logo --}}
            <div class="p-3 rounded-full bg-yellow-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-yellow-600">
                    <path fill="currentColor" d="m9.7 18.7l-1.4-1.4l2.3-2.3l-2.3-2.3l1.4-1.4l2.3 2.3l2.3-2.3l1.4 1.4l-2.3 2.3l2.3 2.3l-1.4 1.4l-2.3-2.3zM5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6z"/>
                </svg>
            </div>

            {{-- Text --}}
            <div>
                <p class="text-sm font-medium text-gray-500">
                    Sedang Cuti
                </p>
                <p class="text-lg font-bold text-gray-900">
                    {{ $total_pegawai_cuti_count }}
                </p>
            </div>
        </div>
    </div>
    {{-- Status Card - End --}}

    {{-- Main Content - Start --}}
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden p-3">
        <livewire:daftar-pegawai-table />
    </div>
    {{-- Main Content - End --}}

</div>
