@extends('layouts.main')

@section('title', 'Company Profile')

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
                    <div class="header-title clearfix">
                        <h4>
                            <label class="control-label"><span class="fa fa-building"></span>&nbsp;Company Profile</label>
                        </h4>
                    </div>
                    <div class="row-fluid pd">
                        <form name='frmcompany' method="post" action="{{ route('company-profile') }}" enctype='multipart/form-data'>
                            <div class="form-group clearfix">
                                <div class="col-md-12">
                                    <div class="alert-company alert hide" role="alert"></div>
                                </div>
                                <div class="col-md-4 clearfix mt">
                                    <div class='col-md-12'>
                                        <div class='upload'>
                                            <span class="fa fa-upload"></span>
                                            <label class="control-label">Upload your logo</label>
                                            <input type="file" name='companyIconUpload' onchange='getFileUpload()' />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Name</label>
                                        <input type='text' name="name" value="{{ !empty($company->name)?$company->name:'' }}" class="form-control" required='required' />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Business Number</label>
                                        <input type='text' name="businessno" value="{{ !empty($company->business_no)?$company->business_no:'' }}" class="form-control" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Email</label>
                                        <input type='text' name="email" value="{{ !empty($company->email)?$company->email:'' }}" class="form-control" required='required' />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Description</label>
                                        <textarea class="form-control" required='required' name='description' rows='5'>{{ !empty($company->description)?$company->description:'' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 clearfix">
                                    <div class="col-md-12">
                                        <label class="control-label">Address</label>
                                        <input type='text' name="address" value="{{ !empty($company->address)?$company->address:'' }}" class="form-control" required='required' />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">City</label>
                                        <input type='text' name="city" value="{{ !empty($company->city)?$company->city:'' }}" class="form-control" required='required' />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Postal Code</label>
                                        <input type='text' name="postalcode" value="{{ !empty($company->postalcode)?$company->postalcode:'' }}" class="form-control" required='required' />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Country</label>
                                        <input type='text' name="country" value="{{ !empty($company->country)?$company->country:'' }}" class="form-control" required='required' />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Industry</label>
                                        <div class='field'>
                                            <div class="select">
                                                <select name="industry" class="form-control" required='required'>
                                                    <option value="" {{ empty($company->industry)?"selected='selected'":"" }} >Select Industry</option>
                                                    @if(!empty($industry))
                                                        @foreach($industry as $key => $value)
                                                            <option value="{{ $value }}" {{ (!empty($company->industry) && $company->industry==$value)?"selected='selected'":"" }}>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 clearfix">
                                    <div class="col-md-12">
                                        <label class="control-label">Contact Person</label>
                                        <input type='text' name="contact_person" value="{{ !empty($company->contact_person)?$company->contact_person:'' }}" class="form-control" required='required' />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Contact Number</label>
                                        <input type='text' name="contactno" value="{{ !empty($company->contact_no)?$company->contact_no:'' }}" class="form-control" required='required' />
                                    </div>
                                </div>
                            </div>
                            <div class='form-group text-right'>
                                <hr/>
                                <button type='submit' class="btn btn-md btn-primary"><span class='fa fa-save'></span>&nbsp;Save</button>
                                <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
                                <div id="companyPreview"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class='content-panel clearfix'>
            <div class='row-fluid clearfix'>                
                <div class="white-panel pn-content pd mt">
                    <div class="header-title clearfix">
                        <h4>
                            <label class="control-label"><span class="fa fa-money"></span>&nbsp;My Wallet</label>
                        </h4>
                    </div>
                    <div class="row-fluid pd">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop