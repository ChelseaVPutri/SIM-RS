<div class="flex-1">
    <div class="mx-auto max-w-8xl px-4 py-8 sm:px-6 lg:px-8"
    x-data="{ 
        showModal: false,
        currentShift: '',
        currentShiftTime: '',
        weekDates: [],

        init() {
            this.updateClock();
            this.calculateWeekDates();
            setInterval(() => this.updateClock(), 1000);
        },

        updateClock() {
            const now = new Date();
            const hour = now.getHours();

            if (hour >= 0 && hour < 8) {
                this.currentShift = 'Shift Pagi';
                this.currentShiftTime = '00:00 - 08:00';
            } else if (hour >= 8 && hour < 15) {
                this.currentShift = 'Shift Siang';
                this.currentShiftTime = '08:00 - 15:00';
            } else {
                this.currentShift = 'Shift Malam';
                this.currentShiftTime = '15:00 - 00:00';
            }
        },

        calculateWeekDates() {
            let curr = new Date();
            let first = curr.getDate() - curr.getDay() + (curr.getDay() == 0 ? -6 : 1);

            let days = [];
            for (let i = 0; i < 7; i++) {
                let next = new Date(curr.setDate(first + i));
                days.push(next.toISOString().slice(0, 10)); // format y-m-d
                curr = new Date(); // reset curr
            }
            this.weekDates = days;
        },

        openModal(dayIndex) {
            let selectedDate = this.weekDates[dayIndex];
            this.showModal = true;
            Livewire.dispatch('update-tanggal-modal', { tanggal: selectedDate });
        }
     }">
        
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
                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg gap-2 bg-blue-100 text-blue-700"
                            :class="{
                                'bg-teal-100 text-teal-700': currentShift === 'Shift Pagi',
                                'bg-blue-100 text-blue-700': currentShift === 'Shift Siang',
                                'bg-indigo-100 text-indigo-700': currentShift === 'Shift Malam'
                            }">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="m15.3 16.7l1.4-1.4l-3.7-3.7V7h-2v5.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.325 0 5.663-2.337T20 12t-2.337-5.663T12 4T6.337 6.338T4 12t2.338 5.663T12 20"/>
                                </svg>
                                <span x-text="currentShift + ' (' + currentShiftTime + ')'"></span>
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
                            <livewire:pegawai-table-dashboard tableName="mainTable" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Status Card - End --}}

        {{-- Jadwal Mingguan - Start --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold tracking-tight text-[#111318] sm:text-3xl">
                Jadwal Mingguan
            </h2>
            <p class="mt-1 text-base text-[#616f89]">
                Pilih kartu hari untuk melihat detail lengkap.
            </p>
        </div>
        {{-- Jadwal Mingguan - End --}}

        {{-- Day Card - Start --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            {{-- Senin --}}
            <div @click="openModal(0)" class="group cursor-pointer overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:border-primary hover:shadow-lg">
                <div class="flex h-ful flex-col justify-between p-6">
                    {{-- Badge and Icon --}}
                    <div class="flex items-center justify-between">
                        {{-- Badge --}}
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-blue-100 text-blue-700">
                            Hari Kerja
                        </span>

                        {{-- Icon --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-gray-400 group-hover:text-primary">
                                <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Nama Hari --}}
                    <div class="mt-4 ml-1">
                        <h3 class="text-2xl font-bold text-[#111318]">
                            Senin
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="weekDates[0]"></p>
                    </div>
                </div>
            </div>

            {{-- Selasa --}}
            <div @click="openModal(1)" class="group cursor-pointer overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:border-primary hover:shadow-lg">
                <div class="flex h-ful flex-col justify-between p-6">
                    {{-- Badge and Icon --}}
                    <div class="flex items-center justify-between">
                        {{-- Badge --}}
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-blue-100 text-blue-700">
                            Hari Kerja
                        </span>

                        {{-- Icon --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-gray-400 group-hover:text-primary">
                                <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Nama Hari --}}
                    <div class="mt-4 ml-1">
                        <h3 class="text-2xl font-bold text-[#111318]">
                            Selasa
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="weekDates[1]"></p>
                    </div>
                </div>
            </div>

            {{-- Rabu --}}
            <div @click="openModal(2)" class="group cursor-pointer overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:border-primary hover:shadow-lg">
                <div class="flex h-ful flex-col justify-between p-6">
                    {{-- Badge and Icon --}}
                    <div class="flex items-center justify-between">
                        {{-- Badge --}}
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-blue-100 text-blue-700">
                            Hari Kerja
                        </span>

                        {{-- Icon --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-gray-400 group-hover:text-primary">
                                <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Nama Hari --}}
                    <div class="mt-4 ml-1">
                        <h3 class="text-2xl font-bold text-[#111318]">
                            Rabu
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="weekDates[2]"></p>
                    </div>
                </div>
            </div>

            {{-- Kamis --}}
            <div @click="openModal(3)" class="group cursor-pointer overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:border-primary hover:shadow-lg">
                <div class="flex h-ful flex-col justify-between p-6">
                    {{-- Badge and Icon --}}
                    <div class="flex items-center justify-between">
                        {{-- Badge --}}
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-blue-100 text-blue-700">
                            Hari Kerja
                        </span>

                        {{-- Icon --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-gray-400 group-hover:text-primary">
                                <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Nama Hari --}}
                    <div class="mt-4 ml-1">
                        <h3 class="text-2xl font-bold text-[#111318]">
                            Kamis
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="weekDates[3]"></p>
                    </div>
                </div>
            </div>

            {{-- Jumat --}}
            <div @click="openModal(4)" class="group cursor-pointer overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:border-primary hover:shadow-lg">
                <div class="flex h-ful flex-col justify-between p-6">
                    {{-- Badge and Icon --}}
                    <div class="flex items-center justify-between">
                        {{-- Badge --}}
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-blue-100 text-blue-700">
                            Hari Kerja
                        </span>

                        {{-- Icon --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-gray-400 group-hover:text-primary">
                                <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Nama Hari --}}
                    <div class="mt-4 ml-1">
                        <h3 class="text-2xl font-bold text-[#111318]">
                            Jumat
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="weekDates[4]"></p>
                    </div>
                </div>
            </div>

            {{-- Sabtu --}}
            <div @click="openModal(5)" class="group cursor-pointer overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:border-primary hover:shadow-lg">
                <div class="flex h-ful flex-col justify-between p-6">
                    {{-- Badge and Icon --}}
                    <div class="flex items-center justify-between">
                        {{-- Badge --}}
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-orange-100 text-orange-600">
                            Akhir Pekan
                        </span>

                        {{-- Icon --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-gray-400 group-hover:text-primary">
                                <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Nama Hari --}}
                    <div class="mt-4 ml-1">
                        <h3 class="text-2xl font-bold text-[#111318]">
                            Sabtu
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="weekDates[5]"></p>
                    </div>
                </div>
            </div>

            {{-- Minggu --}}
             <div @click="openModal(6)" class="group cursor-pointer overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:border-primary hover:shadow-lg">
                <div class="flex h-ful flex-col justify-between p-6">
                    {{-- Badge and Icon --}}
                    <div class="flex items-center justify-between">
                        {{-- Badge --}}
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-lg bg-orange-100 text-orange-600">
                            Akhir Pekan
                        </span>

                        {{-- Icon --}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-gray-400 group-hover:text-primary">
                                <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Nama Hari --}}
                    <div class="mt-4 ml-1">
                        <h3 class="text-2xl font-bold text-[#111318]">
                            Minggu
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="weekDates[6]"></p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Day Card - End --}}

        {{-- Modal - Start --}}
        <div x-show="showModal" x-clock class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            {{-- Backdrop --}}
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/75 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>

            {{-- Modal Wrapper --}}
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    {{-- Modal Content --}}
                    <div @click.outside="showModal = false" x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                        {{-- Header --}}
                        <div class="flex items-center justify-between border-b border-gray-200 px-4 py-4 sm:px-6">
                            {{-- Icon and Title --}}
                            <div class="flex items-center gap-3">
                                {{-- Icon --}}
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" class="text-primary">
                                            <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6zm7 6q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m-4 0q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m8 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14m-4 4q-.425 0-.712-.288T11 17t.288-.712T12 16t.713.288T13 17t-.288.713T12 18m-4 0q-.425 0-.712-.288T7 17t.288-.712T8 16t.713.288T9 17t-.288.713T8 18m8 0q-.425 0-.712-.288T15 17t.288-.712T16 16t.713.288T17 17t-.288.713T16 18"/>
                                        </svg>
                                    </span>
                                </div>
        
                                {{-- Header Title --}}
                                <div>
                                    <h3 id="modal-title" class="text-lg font-bold leading-6 text-gray-900">
                                        Detail Jadwal
                                    </h3>
                                </div>
                            </div>

                            {{-- Close Icon --}}
                            <button @click="showModal = false" type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m12 13.4l-2.917 2.925q-.277.275-.704.275t-.704-.275q-.275-.275-.275-.7t.275-.7L10.6 12L7.675 9.108Q7.4 8.831 7.4 8.404t.275-.704q.275-.275.7-.275t.7.275L12 10.625L14.892 7.7q.277-.275.704-.275t.704.275q.3.3.3.713t-.3.687L13.375 12l2.925 2.917q.275.277.275.704t-.275.704q-.3.3-.712.3t-.688-.3z"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
        
                        {{-- Body --}}
                        <div class="px-4 py-5 sm:p-6">
                            <livewire:pegawai-table-dashboard tableName="modalTable" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- Modal - End --}}
    </div>
</div>
