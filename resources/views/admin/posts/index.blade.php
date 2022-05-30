<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="px-6 py-8">

        <div class="flex">
            <aside class="w-48 border-r border-gray-700 mr-10">
                <ul>
                    <li>
                        <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}">All Posts</a>
                    </li>
                    <li>
                        <a href="/admin/posts/create" class="{{ request()->is('admin/posts/crate') ? 'text-blue-500' : '' }}">New Post</a>
                    </li>
                </ul>
            </aside>
            <div class="flex-1 rounded-xl p-6">
                
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                Category
                </th>
                <th scope="col" class="px-6 py-3">
                Published
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Delete</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        @if (isset($post->image))
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Lary avatar" width="100px" height="100px" class="rounded-xl">
                       @else
                            <img src="https://picsum.photos/100/100?id={{ $post->id }}" alt="" class="rounded-xl">
                       @endif
                    </th>
                    <td class="px-6 py-4">
                        {{ $post->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->category->name }}
                    </td>
                    <td class="px-6 py-4">
                        Published <time>{{ $post->created_at->diffForHumans() }}</time>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="/admin/posts/{{ $post->id }}/edit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4 text-right">
                            <form method="POST" action="/admin/posts/{{ $post->id }}">
                                @csrf
                                @method('DELETE')

                                <button class="text-sm text-gray-500 font-semibold" type="submit">Delete</button>
                            </form>
                    </td>
                </tr>
            @endforeach
           
        </tbody>
    </table>
    </div>
    
            </div>
        </div>
        
    </section>
</x-app-layout>