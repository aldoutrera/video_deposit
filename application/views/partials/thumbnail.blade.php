<div class="video span3">
    <a href="/videos/view/{{ $video->id }}">
        <img class="lazy" data-original="{{ $video->thumbnail_url }}" src="/img/grey.gif">
    </a>
    <div class="caption">
        <p class="title">
            <a href="/videos/view/{{ $video->id }}">
                {{ $video->title }}
            </a>
        </p>
        <p class="info">
            <i>
                By <a href="/users/view/{{ $video->user->id }}">{{ $video->user->name }}</a>
                on {{ $video->created_at }}
                |
                {{ $video->views_count }} views
            </i>
        </p>
    </div>
</div>
