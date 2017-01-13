@extends('layouts.main')

@section('title', 'Reports')

@section('header-menu')
    @include('layouts.admin.header-menu')
@stop


@section('content')
    <script type='text/javascript'>
        $(document).ready(function(){

            $.ajax({
                'url': '/admin/getReports',
                'method': 'GET',
                'dataType':'json',
                beforeSend: function(){
                    $("#tblreports").bootstrapTable('destroy');
                },
                success: function(ret){
                    var tbloption    = '';
                    if(ret.returns)
                    {
                        tbloption       = {
                                            striped: true,
                                            pagination: true,
                                            pageSize: 10,
                                            pageList: [10, 25, 50, 100, 200],
                                            columns: [
                                                          {
                                                            field: 'id',
                                                            title: '#',
                                                            align: 'center',
                                                            sortable: true
                                                          },
                                                          {
                                                            field: 'title',
                                                            title: 'Title',
                                                            align: 'center',
                                                            sortable: true,
                                                          },
                                                          {
                                                            field: 'description',
                                                            title: 'Description',
                                                            align: 'left',
                                                            sortable: true,
                                                          },
                                                          {
                                                            field: 'amount',
                                                            title: 'Amount',
                                                            align: 'center',
                                                            sortable: false,
                                                            formatter: function(value, data){
                                                                return parseInt(data.amount).toFixed(2);
                                                            }
                                                          },
                                                          {
                                                            field: 'created_at',
                                                            title: 'Date Created',
                                                            align: 'center',
                                                            sortable: true,
                                                            formatter: function(value){

                                                                var date = new Date(value);
                                                                var month = '';
                                                                switch(date.getUTCMonth() + 1){
                                                                    case 1: month = 'January';
                                                                        break;
                                                                    case 2: month = 'February';
                                                                        break;
                                                                    case 3: month = 'March';
                                                                        break;
                                                                    case 4: month = 'April';
                                                                        break;
                                                                    case 5: month = 'May';
                                                                        break;
                                                                    case 6: month = 'June';
                                                                        break;
                                                                    case 7: month = 'July';
                                                                        break;
                                                                    case 8: month = 'August';
                                                                        break;
                                                                    case 9: month = 'September';
                                                                        break;
                                                                    case 10: month = 'October';
                                                                        break;
                                                                    case 11: month = 'November';
                                                                        break;
                                                                    case 12: month = 'December';
                                                                        break;
                                                                }
                                                                return month+' '+date.getUTCDate()+', '+date.getUTCFullYear();
                                                                
                                                            }
                                                          },
                                                          {
                                                            field: 'id',
                                                            title: '',
                                                            align: 'center',
                                                            sortable: false,
                                                            formatter: function(value){
                                                                var action  = "<a href='/admin/reports/form/edit/"+$.base64.encode(value)+"'>"+
                                                                                 "<span title='Edit' class='text-warning fa fa-edit'>&nbsp; </span>"+
                                                                              "</a>";
                                                                return action;
                                                            }
                                                          }

                                                      ],
                                            data: ret.results
                                            
                                        }
                    }
                    $("#tblreports").bootstrapTable(tbloption);
                }

            })

            
        })
    </script>
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
                        <div class="pull-left pd">
                            <h4>
                                <label class="control-label"><span class="fa fa-tasks"></span>&nbsp;Reports</label>
                            </h4>
                        </div>
                        <div class="pull-right pd">
                            <a href="{{ URL::to('admin/reports/form/add') }}" target="_self" class="btn btn-md btn-primary"><span class="fa fa-plus"></span>&nbsp;Add New Report</a>
                        </div>
                    </div>
                    <div class="row-fluid pd">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id='tblreports'></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop