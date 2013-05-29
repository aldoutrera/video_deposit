@layout('default')

@section('content')
    <div class="filters row">
        <div class="filters-container span12">
            <div class="row">
                <div class="span12">
                    <form action="" method="POST" class="form-inline" onsubmit="return false">
                        <i class="icon-search"></i>
                        <input type="text" class="" name="user-query" autocomplete="off" />
                        <button type="button" class="btn btn-warning filter-search" data-loading-text="Searching...">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="results"></div>
@endsection
