<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Most starred</div>
            @include('references.partials.list', ['references' => $most_favorited, 'show_stars_count' => TRUE])
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Most viewed</div>
            @include('references.partials.list', ['references' => $most_viewed, 'show_views_count' => TRUE])
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Top Authors</div>
            @include('profiles.partials.list', ['profiles' => $top_authors])
        </div>
    </div>
</div>