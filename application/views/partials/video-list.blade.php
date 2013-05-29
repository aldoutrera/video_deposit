<div class="row">
    @forelse ($videos as $index => $video)
        @if ($index > 0 && $index%4==0)
            </div>
            <div class="row">
        @endif
        @include('partials.thumbnail')
    @empty
        <div class="span12">
            <div class="alert alert-warning">No videos were found, <a href="/videos/new">add some!.</a></div>
        </div>
    @endforelse
</div>
