@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">My draf releases</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Draft Releases</li>
                </ol>
            </nav>
        </div>
        <!-- table -->
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Recently drafted press releases
                        @if(count($news_list) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Is Free?</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($news_list as $news)
                                        <tr>
                                            <td>{{ $news->title }}</td>
                                            <td>{{ ($news->is_free == 1) ? 'Yes' : 'No' }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('news.edit', $news->id) }}">Edit</a>
                                                @if(($news->is_free == 0) && ($news->payment_status == 1))
                                                    <a class="btn btn-info btn-sm" href="javascript:;">Payment Done</a>
                                                @endif
                                                @if(($news->is_free == 0) && ($news->payment_status == 0))
                                                    <a class="btn btn-warning btn-sm" href="{{ route('paidNewsForm', $news->id) }}">Payment Pending</a>
                                                @else
                                                    <a class="btn btn-success btn-sm" href="{{ route('news.publish', $news->id) }}">Publish</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation">
                                <div class="pagination justify-content-center">
                                    {!! $news_list->links("pagination::bootstrap-4") !!}
                                </div>
                            </nav>
                        @else
                            <div class="row justify-content-center">
                                <div class="col-sm-12 pt-5">
                                    No Record Found.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
