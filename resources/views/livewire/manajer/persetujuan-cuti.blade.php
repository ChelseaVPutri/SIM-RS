<div class="flex-1 w-ful max-w-8xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    {{-- Page Header - Start --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#111318]">
            Persetujuan Cuti
        </h2>
        {{-- <p class="mt-1 text-base text-[#616f89]">
            Tinjau dan kelola permohonan cuti.
        </p> --}}
    </div>
    {{-- Page Header - End --}}

    {{-- Status Cards - Start --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        {{-- Perlu Persetujuan --}}
        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm flex items-center justify-between relative overflow-hidden">
            {{-- Text --}}
            <div class="relative z-10">
                <p class="text-md font-medium text-gray-500">
                    Perlu Persetujuan
                </p>
                <p class="text-3xl font-bold text-yellow-600">
                    {{ $total_pending }}
                </p>
            </div>

            {{-- Icon --}}
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 relative z-10">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17 22q-2.075 0-3.537-1.463T12 17t1.463-3.537T17 12t3.538 1.463T22 17t-1.463 3.538T17 22m1.675-2.625l.7-.7L17.5 16.8V14h-1v3.2zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.175q.275-.875 1.075-1.437T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v6.25q-.45-.325-.95-.55T19 10.3V5h-2v3H7V5H5v14h5.3q.175.55.4 1.05t.55.95zm7-16q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5"/>
                    </svg>
                </span>
            </div>

            {{-- Outer Circle --}}
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-yellow-50 rounded-full z-0">

            </div>
        </div>

        {{-- Disetujui Bulan Ini --}}
        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm flex items-center justify-between relative overflow-hidden">
            {{-- Text --}}
            <div class="relative z-10">
                <p class="text-md font-medium text-gray-500">
                    Disetujui Bulan Ini
                </p>
                <p class="text-3xl font-bold text-green-600">
                    {{ $total_disetujui }}
                </p>
            </div>

            {{-- Icon --}}
            <div class="p-3 rounded-full bg-green-100 text-green-600 relative z-10">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/>
                    </svg>
                </span>
            </div>

            {{-- Outer Circle --}}
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-green-50 rounded-full z-0">

            </div>
        </div>

        {{-- Ditolak Bulan Ini --}}
        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm flex items-center justify-between relative overflow-hidden">
            {{-- Text --}}
            <div class="relative z-10">
                <p class="text-md font-medium text-gray-500">
                    Ditolak Bulan Ini
                </p>
                <p class="text-3xl font-bold text-red-600">
                    {{ $total_ditolak }}
                </p>
            </div>

            {{-- Icon --}}
            <div class="p-3 rounded-full bg-red-100 text-red-600 relative z-10">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/>
                    </svg>
                </span>
            </div>

            {{-- Outer Circle --}}
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-red-50 rounded-full z-0">

            </div>
        </div>
    </div>
    {{-- Status Cards - End --}}

    {{-- Table Container - Start --}}
    <div class="bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-gray-50/50 gap-4">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-3">
                <span class="text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14v-3h-3q-.75.95-1.787 1.475T12 18t-2.212-.525T8 16H5zm7-3q.95 0 1.725-.55T14.8 14H19V5H5v9h4.2q.3.9 1.075 1.45T12 16m-7 3h14z"/>
                    </svg>
                </span>
                Daftar Permohonan Cuti
            </h3>
        </div>

        {{-- Table --}}
        <div class="p-5">
            <livewire:persetujuan-cuti-table />
        </div>
    </div>
    {{-- Table Container - End --}}

    {{-- Modal - Start --}}
    <div x-data="{ showModal: false, imageUrl: '' }"
         x-on:open-bukti-modal.window="showModal = true; imageUrl = $event.detail.url"
         x-show="showModal"
         style="display: none;"
         class="relative z-999" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <div x-show="showModal" class="fixed inset-0 bg-gray-900/75 transition-opacity backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div @click.outside="showModal = false" x-show="showModal" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="flex items-center justify-between border-b border-gray-200 px-4 py-3">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Bukti Lampiran</h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="bg-gray-50 p-4 flex justify-center items-center min-h-[200px]">
                        <img :src="imageUrl" class="max-w-full max-h-[80vh] rounded shadow-sm object-contain" alt="Bukti Cuti">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal - End --}}
</div>