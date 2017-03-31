@if($references->count())
    <ul class="list-group">
        @foreach($references as $reference)
            <li class="list-group-item">
                <a href="{{ route('sketches.show', $reference->id) }}">{{{ $reference->title }}}</a>

                <div class="row">
                    <div class="col-sm-8 small muted">by {{ $reference->user->name }}</div>

                    @if(isset($show_stars_count))
                        <div class="col-sm-4 small text-right">{{ number_format($reference->favorites->count()) }} stars</div>
                    @endif

                    @if(isset($show_views_count))
                        <div class="col-sm-4 small text-right">{{ number_format($reference->views) }} views</div>
                    @endif

                </div>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-center text-muted">No sketches found.</p>
@endif
