<div class="form-layout">
    <div class="row mg-b-25">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                {!! Form::text('title', $template->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">Email Event: <span class="tx-danger">*</span></label>
                {!! Form::select('identifier', $email_events, $template->identifier ?? old('identifier'), ['class' => 'form-control select2', 'id' => 'identifier', 'placeholder' => '', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="emailVariables">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Variables</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    @if(!empty(config('emailvariables')))
                        @foreach(config('emailvariables') as $action => $details)
                            <tbody id="{{ $action }}" class="actionDiv">
                            @foreach($details as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Subject: <span class="tx-danger">*</span></label>
                {!! Form::text('subject', $template->subject ?? old('subject'), ['class' => 'form-control', 'placeholder' => 'Enter subject', 'data-validation' => 'required']) !!}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Content: <span class="tx-danger">*</span></label>
                {!! Form::textarea('content', $template->content ?? old('content'), ['class' => 'form-control wysiwyg_editor']) !!}
            </div>
        </div>
    </div>
    <div class="form-layout-footer">
        <button type="submit" class="btn btn-primary bd-0">@if(isset($template)) Update @else Submit @endif</button>
        <a href="{{ route('admin.email_templates') }}" class="btn btn-secondary bd-0">Cancel</a>
    </div>
</div>
@section('footer_scripts')
    <script>
        $(function () {
            'use strict';
            getAction($('#identifier').val());

            $("#identifier").on('change', function () {
                getAction($('#identifier').val());
            });
        });
        function getAction(selected_action) {
            $("#emailVariables").toggle(selected_action != "");
            $(".actionDiv").hide();
            if (selected_action != ""){
                $('#'+selected_action).show();
                $('#emailVariables').show();
            }else{
                $("#emailVariables").hide();
            }
        }
    </script>
@endsection