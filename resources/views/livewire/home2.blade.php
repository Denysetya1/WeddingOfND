<div>
    <div id="viewport" style="
        overflow: hidden;
        position: fixed;
        height: 100vh;
        width: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    ">
        <div id="scroll-container" class=" flex" style="
            overflow: hidden;
            height: 100vh;
            background-image:
                linear-gradient(rgba(255,255,255,.07) 2px, transparent 2px),
                linear-gradient(90deg, rgba(255,255,255,.07) 2px, transparent 2px),
                linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 100px 100px, 100px 100px, 20px 20px, 20px 20px;
            background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
        ">
            <div class="w-full h-full" id="info-cpw" style="top: 0px">
                <livewire:cpw :uid="$uid" />
            </div>
            <div class="w-full h-full" id="info-cpp" style="top: 1000px">
                <livewire:cpp :uid="$uid" />
            </div>
        </div>
    </div>
</div>
