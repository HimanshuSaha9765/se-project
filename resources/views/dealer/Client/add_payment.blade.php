@extends('dealer.dealer_layout')

@section('page-title')
    Add Payment
@endsection

@php
    use Carbon\Carbon;
    $currentDate = Carbon::now('Asia/Kolkata')->format('d-m-Y');

    if (count($payment->get()) > 0) {
        $payment123 = $payment->get();
        $payment_first = $payment->first();

        if ($payment->latest()->first() !== null) {
            $Payment2 = $payment->latest()->first();
        } else {
            $Payment2 = $payment->latest('id')->skip(1)->take(1)->first();
        }

        $maxFinalConfirmAmount = $payment->final_confirm_amount;
        // $maxFinalConfirmAmount = $payment->max('final_confirm_amount');
    }
@endphp
@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Add Payment</h2>
            <div class="clearfix"></div>
        </div>

        @if ($Client_Document_Data)
            <div class="x_content">

                @if ($payment->exists())
                    @isset($payment_first->consumer_number)
                        @if ($payment_first->consumer_number == decrypt(request('authUser')))
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header"
                                    style="border-bottom: 1px solid black;display: flex;justify-content: space-between">
                                    <h2 style="font-weight: 600;text-transform: capitalize;">
                                        <span class="badge bg-secondary px-2 py-2 text-white" style="font-weight: 800">
                                            Consumer Number : {{ $Client_Document_Data->consumer_number }}
                                        </span>
                                    </h2>
                                    <h2 style="font-weight: 600;text-transform: capitalize;">
                                        <span class="badge bg-secondary px-2 py-2 text-white" style="font-weight: 800">
                                            Date : {{ $currentDate }}
                                        </span>
                                    </h2>
                                </div>

                                <ul class="p-2">
                                    <li class="list-group-item" style="font-size: 18px">Total
                                        Final Confirm Amount : {{ $maxFinalConfirmAmount }}</li>

                                    <li class="list-group-item text-success"
                                        style="font-size: 18px;border-bottom: 1px solid black !important">
                                        Recieved Amount : {{ $Payment2->total_amount ?? '-' }}</li>
                                    @if ($Payment2->total_amount > $maxFinalConfirmAmount)
                                        <li class="list-group-item text-warning"
                                            style="font-size: 18px;font-weight: bold;background: none !important;">Total
                                            Amount : {{ $Payment2->due_amount ?? '-' }}</li>
                                    @else
                                        <li class="list-group-item text-danger"
                                            style="font-size: 18px;font-weight: bold;background: none !important;">
                                            Due Amount : {{ $Payment2->due_amount ?? '-' }}</li>
                                    @endif

                                    {{-- <li class="list-group-item text-danger"
                                        style="font-size: 18px;font-weight: bold;background: none !important;">
                                        Due Amount : {{ $Payment2->due_amount ?? '-' }}</li> --}}
                                </ul>
                            </div>
                        @else
                            <div class="card mb-2" style="border: 1px solid black">
                                <div class="card-header"
                                    style="border-bottom: 1px solid black;display: flex;justify-content: space-between">
                                    <h2 style="font-weight: 600;text-transform: capitalize;">
                                        <span class="badge bg-secondary px-2 py-2 text-white" style="font-weight: 800">
                                            Consumer Number : {{ $Client_Document_Data->consumer_number }}
                                        </span>
                                    </h2>
                                    <h2 style="font-weight: 600;text-transform: capitalize;">
                                        <span class="badge bg-secondary px-2 py-2 text-white" style="font-weight: 800">
                                            Date : {{ $currentDate }}
                                        </span>
                                    </h2>
                                </div>
                                <ul class="p-2">
                                    <li class="list-group-item" style="font-size: 18px">Total
                                        Final Confirm Amount : {{ $Client_Document_Data->final_confirm_amount }}</li>
                                    <li class="list-group-item text-success"
                                        style="font-size: 18px;border-bottom: 1px solid black !important">
                                        Recieved Amount : {{ $Client_Document_Data->deposit }}</li>
                                    {{-- <li class="list-group-item" style="font-size: 18px">{{ $Client_Document_Data->due_amount }}</li> --}}
                                    <li class="list-group-item text-danger"
                                        style="font-size: 18px;font-weight: bold;background: none !important;">
                                        Due Amount : {{ $Client_Document_Data->due_amount }}</li>
                                </ul>
                            </div>
                        @endif
                    @endisset
                @else
                    <div class="card mb-2" style="border: 1px solid black">
                        <div class="card-header"
                            style="border-bottom: 1px solid black;display: flex;justify-content: space-between">
                            <h2 style="font-weight: 600;text-transform: capitalize;">
                                <span class="badge bg-secondary px-2 py-2 text-white" style="font-weight: 800">
                                    Consumer Number : {{ $Client_Document_Data->consumer_number }}
                                </span>
                            </h2>
                            <h2 style="font-weight: 600;text-transform: capitalize;">
                                <span class="badge bg-secondary px-2 py-2 text-white" style="font-weight: 800">
                                    Date : {{ $currentDate }}
                                </span>
                            </h2>
                        </div>
                        <ul class="p-2">
                            <li class="list-group-item" style="font-size: 18px">Total
                                Final Confirm Amount : {{ $Client_Document_Data->final_confirm_amount }}</li>
                            <li class="list-group-item text-success"
                                style="font-size: 18px;border-bottom: 1px solid black !important">
                                Recieved Amount : {{ $Client_Document_Data->deposit }}</li>
                            {{-- <li class="list-group-item" style="font-size: 18px">{{ $Client_Document_Data->due_amount }}</li> --}}
                            <li class="list-group-item text-danger"
                                style="font-size: 18px;font-weight: bold;background: none !important;">
                                Due Amount : {{ $Client_Document_Data->due_amount }}</li>
                        </ul>
                    </div>
                @endif



                <!-- start form for validation -->
                <form action="{{ route('dealer.insert_client_payment') }}" method="POST" id="AddPaymentForm">
                    @csrf
                    <div>
                        <input type="hidden" id="consumer_number1" name="consumer_number"
                            value="{{ $Client_Document_Data->consumer_number }}" />

                        <input type="hidden" id="payment_date1" name="payment_date" value="{{ $currentDate }}" />

                        <input type="hidden" id="total_amount_input1" name="total_amount" />
                    </div>
                    <div class="mb-3">
                        <label for="various1" class="col-form-label required_input">Choose Various</label>
                        <select class="form-control select2" id="various1" name="various" style="width: 100%">
                            <option value="=" @if (old('various') == '=') selected @endif>=</option>
                            <option value="+" @if (old('various') == '+') selected @endif>+</option>
                            <option value="-" @if (old('various') == '-') selected @endif>-</option>
                        </select>
                    </div>
                    <div class="row my-2" id="various_field1">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="various_amount1">Various Amount</label>
                            <input type="text" id="various_amount1" class="form-control number_field"
                                name="various_amount" placeholder="Enter Various Amount"
                                value="{{ old('various_amount') }}" maxlength="7" />
                            <span style="color:red">
                                @error('various_amount')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="reason1">Reason</label>
                            <input type="text" placeholder="Enter Reason" id="reason1" class="form-control"
                                name="reason" value="{{ old('reason') }}" />
                            <span style="color:red">
                                @error('reason')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="payment_mode1" class="col-form-label required_input">Choose Payment Mode</label>
                        <select class="form-control select2" id="payment_mode1" name="payment_mode" style="width: 100%">
                            <option value="cash" @if (old('payment_mode') == 'cash') selected @endif>Cash</option>
                            <option value="cheque" @if (old('payment_mode') == 'cheque') selected @endif>Cheque</option>
                            <option value="online" @if (old('payment_mode') == 'online') selected @endif>Online</option>
                        </select>
                    </div>

                    <div class="row my-2" id="payment_bank_details">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="cheque_number1" class="required_input">Cheque Number</label>
                            <input type="text" id="cheque_number1" class="form-control number_field"
                                name="cheque_number" placeholder="Enter Cheque Number"
                                value="{{ old('cheque_number') }}" maxlength="6" minlength="6" required />
                            <span style="color:red" id="cheque_number_error">
                                @error('cheque_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="bank_name1" class="required_input">Bank Name</label>
                            <input type="text" placeholder="Enter Bank Name" id="bank_name1" class="form-control"
                                name="bank_name" value="{{ old('bank_name') }}" required />
                            <span style="color:red" id="bank_name_error">
                                @error('bank_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="row my-2" id="online_payment">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="type_of_payment1" class="required_input">Type of payment</label>
                            <select class="form-control select2" id="type_of_payment1" name="type_of_payment"
                                style="width: 100%">
                                <option value="" selected></option>
                                <option value="NEFT" @if (old('type_of_payment') == 'NEFT') selected @required(true) @endif>
                                    NEFT</option>
                                <option value="RTGS" @if (old('type_of_payment') == 'RTGS') selected @required(true) @endif>
                                    RTGS</option>
                                <option value="BANK TRANSFER"
                                    @if (old('type_of_payment') == 'BANK TRANSFER') selected @required(true) @endif>BANK
                                    TRANSFER
                                </option>
                            </select>
                            <span style="color:red" id="type_of_payment_error">
                                @error('type_of_payment')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="transaction_number1" class="required_input">Transaction Number</label>
                            <input type="text" placeholder="Enter Transaction Number" id="transaction_number1"
                                class="form-control" name="transaction_number" value="{{ old('transaction_number') }}"
                                required />
                            <span style="color:red" id="transaction_number_error">
                                @error('transaction_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>


                    <div>
                        <label for="amount1" class="required_input">Amount</label>
                        <input type="text" placeholder="Enter Amount" id="amount1"
                            class="form-control input-field number_field" name="amount" value="{{ old('amount') }}"
                            maxlength="7" required />
                        <span style="color:red">
                            @error('amount')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="row m-4 p-2"
                        style="border-radius: 10px;background: #edf9f3;color: #73cd9f;border: 2px solid #73cd9f;align-items: center;gap: 10px">
                        <h3 style="font-weight: 700">Total Recieved Amount :</h3>
                        <h3 style="font-weight: 700" id="total_amount">{{ $Client_Document_Data->deposit }}</h3>
                    </div>
                    <div class="form-group p-4" style="display: flex;justify-content: center;align-items: center;">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                <!-- end form for validations -->
            </div>
        @else
            <h1>Document Added first</h1>
        @endif

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // var totalAmount = parseFloat('{{ $Client_Document_Data->deposit }}') || 0;
            var totalAmount = 0;
            // var various_amount = parseFloat($('#various_amount1').val()) || 0;
            $('#total_amount').html(totalAmount);
            $('#total_amount_input1').val(totalAmount);

            $('.input-field').on('input', function() {
                var amount = parseFloat($('#amount1').val()) || 0;
                // var depositAmt = parseFloat('{{ $Client_Document_Data->deposit }}');
                var depositAmt = 0;
                // totalAmount = amount + depositAmt + various_amount;
                totalAmount = amount + depositAmt;
                $('#total_amount').html(totalAmount);
                $('#total_amount_input1').val(totalAmount);
            });



            $('#various_amount1').on('input', function() {
                // various_amount = parseFloat($('#various_amount1').val()) || 0;
                var amount = parseFloat($('#amount1').val()) || 0;
                // var depositAmt = parseFloat('{{ $Client_Document_Data->deposit }}');
                var depositAmt = 0;
                // totalAmount = amount + depositAmt + various_amount;
                totalAmount = amount + depositAmt;
                $('#total_amount').html(totalAmount);
                $('#total_amount_input1').val(totalAmount);
            });

            // *VALIDATION STARTING 
            var addForm = $("#AddPaymentForm");
            addForm.validate({
                errorElement: 'span',
                errorClass: 'error-message',
                submitHandler: function(form) {
                    $(form).submit();
                }
            });
            // *VALIDATION END

            $('.number_field').on('input', function(event) {
                let inputValue = $(this).val();
                let numericValue = inputValue.replace(/[^0-9.]/g, '');
                $(this).val(numericValue);
            })

            various_function();

            // Event listener for type change
            $('#various1').change(function() {
                various_function();
            });

            function various_function() {
                var various1 = $('#various1').val();
                // console.log(various1);

                // Reset all fields and error messages
                $('input[type="text"]').val('');
                $('.error').text('');

                // Show/hide fields based on the selected type
                $('#various_field1').toggle(various1 === '+' || various1 === '-');
                // $('#various_field1').toggle(various1 === '-');
            }

            toggleFields();

            // Event listener for type change
            $('#payment_mode1').change(function() {
                toggleFields();
            });

            function toggleFields() {
                var selectedType = $('#payment_mode1').val();

                // Reset all fields and error messages
                $('input[type="text"]').val('');
                $('.error').text('');

                // Show/hide fields based on the selected type
                $('#payment_bank_details').toggle(selectedType === 'cheque');
                $('#online_payment').toggle(selectedType === 'online');
            }




            $('.select2').select2();
        });
    </script>
@endsection