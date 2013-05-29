@layout('default')

@section('content')
    <div class="row">
        <div class="user span12">
            @if (count($videos) == 0)
                <div class="alert alert-error">
                    The user has no videos.
                </div>
            @else
                <p class="title">
                    Videos by <a href="/users/view/{{ $user->id }}">{{ $user->name }}</a>
                </p>
                @include('partials.video-list')
            @endif
        </div>
    </div>
    {{ $links }}
@endsection
