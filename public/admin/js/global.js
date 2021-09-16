/**
 * Created by Kishan on 19-06-2021.
 */
$(function(){
    'use strict';
    $.validate({
        modules: 'file'
    });

    if ($('.select2').length > 0){
        $('.select2').select2({
            placeholder: "--SELECT--",
            minimumResultsForSearch: Infinity
        });
    }
    if ($('.wysiwyg_editor').length > 0){
        $('.wysiwyg_editor').summernote({
            tabsize: 4,
            height: 250
        });
    }
    if ($('.dropify').length > 0){
        $('.dropify').dropify();
    }
});
function confirmDelete(delete_url) {
    bootbox.confirm({
        size: 'large',
        message: "Are you sure you want to delete ?",
        buttons: {
            confirm: {
                label: "Yes",
                className: 'btn-success btn-sm'
            },
            cancel: {
                label: "No",
                className: 'btn-danger btn-sm'
            }
        },
        callback: function (result) {
            if (result === true) {
                window.location = delete_url;
            }
        }
    });
}