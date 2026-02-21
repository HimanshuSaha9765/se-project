@extends('employee.employee_layout')


@section('page-title')
    Update Document
@endsection

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Update Document</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start form for validation -->
            <form action="{{ route('employee.update_client_document') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row my-2">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="consumer_number1">Consumer Number</label>
                        <input type="text" id="consumer_number1" class="form-control" name="consumer_number"
                            value="{{ $document_data->consumer_number }}" readonly />
                        <span style="color:red">
                            @error('consumer_number')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="adharcard_number1">Adharcard Number</label>
                        <input type="text" placeholder="Enter Adharcard Number" id="adharcard_number1"
                            class="form-control" name="adharcard_number" value="{{ $document_data->adharcard_number }}"
                            maxlength="12" />
                        <span style="color:red">
                            @error('adharcard_number')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="adharcard_image1">Old Adharcard</label>
                        <img style="width: 100%; display: block;"
                            src="{{ asset('images/' . $document_data->adharcard_image) }}" alt="image" width="100"
                            height="200" />
                        <label for="adharcard_image1">Select Adharcard</label>
                        <input type="file" id="adharcard_image1" class="form-control p-1" name="adharcard_image"
                            value="{{ $document_data->adharcard_image }}" onchange="validateImage(this)" />
                        <span style="color:red">
                            @error('adharcard_image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="light_bill1">Old Light Bill</label>
                        <img style="width: 100%; display: block;" src="{{ asset('images/' . $document_data->light_bill) }}"
                            alt="image" width="100" height="200" />
                        <label for="light_bill1">Select Light Bill</label>
                        <input type="file" id="light_bill1" class="form-control p-1" name="light_bill"
                            value="{{ $document_data->light_bill }}" onchange="validateImage(this)" />
                        <span style="color:red">
                            @error('light_bill')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="text_bill1">Old Text Bill</label>
                        <img style="width: 100%; display: block;" src="{{ asset('images/' . $document_data->text_bill) }}"
                            alt="image" width="100" height="200" />
                        <label for="text_bill1">Select Text Bill</label>
                        <input type="file" id="text_bill1" class="form-control p-1" name="text_bill"
                            value="{{ $document_data->text_bill }}" onchange="validateImage(this)" />
                        <span style="color:red">
                            @error('text_bill')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="text_bill1">Old Passport Size Image</label>
                        <img style="width: 100%; display: block;"
                            src="{{ asset('images/' . $document_data->passport_size_image) }}" alt="image"
                            width="100" height="200" />
                        <label for="passport_size_image1">Select Passport Size Image</label>
                        <input type="file" id="passport_size_image1" class="form-control p-1" name="passport_size_image"
                            value="{{ $document_data->passport_size_image }}" onchange="validateImage(this)" />
                        <span style="color:red">
                            @error('passport_size_image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="text_bill1">Old Pancard</label>
                        <img style="width: 100%; display: block;" src="{{ asset('images/' . $document_data->pancard) }}"
                            alt="image" width="100" height="200" />
                        <label for="pancard1">Select Pancard</label>
                        <input type="file" id="pancard1" class="form-control p-1" name="pancard"
                            value="{{ $document_data->pancard }}" onchange="validateImage(this)" />
                        <span style="color:red">
                            @error('pancard')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="text_bill1">Old Bank proof</label>
                        <img style="width: 100%; display: block;"
                            src="{{ asset('images/' . $document_data->bank_proof) }}" alt="image" width="100"
                            height="200" />
                        <label for="bank_proof1">Select Bank proof (Cancel Cheque)</label>
                        <input type="file" id="bank_proof1" class="form-control p-1" name="bank_proof"
                            value="{{ $document_data->bank_proof }}" onchange="validateImage(this)" />
                        <span style="color:red">
                            @error('bank_proof')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="final_confirm_amount1">Final Confirm Amount</label>
                        <input type="text" placeholder="Enter Final Confirm Amount" id="final_confirm_amount1"
                            class="form-control input-field" name="final_confirm_amount"
                            value="{{ $document_data->final_confirm_amount }}" required />
                        <span style="color:red">
                            @error('final_confirm_amount')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="deposit1">Deposit</label>
                        <input type="text" id="deposit1" class="form-control input-field" name="deposit"
                            placeholder="Enter Deposit" value="{{ $document_data->deposit }}" />
                        <span style="color:red">
                            @error('deposit')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="due_amount1">Due Amount</label>
                        <input type="text" id="due_amount1" class="form-control input-field" name="due_amount"
                            value="{{ $document_data->due_amount }}" readonly />
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
            $('.input-field').on('input', function() {
                var value1 = parseFloat($('#final_confirm_amount1').val()) || 0;
                var value2 = parseFloat($('#deposit1').val()) || 0;
                var totalAmount = value1 - value2;
                $('#due_amount1').val(totalAmount);
            });
        });
    </script>
@endsection
