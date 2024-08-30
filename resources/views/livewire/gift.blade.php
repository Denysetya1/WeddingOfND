<div>
    <div id="gift" class="fixed flex flex-col justify-center py-12 h-full w-full">
        <div class="relative py-3 px-4 max-w-xl mx-auto w-full">
            <div class="relative bg-white shadow-lg rounded-3xl px-10 pt-4 pb-10 bg-clip-padding bg-opacity-40 backdrop-filter backdrop-blur-sm h-full">
                <div class="max-w-md mx-auto h-full">
                    <div class="w-full h-full">
                        <h1 class="text-center text-4xl mb-2" style="font-family: Ephesis;">Wedding Gift</h1>
                        <h1 class=" mt-4 text-center text-base" >Tanpa Mengurangi Rasa Hormat Kami Bagi Tamu yang Ingin Mengirimkan Hadiah Kepada Kedua Mempelai Dapat Mengirimkannya Melalui :  </h1>
                        <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7" style="text-align-last: center">
                            @foreach ($reks as $rek)
                                <h1 class=" mt-4 text-center text-base" >{{$rek['nama_rek']}}</h1>
                                <h1 class=" text-center text-base" >{{$rek['bank_name']}}</h1>
                                <h1 class=" mb-4 text-center text-base" id="norek-{{$rek['id']}}">{{$rek['no_rek']}}</h1>
                                <a class="btn-rsvp group-invalid:pointer-events-none group-invalid:opacity-30 btn-copy"
                                data-clipboard-target="#norek-{{$rek['id']}}" wire:click='salin({{$rek['id']}})'>
                                    <span wire:loading.remove wire:target="salin">Salin</span>
                                    <span class=" items-center" wire:loading.inline-flex wire:target="salin" wire:ignore>
                                        <i class="fa-solid fa-spinner fa-spin"></i>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        var Clipboard = new ClipboardJS('.btn-copy');
        // window.addEventListener('swal:confirm', event => {
        //     swal.fire({
        //         title: "Wedding Gift",
        //         html: `
        //             <p class="mt-4 text-based">Fatimah Tunnada</p>
        //             <p class="mt-2 text-based" id="norek">BCA: No. Rek</p>
        //         `,
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Salin"
        //     })
        //         .then((salin) => {
        //             if (salin.isConfirmed) {
        //                 // Copy the text inside the text field
        //                 // navigator.clipboard.writeText("norek");
        //                 document.execCommand('norek');
        //                 swal.fire({
        //                     title: "Tersalin!",
        //                     text: "No. Rek Berhasil Disalin.",
        //                     icon: "success",
        //                     confirmButtonColor: "#3085d6",
        //                     timer: 2000
        //                 })
        //             }
        //         });
        // });
        // window.addEventListener('salinrek', event => {
        //     // Copy the text inside the text field
        //     // navigator.clipboard.writeText("norek");
        //     document.execCommand('norek');
        //     swal.fire({
        //         title: "Tersalin!",
        //         text: "No. Rek Berhasil Disalin.",
        //         icon: "success",
        //         confirmButtonColor: "#3085d6",
        //         timer: 2000
        //     })
        // });
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('salinrek', (id) => {
                document.execCommand('norek-'.id);
                swal.fire({
                    title: "Tersalin!",
                    text: "No. Rek Berhasil Disalin.",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    timer: 2000
                })
            });
        });
    </script>
@endpush
