@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">

                    <img src="{{ $board->picture }}" alt="{{ $board->board }}" class="img-responsive">

                    <h2>{{ $board->board }}</h2>

                    <ul class="profile-list">
                        @if($board->manufacturer)
                            <li>Manufacturer: <a href="{{ route('manufacturers.show', $board->manufacturer_id) }}">{{ $board->manufacturer->manufacturer }}</a></li>
                        @endif
                        @if($board->family)
                            <li>Board Family: {{ $board->family->board_family }}</li>
                        @endif
                        @if($board->mcu)
                            <li>MCU: <a href="{{ route('mcus.show', $board->mcu_id) }}">{{ $board->mcu->mcu }}</a></li>
                        @endif
                        @if($board->website)
                            <li>Website: <a href="{{ $board->website }}" target="_blank">{{ $board->website }}</a></li>
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
                        <a href="#references" aria-controls="references" role="tab" data-toggle="tab">
                            Sketches
                            <span class="badge">{{ $board->references->count() }}</span>
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
                    <div role="tabpanel" class="tab-pane active" id="references">
                        @include('references.partials.list', ['references' => $board->references])
                    </div>

                    <div role="tabpanel" class="tab-pane" id="about">
                        @if($board->description)
                            {{ $board->description }}
                        @else
                            <p class="text-center text-muted">Not found.</p>
                        @endif
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


    {{-- $board --}}

@endsection
