<x-layout>
    <h1 class="text-2xl font-bold w-full text-center mt-6">Create a new post</h1>
    <div class="flex w-full justify-center">
        <x-flashmsg msg="{{ session('success') }}" text='text-green-700 font-bold' />
        <x-flashmsg msg="{{ session('delete') }}" text='text-red-700 font-bold' />
    </div>
    {{--create a new post--}}
    <form action="{{ route('posts.store') }}" method="POST" class="card" enctype="multipart/form-data">
        @csrf
        @error('failed')
            <p class="text-red-700 text-sm text-center ml-1"> {{ $message }}</p>
        @enderror
        <label for="title" class="label">Post title</label>
        <input placeholder="What do you want to talk about..." name="title" value="{{ old('title') }}" type="text"
            class="input">
        @error('title')
            <p class="error"> {{ $message }}</p>
        @enderror

        <label for="body" class="label">Post body</label>
        <textarea name="body" class="textarea" placeholder="What are you thinking right now..." rows="5"></textarea>
        @error('body')
            <p class="error"> {{ $message }}</p>
        @enderror

        <label for="image" class="my-2 label">Cover image</label>
        <input type="file" name="image" id="image">
        @error('image')
            <p class="error"> {{ $message }}</p>
        @enderror
        <button class="btn">Post</button>
    </form>

    {{--show your posts--}}
    <div class="w-full text-center font-bold text-2xl my-4">
        Your latest posts
    </div>
    <div class="grid grid-cols-2 gap-6 px-10">
        @foreach ($user_posts as $post)
            <div class="postCard mt-6">
                {{-- image --}}
                <div class="flex h-52 rounded-md mb-4 justify-center object-cover overflow-hidden ">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" class=" h-full">
                </div>
                {{-- Title --}}
                <h1 class="font-bold mt-2 ml-4">{{ $post->title }}</h1>
                {{-- user and date --}}
                {{-- Laravel uses Carbon for its dates check the website https://carbon.nesbot.com/docs/ 
            we use the diffForHumans() methode to show the time diffenece between the creation date and now like 1 day ago or 1 month ago --}}
                <div class="text-xs ml-4">
                    {{-- comment --}}
                    <span>Created {{ $post->created_at->diffForHumans() }} by</span>
                    <a href="{{ route('posts.user', $post->user) }}"
                        class="text-blue-600">{{ $post->user->username }}</a>
                </div>
                {{-- body --}}
                <div class="mx-10 my-4">
                    {{-- Str::woreds() takes the article we want to show and the number of words we want to show
                so we don't show the full text if it's so long --}}
                    <span>{{ Str::words($post->body, 15) }}</span>
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 text-xs">Read more -></a>
                </div>
                <div class="flex justify-end gap-5">
                    <form action="{{ route('posts.edit', $post) }}" class="flex justify-center editbtn">
                        @csrf
                        <button class="" type="submit">Edit</button>
                    </form>

                    <form action="{{ route('posts.destroy', $post) }}" method="post"
                        class="flex justify-center deletebtn ">
                        @csrf
                        @method('DELETE')
                        <button class="" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="m-10">
        <div>
            {{ $user_posts->links() }}
        </div>
    </div>
</x-layout>
