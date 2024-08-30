<div>
    <div id="cpw-swiper" class="swiper1 swiper pengantin"
        style="
            left: 17%;
            width: 66%;
            height: 53vh;
            top: 10%;
            position: fixed;
            z-index: 0;
        "
        >
        <div class="swiper-wrapper">
            @foreach ($foto as $item)
                <div class="swiper-slide"><img src="{{asset('storage/'.$item)}}" alt=""></div>
            @endforeach
        </div>
    </div>
    <div class="fixed flex flex-col justify-center py-12 h-full w-full" >
        <div class="absolute py-3 px-4 max-w-xl mx-auto w-full"
            style="
                top: 25%;
                text-align: -webkit-center;
            ">
            <div id="cpw-name" class="relative flex justify-end w-full flex-col rounded-xl bg-white bg-clip-border
                bg-opacity-40 backdrop-filter backdrop-blur-sm text-gray-700 shadow-md overflow-visible"
                style="
                    height: 60vh;
                    width: 75vw;
                ">
                <div id="cpw-name2" class="relative px-3 pb-8 text-center" style="opacity: 0">
                    <h4 class="block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                        {{$info->nama}}
                    </h4>
                    <p class="block bg-gradient-to-tr from-blue-800 to-blue-400 bg-clip-text font-sans
                        text-xs font-medium leading-relaxed text-transparent antialiased">
                        Putri dari
                    </p>
                    <p class="block bg-gradient-to-tr from-blue-800 to-blue-400 bg-clip-text font-sans
                        text-xs font-medium leading-relaxed text-transparent antialiased">
                        Bp. {{$info->nama_ayah}} dan
                    </p>
                    <p class="block bg-gradient-to-tr from-blue-800 to-blue-400 bg-clip-text font-sans
                        text-xs font-medium leading-relaxed text-transparent antialiased">
                        Ibu {{$info->nama_ibu}}
                    </p>
                </div>
                {{-- <div class="flex justify-center gap-7 p-6 pt-2">
                  <a
                    href="#facebook"
                    class="block bg-gradient-to-tr from-blue-600 to-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                  >
                    <i class="fab fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a
                    href="#twitter"
                    class="block bg-gradient-to-tr from-light-blue-600 to-light-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                  >
                    <i class="fab fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a
                    href="#instagram"
                    class="block bg-gradient-to-tr from-purple-600 to-purple-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                  >
                    <i class="fab fa-instagram" aria-hidden="true"></i>
                  </a>
                </div> --}}
            </div>
        </div>
    </div>
    <img id="b1-13" src="{{asset('storage/images/bunga13.png')}}" alt="" style="opacity: 0; rotate: -5deg">
    <img id="b1-14" src="{{asset('storage/images/bunga14.png')}}" alt=""style="opacity: 0; rotate: 15deg">
    <img id="b1-15" src="{{asset('storage/images/bunga18.png')}}" alt=""style="opacity: 0; rotate: -5deg">
    <img id="b1-16" src="{{asset('storage/images/bunga19.png')}}" alt=""style="opacity: 0; rotate: -5deg">
</div>
