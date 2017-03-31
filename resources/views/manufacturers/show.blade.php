@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">

                    @if($picture = $manufacturer->picture)
                        <img src="{{ $picture }}" alt="{{ $manufacturer->manufacturer }}" class="img-responsive">
                    @endif

                    <h2>{{ $manufacturer->manufacturer }}</h2>

                    <ul class="profile-list">
                        @if($manufacturer->website)
                            <li>Website: <a href="{{ $manufacturer->website }}" target="_blank">{{ $manufacturer->website }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>


        </div>
        <div class="col-md-8">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#about" aria-controls="about" role="tab" data-toggle="tab">
                            About
                        </a>
                    </li>
                    @if($manufacturer->boards->count())
                        <li role="presentation">
                            <a href="#boards" aria-controls="components" role="tab" data-toggle="tab">
                                Boards
                                <span class="badge">{{ $manufacturer->boards->count() }}</span>
                            </a>
                        </li>
                    @endif
                    @if($manufacturer->components->count())
                        <li role="presentation">
                            <a href="#" aria-controls="" role="tab" data-toggle="tab">
                                Components
                                <span class="badge">{{ $manufacturer->components->count() }}</span>
                            </a>
                        </li>
                    @endif
                    @if($manufacturer->mcus->count())
                        <li role="presentation">
                            <a href="#mcus" aria-controls="" role="tab" data-toggle="tab">
                                MCUs
                                <span class="badge">{{ $manufacturer->mcus->count() }}</span>
                            </a>
                        </li>
                    @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="about">
                        @if($manufacturer->description)
                            {{ $manufacturer->description }}
                        @else
                            <p class="text-center text-muted">Not found.</p>
                        @endif
                    </div>

                    <div role="tabpanel" class="tab-pane" id="boards">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Family</th>
                                <th>Board</th>
                            </thead>
                            <tbody>
                                @foreach($manufacturer->boards as $board)
                                    <tr>
                                        <td>{{ $board->family->board_family }}</td>
                                        <td>
                                            <a href="{{ route('boards.show', $board->id) }}">{{{ $board->board }}}</a>
                                            </td>
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="components">
                        {{ $manufacturer->components }}
                    </div>

                    <div role="tabpanel" class="tab-pane" id="mcus">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Family</th>
                                <th>MCU</th>
                            </thead>
                            <tbody>
                                @foreach($manufacturer->mcus as $mcu)
                                    <tr>
                                        <td>{{ $mcu->family->mcu_family }}</td>
                                        <td>
                                            <a href="{{ route('mcus.show', $mcu->id) }}">{{{ $mcu->mcu }}}</a>
                                            </td>
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="content-ad">
                <!-- Sirce Content Ad -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-6675624626714363"
                     data-ad-slot="9266934222"
                     data-ad-format="auto"></ins>
            </div>

        </div>
    </div>


    {{-- $manufacturer --}}

@endsection
