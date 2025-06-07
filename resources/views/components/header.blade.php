<nav class="w-full flex flex-wrap justify-between bg-white p-4">
  <div class="flex flex-wrap items-center gap-1 md:gap-20">
    <h1 class="text-[#E91E63] text-3xl md:text-5xl font-bold">Sweet Shop</h1>
    <div class="flex gap-4 md:gap-20">
      <a href="{{route('home_page')}}" class="text-[#F06292] text-xl md:text-3xl font-bold">Home</a>
      <a href="{{ route('products.index') }}" class="text-[#F06292] text-xl md:text-3xl font-bold">List Product</a>
    </div>
  </div>
  <div class="flex items-center gap-4 md:gap-6 mt-4 md:mt-0">
    @if (auth()->check())
        <a class="text-[#E91E63] font-bold cursor-pointer">You have {{Auth::user()->money}}$</a>
        <div class="relative group inline-block">
        <a
            href="#"
            class="flex items-center bg-[#E91E63] text-white px-4 py-2 rounded-l-3xl text-sm sm:text-base font-medium hover:bg-white hover:text-[#E91E63] transition-all duration-300"
        >
            <img
            src="/assets/images/user-circle.png"
            alt="User Icon"
            class="w-5 h-5 inline-block mr-2"
            />
            {{Auth::user()->name}}
        </a>

        <div
            class="absolute left-0 mt-2 w-full bg-white rounded-md shadow-lg opacity-0 group-hover:opacity-100 group-hover:visible invisible transition-all duration-300 z-50"
        >
            <ul class="py-2">
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-[#E91E63] hover:bg-pink-100 transition">Cart</a>
                </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="block px-4 py-2 text-sm text-[#E91E63] hover:bg-pink-100 transition"
                >
                Log Out
                </a>
            </li>
            </ul>
        </div>
        </div>

    @else
        <a href="{{route('login_page')}}" class="text-[#F06292] font-medium text-lg md:text-xl">Sign In</a>
        <a href="{{route('register_page')}}" class="text-white font-medium text-lg md:text-xl px-4 py-2 rounded-full bg-[#E91E63]">Sign Up</a>
    @endif
  </div>
</nav>
