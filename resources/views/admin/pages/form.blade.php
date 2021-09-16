<div class="form-layout">
    <div class="row mg-b-25">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                {!! Form::text('title', $page->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Page Type: <span class="tx-danger">*</span></label>
                {!! Form::select('type', $page_types, $page->type ?? old('type'), ['class' => 'form-control select2', 'placeholder' => '', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Content: <span class="tx-danger">*</span></label>
                {!! Form::textarea('content', $page->content ?? old('content'), ['class' => 'form-control wysiwyg_editor']) !!}
            </div>
        </div>
    </div>
    <div class="form-layout-footer">
        <button type="submit" class="btn btn-primary bd-0">@if(isset($page)) Update @else Submit @endif</button>
        <a href="{{ route('admin.pages') }}" class="btn btn-secondary bd-0">Cancel</a>
    </div>
</div>