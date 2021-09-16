@extends('admin.layout.master')
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
        <h6 class="slim-pagetitle">Dashboard 01</h6>
    </div><!-- slim-pageheader -->

    <div class="card card-dash-one mg-t-20">
        <div class="row no-gutters">
            <div class="col-lg-3">
                <i class="icon ion-ios-analytics-outline"></i>
                <div class="dash-content">
                    <label class="tx-primary">Impressions</label>
                    <h2>822,490</h2>
                </div><!-- dash-content -->
            </div><!-- col-3 -->
            <div class="col-lg-3">
                <i class="icon ion-ios-pie-outline"></i>
                <div class="dash-content">
                    <label class="tx-success">Page Visits</label>
                    <h2>465,183</h2>
                </div><!-- dash-content -->
            </div><!-- col-3 -->
            <div class="col-lg-3">
                <i class="icon ion-ios-stopwatch-outline"></i>
                <div class="dash-content">
                    <label class="tx-purple">Commision</label>
                    <h2>781,524</h2>
                </div><!-- dash-content -->
            </div><!-- col-3 -->
            <div class="col-lg-3">
                <i class="icon ion-ios-world-outline"></i>
                <div class="dash-content">
                    <label class="tx-danger">Earnings</label>
                    <h2>369,657</h2>
                </div><!-- dash-content -->
            </div><!-- col-3 -->
        </div><!-- row -->
    </div><!-- card -->
@endsection
