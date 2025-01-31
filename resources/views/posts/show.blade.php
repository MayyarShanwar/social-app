<x-layout>
    <div class="postCard mt-10 ">
        {{-- Title --}}
        <h1 class="font-bold mt-2 mb-2 ml-4">{{ $post->title }}</h1>
        {{-- user ande date --}}
        {{-- Laravel uses Carbon for its dates check the website https://carbon.nesbot.com/docs/ 
we use the diffForHumans() methode to show the time diffenece between the creation date and now like 1 day ago or 1 month ago --}}
        <div class="text-xs ml-4">
            {{-- comment --}}
            <span>Created {{ $post->created_at->diffForHumans() }} by</span>
            <a href="{{route('posts.user' , $post->user)}}" class="text-blue-600">{{ $post->user->username }}</a>
        </div>
        {{-- body --}}
        <div class="mx-10 my-4">
            {{-- Str::words() takes the article we want to show and the number of words we want to show
    so we don't show the full text if it's so long --}}
            <p class="leading-6">{{ $post->body }}</p>
        </div>
        <div class="flex h-52 rounded-md mb-4 justify-center object-cover overflow-hidden ">
            <img src="{{ asset('storage/' . $post->image) }}" alt="" class=" h-full">
        </div>
    </div>
</x-layout>
