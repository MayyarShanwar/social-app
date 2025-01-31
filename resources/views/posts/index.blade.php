<x-layout>
    @auth
        <h1 class="text-2xl font-bold w-full text-center mt-6">Posts list</h1>
        {{-- posts cards --}}
        <div class="grid grid-cols-2 gap-6 px-10">
            @foreach ($posts as $post)
                <div class="postCard mt-6">

                    <div class="flex h-52 rounded-md mb-4 justify-center object-cover overflow-hidden ">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="" class=" h-full">
                    </div>
                    {{-- Title --}}
                    <h1 class="font-bold mt-2 ml-4">{{ $post->title }}</h1>
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
                        <span>{{ Str::words($post->body, 15) }}</span>
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 text-xs">Read more -></a>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="m-10">
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    @endauth

    @guest
        <h1 class="text-2xl font-bold w-full text-center mt-6">Hi, Log in so you can see all of our features</h1>
    @endguest
</x-layout>
