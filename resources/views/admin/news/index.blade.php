@extends('admin.layout.master')
@section('css')
    <link href="{{ asset('admin/theme/lib/datatables/css/jquery.dataTables.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">News</li>
        </ol>
        <h6 class="slim-pagetitle">News List</h6>
    </div>
    <div class="section-wrapper">
        @include('admin.layout.partials.flash_messages')
        <div class="table-wrapper">
            <table id="dataTable" class="table display responsive nowrap">
                <thead>
                <tr>
                    <th class="wd-40p">User Details</th>
                    <th class="wd-10p">News Title</th>
                    <th class="wd-10p">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($news_list as $item)
                    <tr>
                        <td>{{ $item->userDetails->email ?? "- -" }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <a href="{{ route("admin.news.details",$item->id) }}" class="btn btn-secondary btn-sm"
                               title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            @if($item->status == 0)
                                <a href="javascript:;" onclick="confirm('{{ route("admin.news.approve",$item->id) }}')" class="btn btn-success btn-sm"
                                   title="Approve">
                                    <div>Approve</div>
                                </a>
                                <a href="javascript:;" data-id="{{ $item->id }}" class="btn btn-danger btn-sm rejectNewsFeed"
                                   title="Reject">
                                    Reject
                                </a>
                            @elseif($item->status == 1)
                                <a href="javascript:;" class="btn btn-success btn-sm" title="Edit">
                                    <div>Approved</div>
                                </a>
                            @elseif($item->status == 2)
                                <a href="javascript:;" class="btn btn-danger btn-sm" title="Edit">
                                    <div>Rejected</div>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="modaldemo1" class="modal fade">
        <div class="modal-dialog modal-lg" role="document" style="width: 1000px;">
            <div class="modal-content bd-0 tx-14">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Reject Reason</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.news.reject') }}" method="post">
                    @csrf
                    <div class="modal-body pd-25">
                        <h5 class="lh-3 mg-b-20">Enter Reason:</h5>
                        <input type="hidden" name="news_id" id="newsId">
                        <input type="text" name="reason" class="form-control" data-validation="required">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div>
@endsection
@section('footer_scripts')
    <script src="{{ asset('admin/theme/lib/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/theme/lib/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script>
        $(function () {
            'use strict';
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: ''
                }
            });
        });

        function confirm(url){
            bootbox.confirm({
                size: 'large',
                message: "Are you sure you want to approve?",
                buttons: {
                    confirm: {
                        label: "Yes",
                        className: 'btn-success btn-sm'
                    },
                    cancel: {
                        label: "No",
                        className: 'btn-danger btn-sm'
                    }
                },
                callback: function (result) {
                    if (result === true) {
                        window.location = url;
                    }
                }
            });
        }

        $(".rejectNewsFeed").on('click', function (){
            $("#newsId").val($(this).data('id'));
            $("#modaldemo1").modal('show');
        });
        function reject(url){
            bootbox.prompt({
                size: 'large',
                title: "Enter Reason",
                callback: function (result) {
                    if (result === true) {
                        window.location = url;
                    }
                }
            });
        }
    </script>
@endsection
