@extends('layouts.main')

@section('title', 'Post Goodies | Home Page')

@section('header-menu')
    @include('layouts.site.header-menu')
@stop


@section('content')
    <div class='row clearfix header-content clearfix' id='home'>                
        <div class="col-md-6 col-md-offset-3 text-center pd">
        	<br/><br/><br/><br/><br/>
        	<form method="get" action="{{ route('company') }}">
        		<div class="row-fluid">
            		<div class="form-group clearfix">
            			<div class="col-lg-12">
						    <div class="input-group pd">
							    <input type="text" class="form-control search" name='company' placeholder="Search for company">
							    <span class="input-group-btn">
							    	<button class="btn btn-primary btn-search" type="button"><span class='fa fa-search'></span>&nbsp;Go!</button>
							    </span>
						    </div>
						</div>
            		</div>
        		</div>
        	</form>
        	<br/>
			<br/>
        </div>
    </div>
    <div class="row-fluid clearfix pd" id='featured-post'>
    	<br/>
    	<div class="col-md-8">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<label class="control-label"><span class="fa fa-building"></span>&nbsp;Featured Companies</label>
    			</div>
    			<div class="panel-body">
    				Content here
    			</div>
    			<div class="panel-footer text-right">
    				<a>View more&nbsp;<i class="fa fa-chevron-right"></i></a>
    			</div>
    		</div>
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<label class="control-label"><span class="fa fa-gift"></span>&nbsp;Featured Promo</label>
    			</div>
    			<div class="panel-body">
    				Content here
    			</div>
    			<div class="panel-footer text-right">
    				<a>View more&nbsp;<i class="fa fa-chevron-right"></i></a>
    			</div>
    		</div>
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<label class="control-label">&nbsp;<span class='text-danger'><i class="fa fa-fire"></i>Hot</span>&nbsp;&&nbsp;Latest Promo</label>
    			</div>
    			<div class="panel-body">
    				<p>Content here</p>
    			</div>
    			<div class="panel-footer text-right">
    				<a>View more&nbsp;<i class="fa fa-chevron-right"></i></a>
    			</div>
    		</div>
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<label class="control-label"><span class='fa fa-cloud text-info'></span>&nbsp;Hosted Promo</label>
    			</div>
    			<div class="panel-body">
    				<p>Content here</p>
    			</div>
    			<div class="panel-footer text-right">
    				<a>View more&nbsp;<i class="fa fa-chevron-right"></i></a>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-4 mb">
    		<div class="white-panel pn-content pd">
    			<div class="header-title">
        			<h4><label class="control-label"><span class="fa fa-bullhorn"></span>&nbsp;Announcement</h4></label>
        		</div>
        		<div class="row-fluid clearfix pd">
        			<div class="alert show alert-warning" role='alert'>
        				<label class="control-label">No results found</label>
        			</div>
        		</div>
    		</div>
    		<div class="white-panel pn-content pd mt">
    			<div class="header-title">
        			<h4><label class="control-label"><span class="fa fa-envelope-o"></span>&nbsp;Join the Newsletter</h4></label>
        		</div>
        		<div class="row-fluid clearfix pd">
        			<form name="frmJoinNewsLetter" method="post">
        				<div class="form-group">
        					<p>Get updates on all the latest promos online and more by subscribing below!</p>
        					<br/>
						    <div class="input-group">
							    <input type="text" class="form-control" name='email' placeholder="Place your email">
							    <span class="input-group-btn">
							    	<button class="btn btn-primary" type="button">Subscribe!</button>
							    </span>
						    </div>
							
        				</div>
        			</form>
        		</div>
    		</div>
    		<div class="white-panel pn-content pd mt">
    			<div class="header-title">
        			<h4><label class="control-label">&nbsp;<span class='text-danger'><i class="fa fa-fire"></i>Hot</span>&nbsp;&&nbsp;Latest Promo</h4></label>
        		</div>
        		<div class="row-fluid clearfix pd">
        			<ul type="none">
        				<li><a><span class="fa fa-chevron-right"></span>&nbsp;Lorem Ipsum Dollor</a></li>
        				<li><a><span class="fa fa-chevron-right"></span>&nbsp;Lorem Ipsum Dollor</a></li>
        				<li><a><span class="fa fa-chevron-right"></span>&nbsp;Lorem Ipsum Dollor</a></li>
        				<li><a><span class="fa fa-chevron-right"></span>&nbsp;Lorem Ipsum Dollor</a></li>
        			</ul>
        		</div>
    		</div>
    	</div>
    </div>
    <div class="row clearfix pd bg-gray" id='instagramfeeds'>
    	<br/>
    	<div class="white-panel pn-content pd">
    		<div class="header-title">
    			<h4><label class="control-label"><span class="fa fa-instagram"></span>&nbsp;Instagram Feeds : #postGoodies</h4></label>
    		</div>
    		<div class="row-fluid clearfix pd mt">
		        @if(empty($data['instagram']['error_message']))
	                @if(!empty($data['instagram']['fields']))
	                    @foreach($data['instagram']['fields'] as $iglist)
	                       <div class="col-md-3 col-sm-6 col-xs-6 mb">
	                       		<div class="white-panel pn-content pd">
	                       			<a href="{{ $iglist['ig_link'] }}" target="_blank">
		                        		<div class="row-fluid clearfix hidden-xs">
		                        			<div class="header-title text-info">
		                        				<label class="control-label"><span class='fa fa-user'></span>&nbsp;{{ (strlen($iglist['user']['author_name']) > 25)?substr($iglist['user']['author_name'],0,20).'...':$iglist['user']['author_name'] }}</label>
		                        			</div>
	                        				<label class="control-label text-info small h5">Date Created&nbsp;<span class='fa fa-clock-o'></span>&nbsp;{{ date('M d, Y h:i A', $iglist['created_time']) }}</label>
		                        		</div>
		                        		<div class="row-fluid clearfix">
		                        			<img src="{{ $iglist['img_src'] }}" class="img-responsive center-block" />
		                        		</div>
		                        		<div class="row-fluid clearfix">
		                        			<div class='pull-left'>
		                        				<label class='control-label text-info'><span class='fa fa-comments'></span>&nbsp;{{ $iglist['comments'] }}</label>
		                        			</div>
		                        			<div class='pull-right'>
		                        				<label class='control-label text-danger'><span class='fa fa-heart'></span>&nbsp;{{ $iglist['likes'] }}</label>
		                        			</div>
		                        		</div>
	                        		</a>
		                      	</div>
	                      	</div>
	            		@endforeach
	            	@endif
		        @else
		            <div class='alert alert-warning' role='alert'>
		              <label class='control-label'><span class='fa fa-warning'></span>&nbsp;{{ $data['instagram']['error_message'] }}</label>
		            </div>
		            
		        @endif
    		</div>
    	</div>
    	<br/>
    </div>
    
    
@stop