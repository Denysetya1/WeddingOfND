<div class="flex justify-between mt-1">
    <div class="font-bold text-3xl">Tamu Undangan Digital</div>
    <div>
        {{$data}}
    </div>
</div>
<div x-data="{ isUploading: false, buttonShow: @entangle('buttonShow'), progress: 0 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false, buttonShow = true"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
class="flex justify-between">
    {{-- {{$file}} --}}
    <form wire:submit='import' class="w-full max-w-sm flex mt-2">
        <div class="mb-5">
            <label for="fileinput" class="block text-gray-700 text-sm font-bold mb-2">
                Pilih File Excel
            </label>
            <input type="file" class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="fileinput" wire:model='file'>
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
        <div class="flex items-center justify-between mt-3" x-show="buttonShow">
            <button style="--c-400:var(--generate-400);--c-500:var(--generate-500);--c-600:var(--generate-600);"
            class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2
            rounded-lg fi-color-custom fi-btn-color-new fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600
            text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50 fi-ac-btn-action"
            type="submit">
                <span wire:loading.remove wire:target="import">Unggah</span>
                <span wire:loading.inline-flex wire:target="import" wire:ignore>
                    Mengunggah
                </span>
            </button>
        </div>
    </form>
    <div class="flex items-center justify-between mt-3">
        <a style="--c-400:var(--generate-400);--c-500:var(--generate-500);--c-600:var(--generate-600);cursor:pointer;"
        class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2
        rounded-lg fi-color-custom fi-btn-color-new fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600
        text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50 fi-ac-btn-action"
        wire:click='generate'>
            <span wire:loading.remove wire:target="generate">Generate Pesan</span>
            <span wire:loading.inline-flex wire:target="generate" wire:ignore>
                Proses...
            </span>
        </a>
    </div>
</div>
