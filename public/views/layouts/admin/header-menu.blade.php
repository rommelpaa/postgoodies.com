@section('header-menu')
<div class='row'>
	<header>
		<nav role="navigation" class="navbar navbar-default">
			<div class="container-fluid clearfix no_padding">
				<div class='navbar-header col-lg-12 col-md-12 col-sm-12 col-xs-12'>
					<button class='c_menu_toggle fa fa-bars' type='button'></button>
					<a class='navbar-brand' href='#'>
						<!--img width="105" class="img-responsive center-block pd" src="{{ url('public/images/acquire.png') }}"-->
					</a>
					<a href='/logout' class="btn btn-sm btn-default pull-right btn-logout">Logout</a>
				</div>
			</div>
		</nav>
	</header>
</div>
@stop