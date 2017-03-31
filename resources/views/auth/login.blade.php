@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">You can use the providers below to register / login to Sirce.info.</div>
				<div class="panel-body">

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <a href="{{ route('auth.login', 'facebook') }}" class="btn btn-primary btn-lg btn-block">
                                Login with Facebook&reg;
                            </a>

                            <a href="{{ route('auth.login', 'github') }}" class="btn btn-default btn-lg btn-block">
                                Login with GitHub&reg;
                            </a>
                        </div>
                    </div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
