<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ env('APP_NAME') }}</title>
    @vite('./resources/css/app.css')
</head>

<body class="bg-slate-200" x-data={open:false}>
    <header>
        <nav class=" relative flex w-full gap-4 bg-blue-900 items-center h-20 px-8 py-4 justify-between">
            <a class="text-4xl text-white border rounded-lg border-hidden hover:bg-slate-200 hover:text-black p-2"
                href="{{ route('posts.index') }}">Home</a>
            @guest
                <div class="flex gap-5">
                    <a href="{{ route('login') }}"
                        class="text-white border rounded-lg border-hidden hover:bg-slate-200 hover:text-black p-2">Log
                        in</a>
                    <a href="{{ route('register') }}"
                        class="text-white border rounded-lg border-hidden hover:text-black hover:bg-slate-200 p-2">Register</a>
                </div>
            @endguest
            @auth
                <img @click = "open = !open"
                    src="https://buffer.com/library/content/images/size/w1200/2023/10/free-images.jpg"
                    class="justify-end rounded-full hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-violet-200 w-14 h-14">
                <div @click.outside="open = false" x-show="open"
                    class="absolute border-2 text-center rounded-lg shadow-xl bg-gray-50 right-10 top-20 w-40 grid">

                    <a class="text-start text-xs border-b p-2 border-b-blue-900 font-serif font-bold text-blue-950">{{ auth()->user()->username }}
                    </a>
                    <a href="{{ route('dashboard') }}" class="py-2 hover:bg-blue-900 hover:text-white">dashboard
                    </a>
                    <a class="py-2 hover:bg-blue-900 hover:text-white">Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="py-2 rounded-b-lg hover:bg-blue-900 hover:text-white">
                        @csrf
                        <button type="submit" class="w-full h-full">Log out
                        </button>
                    </form>
                </div>
            @endauth
        </nav>
    </header>
    <main class="">
        {{ $slot }}
    </main>
    <div class="w-full h-10">

    </div>
</body>

</html>
