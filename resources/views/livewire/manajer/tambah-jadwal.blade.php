<div class="flex-1 w-full max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Page Header - Start --}}
    <div>
        <h2 class="text-2xl font-bold tracking-tight text-[#111318]">
            Kelola Jadwal Shift
        </h2>
        <p class="mt-1 text-base text-[#616f89]">
            Tambahkan atau ubah jadwal jaga perawat.
        </p>
    </div>
    {{-- Page Header - End --}}

    {{-- Main Content - Start --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-5">
        {{-- Left Section --}}
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden sticky top-24">
            {{-- Title --}}
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-primary">
                        <path fill="currentColor" d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4zm1 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/>
                    </svg>
                    Tambah Jadwal
                </h3>
            </div>

            {{-- Form --}}
            <form wire:submit="save" class="p-6 space-y-5">
                {{-- Tanggal Tugas --}}
                <div>
                    <label for="date" class="block text-sm font-semibold text-gray-700 mb-1">
                        Tanggal Tugas
                    </label>
                    <div class="relative">
                        <input type="date" id="date" wire:model="tanggal" class="w-full rounded-lg border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-primary focus:ring-primary sm:text-sm" required>
                    </div>
                </div>

                {{-- Department --}}
                <div>
                    <label for="employee" class="block text-sm font-semibold text-gray-700 mb-1">
                        Department
                    </label>
                    <select id="department" wire:model.live="department_id" class="w-full rounded-lg border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-primary focus:ring-primary sm:text-sm" required>
                        <option value="" disabled selected>
                            Pilih Department
                        </option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">
                                {{ $dept->nama_department ?? $dept->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <span class="text-red-500 text-xs">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Pilih Pegawai --}}
                <div>
                    <label for="employee" class="block text-sm font-semibold text-gray-700 mb-1">
                        Nama Pegawai
                    </label>
                    <select id="employee" wire:model="pegawai_id" class="w-full rounded-lg border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-primary focus:ring-primary sm:text-sm" required>
                        <option value="" disabled selected>
                            Pilih Perawat
                        </option>
                        @foreach ($this->pegawaiOptions as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama_lengkap }} - {{ $p->nip }}
                            </option>
                        @endforeach
                    </select>
                    @if (empty($department_id))
                        <p class="text-xs text-red-500 mt-1">
                            Pilih department terlebih dahulu
                        </p>
                    @endif
                    @error('pegawai_id')
                        <span class="text-red-500 text-xs">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Shift --}}
                <div>
                    <label for="" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Shift
                    </label>
                    <div class="grid grid-cols-1 gap-3">
                        @foreach ($shifts as $shift)
                            <label wire:key="shift-{{ $shift->id }}" class="relative flex cursor-pointer rounded-lg border bg-white p-3 shadow-sm focus:outline-none hover:border-primary/50 transition-all has-checked:border-primary has-checked:ring-1 has-checked:ring-primary   {{ $shift_id == $shift->id ? 'border-primary ring-1 ring-primary' : 'border-gray-200' }}">
                                <input type="radio" wire:model.live="shift_id" name="shift_group" value="{{ $shift->id }}" class="sr-only">
                                <span class="flex flex-1">
                                    <span class="flex flex-col">
                                        <span class="block text-sm font-medium text-gray-900">
                                            {{ $shift->nama_shift }}
                                        </span>
                                        <span class="mt-1 flex items-center text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($shift->waktu_mulai)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($shift->waktu_selesai)->format('H:i') }} WIB
                                        </span>
                                    </span>
                                </span>

                                <span>
                                    @if(stripos($shift->nama_shift, 'Pagi') !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024" class="text-teal-400"><path fill="currentColor" d="M32 768h960a32 32 0 1 1 0 64H32a32 32 0 1 1 0-64m129.408-96a352 352 0 0 1 701.184 0h-64.32a288 288 0 0 0-572.544 0zM512 128a32 32 0 0 1 32 32v96a32 32 0 0 1-64 0v-96a32 32 0 0 1 32-32m407.296 168.704a32 32 0 0 1 0 45.248l-67.84 67.84a32 32 0 1 1-45.248-45.248l67.84-67.84a32 32 0 0 1 45.248 0m-814.592 0a32 32 0 0 1 45.248 0l67.84 67.84a32 32 0 1 1-45.248 45.248l-67.84-67.84a32 32 0 0 1 0-45.248"/></svg>
                                    @elseif(stripos($shift->nama_shift, 'Siang') !== false)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-orange-400"><path fill="currentColor" d="M11 4V1h2v3zm0 19v-3h2v3zm9-10v-2h3v2zM1 13v-2h3v2zm17.7-6.3l-1.4-1.4l1.75-1.8l1.45 1.45zM4.95 20.5L3.5 19.05l1.8-1.75l1.4 1.4zm14.1 0l-1.75-1.8l1.4-1.4l1.8 1.75zM5.3 6.7L3.5 4.95L4.95 3.5L6.7 5.3zM12 18q-2.5 0-4.25-1.75T6 12t1.75-4.25T12 6t4.25 1.75T18 12t-1.75 4.25T12 18m0-2q1.675 0 2.838-1.162T16 12t-1.162-2.838T12 8T9.162 9.163T8 12t1.163 2.838T12 16m0-4"/></svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-indigo-400"><path fill="currentColor" d="M12 21q-3.75 0-6.375-2.625T3 12t2.625-6.375T12 3q.35 0 .688.025t.662.075q-1.025.725-1.638 1.888T11.1 7.5q0 2.25 1.575 3.825T16.5 12.9q1.375 0 2.525-.613T20.9 10.65q.05.325.075.662T21 12q0 3.75-2.625 6.375T12 21m0-2q2.2 0 3.95-1.213t2.55-3.162q-.5.125-1 .2t-1 .075q-3.075 0-5.238-2.163T9.1 7.5q0-.5.075-1t.2-1q-1.95.8-3.163 2.55T5 12q0 2.9 2.05 4.95T12 19m-.25-6.75"/></svg>
                                    @endif
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('shift_id')
                        <span class="text-red-500 text-xs">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center items-center gap-2 rounded-lg bg-primary py-3 px-4 text-sm font-bold text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z"/>
                            </svg>
                        </span>
                        <span wire:loading.remove>Simpan Jadwal</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Right Section --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Status Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Jadwal Baru --}}
                <div class="w-full bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center gap-4">
                    {{-- Logo --}}
                    <div class="p-3 rounded-lg bg-green-100 text-green-600">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.2q.325-.9 1.088-1.45T12 1t1.713.55T14.8 3H19q.825 0 1.413.588T21 5v6.7q-.475-.225-.975-.387T19 11.075V5H5v14h6.05q.075.55.238 1.05t.387.95zm0-3v1V5v6.075V11zm2-1h4.075q.075-.525.238-1.025t.362-.975H7zm0-4h6.1q.8-.75 1.788-1.25T17 11.075V11H7zm0-4h10V7H7zm5-4.75q.325 0 .538-.213t.212-.537t-.213-.537T12 2.75t-.537.213t-.213.537t.213.538t.537.212M18 23q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23m-.5-2h1v-2.5H21v-1h-2.5V15h-1v2.5H15v1h2.5z"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Text --}}
                    <div>
                        <p class="text-sm text-gray-500">
                            Jadwal Baru
                        </p>
                        <p class="text-xl font-bold text-gray-900">
                            {{ $jadwal_baru_count }}
                        </p>
                    </div>
                </div>

                {{-- Total Pegawai --}}
                <div class="w-full bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center gap-4">
                    {{-- Logo --}}
                    <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M10.275 12q-.7 0-1.15-.525T8.8 10.25l.3-1.8q.2-1.075 1.013-1.763T12 6q1.1 0 1.913.688t1.012 1.762l.3 1.8q.125.7-.325 1.225T13.75 12zm.6-2h2.275l-.2-1.225q-.05-.35-.325-.562T12 8t-.612.213t-.313.562zM3.1 12.975q-.575.025-.988-.225t-.537-.775q-.05-.225-.025-.45t.125-.425q0 .025-.025-.1q-.05-.05-.25-.6q-.05-.3.075-.575T1.8 9.35l.05-.05q.05-.475.388-.8t.837-.325q.075 0 .475.1l.075-.025q.125-.125.325-.187T4.375 8q.275 0 .488.088t.337.262q.025 0 .038.013t.037.012q.35.025.612.212t.388.513q.05.175.038.338t-.063.312q0 .025.025.1q.175.175.275.388t.1.437q0 .1-.15.525q-.025.05 0 .1l.05.4q0 .525-.437.9t-1.063.375zM20 13q-.825 0-1.412-.587T18 11q0-.3.088-.562t.237-.513l-.7-.625q-.25-.2-.088-.5T18 8.5h2q.825 0 1.413.588T22 10.5v.5q0 .825-.587 1.413T20 13M0 18v-1.575q0-1.1 1.113-1.763T4 14q.325 0 .625.013t.575.062q-.35.5-.525 1.075T4.5 16.375V18zm6 0v-1.625q0-1.625 1.663-2.625t4.337-1q2.7 0 4.35 1T18 16.375V18zm14-4q1.8 0 2.9.663t1.1 1.762V18h-4.5v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14m-8 .75q-1.425 0-2.55.375T8.125 16H15.9q-.225-.5-1.338-.875T12 14.75M12.025 9"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Text --}}
                    <div>
                        <p class="text-sm text-gray-500">
                            Total Pegawai
                        </p>
                        <p class="text-xl font-bold text-gray-900">
                            {{ $total_pegawai_count }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Table Container --}}
            <div class="bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">
                {{-- Header --}}
                <div class="px-5 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Jadwal Baru Ditambahkan
                    </h3>
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-[#E5E5E5] text-[#808080]">
                        Hari Ini
                    </span>
                </div>

                {{-- Table --}}
                <div class="p-3">
                    <livewire:jadwal-table />
                </div>
            </div>
        </div>
    </div>
    {{-- Main Content - End --}}

    {{-- Toast - Start --}}
    <div 
        x-data="{ show: false, message: '' }" 
        x-on:show-toast.window="
            show = true; 
            message = $event.detail.message; 
            setTimeout(() => show = false, 3000)
        "
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave-end="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
        class="fixed bottom-5 right-5 z-50 flex w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg border border-gray-100"
        style="display: none;">
            <div class="w-1.5 bg-green-500"></div>

            <div class="flex items-center flex-1 p-4">
                <div class="shrink-0">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-green-100 text-green-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                </div>

                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-gray-900" x-text="message"></p>
                </div>

                <button @click="show = false" class="ml-4 shrink-0 text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
    </div>
    {{-- Toast - End --}}
</div>
