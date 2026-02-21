@extends('master_layout.layout')


@section('page-title')
    Add User
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Add User</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start form for validation -->
            <form id="adduserForm" action="{{ route('admin.insert_user') }}" method="POST">
                @csrf
                <div class="row my-2">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="fname1" class="required_input">Name</label>
                        <input type="text" placeholder="Enter User Name" id="fname1" class="form-control"
                            name="fname" value="{{ old('fname') }}" required />
                        <span style="color:red">
                            @error('fname')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="email1" class="required_input">Email</label>
                        <input type="email" placeholder="Enter User Email" id="email1" class="form-control"
                            name="email" value="{{ old('email') }}" required />
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
                            name="mobile_number" value="{{ old('mobile_number') }}" minlength="10" maxlength="10"
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
                            <option value="" disabled selected></option>
                            <option value="admin" @if (old('role') == 'admin') selected @endif>Admin</option>
                            <option value="employee" @if (old('role') == 'employee') selected @endif>Employee</option>
                            <option value="dealer" @if (old('role') == 'dealer') selected @endif>Dealer</option>
                            <option value="installer" @if (old('role') == 'installer') selected @endif>Installer</option>
                        </select>
                        {{-- <input type="text" placeholder="Enter User Mobile Nmber" id="mobile_number1" class="form-control" name="mobile_number" value="{{old('mobile_number')}}" required/>         --}}
                        <span style="color:red">
                            @error('role')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="pwd1" class="required_input">Password</label>
                        <input type="password" placeholder="Enter Password" id="pwd1" class="form-control"
                            name="pwd" value="{{ old('pwd') }}" required />
                        <span style="color:red">
                            @error('pwd')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="pwd_confirmation1" class="required_input">Confirm Password</label>
                        <input type="password" placeholder="Enter Confirm Password" id="pwd_confirmation1"
                            class="form-control" name="pwd_confirmation" value="{{ old('pwd_confirmation') }}" required />
                        <span style="color:red">
                            @error('pwd_confirmation')
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
            var addForm = $("#adduserForm");
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
