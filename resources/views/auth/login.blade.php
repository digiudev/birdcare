@extends('app')

@section('content')
<link href="{{VIEW_PATH}}css/social.css" rel="stylesheet">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('auth.title_login') }}</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						{!! csrf_field() !!}

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('auth.lbl_email') }}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('auth.lbl_pwd') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
									<div class="row">
										<div class="spanfb"><a href="/auth/facebook" role="button"><img src="{{VIEW_PATH}}images/facebook.png" alt="{{ trans('auth.lbl_loginfb') }}"/><i>{{ trans('auth.lbl_loginfb') }}</i><div class="clear"></div></a></div>
									</div>
									<div class="row">
										<div class="spantw"><a href="/auth/twitter" role="button"><img src="{{VIEW_PATH}}images/twitter.png" alt="{{ trans('auth.lbl_logintw') }}"/><i>{{ trans('auth.lbl_logintw') }}</i><div class="clear"></div></a></div>
									</div>
									<div class="row">
										<div class="spangp"><a href="/auth/google" role="button"><img src="{{VIEW_PATH}}images/gplus.png" alt="{{ trans('auth.lbl_logingp') }}"/><i>{{ trans('auth.lbl_logingp') }}</i><div class="clear"></div></a></div>
									</div>
							</div>
							</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> {{trans('auth.lbl_remember_me')}}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">{{trans('auth.lbl_login')}}</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">{{trans('auth.lbl_forgot_pwd')}}</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
