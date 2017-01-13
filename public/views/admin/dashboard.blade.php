@extends('layouts.main')

@section('title', 'Dashboard')

@section('header-menu')
    @include('layouts.admin.header-menu')
@stop


@section('content')
    <div class="main-content">
        <div class='left-panel clearfix'>
            <div class='row-fluid'>
                @include('layouts.admin.leftpanel')
            </div>
        </div>
        <div class='content-panel clearfix'>
            <div class='row-fluid clearfix'>                
                <div class="white-panel pn-content pd mt">
                    <div class="header-title">
                        <h4>
                            <label class="control-label"><span class="fa fa-dashboard"></span>&nbsp;Dashboard</label>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop