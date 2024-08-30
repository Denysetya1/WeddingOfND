<x-filament-widgets::widget>
    <x-filament::section>
        {{-- {{ $data }} --}}
        @if (!$data)
            <div class="flex flex-col">
                <h1 class=" text-lg font-bold">Pengantin Pria</h1>
                <p class=" text-xs">Informasi Pengantin Pria</p>
            </div>
            <div class="flex flex-col items-center justify-center mt-6">
                {{ $this->createAction }}
                <h1 class="mt-3">
                    Belum Ada Data Pengantin Pria
                </h1>
            </div>
        @else
            {{$this->infolist}}
        @endif
    </x-filament::section>
    <x-filament-actions::modals />
</x-filament-widgets::widget>
