<div class="form-layout">
    <div class="row mg-b-25">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                {!! Form::text('title', $blog->title ?? old('title'), ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter title', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Slug: <span class="tx-danger">*</span></label>
                {!! Form::text('slug', $blog->slug ?? old('slug'), ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'Enter slug', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Short Content: <span class="tx-danger">*</span></label>
                {!! Form::textarea('short_content', $blog->short_content ?? old('short_content'), ['class' => 'form-control', 'placeholder' => 'Enter short content', 'data-validation' => 'required', 'rows' => 3]) !!}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Content: <span class="tx-danger">*</span></label>
                {!! Form::textarea('content', $blog->content ?? old('content'), ['class' => 'form-control wysiwyg_editor']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Schema: </label>
                {!! Form::textarea('schema', $blog->schema ?? old('schema'), ['class' => 'form-control', 'placeholder' => 'Enter Schema Script']) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Image: <span class="tx-danger">*</span></label>
                <input type="file" accept="image/*" class="file-upload dropify" data-show-remove="false"
                       @if(isset($blog->image)) data-default-file="{{ showBlogImage($blog->image) }}" @endif
                       name="image" data-validation="@if(!isset($blog->image)) required @endif mime size"
                       data-validation-allowing="jpg, png, jpeg" data-validation-max-size="2M"/>
            </div>
        </div>
    </div>
    <div class="form-layout-footer">
        <button type="submit" class="btn btn-primary bd-0">@if(isset($blog)) Update @else Submit @endif</button>
        <a href="{{ route('admin.blog') }}" class="btn btn-secondary bd-0">Cancel</a>
    </div>
</div>
@section('footer_scripts')
    <script>
        $(function () {
            'use strict';
            /* SET SLUG ON LOST FOCUS OF TITLE WITH SLUG CONDITIONS */
            $("#title").focusout(function (i, d) {
                var title = $("#title").val();
                if (title.length > 0) {
                    title = title.toLowerCase();
                    title = title.replace(/[^a-z0-9\s]/gi, '').replace(/  +/g, ' ').replace(/[_\s]/g, '-');
                    if (title.length > 60) {
                        title = title.substring(0, 59).replace(/-+$/, '');
                        $(".slug-error").text("Maximum length of slug is 60");
                    } else {
                        $(".slug-error").text("");
                    }
                }
                $("#slug").val(title);
            });

            /* CONVERT TO LOWER CASE ON SLUG LOST FOCUS */
            $("#slug").focusout(function (e) {
                var slug = $("#slug").val().toLowerCase();
                $("#slug").val(slug);
            });

            /* ALLOW ONLY LOWER CASE, UPPER CASE AND NUMERIC ON SLUG KEY PRESS */
            $("#slug").keypress(function (e) {
                var regex = new RegExp("^[A-Za-z0-9-]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
        });
    </script>
@endsection
