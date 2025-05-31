<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/carousel.js'])
</head>
<body class="w-full">
    <x-header/>
    <main class="p-4 h-[200vh] grid gap-6 grid-rows-[1fr_1fr]">
        <x-carousel :promos="$promos"/>
        <div class="flex flex-col gap-8">
            <div class="h-1/2 flex flex-col gap-4">
                <h1 class="text-[#E91E63] text-xl md:text-3xl font-bold">Flower Bouquet</h1>
                <div class="grid grid-cols-5 grid-rows-1 gap-4 h-full">
                    @foreach ($others as $promo)
                        <div class="w-full bg-[#F8BBD052] rounded-3xl h-5/6 grid grid-rows-[1fr_2fr]">
                            <img src="{{asset('storage/'. $promo->product->image)}}" alt="">
                            <div class="p-6 flex flex-col justify-between ">
                                <h2 class="text-[#E91E63] text-2xl font-bold">{{$promo->product->name}}</h2>
                                <div class="flex justify-between text-[#F06292] text-xs relative">
                                    <div>
                                        <div class="flex gap-1">
                                            <h3 class="text-xl font-bold line-through">{{ 'Rp ' . number_format($promo->product->price, 0, ',', '.') }}</h3>
                                            <div class="bg-white rounded-xl px-1.5 flex justify-center items-center top-0 font-black">
                                                {{$promo->promo}}% Off
                                            </div>
                                        </div>
                                        <h3>{{ 'Rp ' . number_format($promo->price_after_discount, 0, ',', '.') }}</h3>
                                    </div>
                                    <a href="#" class="absolute bottom-0 right-0">See More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="h-1/2 flex flex-col gap-4">
                <h1 class="text-[#E91E63] text-xl md:text-3xl font-bold">Single Flower</h1>
                <div class="grid grid-cols-5 grid-rows-1 gap-4 h-full">
                    @foreach ($singles as $promo)
                        <div class="w-full bg-[#F8BBD052] rounded-3xl h-5/6 grid grid-rows-[1fr_2fr]">
                            <img src="{{asset('storage/'. $promo->product->image)}}" alt="">
                            <div class="p-6 flex flex-col justify-between ">
                                <h2 class="text-[#E91E63] text-2xl font-bold">{{$promo->product->name}}</h2>
                                <div class="flex justify-between text-[#F06292] text-xs relative">
                                    <div>
                                        <div class="flex gap-1">
                                            <h3 class="text-xl font-bold line-through">{{ 'Rp ' . number_format($promo->product->price, 0, ',', '.') }}</h3>
                                            <div class="bg-white rounded-xl px-1.5 flex justify-center items-center top-0 font-black">
                                                {{$promo->promo}}% Off
                                            </div>
                                        </div>
                                        <h3>{{ 'Rp ' . number_format($promo->price_after_discount, 0, ',', '.') }}</h3>
                                    </div>
                                    <a href="#" class="absolute bottom-0 right-0">See More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <x-footer/>
</body>
</html>
