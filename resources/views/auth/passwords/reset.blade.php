<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="flex flex-col w-full max-w-md gap-10">
            <div class="text-center">
                <h1 class="text-[#E91E63] text-3xl md:text-5xl font-bold">Reset Your Password</h1>
            </div>

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

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">


                <div class="relative">
                    <img src="{{ asset('assets/images/envelope.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5" alt="Email icon">
                    <input id="email" type="email" name="email" value="{{ $request->email ?? old('email') }}" required autofocus
                           class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292] @error('email') border-red-500 @enderror"
                           placeholder="your@email.com">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <img src="{{ asset('assets/images/lock.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5" alt="Password icon">
                    <input id="password" type="password" name="password" required
                           class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292] @error('password') border-red-500 @enderror"
                           placeholder="New Password">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <img src="{{ asset('assets/images/lock.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5" alt="Password Confirmation">
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="text-[#F0629280] font-medium pl-10 block w-full px-4 py-2 rounded-3xl shadow-sm border-0 bg-[#F8BBD052] focus:outline-none focus:ring-2 focus:ring-[#F06292]"
                           placeholder="Confirm New Password">
                </div>

                <div>
                    <button type="submit" class="rounded-3xl w-full flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium text-white bg-[#E91E63] hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E91E63] cursor-pointer">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
