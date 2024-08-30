<div>
    <button type="button" class="music_button bg-transparent text-orange-700 font-bold py-2 px-3 rounded-full flex"
    {{-- wire:click='pp'  --}}
    onClick="togglePlay()"
    style="z-index: 3">
        @if ($playpause)
            <span>
                <i class="fa-solid fa-pause fa-spin"></i>
            </span>
        @else
            <span>
                <i class="fa-solid fa-play fa-beat-fade"></i>
            </span>
        @endif
    </button>
    <audio loop id="musik" src="{{asset('storage/musics/aku_memilihmu.mp3')}}" type="audio/mpeg"></audio>
    @section('page-script2')
        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     @this.on('play', () => {
            //         document.getElementById("musik").play();
            //     });
            //     @this.on('pause', () => {
            //         document.getElementById("musik").pause();
            //     });
            // });
            var myAudio = document.getElementById("musik");
            var isPlaying = false;
            function togglePlay() {
                @this.call('pp');
                isPlaying ? myAudio.pause() : myAudio.play();
            };

            myAudio.onplaying = function() {
                isPlaying = true;
            };
            myAudio.onpause = function() {
                isPlaying = false;
            };
        </script>
    @endsection
</div>
