@extends('layouts.main')

@section('title', 'Post Goodies | Company Page')

@section('header-menu')
    @include('layouts.site.header-menu')
@stop


@section('content')
    <div class="row clearfix" id='featured-post'>
    	<div class='white-panel pn-content pd'>
            <div class="container clearfix mt">
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label class="control-label"><span class="fa fa-search"></span>&nbsp;Search Filter</label>
                        </div>
                        <div class="panel-body">
                            <form action="" method="post" name="frmsearch">
                                <div class="form-group">
                                    <label class="control-label">Search Criteria</label>
                                    <input type="text" class="form-control" name='txtsearch' placeholder="Company Name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Industry</label>
                                    <div class="field">
                                        <div class="select">
                                            <select class="form-control" name="industry">
                                                <option value="">Select Industry</option>
                                                @foreach($industry as $key => $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-primary btn-md"><span class='fa fa-search'></span>&nbsp;Refine</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label class="control-label"><span class='fa fa-building'></span>&nbsp;Company List</label>
                        </div>
                        <div class='panel-body'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
@stop