@extends('master_layout.layout')


@section('page-title')
    Update User
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Update User</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start form for validation -->
            <form id="updateuserForm" action="{{ route('admin.update_user') }}" method="POST">
                @csrf
                <input type="text" value="{{ $user->id }}" name="id" id="id1" style="display: none;">
                <div class="row my-2">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="fname1" class="required_input">Name</label>
                        <input type="text" placeholder="Enter User Name" id="fname1" class="form-control"
                            name="fname" value="{{ $user->name }}" required />
                        <span style="color:red">
                            @error('fname')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="email1" class="required_input">Email</label>
                        <input type="email" placeholder="Enter User Email" id="email1" class="form-control"
                            name="email" value="{{ $user->email }}" readonly />
                        <span style="color:red">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="mobile_number1" class="required_input">Mobile Nmber</label>
                        <input type="text" placeholder="Enter User Mobile Nmber" id="mobile_number1" class="form-control number_field"
                            name="mobile_number" value="{{ $user->mobile_number }}" minlength="10" maxlength="10"
                            required />
                        <span style="color:red">
                            @error('mobile_number')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="role1" class="required_input">Select User Role</label>
                        <select class="form-control select2" id="role1" name="role" style="width: 100%">
                            <option value="admin"@if ($user->role == 'admin') selected @endif>Admin</option>
                            <option value="employee"@if ($user->role == 'employee') selected @endif>Employee</option>
                            <option value="dealer"@if ($user->role == 'dealer') selected @endif>Dealer</option>
                            <option value="installer"@if ($user->role == 'installer') selected @endif>Installer</option>
                        </select>
                        {{-- <input type="text" placeholder="Enter User Mobile Nmber" id="mobile_number1" class="form-control" name="mobile_number" value="{{old('mobile_number')}}" required/>         --}}
                        <span style="color:red">
                            @error('role')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="form-group p-4" style="display: flex;justify-content: center;align-items: center;">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
            <!-- end form for validations -->

        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            var addForm = $("#updateuserForm");
            addForm.validate({
                errorElement: 'span',
                errorClass: 'error-message',
                submitHandler: function(form) {
                    $(form).submit();
                }
            });

            $('.number_field').on('input', function(event) {
                let inputValue = $(this).val();
                let numericValue = inputValue.replace(/[^0-9.]/g, '');
                $(this).val(numericValue);
            })
        });
    </script>
@endsection
