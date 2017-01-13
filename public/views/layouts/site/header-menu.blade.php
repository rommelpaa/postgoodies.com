@section('header-menu')
<div class='row'>
	<header>
		<nav role="navigation" class="navbar navbar-default">
			<div class="container-fluid clearfix no_padding">
				<div class='navbar-header'>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menus-heading" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				    <a class="navbar-brand" href="#">PostGoodies</a>
				</div>
				<div class="collapse navbar-collapse" id="menus-heading">
      				<ul class="nav navbar-nav">
      					<li {{ (Request::segment(1)=='home')?"class=active":'' }}><a href="{{ URL::to('/') }}">Home</a></li>
        				<li {{ (Request::segment(1)=='company')?"class=active":'' }} ><a href="{{ URL::to('company') }}">Company</a></li>
        				<li role="presentation" class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Categories <span class="caret"></span> </a> 
        					<ul class="dropdown-menu"> 
	        					<li><a href="#">Beauty & Hair</a></li>
	        					<li><a href="#">Books</a></li> 
	        					<li><a href="#">Cash & Gift Cards</a></li> 
	        					<li><a href="#">Fasion</a></li> 
	        					<li><a href="#">Gadgets</a></li>
	        					<li role="separator" class="divider"></li> 
	        					<li><label class="control-label text-info">&nbsp;&nbsp;Others&nbsp;<span class="fa fa-chevron-down"></span></label></li> 
			        			<li role="separator" class="divider"></li> 
			        			<li><a href="#">Cars & Accessories</a></li>
			        			<li><a href="#">DIY & Crafts</a></li>
			        			<li><a href="#">Films & Categories</a></li>
			        			<li><a href="#">Foods & Drinks</a></li>
			        			<li><a href="#">Health & Fitness</a></li>
			        			<li><a href="#">Home & Kitchen & Garden</a></li>
			        			<li><a href="#">Moms & Babies</a></li>
			        			<li><a href="#">Pet Stuff</a></li>
			        			<li><a href="#">Prize Packs</a></li>
			        			<li><a href="#">Services & Software</a></li>
			        			<li><a href="#">Toys & Kids</a></li>
			        			<li><a href="#">Travels</a></li>
	        				</ul>
	        			</li>
        				<li>Contact Us</li>
      				</ul>
      				<ul class="nav navbar-nav navbar-right">
      					@if(!Session::has('users'))
	      					<li class="signup"><span class='fa fa-user-plus'></span>&nbsp;Sign Up</li>
	      					<li class="login"><span class='fa fa-sign-in'></span>&nbsp;Login</li>
      					@endif
      				</ul>
      			</div>
			</div>
		</nav>
	</header>
</div>
@stop