<ul class='menulist'>
	<li><a href='{{ URL::to("admin/dashboard") }}' {{ (Request::segment(2)=='dashboard')?"class=active":"" }} ><span class='fa fa-dashboard'></span>&nbsp; Dashboard</a></li>
	@if((int)Session::get('users.user_type_id')==2)
	<li><a href='{{ URL::to("admin/company-profile") }}' {{ (Request::segment(2)=='company-profile')?"class=active":"" }} ><span class='fa fa-building'></span>&nbsp; Company Profile</a></li>
	@endif
	<li><a href='{{ URL::to("admin/reports") }}' {{ (Request::segment(2)=='reports')?"class=active":"" }} ><span class='fa fa-tasks'></span>&nbsp; Reports</a></li>
</ul>  