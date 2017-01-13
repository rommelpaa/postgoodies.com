@extends('layouts.main')

@section('title', '404 Page could not be found')

@section('content')
	<div class="main-content">
		<div class="row-fluid clearfix">
			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
				<div class="white-panel pn-content pd">
					<div class="row-fluid text-center pd">
						<h1>[404]</h1>
						<br/>
						<h3>Page not found!</h3>
						<br/>
						<a href="{{ URL::to('/') }}" class="btn btn-md btn-primary"><span class='fa fa-home'></span>&nbsp;Return to Main Page</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop