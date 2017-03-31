@if($profiles->count())
    <ul class="list-group">
        @foreach($profiles as $user)
            <li class="list-group-item">
                <span class="small pull-right">{{ number_format($user->references->count()) }} sketches</span>
                <a href="{{ route('profiles.index', $user->id) }}">{{{ $user->name }}}</a>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-center text-muted">No profiles found.</p>
@endif
