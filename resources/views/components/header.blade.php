<nav class="w-full flex flex-wrap justify-between bg-white mt-8 p-4">
  <div class="flex flex-wrap items-center gap-1 md:gap-20">
    <h1 class="text-[#E91E63] text-3xl md:text-5xl font-bold">Sweet Shop</h1>
    <div class="flex gap-4 md:gap-20">
      <a href="/" class="text-[#F06292] text-xl md:text-3xl font-bold">Home</a>
      <a href="#" class="text-[#F8BBD0] text-xl md:text-3xl font-bold">List Product</a>
    </div>
  </div>
  <div class="flex items-center gap-4 md:gap-6 mt-4 md:mt-0">
    @if (auth()->check())

    @else
        <a href="{{route('login_page')}}" class="text-[#F06292] font-medium text-lg md:text-xl">Sign In</a>
        <a href="{{route('register_page')}}" class="text-white font-medium text-lg md:text-xl px-4 py-2 rounded-full bg-[#E91E63]">Sign Up</a>
    @endif
  </div>
</nav>
