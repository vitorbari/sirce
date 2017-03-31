<div class="panel panel-default">
    <div class="panel-heading">Boards:</div>
    <div class="panel-body" style="min-height: 50px;
              max-height: 350px;
              overflow-y: scroll;">
        <ul class="list-unstyled">
            @foreach($board_families as $family)
                <li>
                    {{ $family->board_family }}

                    @foreach($family->boards as $board)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('board_id[]', $board->id, isset($reference) ? $reference->boards->contains($board->id) : FALSE) !!}
                                {{ $board->board }}
                            </label>
                        </div>
                    @endforeach
                </li>
            @endforeach
        </ul>
    </div>
</div>

