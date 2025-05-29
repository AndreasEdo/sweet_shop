<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
        <div class=" flex flex-col items-center justify-center p-8">
            <x-rocks class="w-full max-w-md mb-8"></x-rocks>
            <img
                src="{{ asset('assets/images/gambar2.png') }}"
                alt="Login Illustration"
                class="w-full max-w-md h-auto"
            >
        </div>

        <div class="flex items-center justify-center p-8">
            <div class="flex flex-col w-full max-w-md gap-10">
                <h1 class="text-[#E91E63] text-3xl md:text-5xl font-bold">Sign In</h1>

                <form class="space-y-6">
                    @csrf
                    <div class="relative">
                        <div class="relative">
                            <img
                                src="{{ asset('assets/images/envelope.png') }}"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5"
                            >
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292]"
                                placeholder="your@email.com"
                                required
                            >
                        </div>
                    </div>

                    <div class="relative">

                        <div class="relative">
                            <img
                                src="{{ asset('assets/images/lock.png') }}"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5"
                                alt="password icon"
                            >
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292]"
                                placeholder="Password"
                                required
                            >
                            <img
                                src="{{ asset('assets/images/password_eye.png') }}"
                                class="absolute right-3 top-0 transform flex-col translate-y-1/2 h-5 w-5 cursor-pointer"
                                id="eye"
                                alt="Password icon"
                            >
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-[#E91E63] hover:text-[#E91E63]">Forgot password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="rounded-3xl w-full flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-[#E91E63] cursor-pointer">
                            Sign in
                        </button>
                    </div>
                </form>

                <div class="flex justify-center items-center gap-1">
                    <h2 class="text-[#F8BBD0]">Don't have an account?</h2>
                    <a href="{{route('register_page')}}" class="text-[#E91E63]">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
    <script src="/resources/js/app.js"></script>
</body>
</html>
