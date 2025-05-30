<!DOCTYPE html>
<html lang="en">

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
        <div class="font-bold">Whoops! Something went wrong.</div>
        <ul class="mt-3 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
        <div class=" flex flex-col items-center justify-center p-8">
            <x-rocks class="w-full max-w-md mb-8"></x-rocks>
            <img
                src="{{ asset('assets/images/gambar1.png') }}"
                alt="Login Illustration"
                class="w-full max-w-md h-auto"
            >
        </div>

        <div class="flex items-center justify-center p-8">
            <div class="flex flex-col w-full max-w-md gap-10">
                <h1 class="text-[#E91E63] text-3xl md:text-5xl font-bold">Sign Up</h1>

                <form method="POST" action="{{ url('/register') }}" class="space-y-6">
                    @csrf
                    <div class="relative">
                        <img
                            src="{{ asset('assets/images/user_card.png') }}"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5"
                            alt="name"
                        >
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292] @error('name') border-red-500 @enderror" {{-- Added @error class for styling --}}
                            placeholder="Name"
                            value="{{ old('name') }}"
                            required
                        >
                        @error('name') {{-- Added: Display specific error for name --}}
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <img
                            src="{{ asset('assets/images/envelope.png') }}"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5"
                            alt="Email icon"
                        >
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292] @error('email') border-red-500 @enderror" {{-- Added @error class for styling --}}
                            placeholder="Email"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <img
                            src="{{ asset('assets/images/lock.png') }}"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5"
                            alt="Password icon"
                        >
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292]"
                            placeholder="Password"
                            required
                        >
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <img
                            src="{{ asset('assets/images/password_eye.png') }}"
                            class="eye absolute right-3 top-0 transform flex-col translate-y-1/2 h-5 w-5 cursor-pointer"
                            id="eye"
                            alt="password icon"
                        >
                    </div>

                    <div class="relative">
                        <img
                            src="{{ asset('assets/images/lock.png') }}"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5"
                            alt="Password Confirmation"
                        >
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class=" text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292]"
                            placeholder="Password Confirmation"
                            required
                        >
                        <img
                            src="{{ asset('assets/images/password_eye.png') }}"
                            class="absolute right-3 top-0 transform flex-col translate-y-1/2 h-5 w-5 cursor-pointer"
                            id="eye2"
                            alt="password_confirmation"
                        >
                    </div>
                    <div>
                        <button type="submit" class=" rounded-3xl w-full flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-[#E91E63] cursor-pointer">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="flex justify-center items-center gap-1">
                    <h2 class="text-[#F8BBD0]">Already A Member?</h2>
                    <a href="{{route('login_page')}}" class="text-[#E91E63]">Sign In</a>
                </div>
            </div>
        </div>
    </div>
    <img src="/resources/js/app.js" alt="">
</body>
</html>
