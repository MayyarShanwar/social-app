<x-layout>
    <h1 class="relative flex my-4 text-4xl w-full justify-center">Register</h1>
    <form action="{{ route('register') }}" method="POST"
        class="card">
        @csrf
    <label for="username" class="label">Username</label>
    <input name="username" value="{{old('username')}}" type="text" class="input">
    @error('username')
    <p class="error"> {{$message}}</p>
    @enderror

    <label for="email" class="label">Email</label>
    <input name="email"
    value="{{old('email')}}" type="email" class="input">
    @error('email')
    <p class="error"> {{$message}}</p>
    @enderror

    <label for="password" class="label">Password</label>
    <input name="password" value="{{old('password')}}" type="password" class="input">
    @error('password')
    <p class="error"> {{$message}}</p>
    @enderror

    <label for="password_confirmation" class="label">Confirm Password</label>
    <input name="password_confirmation" value="{{old('password')}}" type="password" class="input">
    @error('password')
    <p class="error"> {{$message}}</p>
    @enderror

    <button class="btn">Sign up</button>
</form>
</x-layout>
