@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">My press releases</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My press releases</li>
                </ol>
            </nav>
        </div>
        <!-- table -->
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Recently published press releases <a class="float-right btn btn-primary btn-sm" href="#">Submit press releases</a></h4>
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
                                <tr>
                                    <td>New business</td>
                                    <td>Dec 5, 2017</td>
                                    <td>Mumbai</td>
                                    <td>New business</td>
                                    <td><label class="badge badge-success">DONE</label></td>
                                </tr>
                                <tr>
                                    <td>New hire</td>
                                    <td>Dec 5, 2017</td>
                                    <td>Delhi</td>
                                    <td>New hire</td>
                                    <td><label class="badge badge-warning">PROGRESS</label></td>
                                </tr>
                                <tr>
                                    <td>Book release</td>
                                    <td>Dec 5, 2017</td>
                                    <td>Bangalore</td>
                                    <td>Book release</td>
                                    <td><label class="badge badge-info">ON HOLD</label></td>
                                </tr>
                                <tr>
                                    <td>Rebranding</td>
                                    <td>Dec 5, 2017</td>
                                    <td>Ahmedabad</td>
                                    <td>Rebranding</td>
                                    <td><label class="badge badge-danger">REJECTED</label></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-4">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
