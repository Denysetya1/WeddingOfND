<div>
    <div id="ucapan" class="fixed flex flex-col justify-center py-12 h-full w-full" >
        <div class="relative py-3 px-4 max-w-xl mx-auto h-full w-full">
            <div class="relative overflow-y-scroll bg-white shadow-lg rounded-3xl p-10 bg-clip-padding bg-opacity-40
                backdrop-filter backdrop-blur-sm h-full overflow-hidden">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-center text-3xl" style="font-family: Ephesis">Ucapan dan Doa Restu</h1>
                        <h1 class=" mt-4 text-center text-base leading-4" >Silahkan Memberikan Ucapan Selamat dan Doa Restu Kepada Kami Melalui Form Di Bawah Ini:</h1>
                        <div class="py-2 text-base leading-6 space-y-1 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="form-glass-group-doa">
                                {{-- <label class="block font-medium text-sm text-gray-700" for="name">
                                    Nama Tamu
                                </label> --}}
                                <input type="text" class="form-glass-control"
                                placeholder="Nama" wire:model='doa.name' required>
                                @error('doa.name') <span class=" text-red-600">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-glass-group-doa">
                                <textarea class="form-glass-control" cols="30" rows="3" placeholder="Ucapan & Doa Restu" wire:model='doa.ucapan'
                                style="font-size: 1em" required></textarea>
                                @error('doa.ucapan') <span class=" text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="text-base leading-6 font-bold sm:text-lg sm:leading-7" style="text-align-last: center">
                            <a class="btn-rsvp group-invalid:pointer-events-none group-invalid:opacity-30" wire:click='submitFormDoa'>
                                <span wire:loading.remove wire:target="submitFormDoa">Kirim</span>
                                <span class=" items-center" wire:loading.inline-flex wire:target="submitFormDoa" wire:ignore>
                                    <i class="fa-solid fa-spinner fa-spin"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="overflow-y-scroll relative max-w-sm mx-auto mt-4 shadow-lg rounded-3xl p-4 bg-clip-padding bg-opacity-25
                    backdrop-filter backdrop-blur-sm" style="height: 41vh">
                    @isset($pesans)
                        @foreach ($pesans as $key => $pesan)
                            <div class="flex flex-col p-3">
                                <strong class="text-slate-800 text-base font-medium">{{$pesan->name}}</strong>
                                <span class=" text-slate-950 text-base font-medium">{{$pesan->ucapan}}</span>
                                <span class=" text-slate-500 text-sm font-medium">{{$pesan->created_at->diffForHumans()}}</span>
                            </div>
                        @endforeach
                    @endisset

                    @empty($pesans)
                        <div class="flex flex-col p-3">
                            <strong class="text-slate-800 text-base font-medium">Silahkan Mengirimkan Ucapan dan Doa</strong>
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</div>
