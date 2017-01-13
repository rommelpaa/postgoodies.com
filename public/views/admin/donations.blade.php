@extends('layouts.main')

@section('title', 'Donations')

@section('header-menu')
    @include('layouts.admin.header-menu')
@stop


@section('content')
    <script type='text/javascript'>
        $(document).ready(function(){

            $.ajax({
                'url': '/admin/getDonations',
                'method': 'GET',
                'dataType':'json',
                beforeSend: function(){
                    $("#tbldonations").bootstrapTable('destroy');
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
                                                            field: 'name',
                                                            title: 'Charity Name',
                                                            align: 'center',
                                                            sortable: true
                                                          },
                                                          {
                                                            field: 'firstname',
                                                            title: 'Full Name',
                                                            align: 'left',
                                                            sortable: true,
                                                            formatter: function(value, data){
                                                                return data.firstname+' '+data.lastname;
                                                            }
                                                          },
                                                          {
                                                            field: 'phoneno',
                                                            title: 'Contact No.',
                                                            align: 'left',
                                                            sortable: false,
                                                          },
                                                          {
                                                            field: 'country',
                                                            title: 'Country',
                                                            align: 'left',
                                                            sortable: true,
                                                          },
                                                          {
                                                            field: 'city',
                                                            title: 'City',
                                                            align: 'left',
                                                            sortable: true,
                                                          },
                                                          {
                                                            field: 'amount',
                                                            title: 'Amount',
                                                            align: 'center',
                                                            formatter: function(value, data){
                                                                return parseInt(data.amount).toFixed(2)+' '+data.currency;
                                                            }
                                                          },
                                                          {
                                                            field: 'payType',
                                                            title: 'Pay Type',
                                                            align: 'center',
                                                            sortable: true
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
                                                            field: 'donate_status',
                                                            title: 'Status',
                                                            align: 'center',
                                                            sortable: true
                                                          },
                                                          {
                                                            field: 'id',
                                                            title: '',
                                                            align: 'center',
                                                            sortable: false,
                                                            formatter: function(value){
                                                                var action  = "<a href='/admin/donations/form/view/"+$.base64.encode(value)+"'>"+
                                                                                 "<span title='View' class='text-success fa fa-eye'>&nbsp; </span>"+
                                                                              "</a>";
                                                                return action;
                                                            }
                                                          }

                                                      ],
                                            data: ret.results
                                            
                                        }
                    }
                    $("#tbldonations").bootstrapTable(tbloption);
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
                    <div class="header-title">
                        <h4>
                            <label class="control-label"><span class="fa fa-gift"></span>&nbsp;Donations</label>
                        </h4>
                    </div>
                    <div class="row-fluid pd">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id='tbldonations'></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop