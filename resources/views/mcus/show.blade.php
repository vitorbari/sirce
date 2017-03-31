@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">

                    <img src="{{ $mcu->picture }}" alt="{{ $mcu->mcu }}" class="img-responsive">

                    <h2>{{ $mcu->mcu }}</h2>

                    @if($mcu->manufacturer)
                        <li>Manufacturer: <a href="{{ route('manufacturers.show', $mcu->manufacturer_id) }}">{{ $mcu->manufacturer->manufacturer }}</a></li>
                    @endif
                    @if($mcu->family)
                        <li>Mcu Family: {{ $mcu->family->mcu_family }}</li>
                    @endif
                    @if($mcu->website)
                        <li>Website: <a href="{{ $mcu->website }}" target="_blank">{{ $mcu->website }}</a></li>
                    @endif
                </div>
            </div>


        </div>
        <div class="col-md-8">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#boards" aria-controls="boards" role="tab" data-toggle="tab">
                            Boards
                            <span class="badge">{{ $mcu->boards->count() }}</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#about" aria-controls="about" role="tab" data-toggle="tab">
                            About
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="boards">
                        @if($mcu->boards)

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Manufacturer</th>
                                    <th>Family</th>
                                    <th>Board</th>
                                </thead>
                                <tbody>
                                    @foreach($mcu->boards as $board)
                                        <tr>
                                            <td>
                                                <a href="{{ route('manufacturers.show', $board->manufacturer->id) }}">{{{ $board->manufacturer->manufacturer }}}</a>
                                            </td>
                                            <td>{{ $board->family->board_family }}</td>
                                            <td>
                                                <a href="{{ route('boards.show', $board->id) }}">{{{ $board->board }}}</a>
                                            </td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                            </table>

                        @else
                            <p class="text-center text-muted">No boards found.</p>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane" id="about">
                        @if($mcu->description)
                            {{ $mcu->description }}
                        @else
                            <p class="text-center text-muted">Not found.</p>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>


    {{-- $mcu --}}

@endsection
