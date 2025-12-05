<div class="flex-1">
    <div class="mx-auto max-w-8xl px-4 py-8 sm:px-6 lg:px-8">
        
        {{-- Status Card - Start --}}
        <div class="mb-8 overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-gray-900/5">
            {{-- Header --}}
            <div class="bg-linear-to-r from-slate-900 to-slate-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        {{-- Green Icon --}}
                        <div class="relative flex h-3 w-3">
                            <span class="live-indicator absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
                        </div>
                        {{-- Text --}}
                        <h3 class="text-base font-semibold text-white tracking-wide uppercase">
                            Status Jaga Saat Ini
                        </h3>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                    {{-- Left Section - Current Date and Time --}}
                    <div class="flex-1"
                    x-data="{
                        time: '',
                        date: '',
                        init() {
                            this.updateClock();
                            setInterval(() => this.updateClock(), 1000);
                        },
                        updateClock() {
                            const now = new Date();

                            this.time = now.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: false
                            }).replace('.', ':');

                            this.date = now.toLocaleDateString('id-ID', {
                                weekday: 'long',
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });
                        }
                    }">
                        {{-- Current Time --}}
                        <div class="flex items-baseline gap-2">
                            <h2 x-text="time" class="text-4xl font-bold tracking-tight text-gray-900 font-mono">
                                --:--
                            </h2>
                            <span class="text-xl font-medium text-gray-500">
                                WIB
                            </span>
                        </div>

                        {{-- Current Date --}}
                        <p x-text="date" class="text-lg font-medium text-primary mt-1">-- --- ----</p>

                        {{-- Current Shift --}}
                        <div class="mt-4">
                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg gap-2 bg-blue-100 text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="m15.3 16.7l1.4-1.4l-3.7-3.7V7h-2v5.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.325 0 5.663-2.337T20 12t-2.337-5.663T12 4T6.337 6.338T4 12t2.338 5.663T12 20"/>
                                </svg>
                                Shift Siang (15:00 - 23:00)
                            </span>
                        </div>
                    </div>

                    {{-- Right Section - Current Employee --}}
                    <div class="flex-[1.5] border-l border-gray-200 pl-0 md:pl-6 ">
                        {{-- Text --}}
                        <p class="mb-3 text-sm font-medium text-gray-500">
                            Tim Medis Bertugas (Sesuai Jadwal):
                        </p>

                        {{-- Employee List --}}
                        <div class="w-full">
                            {{-- Employee 1 --}}
                           
                            <livewire:pegawai-table />
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Status Card - End --}}

    </div>
</div>
