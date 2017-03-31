@extends('layouts.app')

@section('content')

    {{ $component->photos }}

    <div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">

                    @if($picture = $component->picture)
                        <img src="{{ $picture }}" alt="{{ $component->component }}" class="img-responsive">
                    @endif

                    <h2>{{ $component->component }}</h2>

                    <ul class="profile-list">
                        @if($component->manufacturer)
                            <li>Manufacturer: <a href="{{ route('manufacturers.show', $component->manufacturer_id) }}">{{ $component->manufacturer->manufacturer }}</a></li>
                        @endif
                        <li>
                            Category:
                            @foreach($component_category_hierarchy as $key => $category)
                                @if($key > 0)
                                    /
                                @endif
                                {{ $category }}
                            @endforeach
                        </li>
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
                            <span class="badge">{{ $component->references->count() }}</span>
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
                        @include('references.partials.list', ['references' => $component->references])
                    </div>

                    <div role="tabpanel" class="tab-pane" id="about">
                        @if($component->description)
                            {{ $component->description }}
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


    {{-- $component --}}

@endsection
