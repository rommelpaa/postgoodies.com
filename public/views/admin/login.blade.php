@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <div class="main-content">
        <div class="container clearfix">
            <div class='row-fluid pd mt col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-12'>
                <div class="panel panel-default">
                    <div class="panel-heading"><h4><strong><i>&nbsp;Login</i></strong></h4></div>
                    <div class="panel-body">
                        <div class="row-fluid pd">
                            @if(!empty($message))
                                <div class="alert {{ $alert_type }}" role='alert'>
                                    @foreach($message as $key => $row)
                                        @if($key!='logout')
                                            <label class="control-label"><strong>{{ strtoupper($key) }}</strong></label>
                                        @endif
                                        <ul type="bullet" class="pd">
                                            @foreach($row as $retMessage)
                                                <li>{{ $retMessage }}</li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                    
                                </div>
                            @endif
                            <form name='frmlogin' method="post" action="{{ route('admin-form-login') }}">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="admin-username"><i class='fa fa-user'></i></span> 
                                        <input type="text" name='username' placeholder='Username' value='' class="form-control" aria-describedby="admin-username" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="admin-password"><i class='fa fa-key'></i></span> 
                                        <input type="password" name='password' placeholder='Password' value='' class="form-control" aria-describedby="admin-password" />
                                    </div>
                                    <div class="checkbox text-right">
                                        <label>
                                            <input type="checkbox" name="rememberme" value=''>Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-sign-in"></i>&nbsp;Login</button>
                                    <input type="hidden" name='_token' value='{{ csrf_token() }}'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop