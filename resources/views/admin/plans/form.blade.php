<div class="form-layout">
    <div class="row mg-b-25">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                {!! Form::text('title', $plan->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
                {!! Form::text('price', $plan->price ?? old('price'), ['class' => 'form-control', 'placeholder' => 'Enter price', 'data-validation' => 'required number']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Content: <span class="tx-danger">*</span></label>
                {!! Form::textarea('content', $plan->content ?? old('content'), ['class' => 'form-control', 'placeholder' => 'Enter content', 'data-validation' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="form-layout-footer">
        <button type="submit" class="btn btn-primary bd-0">@if(isset($plan)) Update @else Submit @endif</button>
        <a href="{{ route('admin.pages') }}" class="btn btn-secondary bd-0">Cancel</a>
    </div>
</div>