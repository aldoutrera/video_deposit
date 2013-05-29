@layout('default')

@section('content')
    <div class="video-details row">
        <div class="span12">
            <div class="info row">
                <div class="span12">
                    <h3 class="title">{{ $video->title }}</h3>
                    <form class="form-inline" action="/videos/delete/{{ $video->id }}" method="POST">
                        By <a href="/users/view/{{ $video->user->id }}">{{ $video->user->name }}</a>
                        on {{ $video->created_at }} | {{ $video->views_count }} views
                        <a class="btn btn-info" href="/videos/edit/{{ $video->id }}">Edit</a>
                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                    </form>
                </div>
            </div>
            <div class="iframe row">
                <div class="span12">
                    {{ $video->html }}
                </div>
            </div>
            <div class="comments row">
                <div class="span12">
                    @include('partials.disqus')
                </div>
            </div>
        </div>
    </div>
@endsection
