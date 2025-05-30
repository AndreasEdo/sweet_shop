<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="flex flex-col w-full max-w-md gap-10">
            <div class="text-center">
                <h1 class="text-[#E91E63] text-3xl md:text-5xl font-bold">Forgot Your Password?</h1>
                <p class="mt-2 text-sm text-gray-600">
                    No problem. Just let us know your email address and we will email you a password reset link.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-md">
                    <div class="font-bold">Whoops! Something went wrong.</div>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

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
                        class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292] @error('email') border-red-500 @enderror"
                        placeholder="your@email.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="rounded-3xl w-full flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-[#E91E63] hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E91E63] cursor-pointer">
                        Email Password Reset Link
                    </button>
                </div>
            </form>

            <div class="text-center">
                <a href="{{ route('login_page') }}" class="font-medium text-[#E91E63] hover:text-pink-700">
                    Back to login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
