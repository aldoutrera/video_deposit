<div class="row">
    <div class="span8 offset2 form-video">
        <div class="row">
            <div class="span8">
                <form class="form-horizontal" action="/videos/{{ $action }}" method="POST">
                    <div class="control-group">
                        <label class="control-label" for="video-url">Video Url</label>
                        <div class="controls">
                            <input type="text" id="video-url" name="video-url" placeholder="Video Url" class="input-xxlarge" value="{{ $video->url }}">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="/videos" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
