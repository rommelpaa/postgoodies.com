@extends('layouts.main')

@section('title', 'Reports Forms')

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
                            <label class="control-label"><span class="fa fa-tasks"></span>&nbsp;Reports Forms</label>
                        </h4>
                    </div>
                    <div class="row-fluid pd clearfix">
                        <form name="frmReports" method="post" action="{{ URL::to('admin/reports/form/'.$action) }}">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="alert {{ (Session::has('alertType'))?Session::get('alertType').' show':'hide' }}" role='alert'>
                                    @if(Session::has('message'))
                                        @foreach(Session::get('message') as $key => $msg)
                                            <label class="control-label"><strong>{{ $key }}</strong>&nbsp;:&nbsp;{{ $msg }}</label>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" value='{{ !empty($reports["returns"])?$reports["results"][0]->title:'' }}' name='title' required='required' />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" rows='5' name="description" required='required'>{{ !empty($reports["returns"])?$reports["results"][0]->description:'' }}</textarea>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-3 no_padding">
                                        <label class="control-label">Amount</label>
                                        <input type="text" class="form-control" value='{{ !empty($reports["returns"])?$reports["results"][0]->amount:'' }}' name='amount' required='required' />
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <button class="btn btn-md btn-primary col-md-12 col-sm-12 col-xs-12"><span class="fa fa-reports"></span>&nbsp;{{ ($action=='add')?'Save':'Update' }}</button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="{{ $id }}" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop