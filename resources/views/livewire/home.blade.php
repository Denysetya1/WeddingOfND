<div>
    <div class="boxView" id="smooth-content">
        @livewire('musicbutton')
        <div id="openinvitation" class="fixed" style="z-index: 3" >
            {{-- <div class="fixed inset-0 bg-gray-500 bg-opacity-75">
            </div> --}}
            <div class="fixed inset-0 w-screen overflow-y-auto" style="z-index: 3">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div style="z-index: 3"
                    class="open_invitation show ">
                        @if ($foto['cover'] == null)
                            <img src="{{asset('storage/images/cover.png')}}" alt="">
                        @else
                            <img src="{{asset('storage/'.$foto['cover'])}}" alt="">
                        @endif
                        <div class="overlay"></div>
                        <h3 style="position: fixed; bottom: 30%; color:#dff3ff; font-size:large">Kepada</h3>
                        <h2 style="position: fixed; bottom: 23%; color:aliceblue; font-size: 7vw;">{{$tamu}}</h2>
                        <h2 style="position: fixed; bottom: 19%; color:#c6eaff; font-size: large">Anda diundang ke pernikahan</h2>
                        <h2 style="position: fixed; bottom: 12%; color:#9edcff; font-size: 9.5vw; font-weight:bold; font-family: caveat;">{{$pernikahan}}</h2>
                        <button class="btn animate-pulse" id="close" onClick="closeDialog()" style="display: none">Buka Undangan</button>
                    </div>
                </div>
            </div>
        </div>
        <img id="bg-2" src="{{asset('storage/images/bg3.png')}}" alt="">
        <img id="bg-4" src="{{asset('storage/images/bg5.png')}}" alt="" style="scale: 2; opacity: 0;">
        <img id="bg-6" src="{{asset('storage/images/bg6.png')}}" alt="" style="scale: 2; opacity: 0;">
        <img id="bg-3" src="{{asset('storage/images/bg5.png')}}" alt="">
        <img id="bg-1" src="{{asset('storage/images/bg2.jpg')}}" alt="">

        {{-- Awal --}}
        {{-- <ul class="nav absolute z-50" id="nextayat">
            <li><a href="" id="toAyat">Next</a></li>
        </ul> --}}
        @if ($foto['logo'])
            <img id="logo" src="{{asset('storage/'.$foto['logo'])}}" alt="">
            {{-- <img id="logo" src="{{asset('storage/images/logo.png')}}" alt=""> --}}
        @endif
        @if ($foto['awal'])
            <img class="tengah" id="info2" src="{{asset('storage/'.$foto['awal'])}}" alt="">
            {{-- <img class="tengah" id="info2" src="{{asset('storage/images/foto2.png')}}" alt=""> --}}
        @endif
        @if ($foto['nama'])
            <img id="nama" src="{{asset('storage/'.$foto['nama'])}}" alt="">
            {{-- <img id="nama" src="{{asset('storage/images/Nama.png')}}" alt=""> --}}
        @endif
        {{-- <img class="tengah" id="deny" src="{{asset('storage/images/deny.png')}}" alt="" style="z-index: 1">
        <img class="tengah" id="nada" src="{{asset('storage/images/nada.png')}}" alt="" style="z-index: 1"> --}}

        {{-- Sakura --}}
        <div id="container">
        </div>
        {{-- <ul class="nav absolute z-50" id="nextcpw">
            <li><a href="" id="toCpw">Next</a></li>
        </ul> --}}
        <img id="b1-4" src="{{asset('storage/images/bunga4.png')}}" alt="">
        <img id="b1-3" src="{{asset('storage/images/bunga3.png')}}" alt="">
        <img id="b1-5" src="{{asset('storage/images/bunga5.png')}}" alt="">
        <img id="b1-2" src="{{asset('storage/images/bunga2.png')}}" alt="">
        <img id="b1-1" src="{{asset('storage/images/bunga1.png')}}" alt="">

        {{-- Ayat Al Quran --}}
        <img id="ayat1" src="{{asset('storage/images/asap.png')}}" alt="">
        <img id="ayat2" src="{{asset('storage/images/bingkai.png')}}" alt="">
        <img id="ayat3" src="{{asset('storage/images/ayat.png')}}" alt="">

        {{-- Bunga Di bawah Ayat --}}
        <img id="b1-6" src="{{asset('storage/images/bunga6.png')}}" alt="">
        <img id="b1-7" src="{{asset('storage/images/bunga7.png')}}" alt="">
        <img id="b1-8" src="{{asset('storage/images/bunga8.png')}}" alt="">
        <img id="b1-9" src="{{asset('storage/images/bunga9.png')}}" alt="">
        <img id="b1-12" src="{{asset('storage/images/bunga12.png')}}" alt="">
        <img id="b1-10" src="{{asset('storage/images/bunga10.png')}}" alt="">
        <img id="b1-11" src="{{asset('storage/images/bunga11.png')}}" alt="">


        {{-- Foto Pengantin --}}
        <livewire:cpw :uid="$uid" />
        <livewire:cpp :uid="$uid" />
        {{-- @livewire('cpw') --}}
        {{-- <div id="swipe1" class="swiper1 swiper pengantin" style="z-index: 0; position:fixed">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{asset('storage/images/slide (1).jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{asset('storage/images/slide (2).jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{asset('storage/images/slide (3).jpg')}}" alt=""></div>
            </div>
        </div> --}}

        {{-- <div id="swipe2" class="swiper2 swiper pengantin" style="z-index: 0; position:fixed">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{asset('storage/images/slide (1).jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{asset('storage/images/slide (2).jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{asset('storage/images/slide (3).jpg')}}" alt=""></div>
            </div>
        </div> --}}

        {{-- <img id="b1-13" src="{{asset('storage/images/bunga13.png')}}" alt="" style="opacity: 0; rotate: -5deg">
        <img id="b1-14" src="{{asset('storage/images/bunga14.png')}}" alt=""style="opacity: 0; rotate: 15deg">
        <img id="b1-15" src="{{asset('storage/images/bunga15.png')}}" alt=""style="opacity: 0; rotate: -5deg">
        <img id="b1-16" src="{{asset('storage/images/bunga16.png')}}" alt=""style="opacity: 0; rotate: 15deg">

        <img id="b1-17" src="{{asset('storage/images/bunga17.png')}}" alt=""style="opacity: 0; rotate: 5deg">
        <img id="b1-18" src="{{asset('storage/images/bunga18.png')}}" alt=""style="opacity: 0; rotate: -5deg">
        <img id="b1-19" src="{{asset('storage/images/bunga19.png')}}" alt=""style="opacity: 0; rotate: -5deg">
        <img id="b1-20" src="{{asset('storage/images/bunga20.png')}}" alt=""style="opacity: 0; rotate: 5deg"> --}}

        <img id="b1-21" src="{{asset('storage/images/bunga21.png')}}" alt="" style="opacity: 0.6;">
        <img id="b1-22" src="{{asset('storage/images/bunga22.png')}}" alt="" style="opacity: 0.6;">
        <img id="b1-23" src="{{asset('storage/images/bunga23.png')}}" alt="" style="opacity: 0.6;">
        <img id="b1-24" src="{{asset('storage/images/bunga24.png')}}" alt="" style="opacity: 0.6;">
        <img id="b1-25" src="{{asset('storage/images/bunga25.png')}}" alt="" style="opacity: 0.6;">
        <img id="b1-26" src="{{asset('storage/images/bunga26.png')}}" alt="" style="opacity: 0.6;">
        <img id="b1-27" src="{{asset('storage/images/bunga27.png')}}" alt="" style="opacity: 1;">
        <img id="b1-28" src="{{asset('storage/images/bunga28.png')}}" alt="" style="opacity: 1;">

        <div class="boxinfo" style="color: navy">
            <h1 id="event">Wedding Event</h1>
            <h3 id="eventakad1">Akad Nikah</h3>
            <h2 id="eventakad2">
                @empty($akad['tanggal'])
                    Belum Diatur
                @endempty
                {{$akad['tanggal']->translatedFormat('l')}},
            </h2>
            <h2 id="eventakad3">
                @empty($akad['tanggal'])
                    Belum Diatur
                @endempty
                {{$akad['tanggal']->translatedFormat('d F Y')}}
            </h2>
            <p id="eventakad4" style="margin-top: 3%;font-size: medium;font-weight: bold;">
                @empty($akad['waktu_mulai'] && $akad['waktu_selesai'])
                    Belum Diatur
                @endempty
                {{$akad['waktu_mulai']->translatedFormat('H.i')}} -
                @empty($akad['waktu_selesai'])
                    Selesai
                @endempty
                {{$akad['waktu_selesai']->format('H.i')}} {{$akad->zonawaktu->ket}}
            </p>
            <p id="eventakad5" style="margin-top: 3%;">{{$akad['tempat']}}</br>
                {{$akad['alamat']}}
            </p>
            <div id="eventakad6" style="margin-top: 4%">
                <a class="btnmaps" href="{{$akad['url_map']}}" target="_blank">Buka Maps</a>
            </div>
            {{-- Resepsi --}}
            <h3 id="eventresepsi1" style="margin-top: 3%">Resepsi</h3>
            <h2 id="eventresepsi2">
                @empty($resepsi['tanggal'])
                    Belum Diatur
                @endempty
                {{$resepsi['tanggal']->translatedFormat('l')}},
            </h2>
            <h2 id="eventresepsi3">
                @empty($resepsi['tanggal'])
                    Belum Diatur
                @endempty
                {{$resepsi['tanggal']->translatedFormat('d F Y')}}
            </h2>
            <p id="eventresepsi4" style="margin-top: 3%;font-size: medium;font-weight: bold;">
                @empty($resepsi['waktu_mulai'] && $resepsi['waktu_selesai'])
                    Belum Diatur
                @endempty
                {{$resepsi['waktu_mulai']->translatedFormat('H.i')}} -
                @empty($resepsi['waktu_selesai'])
                    Selesai
                @endempty
                {{$resepsi['waktu_selesai']->format('H.i')}} {{$resepsi->zonawaktu->ket}}
            </p>
            <p id="eventresepsi5" style="margin-top: 3%;">{{$resepsi['tempat']}}</br>
                {{$resepsi['alamat']}}
            </p>
            <div id="eventresepsi6" style="margin-top: 4%">
                <a class="btnmaps" href="{{$resepsi['url_map']}}" target="_blank">Buka Maps</a>
            </div>
        </div>

        <livewire:rsvp :keys="$keys" />
        {{-- @livewire('rsvp') --}}

        <livewire:gallery :uid="$uid" />
        {{-- @livewire('gallery') --}}

        <livewire:gift :rekening="$rekening" />
        {{-- @livewire('gift', $rekening=$rekening) --}}

        <livewire:ucapan :keys="$keys" />
        {{-- @livewire('ucapan') --}}

        @livewire('thankyou')
        {{-- Timeline --}}
        {{-- <div class="box-timeline" style="opacity: 0;">
            <header>
                <h1>Perjalanan Cinta Kami</h1>
            </header>

            <section id="cd-timeline" class="cd-container">
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-location">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/cd-icon-location.svg" alt="Picture">
                    </div> <!-- cd-timeline-img -->

                    <div class="cd-timeline-content">
                        <span class="cd-date">Jan 14</span>
                        <h2>Pertama Kali Bertemu</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                    </div> <!-- cd-timeline-content -->
                </div> <!-- cd-timeline-block -->

                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/cd-icon-movie.svg" alt="Movie">
                    </div> <!-- cd-timeline-img -->

                    <div class="cd-timeline-content">
                        <span class="cd-date">Jan 18</span>
                        <h2>Title of section 2</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>
                    </div> <!-- cd-timeline-content -->
                </div> <!-- cd-timeline-block -->

                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/cd-icon-picture.svg" alt="Picture">
                    </div> <!-- cd-timeline-img -->

                    <div class="cd-timeline-content">
                        <span class="cd-date">Jan 24</span>
                        <h2>Title of section 3</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci.</p>
                    </div> <!-- cd-timeline-content -->
                </div> <!-- cd-timeline-block -->
            </section>
        </div> --}}

        {{-- Buka di HP --}}
        <div class="bukadihp">
            {{-- <img src="{{asset('storage/images/bg_bukadihp.jpg')}}" alt=""> --}}
            @if ($foto['awal'])
                <img class="tengah" src="{{asset('storage/'.$foto['awal'])}}" alt="">
            @endif
            <h1>Agar Lebih Berkesan, Silahkan Akses Undangan Ini Melalui HandPhone Anda. Terima Kasih</h1>
        </div>
    </div>

    <div class="scrollElement" id="box"></div>

    @section('page-script')
        <script>
            const scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
            const body = document.body;
            body.style.position = 'fixed';
            body.style.top = `-${scrollY}`;

            const closeDialog = (e) => {
                // document.getElementById('dialog').classList.add('show')
                const scrollY = body.style.top;
                body.style.position = "";
                body.style.top = "";
                window.scrollTo(0, parseInt(scrollY || "0") * -1);
                let myDocument = document.documentElement;
                // document.documentElement.requestFullscreen();
                if (myDocument.requestFullscreen) {
                    myDocument.requestFullscreen();
                }
                else if (myDocument.msRequestFullscreen) {
                    myDocument.msRequestFullscreen();
                }
                else if (myDocument.mozRequestFullScreen) {
                    myDocument.mozRequestFullScreen();
                }
                else if(myDocument.webkitEnterFullscreen) {
                    myDocument.webkitEnterFullscreen();
                }
                document.getElementById("musik").play();
            };

        </script>
    @endsection
</div>
