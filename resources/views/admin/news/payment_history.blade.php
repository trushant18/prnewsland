@extends('admin.layout.master')
@section('css')
    <link href="{{ asset('admin/theme/lib/datatables/css/jquery.dataTables.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payment History</li>
        </ol>
        <h6 class="slim-pagetitle">Payment History</h6>
    </div>
    <div class="section-wrapper">
        @include('admin.layout.partials.flash_messages')
        <div class="table-wrapper">
            <table id="dataTable" class="table display responsive nowrap">
                <thead>
                <tr>
                    <th class="wd-20p">User Details</th>
                    <th class="wd-20p">News Title</th>
                    <th class="wd-10p">Price</th>
                    <th class="wd-10p">Type</th>
                    <th class="wd-10p">Payment ID</th>
                </tr>
                </thead>
                <tbody>
                @foreach($history as $item)
                    <tr>
                        <td>{{ $item->userDetails->email ?? "- -" }}</td>
                        <td>{{ $item->newsDetails->title }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->payment_id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
    </script>
@endsection
