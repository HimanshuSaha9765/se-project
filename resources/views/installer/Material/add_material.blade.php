@extends('installer.intsaller_layout')

@section('page-title')
    Add Material
@endsection

@section('title')
    Add Material
@endsection

@php
    // $sell_product_demo_data_first = $sell_product_data->first();
    // $sell_product_demo_data = $sell_product_data->get();
    // dd($sell_product_demo_data);
    use Carbon\Carbon;
    $currentDate = Carbon::now('Asia/Kolkata')->format('d-m-Y');
@endphp

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Add Material</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start form for validation -->
            <form action="{{ route('admin.insert_material') }}" method="POST" enctype="multipart/form-data" id="Addmaterial">
                @csrf

                <div class="row my-2">
                    <div class="col-sm-6 col-xs-12 px-4">
                        <h2 class="d-block"><strong>Consumer Number : {{ decrypt(request('authUser')) ?? '-' }} </strong>
                        </h2>
                        {{-- <small class="text-secondary"
                            style="font-size: 17px;">{{ decrypt(request('authUser')) ?? '-' }}</small> --}}
                    </div>
                    <div class="col-sm-6 col-xs-12 px-4">
                        <div class="form-group">
                            <h2 class="d-block"><strong>Date : {{ $currentDate }}</strong></h2>
                        </div>
                    </div>
                </div>
                <hr>


                @if ($sell_product_demo_data->isNotEmpty())
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <h2 class="mb-1">Stock List</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product id</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Delete Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sell_product_demo_data as $sell_product_demo_datas)
                                        <tr>
                                            <td>{{ $sell_product_demo_datas->product_id }}</td>
                                            <td>{{ $sell_product_demo_datas->product_name }}</td>
                                            <td>{{ $sell_product_demo_datas->product_quantity }}</td>
                                            <td>
                                                <a
                                                    href="{{ URL::to('admin/') }}/sell_product_demo_datas_delete/{{ $sell_product_demo_datas->id }}">
                                                    <i class="glyphicon glyphicon-trash mx-2"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p style="color: red" class="h6">* If you have to add material then you have to do final submit otherwise it's not consider as added material.</p>
                            <p style="color: red" class="h6">* જો તમારે સામગ્રી ઉમેરવી હોય તો તમારે અંતિમ સબમિટ કરવું પડશે અન્યથા તેને ઉમેરાયેલ સામગ્રી તરીકે ગણવામાં આવશે નહીં.</p>
                            <div class="form-group p-4" style="display: flex; justify-content: flex-end; align-items: center;">
                                <button type="button" id="final-submit-data" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                @endif

                <input type="hidden" value="{{ decrypt(request('authUser')) }}" name="consumer_number">
                {{-- * Structure Repeater --}}
                <div class="row my-2">
                    <div class="col-12">
                        <h2 class="d-block"><strong>Material</strong></h2>
                        <div id="structures">
                            <div class="contact-person row">
                                <div class="form-group col">
                                    <span>Select Material</span>
                                    <select class="form-control select2" id="product_id" name="product_id"
                                        style="width: 100%">
                                        @foreach ($stock_data as $stock_datas)
                                            <option value="{{ $stock_datas->product_id }}" selected
                                                @if (old('product_id') == '{{ $stock_datas->product_name }}')  @endif>
                                                {{ $stock_datas->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">
                                        @error('product_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control number_field" id="quantity"
                                        name="product_quantity" placeholder="Enter Quantity" maxlength="3" required>
                                    {{-- <input type="text" class="form-control" id="quantity" name="total_structure_qty[]"
                                        placeholder="Enter quantity"> --}}
                                </div>
                                {{-- <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="form-group p-4" style="display: flex;justify-content: flex-end;align-items: center;">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(() => {

            $('#final-submit-data').on('click', function() {
                // Extract the 'authUser' parameter from the URL
                const urlParams = new URLSearchParams(window.location.search);
                const authUser = urlParams.get('authUser');
                console.log(authUser);

                $.ajax({
                    url: '{{ route('admin.insert_material_coform_data') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        authUser: authUser,
                    },
                    success: function(response) {
                        // console.log(response);
                        alert('Data submitted successfully!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        console.log(xhr.responseText);
                        alert('Failed to submit data.');
                    },
                });
            });




            var addForm = $("#Addmaterial");
            addForm.validate({
                errorElement: 'span',
                errorClass: 'error-message',
                submitHandler: function(form) {
                    $(form).submit();
                }
            });


            $('.number_field').on('input', function(event) {
                let inputValue = $(this).val();
                let numericValue = inputValue.replace(/[^0-9]/g, '');
                $(this).val(numericValue);
            })

            // * Structure
            document.getElementById('add_structure_btn').addEventListener('click', function() {
                addStructure();
            });

            function addStructure() {

                const structures = document.getElementById('structures');

                // Create a new div for the contact person
                const newContactPerson = document.createElement('div');
                newContactPerson.classList.add('contact-person', 'row');

                // Append input fields for a contact person (similar to your existing structure)
                newContactPerson.innerHTML = `
                <div class="form-group col">
                                    <span>Select Material</span>
                                    <select class="form-control select2" id="product_id" name="product_id[]"
                                        style="width: 100%">
                                        @foreach ($stock_data as $stock_datas)
                                            <option value="{{ $stock_datas->product_id }}" selected
                                                @if (old('product_id') == '{{ $stock_datas->product_name }}')  @endif>
                                                {{ $stock_datas->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_structure_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
            `;

                // Append the new contact person div
                structures.appendChild(newContactPerson);
                disableCancelButtonIfNeeded();
            }

            // Event delegation to handle dynamically added cancel buttons
            document.getElementById('structures').addEventListener('click', function(event) {
                const target = event.target;

                if (target.matches('#cancel_btn')) {
                    const contactPersonRow = target.closest('.contact-person');
                    if (contactPersonRow) {
                        contactPersonRow.remove();
                        disableCancelButtonIfNeeded();
                    }
                }
            });

            function disableCancelButtonIfNeeded() {
                const structures = document.querySelectorAll('.contact-person');
                const cancelButtons = document.querySelectorAll(
                    '.contact-person .btn-danger'); // Select cancel buttons inside contact person rows

                if (structures.length === 1) {
                    // Disable cancel button if there is only one contact person
                    cancelButtons.forEach(button => {
                        button.disabled = true;
                    });
                } else {
                    // Enable all cancel buttons if there are multiple contact persons
                    cancelButtons.forEach(button => {
                        button.disabled = false;
                    });
                }
            }

        })
    </script>
@endsection
