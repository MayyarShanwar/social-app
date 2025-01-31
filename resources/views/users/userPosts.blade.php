<x-layout>
    <div class="w-full text-center font-bold text-2xl my-4">
        {{$user_name}} latest posts
    </div>
    <div class="grid grid-cols-2 gap-6 px-10">
        @foreach ($user_posts as $post)
                <div class="postCard mt-6">
                    {{-- Title --}}
                    <h1 class="font-bold mt-2 ml-4">{{ $post->title }}</h1>
                    {{-- user ande date --}}
                    {{-- Laravel uses Carbon for its dates check the website https://carbon.nesbot.com/docs/ 
            we use the diffForHumans() methode to show the time diffenece between the creation date and now like 1 day ago or 1 month ago --}}
                    <div class="text-xs ml-4">
                        {{-- comment --}}
                        <span>Created {{ $post->created_at->diffForHumans() }} by</span>
                        <a href="{{route('posts.user', $post->user )}}" class="text-blue-600">{{ $post->user->username }}</a>
                    </div>
                    {{-- body --}}
                    <div class="mx-10 my-4">
                        {{-- Str::woreds() takes the article we want to show and the number of words we want to show
                so we don't show the full text if it's so long --}}
                        <p>{{ Str::words($post->body, 15) }}</p>
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