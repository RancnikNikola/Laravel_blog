<x-app-layout>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              
            </h2>
            <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
                <!--  Category -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                    
                    <div x-data="{ show: false }" @click.away="show = false">
        
                        <button 
                            @click="show = !show"
                            class="py-2 pl-3 pr-9 text-sm font-semibold w-34 text-left">
                            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
                                <svg class="transform -rotate-90 absolute pointer-events-none inline-flex" style="right: 12px;" width="22"
                                height="22" viewBox="0 0 22 22">
                                    <g fill="none" fill-rule="evenodd">
                                        <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                        </path>
                                        <path fill="#222"
                                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                                    </g>
                                </svg>
                        </button>
        
                        <div x-show="show" class="py-2 absolute bg-gray-100 w-full rounded-xl mt-2 z-20" style="display: none">
                                <a href="/"
                                    :active='request()->routeIs("home")'
                                    class="block w-full text-left px-3 py-1 text-sm leading-6 hover:bg-gray-300 focus:bg-gray-300 font-semibold">
                                    All
                                </a>
                            @foreach ($categories as $category)
                                <a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category')) }}"
                                    :active='request()->is("categories/{$category->slug}")'
                                    class="block w-full text-left px-3 py-1 text-sm leading-6 hover:bg-gray-300 focus:bg-gray-300 font-semibold">
                                   {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
        
                    </div>
                </div>
        
                <!-- Tags -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
                    
                    <div x-data="{ show: false }" @click.away="show = false">
        
                        <button 
                            @click="show = !show"
                            class="py-2 pl-3 pr-9 text-sm font-semibold w-36 text-left">
                            {{ isset($currentTag) ? ucwords($currentTag->name) : 'Tags' }}
                                <svg class="transform -rotate-90 absolute pointer-events-none inline-flex" style="right: 12px;" width="22"
                                height="22" viewBox="0 0 22 22">
                                    <g fill="none" fill-rule="evenodd">
                                        <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                        </path>
                                        <path fill="#222"
                                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                                    </g>
                                </svg>
                        </button>
        
                        <div x-show="show" class="py-2 absolute bg-gray-100 w-full rounded-xl mt-2 z-20" style="display: none">
                                <a href="/"
                                    :active='request()->routeIs("home")'
                                    class="block w-full text-left px-3 py-1 text-sm leading-6 hover:bg-gray-300 focus:bg-gray-300 font-semibold">
                                    All
                                </a>
                            @foreach ($tags as $tag)
                                <a href="/?tag={{ $tag->slug }}&{{ http_build_query(request()->except('tag')) }}"
                                    :active='request()->is("tags/{$tag->slug}")'
                                    class="block w-full text-left px-3 py-1 text-sm leading-6 hover:bg-gray-300 focus:bg-gray-300 font-semibold">
                                   {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
        
                    </div>
                </div>
        
                <!-- Search -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                    <form method="GET" action="/">
                        @if (request('category') )
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('tag') )
                            <input type="hidden" name="tag" value="{{ request('tag') }}">
                        @endif
                        <input type="text" name="search" placeholder="Find something"
                               class="bg-transparent placeholder-black font-semibold text-sm">
                    </form>
                </div>
            </div>
        </x-slot>
        <div class="lg:grid lg:grid-cols-6">
         
            @foreach ($posts as $post)
                <x-post-article
                    :post="$post"
                    class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"
                />
            @endforeach

        </div>

    </main>
</x-app-layout>
