<div class="relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-linear-to-br from-primary-blue to-primary-green p-4 md:p-6 lg:p-8">
    <div class="w-full max-w-md">
        {{-- Logo dan Nama Aplikasi - Start --}}
        <div class="mb-8 flex flex-col items-center">
            <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" class="text-white">
                    <path fill="currentColor" d="M10.5 17h3v-3.5H17v-3h-3.5V7h-3v3.5H7v3h3.5zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zM5 5v14z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">MediShift</h1>
        </div>
        {{-- Logo dan Nama Aplikasi - End --}}

        {{-- Login Form - Start --}}
        <div class="rounded-xl bg-white shadow-2xl">
            <div class="p-8 sm:p-10">
                <form wire:submit.prevent="login">
                    <div class="flex flex-col gap-4">
                        {{-- Nomor Induk Pegawai --}}
                        <div class="flex flex-col">
                            <label for="nip" class="flex flex-col min-w-40 flex-1">
                                <p class="text-black text-sm font-medium leading-normal pb-2">
                                    Nomor Induk Pegawai
                                </p>
                                <input wire:model="nip" type="text" class="form-input flex-w-full min-w-0 flex-1 resize-none overflow-hidden rounded-md text-black ocus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbdfe6] px-4 py-2 text-base font-normal leading-normal" placeholder="Masukkan NIP Anda">
                            </label>
                            @error('nip')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="flex flex-col">
                            <label for="" class="flex flex-col min-w-40 flex-1">
                                <p class="text-black text-sm font-medium leading-normal pb-2">
                                    Password
                                </p>
                                <input wire:model="password" type="password" class="form-input flex-w-full min-w-0 flex-1 resize-none overflow-hidden rounded-md text-black ocus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbdfe6] px-4 py-2 text-base font-normal leading-normal" placeholder="Masukkan password">
                            </label>
                            @error('password') 
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
                            @enderror
                        </div>

                        {{-- Login Button --}}
                        <div class="pt-4">
                            <button type="submit" class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-md h-12 px-5 bg-primary-blue text-white font-bold leading-normal hover:bg-primary-blue/90 focus:outline-none focus:ring-2 focus:ring-offset-2">
                                Login
                            </button>
                        </div>
                    </div>
                </form>   
            </div>
        </div>
        {{-- Login Form - End --}}
    </div>
</div>
