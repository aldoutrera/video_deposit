@layout('default')

@section('content')
    <div class="filters row">
        <div class="filters-container span12">
            <div class="row">
                <div class="span10">
                    <form action="" method="POST" class="form-inline" onsubmit="return false">
                        <i class="icon-search"></i>
                        <input type="text" class="" name="video-query" autocomplete="off" />
                        <div class="btn-group video-order" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-primary active">Newest</button>
                            <button type="button" class="btn btn-primary">Oldest</button>
                        </div>
                        <button type="button" class="btn btn-warning filter-search" data-loading-text="Searching...">Search</button>
                    </form>
                </div>
                <div class="span2">
                    <a href="/videos/new" class="btn btn-link pull-right">
                        <i class="icon-plus"></i>
                        Add Video
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="results">
    </div>
@endsection
