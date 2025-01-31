<x-layout>
    <form action="{{ route('posts.update',$post) }}" method="post" class=" mt-10 card" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @error('failed')
            <p class="text-red-700 text-sm text-center ml-1"> {{ $message }}</p>
        @enderror
        <label for="title" class="label">Post title</label>
        <input placeholder="What do you want to talk about..." name="title" value="{{ $post->title }}" type="text"
            class="input">
        @error('title')
            <p class="error"> {{ $message }}</p>
        @enderror

        <label for="body" class="label">Post body</label>
        <textarea name="body" class="textarea" placeholder="What are you thinking right now..."  rows="5">{{ $post->body }}</textarea>
        @error('body')
            <p class="error"> {{ $message }}</p>
        @enderror

        @if ($post->image)
        <label for="image" class="mb-2 label">current cover image</label>
        <div class="flex h-52 rounded-md mb-4 justify-center object-cover overflow-hidden ">
        
            <img src="{{ asset('storage/' . $post->image) }}" alt="" class=" h-full">
        </div>
        @endif
        <label for="image" class="my-2">Cover image</label>
        <input type="file" name="image" id="image">
        @error('image')
            <p class="error"> {{ $message }}</p>
        @enderror 
        <button class="btn">Update</button>
    </form>
</x-layout>