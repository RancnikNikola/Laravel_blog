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
                        <a href="/admin/posts/create" class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                    </li>
                </ul>
            </aside>
            <div class="flex-1 rounded-xl p-6">
                
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-6">
                <label 
                    for="title"
                    class="block mb-2 uppercase font-bold text-xs text-gray-700"
                    >
                    Title
                </label>

                <input 
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $post->title) }}"
                    required
                >
        

            @error('title')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
                <label 
                    for="body"
                    class="block mb-2 uppercase font-bold text-xs text-gray-700"
                    >
                    Content
                </label>

                <textarea 
                        class="w-full p-2" 
                        name="body" 
                        id="body" 
                        rows="5" 
                        placeholder="Write your article here"
                        required
                        >
                        {{ old('body', $post->body) }}
                    </textarea>
        

            @error('body')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            
            <label 
                for="image"
                class="block mb-2 uppercase font-bold text-xs text-gray-700"
                >
                Image
            </label>

            <input type="file" id="image" name="image">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Lary avatar" class="mt-5">

     </div>
     <div class="mb-6">
        <label 
            for="category_id"
            class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
            Category
        </label>

        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" 
                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                {{ ucwords($category->name) }}</option>
            @endforeach
        </select>


    @error('category_id')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
 </div>
     <div class="mb-6">
        <button type="submit"
            class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"
            >Update</button>
    </div>
    </form>
    </div>
    
            </div>
        </div>
        
    </section>
</x-app-layout>