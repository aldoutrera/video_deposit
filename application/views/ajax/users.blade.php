<div class="row">
    @forelse ($users as $user)
        <div class="user span12">
            <p class="title">
                Videos by <a href="/users/view/{{ $user->id }}">{{ $user->name }}</a>
            </p>
            @if(count($user->videos) > 0)
                @render('partials.video-list', array('videos' => $user->videos))
            @else
                <div class="alert alert-error">
                    The user has no videos.
                </div>
            @endif
        </div>
    @empty
        <div class="span12">
            <div class="alert alert-warning">No users were found, add some <a href="/videos/new">videos</a> first!.</div>
        </div>
    @endforelse
    {{ $links }}
</div>
