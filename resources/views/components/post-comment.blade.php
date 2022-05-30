@props(['comment'])

<article class="flex bg-gray-100 p-6 rounded-xl">

    <div class="flex-shrink-0 mr-4">
        <img src="https://i.pravatar.cc/60?u={{ $comment->id }}" alt="" width="60px" height="60px" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->user->name }}</h3>
            <p class="text-xs">Posted <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time></p>
        </header>
        <p> 
            {{ $comment->body }}
        </p>
    </div>

</article>