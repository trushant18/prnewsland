@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">My press releases</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Press Releases</li>
                </ol>
            </nav>
        </div>
        <!-- table -->
        @include('admin.layout.partials.flash_messages')
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Recently published press releases <a
                                    class="float-right btn btn-primary btn-sm" href="{{ route('user.dashboard') }}">Submit press releases</a></h4>
                        @if(count($news_list) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Publish date</th>
                                        <th>Dateline City</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($news_list as $news)
                                        <tr>
                                            <td>{{ $news->title }}</td>
                                            <td>{{ formatDate($news->created_at) }}</td>
                                            <td>{{ $news->city }}</td>
                                            <td>{{ \App\Models\News::CATEGORIES[$news->category] }}</td>
                                            <td>
                                                @if($news->status == 0)
                                                    <label class="badge badge-warning">PROGRESS</label>
                                                @elseif($news->status == 1)
                                                    <label class="badge badge-success">DONE</label>
                                                @elseif($news->status == 2)
                                                    <label class="badge badge-danger">REJECTED</label>
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
                                <div class="col-sm-12 ">
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
