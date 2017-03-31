<ul class="list-group">
    @foreach($boards as $board)
        <li class="list-group-item">
            <small>{{{ $board->manufacturer->manufacturer }}}</small>
            <a href="{{ route('boards.show', $board->id) }}">{{{ $board->board }}}</a>

            <div class="text-right">
                <small class="muted">{{ number_format($board->views) }} views</small>
            </div>
        </li>
    @endforeach
</ul>