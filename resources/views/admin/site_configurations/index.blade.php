@extends('admin.layout.master')
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Site Configurations</li>
        </ol>
        <h6 class="slim-pagetitle">Site Configurations</h6>
    </div><!-- slim-pageheader -->
    <div class="section-wrapper">
        @if(count($site_configurations) > 0)
            @include('admin.layout.partials.flash_messages')
            <form method="POST" action="{{ route('admin.site_configurations.update') }}" accept-charset="UTF-8"
                  class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-layout form-layout-6">
                    @foreach($site_configurations as $item)
                        <div class="row no-gutters">
                            <div class="col-5 col-sm-4">
                                {{ $item->title }}:
                            </div>
                            <div class="col-7 col-sm-8">
                                {!! Form::text('configurations['.$item->identifier.']', $item->value, ['class' => 'form-control', 'placeholder' => 'Enter value']) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-layout-footer bd pd-20 bd-t-0">
                    <button type="submit" class="btn btn-primary bd-0">Update</button>
                </div>
            </form>
        @else
            <label class="section-title">No Record Found.</label>
            <p class="mg-b-20 mg-sm-b-40">Run "php artisan db:seed" command.</p>
        @endif
    </div>
@endsection
