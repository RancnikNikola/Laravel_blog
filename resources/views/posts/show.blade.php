<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                @if (isset($post->image))
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Lary avatar">
                @else
                    <img src="https://picsum.photos/400/400?id={{ $post->id }}" alt="">
                @endif

                <p class="mt-4 block text-gray-400 text-xs">
                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>

                <div class="flex items-center lg:justify-center text-sm mt-4">
                    @if (isset($post->user->profilephoto))
                        <img src="{{ asset('storage/' . $post->user->profilephoto) }}" alt="Lary avatar" width="60px" height="60px" class="rounded-full">

                    @else
                        <img src="https://i.pravatar.cc/60?u={{ $post->user->id }}" alt="" width="60px" height="60px" class="rounded-full">
                    @endif
                    <div class="ml-3 text-left">
                        <h5 class="font-bold">{{ $post->user->name }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="/"
                        class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path class="fill-current"
                                    d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                </path>
                            </g>
                        </svg>

                        Back to Posts
                    </a>
                </div>
                <h1 class="font-bold text-3xl lg:text-4xl mb-2">
                    {{ $post->title }}
                </h1>
                <div class="space-x-2">
                    <a href="#"
                       class="py-1 text-red-500 text-xs uppercase font-semibold"
                       >
                       {{ $post->category->name }}
                    </a>
                </div>
                

                <div class="space-y-4 lg:text-lg leading-loose mt-10">

                    <h2 class="font-bold text-lg">Article:</h2>

                    <p>{{ $post->body }}</p>

                </div>
                <div class="space-x-2 mt-5">
                    @foreach ($post->tags as $tag)
                        <a href="/?tag={{ $tag->slug }}&{{ http_build_query(request()->except('tag')) }}"
                            :active='request()->is("tags/{$tag->slug}")'
                            style="font-size: 12px"
                            class="p-1 text-sm uppercase font-bold {{ $loop->odd ? 'text-blue-500' : 'text-red-500'}}"
                        >
                        #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- COMMENTS --}}
            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @auth
                <form method="POST" action="/posts/{{ $post->id }}/comments" class="border border-gray-500 rounded-xl p-6">
                    @csrf
                    <header class="flex items-center">
                        <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="60px" height="60px" class="rounded-full">
                        <h2 class="ml-4">Leave a comment</h2>
                    </header>
                    <div class="mt-6">
                        <textarea 
                            class="w-full p-2" 
                            name="body" 
                            id="body" 
                            rows="5" 
                            placeholder="Write your comment here">
                        </textarea>
                    </div>
                    <div class="flex justify-end mt-10 border-t border-gray-300 mt-6 pt-6">
                        <button type="submit"
                                class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"
                        >Post</button>
                    </div>
                </form>

                @else 
                <p>
                    <a href="/register">Register</a> or <a href="/login">Login in to leave a comment</a>
                </p>
                @endauth

                @foreach ($post->comments as $comment)
                    <x-post-comment :comment="$comment"/>
                @endforeach

            </section>

        </article>
    </main>
</x-app-layout>
 
