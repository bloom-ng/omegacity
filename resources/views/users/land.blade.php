<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] font-just text-[#010504]">

    <!-- Navbar -->
    @include("users.nav")

    <!-- Search Section -->
    <section class="flex flex-row justify-center items-center px-4 md:px-12 lg:px-20 py-6 md:py-8 lg:py-10">
        <div class="flex flex-row items-center w-full max-w-[300px] sm:min-w-[350px] md:min-w-[450px] lg:min-w-[650px] gap-2">
            <form class="flex flex-row items-center gap-2 border-[0.5px] border-[#676968]/80 rounded-[40px] w-full px-3 py-3" action="">
                <img src="{{ asset("assets/images/search.svg") }}" alt="search" class="w-3">
                <input type="text" placeholder="search location" class="w-full placeholder:text-[#676968]/50">

                <div class="self-stretch w-[0.5px] bg-[#676968]/80 mr-2 -my-3"></div>
                <img src="{{ asset("assets/images/filter.svg") }}" alt="filter" class="w-3 mr-1">
            </form>
        </div>
    </section>

    <!-- Land Section -->
    <section class="md:px-12 lg:px-20 py-10">
        @foreach (($sections ?? []) as $section)
        <div class="flex flex-col {{ !$loop->first ? 'lg:pt-20' : '' }} gap-6 mb-10">
            <h1 class="px-4 sm:px-6 lg:px-0 font-extrabold md:text-xl lg:text-2xl">{{ $section['location'] }}</h1>

            <!-- Extra Small Swiper (< 640px) - 1 slide -->
            <swiper-container slides-per-view="1" speed="500" loop="true" autoplay="true" css-mode="true"
                class="flex items-center justify-center flex-row sm:hidden w-full px-4">
                @foreach ($section['listings'] as $listing)
                <swiper-slide>
                    <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                        <div class="h-[81%] w-full rounded-t-lg">
                            @php
                                $photos = $listing->photos ?? [];
                                $first = is_array($photos) && count($photos) ? $photos[0] : null;
                                $imgSrc = $first ? (\Illuminate\Support\Str::startsWith($first, ['http://','https://']) ? $first : asset('storage/' . $first)) : asset('assets/images/landImage.png');
                            @endphp
                            <img src="{{ $imgSrc }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                        </div>
                        <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                            <p>2 plots of land 350sq.ft</p>
                            <div class="flex flex-row justify_between">
                                <p class="font-extrabold">NGN {{ number_format($listing->selling_price / 1000000, 2) }} million</p>
                                <a href="{{ route('landlisting.show', ['id' => $listing->id]) }}" class="border-b-[0.5px] border-[#676968] px-1.5">View Land</a>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
                @endforeach
            </swiper-container>

            <!-- Small Swiper (640-767px) - 2 slides -->
            <swiper-container slides-per-view="2" speed="500" loop="true" autoplay="true" css-mode="true"
                class="hidden sm:flex md:hidden w-full px-4">
                @foreach ($section['listings'] as $listing)
                <swiper-slide>
                    <div class="flex h-full w-72 flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                        <div class="h-[81%] w-full rounded-t-lg">
                            @php
                                $photos = $listing->photos ?? [];
                                $first = is_array($photos) && count($photos) ? $photos[0] : null;
                                $imgSrc = $first ? (\Illuminate\Support\Str::startsWith($first, ['http://','https://']) ? $first : asset('storage/' . $first)) : asset('assets/images/landImage.png');
                            @endphp
                            <img src="{{ $imgSrc }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                        </div>
                        <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                            <p>2 plots of land 350sq.ft</p>
                            <div class="flex flex-row justify-between">
                                <p class="font-extrabold">NGN {{ number_format($listing->selling_price / 1000000, 2) }} million</p>
                                <a href="{{ route('landlisting.show', ['id' => $listing->id]) }}" class="border-b-[0.5px] border-[#676968] px-1.5">View Land</a>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
                @endforeach
            </swiper-container>

            <!-- Desktop Grid (≥ 768px) -->
            <div class="hidden md:grid grid-cols-3 md:h-[45vh] gap-3">
                @foreach ($section['listings'] as $listing)
                <div class="flex h-full flex-col rounded-b-lg border-[0.5px] rounded-lg border-[#676968]">
                    <div class="h-[81%] w-full rounded-t-lg">
                        @php
                            $photos = $listing->photos ?? [];
                            $first = is_array($photos) && count($photos) ? $photos[0] : null;
                            $imgSrc = $first ? (\Illuminate\Support\Str::startsWith($first, ['http://','https://']) ? $first : asset($first)) : asset('assets/images/landImage.png');
                        @endphp
                        <img src="{{ $imgSrc }}" class="object-cover h-full w-full rounded-t-lg" alt="land image">
                    </div>
                    <div class="h-[19%] text-xs lg:text-base gap-2 rounded-b-lg p-2.5 ">
                        <p>2 plots of land 350sq.ft</p>
                        <div class="flex flex-row justify-between">
                            <p class="font-extrabold">NGN {{ number_format($listing->selling_price / 1000000, 2) }} million</p>
                            <a href="{{ route('landlisting.show', ['id' => $listing->id]) }}" class="border-b-[0.5px] border-[#676968] px-1.5">View Land</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </section>

    <!-- Footer Section -->
    @include("users.footer")


</body>

</html>
