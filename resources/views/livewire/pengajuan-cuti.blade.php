<div class="flex-1 w-full max-w-8xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    {{-- Page Header - Start --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#111318]">
                Pengajuan Cuti
            </h2>
            <p class="mt-1 text-base text-[#616f89]">
                Ajukan permohonan cuti dan pantau status persetujuan.
            </p>
        </div>
    </div>
    {{-- Page Header - End --}}

    {{-- Main Content - Start --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-5">
        {{-- Left Section --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden sticky top-24">
                {{-- Title --}}
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-primary">
                            <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v5h-2v-1H5v10h7v2zM5 8h14V6H5zm0 0V6zm9 14v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.5 5.5zm7.5-6.575l-.925-.925zm-6 5.075h.95l3.025-3.05l-.45-.475l-.475-.45l-3.05 3.025zm3.525-3.525l-.475-.45l.925.925z"/>
                        </svg>
                        Formulir Cuti
                    </h3>
                </div>

                {{-- Form --}}
                <form wire:submit="save" class="p-6 space-y-5">
                    {{-- Jenis Cuti --}}
                    <div>
                        <label for="jenis-cuti" class="block text-sm font-semibold text-gray-700 mb-1">
                            Jenis Cuti
                        </label>
                        <select id="jenis-cuti" wire:model="jenis_cuti" class="w-full rounded-lg border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-primary focus:ring-primary sm:text-sm" required>
                            <option value="" disabled selected>Pilih jenis cuti</option>
                            <option value="Cuti sakit">Cuti sakit</option>
                            <option value="Cuti tahunan">Cuti tahunan</option>
                        </select>
                        @error('jenis_cuti')
                            <span class="text-red-500 text-xs">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div>
                        <label for="tanggal-mulai" class="block text-sm font-semibold text-gray-700 mb-1">
                            Tanggal Mulai
                        </label>
                        <div class="relative">
                            <input type="date" id="tanggal-mulai" wire:model="tanggal_mulai" class="w-full rounded-lg border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-primary focus:ring-primary sm:text-sm" required>
                            @error('tanggal_mulai')
                                <span class="text-red-500 text-xs">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div>
                        <label for="tanggal-selesai" class="block text-sm font-semibold text-gray-700 mb-1">
                            Tanggal Selesai
                        </label>
                        <div class="relative">
                            <input type="date" id="tanggal-selesai" wire:model="tanggal_selesai" class="w-full rounded-lg border-gray-300 bg-white px-3 py-2.5 text-gray-900 focus:border-primary focus:ring-primary sm:text-sm" required>
                            @error('tanggal_selesai')
                                <span class="text-red-500 text-xs">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Alasan Cuti --}}
                    <div>
                        <label for="tanggal-mulai" class="block text-sm font-semibold text-gray-700 mb-1">
                            Alasan Cuti
                        </label>
                        <textarea id="alasan-cuti" wire:model="alasan" rows="
                        3" placeholder="Jelaskan alasan pengajuan cuti Anda..." class="w-full rounded-lg border-gray-300 bg-white px-3 py-2.5 text-gray-900 placeholder:text-gray-500 focus:border-primary focus:ring-primary sm:text-sm resize-none" required></textarea>
                        @error('alasan')
                            <span class="text-red-500 text-xs">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Bukti Foto --}}
                    <div>
                        <label for="alasan-cuti" class="block text-sm font-semibold text-gray-700 mb-1">
                            Bukti Foto / Surat Dokter
                        </label>
                        
                        {{-- Upload Foto --}}
                        <div class="mt-1 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-6 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer relative">
                            <div class="text-center">
                                @if ($bukti_foto)
                                    <p class="text-sm text-blue-600 font-semibold">
                                        File terpilih: {{ $bukti_foto->getClientOriginalName() }}
                                    </p>
                                @else
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-gray-400 mx-auto">
                                            <path fill="currentColor" d="M19.35 10.04A7.49 7.49 0 0 0 12 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 0 0 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5c0-2.64-2.05-4.78-4.65-4.96M19 18H6c-2.21 0-4-1.79-4-4c0-2.05 1.53-3.76 3.56-3.97l1.07-.11l.5-.95A5.47 5.47 0 0 1 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5l1.53.11A2.98 2.98 0 0 1 22 15c0 1.65-1.35 3-3 3M8 13h2.55v3h2.9v-3H16l-4-4z"/>
                                        </svg>
                                    </span>
                                    <div class="mt-2 flex text-sm text-gray-600 justify-center">
                                        <label for="bukti-foto" class="relative cursor-pointer rounded-md font-medium text-primary focus-within:outline-none focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 hover:text-primary/80">
                                            <span>Upload file</span>
                                            <input type="file" id="bukti-foto" wire:model="bukti_foto" class="sr-only" accept="image/*, .pdf">
                                        </label>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        PNG, JPG, PDF up to 5MB
                                    </p>
                                @endif
                                <div wire:loading wire:target="bukti_foto" class="text-xs text-primary mt-2">
                                    Uploading...
                                </div>
                            </div>
                        </div>
                        @error('bukti_foto')
                            <span class="text-red-500 text-xs">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-3">
                        <button type="submit" class="w-full flex justify-center items-center gap-2 rounded-lg bg-primary py-3 px-4 text-sm font-bold text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M3 20V4l19 8zm2-3l11.85-5L5 7v3.5l6 1.5l-6 1.5zm0 0V7z"/>
                                </svg>
                            </span>
                            Ajukan Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Right Section --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Status Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                {{-- Total Cuti Tahun Ini --}}
                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">
                        Total Cuti Tahun Ini
                    </p>
                    <p class="text-xl font-bold text-gray-900">
                        {{ $total_cuti }} Hari
                    </p>
                </div>

                {{-- Sisa Cuti --}}
                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">
                        Sisa Cuti
                    </p>
                    <p class="text-xl font-bold text-primary">
                        {{ $sisa_cuti ?? 0 }} Hari
                    </p>
                </div>

                {{-- Menuggu --}}
                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">
                        Menuggu
                    </p>
                    <p class="text-xl font-bold text-yellow-600">
                        {{ $pendingCount }}
                    </p>
                </div>

                {{-- Disetujui --}}
                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">
                        Disetujui
                    </p>
                    <p class="text-xl font-bold text-green-600">
                        {{ $approvedCount }}
                    </p>
                </div>
            </div>

            {{-- Table Container --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">
                        Riwayat Pengajuan Cuti
                    </h3>
                </div>

                {{-- Table --}}
                <div>
                    
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
