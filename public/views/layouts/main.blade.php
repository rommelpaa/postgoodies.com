<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PostGoodies">
    <meta name="author" content="RommelPaa">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<head>
	    <title>@yield('title')</title>
	     @include('snippet.head')
	</head>
	<script type="text/javascript">
		$(window).ready(function(){
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': "{{ csrf_token() }}"
			    }
			});
		})
	</script>
	<body>
	<div class="modal fade c_alert">
		<div class='row-fluid'>
			<div class="modal-dialog text-center">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove"></span></button>
						<p class="modal-title text-left" id="myModalLabel">Modal title</p>
					</div>
					<div class="modal-body">
						<!--Content Goes here-->
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	</div>	
	<section class='container-fluid'>
		@yield('header-menu')
		<div class="main-content">
			@yield('content')
		</div>
		@if(Request::segment(1)!='admin')
			<div class="row clearfix" id='contactus'>
				<div class="col-md-6 col-md-offset-3 pd mb mt">
					<form name='frmcontact' method="post" action="">
						<div class="form-group">
							<label class="control-label">If you have any feedback, suggestions, inquiries, or concerns please send us an email we are greatly appreciated your thoughts. Fill out the fields and we will get in touch with you as soon as we can. </label>
						</div>
						<div class="form-group">
							<label class="control-label">Fullname*</label>
							<input type="text" class="form-control" name='fullname' value="" autocomplete="off" required='required'/>
						</div>
						<div class="form-group">
							<label class="control-label">Email*</label>
							<input type="text" class="form-control" name='email' value="" autocomplete="off" required='required'/>
						</div>
						<div class="form-group">
							<label class="control-label">Subject*</label>
							<input type="text" class="form-control" name='subject' value="" autocomplete="off" required='required'/>
						</div>
						<div class="form-group">
							<label class="control-label">Message*</label>
							<textarea class="form-control" rows='5' required='required' name='message'></textarea>
						</div>
						<div class="form-group clearfix">
							<button class="btn btn-primary btn-md col-md-12 col-sm-12 col-xs-12"><span class="fa fa-send-o"></span>&nbsp;Send</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row clearfix pd footer">
	        	<div class="text-center">
	        		<label class="control-label">Copyright &copy; {{ date('Y') }} : Post Goodies</label>
	        	</div>
	        </div>
		@endif
	</section>
	</body>
</html>
