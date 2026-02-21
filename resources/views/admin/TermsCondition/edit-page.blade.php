@extends('master_layout.layout')

@section('title') Edit Terms & Conditions @endsection

@section('content')
<section id="summernote-edit-save">
    <div class="row">
        <div class="col-12">
            <div class="card border-info border-bottom-2">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form-horizontal edit-page-form-validate" method="post" action="{{ route('admin.terms.update') }}">
                            @csrf
                            <div class="form-group">
                                <textarea name="content" id="content">{{ $terms->content ?? '' }}</textarea>
                            </div>
                            <button id="save" class="btn btn-primary btn-min-width" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@if (session()->has('success'))
<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                title: 'title'
            },
            width: '25rem',
            padding: '10px',
            timerProgressBar: true,
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}',
        })
    });
</script>
@endif
@if (session()->has('error'))
<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                title: 'title'
            },
            width: '25rem',
            padding: '10px',
            timerProgressBar: true,
        });

        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}',
        })
    });
</script>
@endif
<!-- Load CKEditor Script -->
<script src="{{ asset('lib/ckeditor/ckeditor.js') }}" async></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize CKEditor
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('content', {
                height: 300, 
                removePlugins: 'sourcearea' 
            });
        } else {
            console.error("CKEditor could not be loaded. Check the script path.");
        }
    });
</script>
@endsection
