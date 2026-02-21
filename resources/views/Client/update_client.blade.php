@extends('master_layout.layout')


@section('page-title')
    Update Client
@endsection


@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Update Client</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- start form for validation -->
            <form action="{{ route('admin.update_client') }}" method="POST" enctype="multipart/form-data"
                id="updateclientForm">
                @csrf
                <input type="hidden" value="{{ $client->id }}" name="id">
                <div class="row my-2">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="consumer_number1">Consumer Number</label>
                        <input type="text" placeholder="Enter Consumer Number" id="consumer_number1" class="form-control"
                            name="consumer_number" value="{{ $client->consumer_number }}" readonly />
                        <span style="color:red">
                            @error('consumer_number')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="client_name1" class="required_input">Client Name</label>
                        <input type="text" placeholder="Enter Client Name" id="client_name1" class="form-control"
                            name="client_name" value="{{ $client->name }}">
                        <span style="color:red">
                            @error('client_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="mobile_number1" class="required_input">Mobile Nmber</label>
                        <input type="text" placeholder="Enter Mobile Nmber" id="mobile_number1"
                            class="form-control number_field" name="mobile_number" value="{{ $client->mobile_number }}"
                            maxlength="10" />
                        <span style="color:red">
                            @error('mobile_number')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row my-2">

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="email1">Customer Mail Id</label>
                        <input type="text" placeholder="Enter Customer Mail Id" id="email" class="form-control"
                            name="email" value="{{ $client->email }}" />
                        <span style="color:red">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="bill_amount1">Running Bill Amount</label>
                        <input type="text" placeholder="Enter Running Bill Amount" id="bill_amount1"
                            class="form-control number_field" name="bill_amount" value="{{ $client->bill_amount }}" />
                        <span style="color:red">
                            @error('bill_amount')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="kw1" class="required_input">Requirement of KW</label>
                        <input type="text" placeholder="Enter KW" id="kw1" class="form-control number_field"
                            name="kw" value="{{ $client->kw }}" />
                        <span style="color:red">
                            @error('kw')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>



                <div class="row my-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="structure_length1">Structure Length</label>
                        <input type="text" placeholder="Enter Structure Length" id="structure_length1"
                            class="form-control number_field" name="structure_length"
                            value="{{ $client->structure_length }}" />
                        <span style="color:red">
                            @error('structure_length')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="structure_width1">Structure Width</label>
                        <input type="text" placeholder="Enter Structure Width" id="structure_width1"
                            class="form-control number_field" name="structure_width"
                            value="{{ $client->structure_width }}" />
                        <span style="color:red">
                            @error('structure_width')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <label for="structure_height1">Structure Height</label>
                        <input type="text" placeholder="Enter Structure Height" id="structure_height1"
                            class="form-control number_field" name="structure_height"
                            value="{{ $client->structure_height }}" />
                        <span style="color:red">
                            @error('structure_height')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                </div>

                <div class="row my-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="quotation_amount1">Final Quotation Amount</label>
                        <input type="text" placeholder="Enter Final Quotation Amount" id="quotation_amount1"
                            class="form-control number_field" name="quotation_amount"
                            value="{{ $client->quotation_amount }}" />
                        <span style="color:red">
                            @error('quotation_amount')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="reference_by1" class="required_input">Reference By</label>
                        <select class="form-control select2" id="reference_by1" name="reference_by" style="width: 100%">
                            @foreach ($User_data as $user_ref_name)
                                <option value="{{ $user_ref_name->email_assign }}"
                                    @if ($client->reference_by == $user_ref_name->name .' - '. $user_ref_name->city_name) selected @endif>
                                    {{ $user_ref_name->name }} - {{ $user_ref_name->city_name  }}
                                </option>
                            @endforeach
                        </select>
                        <span style="color:red">
                            @error('reference_by')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="address1">Customer Address (20 chars min, 100 max)</label>
                        <textarea id="address1" class="form-control" name="address" placeholder="Enter Customer Address">{{ $client->address }}</textarea>
                        <span style="color:red">
                            @error('address')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="customFile">Old Attachment</label><br>
                                <img src="{{ asset('images/' . $client->structure_image) }}" alt="Image"
                                    width="150" height="150">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <label for="structure_image1">Select Structure Image</label>
                        <input type="file" id="structure_image1" class="form-control p-1" name="structure_image"
                            value="{{ old('structure_image') }}" />
                        <span style="color:red">
                            @error('structure_image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                </div>

                <div class="form-group p-4" style="display: flex;justify-content: flex-end;align-items: center;">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
            <!-- end form for validations -->

        </div>
    </div>
@endsection


@section('script')
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
                    title: '<h5>{{ session('error') }}</h5>',
                })
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            var addForm = $("#updateclientForm");
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
