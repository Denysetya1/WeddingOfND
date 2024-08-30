<div>
    <div id="rsvp" class="fixed flex flex-col justify-center py-12 h-full w-full" >
        <div class="relative py-3 px-4 max-w-xl mx-auto w-full">
            <div class="relative bg-white shadow-lg rounded-3xl p-10 bg-clip-padding bg-opacity-40 backdrop-filter backdrop-blur-sm">
                <div class="max-w-md mx-auto h-full">
                    <div class="divide-y divide-gray-200">
                        <h1 class=" mt-4 text-center text-3xl" style="font-family: Tourney">RSVP</h1>
                        <h1 class=" mt-4 text-center text-base" >Bagi tamu undangan yang akan hadir di acara pernikahan kami silahkan kirimkan konfirmasi kehadiran dengan mengisi form berikut : </h1>
                        @if ($data)
                            <div class="py-2 text-base leading-6 space-y-1 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="form-glass-group">
                                    <input type="text" class="form-glass-control"
                                    placeholder="Nama Tamu" wire:model='rsvp.name' required>
                                    @error('rsvp.name') <span class=" text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-glass-group">
                                    <div wire:ignore class="w-full">
                                        <select id="categories2"
                                                class=" @error('rsvp.jumlah') border-red-500 @enderror select2" name="rsvp.jumlah" required>
                                                <option></option>
                                                <option value="1"  @if($data->jumlah === 1) selected="selected" @endif>{{__('1 (Satu)')}}</option>
                                                <option value="2"  @if($data->jumlah === 2) selected="selected" @endif>{{__('2 (Dua)')}}</option>
                                        </select>
                                    </div>
                                    @error('rsvp.jumlah') <span class=" text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7" style="text-align-last: center">
                                {{-- <a class="btn-rsvp group-invalid:pointer-events-none group-invalid:opacity-30" wire:click='submitForm'>
                                    <span wire:loading.remove wire:target="submitForm">Ubah</span>
                                    <span class=" items-center" wire:loading.inline-flex wire:target="submitForm" wire:ignore>
                                        <i class="fa-solid fa-spinner fa-spin"></i>
                                    </span>
                                </a> --}}
                                <a class="btn-rsvp group-invalid:pointer-events-none group-invalid:opacity-30" style="background-color: #ff000014;"
                                wire:click='cancel({{$data->id}})'>
                                    <span wire:loading.remove wire:target='cancel({{$data->id}})'>Batalkan Kehadiran</span>
                                    <span class=" items-center" wire:loading.inline-flex wire:target='cancel({{$data->id}})' wire:ignore>
                                        <i class="fa-solid fa-spinner fa-spin"></i>
                                    </span>
                                </a>
                            </div>
                        @else
                            <div class="py-2 text-base leading-6 space-y-1 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="form-glass-group">
                                    <input type="text" class="form-glass-control"
                                    placeholder="Nama Tamu" wire:model='rsvp.name' required>
                                    @error('rsvp.name') <span class=" text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-glass-group">
                                    <div wire:ignore class="w-full">
                                        <select id="categories"
                                                class=" @error('rsvp.jumlah') border-red-500 @enderror select2" name="rsvp.jumlah" required>
                                                <option></option>
                                                <option value="1">{{__('1 (Satu)')}}</option>
                                                <option value="2">{{__('2 (Dua)')}}</option>
                                        </select>
                                    </div>
                                    @error('rsvp.jumlah') <span class=" text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7" style="text-align-last: center">
                                <a class="btn-rsvp group-invalid:pointer-events-none group-invalid:opacity-30" wire:click='submitForm'>
                                    {{-- Kirim --}}
                                    <span wire:loading.remove wire:target="submitForm">Kirim</span>
                                    <span class=" items-center" wire:loading.inline-flex wire:target="submitForm" wire:ignore>
                                        <i class="fa-solid fa-spinner fa-spin"></i>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let el = $('#categories')
            let el2 = $('#categories2')
            initSelect()

            Livewire.hook('message.processed', (message, component) => {
                initSelect()
            })

            Livewire.on('setJumlahSelect', values => {
                el.val(values).trigger('change.select2')
            })

            el.on('change', function (e) {
                @this.set('rsvp.jumlah', el.select2("val"))
            })
            el2.on('change', function (e) {
                @this.set('rsvp.jumlah', el2.select2("val"))
            })

            function initSelect () {
                el.select2({
                    placeholder: '{{__('Jumlah Tamu')}}',
                    allowClear: !el.attr('required'),
                    minimumResultsForSearch: Infinity,
                })
                el2.select2({
                    placeholder: '{{__('Jumlah Tamu')}}',
                    allowClear: !el2.attr('required'),
                    minimumResultsForSearch: Infinity,
                })
            }
        })
        // window.addEventListener('swal:modal', event => {
        //     swal.fire({
        //         title: event.detail.title,
        //         text: event.detail.text,
        //         icon: event.detail.type,
        //     });
        // });
        window.addEventListener('swal', function(e) {
            swal.fire(e.detail);
        });
    </script>
@endpush
