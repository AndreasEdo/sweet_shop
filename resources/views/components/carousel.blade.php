<div class="relative bg-white shadow-md rounded-lg p-4 h-6/7 grid grid-rows-[20fr_1fr]">
    <div class="items text-center text-4xl font-bold flex items-center justify-center relative overflow-hidden h-full">
        @foreach ($promos as $index => $promo)
            <a href="">
                <img
                    class="item {{ $index !== 0 ? 'hidden' : '' }} "
                    src="{{ asset('storage/image/' . $promo->image) }}"
                    alt="Promo Image {{ $index + 1 }}">
            </a>

        @endforeach
    </div>

    <div class="marker flex justify-center items-end space-x-2 mt-4">
        @foreach ($promos as $index => $slide)
            <div
                class="dot w-3 h-3 rounded-full cursor-pointer {{ $index === 0 ? 'bg-gray-800' : 'bg-gray-400' }}"
                data-index="{{ $index }}">
            </div>
        @endforeach
    </div>
</div>
