<x-layout>
    <h1 class="relative flex my-4 text-4xl w-full justify-center">Welcome back</h1>
    <form action="{{ route('login') }}" method="POST" class="card">
        @csrf
        @error('failed')
    <p class="text-red-700 text-sm text-center ml-1"> {{ $message }}</p>
    @enderror
        <label for="email" class="label">Email</label>
        <input name="email" value="{{ old('email') }}" type="email" class="input">
        @error('email')
            <p class="error"> {{ $message }}</p>
        @enderror

        <label for="password" class="label">Password</label>
        <input name="password" value="{{ old('password') }}" type="password" class="input">
        @error('password')
            <p class="error"> {{ $message }}</p>
        @enderror
        <div class="flex justify-start gap-1 mt-1 ml-1">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember" class="text-sm">Remember me</label>
    </div>
        <button class="btn">Log in</button>
    </form>
</x-layout>
