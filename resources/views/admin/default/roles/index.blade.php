{{--MASTER PAGE--}}
@extends('admin.default.master')
{{--Title Heading--}}
@section('title_heading',$lang['title_heading'])
{{--OTHER CSS--}}
@section('css')
    <!-- Datatables -->
    <link href="{{$asset_path}}vendors/DataTables-1.10.12/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection
{{--OTHER JS--}}
@section('js')
    <!-- Datatables -->
    {{--<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>--}}
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/jquery.dataTables.min.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/dataTables.bootstrap.min.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/dataTables.buttons.min.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/buttons.flash.min.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/jszip.min.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/pdfmake.min.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/vfs_fonts.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/buttons.html5.min.js"></script>
    <script src="{{$asset_path}}vendors/DataTables-1.10.12/extensions/buttons.print.min.js"></script>
    <!-- Bootstrap Confirmation -->
    <script src="{{$asset_path}}vendors/bootstrap-confirmation/bootstrap-confirmation.js"></script>
@endsection
{{--OTHER JS-INIT--}}
@section('js-init')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ajax": "{!! route('roles.datatable') !!}",
                "language": {
                    "emptyTable": "{{$lang['text_empty']}}",
                    "info": "{{$lang['info']}}",
                    "infoEmpty": "{{$lang['infoEmpty']}}",
                    "infoFiltered": "{{$lang['infoFiltered']}}",
                    "lengthMenu": "{{$lang['lengthMenu']}}",
                    "loadingRecords": "{{$lang['loadingRecords']}}",
                    "processing": "{{$lang['processing']}}",
                    "search": "",
                    "searchPlaceholder": "{{$lang['searchPlaceholder']}}",
                    "zeroRecords": "{{$lang['zeroRecords']}}",
                    "paginate": {
                        "first": "{{$lang['first']}}",
                        "last": "{{$lang['last']}}",
                        "next": "{{$lang['next']}}",
                        "previous": "{{$lang['previous']}}"
                    },
                    "aria": {
                        "sortAscending": "{{$lang['sortAscending']}}",
                        "sortDescending": "{{$lang['sortDescending']}}"
                    }
                },
                "columns": [
                    {data: 'rownum', name: 'rownum', searchable: false},
                    {data: 'app_key', name: 'app_key'},
                    {data: 'value', name: 'value'},
                    {data: 'orders', name: 'orders'},
                    {data: 'cmd', name: 'cmd', orderable: false, searchable: false}
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script>
        $(function () {
            $(document).ajaxComplete(function () {
                $('.delete-row').confirmation({
                    popout: true,
                    singleton: true,
                    placement: 'left',
                    html: true,
                    title: '{{$lang['msg_confirm_title']}}',
                    btnOkLabel: '{{$lang['msg_confirm_ok']}}',
                    btnCancelLabel: '{{$lang['msg_confirm_cancel']}}',
                    onConfirm: function () {
                        var parent = $(this).parents('tr');
                        var id = parent.attr('id');
                        $.get({
                            url: '{{URL::route($route_index)}}/' + id + '/delete',
                            data: id,
                            success: function (a) {
                                $(parent).fadeOut(function () {
                                    $(this).remove()
                                });
                                $('#TMAlert').TMAlert({message: a});
                            }
                        });
                    }
                });
            })
        })
    </script>
@endsection
{{--CONTENT--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$lang['title_list']}}
                        </h2>
                        <div>
                            <a class="btn btn-primary pull-right btn-sm"
                               href="{!! route($route_create) !!}">{{$lang['button_new']}}</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <table id="datatable" class="table table-striped table-bordered dataTable no-footer display"
                                   aria-describedby="datatable_info" role="grid">
                                <thead>
                                <tr>
                                    <th class="cmd-col">{{$lang['entry_stt']}}</th>
                                    <th>{{$lang['entry_roles_key']}}</th>
                                    <th>{{$lang['entry_roles_value']}}</th>
                                    <th class="order-col">{{$lang['entry_order']}}</th>
                                    <th class="cmd-col">#</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection