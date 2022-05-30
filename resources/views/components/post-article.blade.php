@props(['post'])

<article
                {{ $attributes->merge(['class' => "transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl transition-shadow ease-in-out duration-300 shadow-none hover:shadow-xl"]) }}>
                <div class="py-6 px-6">
                    <div>
                       @if (isset($post->image))
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Lary avatar" class="max-w-xs">
                       @else
                            <img src="https://picsum.photos/500/500?id={{ $post->id }}" alt="">
                       @endif
                    </div>

                    <div class="mt-8 flex flex-col justify-between">
                        <header>
                            <div class="space-x-2">
                                @foreach ($post->tags as $tag)
                                    <a href="#"
                                        class="py-1 {{ $loop->odd ? 'text-blue-500' : 'text-red-500'}} text-sm uppercase font-bold"
                                        style="font-size: 10px">#{{$tag->name}}
                                    </a>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <h1 class="text-3xl">
                                    {{ $post->title }}
                                </h1>

                                <span class="mt-2 block text-gray-400 text-xs">
                                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                                </span>
                            </div>
                        </header>

                        <div class="text-sm mt-4 space-y-4 overflow-x-auto">
                            <p>
                                {{ $post->body }}
                            </p>
                        </div>
                        <footer class="flex justify-between items-center mt-8">
                            <div class="flex items-center text-sm">
                                @if (isset($post->user->profilephoto))
                                    <img src="{{ asset('storage/' . $post->user->profilephoto) }}" alt="Lary avatar" width="60px" height="60px" class="rounded-full">
                                @else
                                    <img src="https://i.pravatar.cc/60?u={{ $post->user->id }}" alt="" width="60px" height="60px" class="rounded-full">
                                @endif
                                <div class="ml-3">
                                    <h5 class="font-bold">{{ $post->user->name }}</h5>
                                </div>
                            </div>

                            <div>
                                <a href="/posts/{{ $post->id }}"
                                    class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                                 >Read More</a>
                            </div>
                            
                        </footer>
                        <div class="space-x-2 mt-4">
                            <a href="#"
                               class="py-1 text-red-500 text-xs uppercase font-semibold"
                               >
                               {{ $post->category->name }}</a>
                        </div>
                    </div>
                </div>
            </article>