<div>
    <div id="gallery" class="fixed flex flex-col justify-center py-12 h-full w-full">
        <div class="relative py-3 px-4 max-w-xl mx-auto h-full w-full">
            <div class="relative bg-white shadow-lg rounded-3xl px-10 pt-4 pb-10 bg-clip-padding bg-opacity-40 backdrop-filter backdrop-blur-sm h-full">
                <div class="max-w-md mx-auto h-full">
                    <div class="w-full h-full">
                        <h1 class="text-center text-4xl mb-2" style="font-family: Ephesis;">Gallery Kami</h1>
                        @if ($foto)
                            <div class="swiper mySwiper2" style="padding: 5px;border-radius: 25px;">
                                <div class="swiper-wrapper">
                                    @foreach ($foto as $item)
                                        <div class="swiper-slide"><img src="{{asset('storage/'.$item)}}" alt=""></div>
                                    @endforeach
                                </div>
                            </div>
                            <div thumbsSlider="" class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @foreach ($foto as $item)
                                        <div class="swiper-slide"><img src="{{asset('storage/'.$item)}}" alt=""></div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <h1 class="text-center text-4xl mb-2" style="font-family: Ephesis;">Belum Ada Foto</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
