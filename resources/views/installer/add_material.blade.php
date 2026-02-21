@extends('installer.intsaller_layout')

@section('page-title')
    Add Material
@endsection

@section('title')
    Add Material
@endsection

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>Add Material</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- start form for validation -->
            <form action="{{ route('installer.insert_material') }}" method="POST" enctype="multipart/form-data" id="Addmaterial">
                @csrf
                <div class="row my-2">
                    <div class="col-sm-6 col-xs-12 px-4">
                        <h2 class="d-block"><strong>Consumer Number</strong></h2>
                        <small class="text-secondary"
                            style="font-size: 17px;">{{ decrypt(request('authUser')) ?? '-' }}</small>
                    </div>
                    <div class="col-sm-6 col-xs-12 px-4">
                        <div class="form-group">
                            <label for="Unit" class="col-form-label required_input">Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                placeholder="Enter date" required>
                        </div>
                    </div>
                </div>
                <hr>
                <input type="hidden" value="{{ decrypt(request('authUser')) }}" name="consumer_number">
                {{-- * Structure Repeater --}}
                <div class="row my-2">
                    <div class="col-12">
                        <h2 class="d-block"><strong>Structure</strong></h2>
                        <div id="structures">
                            <div class="contact-person row">
                                <div class="form-group col">
                                    <span>Select Structure</span>
                                    <select class="form-control select2" id="structure" name="structure[]"
                                        style="width: 100%" >
                                        @foreach ($structures as $structure)
                                            <option value="{{ $structure->info_id }}"
                                                @if (old('structure') == '{{ $structure->info_id }}') selected @endif>
                                                {{ $structure->accessories_name }} {{ $structure->unit }}
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
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-success"
                                style="display: flex;
                            justify-content: center;
                            align-items: center;
                            gap: 10px;
                            "
                                name="add_structure_btn" id="add_structure_btn">
                                Add<i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- * Panel Repeater --}}
                <div class="row my-2">
                    <div class="col-12">
                        <h2 class="d-block" for="cvv"><strong>Panel</strong></h2>
                        <div id="panels_id">
                            <div class="panel_repeater row">
                                <div class="form-group col">
                                    <span>Select Panel</span>
                                    <select class="form-control select2" id="panel" name="panel[]" style="width: 100%"
                                        >
                                        @foreach ($panels as $panel)
                                            <option value="{{ $panel->info_id }}"
                                                @if (old('panel') == '{{ $panel->info_id }}') selected @endif>
                                                {{ $panel->panel_name }} {{ $panel->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_panel_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-success"
                                style="display: flex;
                            justify-content: center;
                            align-items: center;
                            gap: 10px;
                            "
                                name="add_panel_btn" id="add_panel_btn">
                                Add<i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- * Inverter Repeater --}}
                <div class="row my-2">
                    <div class="col-12">
                        <h2 class="d-block" for="cvv"><strong>Inverter</strong></h2>
                        <div id="inverter_id">
                            <div class="inverter_repeater row">
                                <div class="form-group col">
                                    <span>Select inverter</span>
                                    <select class="form-control select2" id="inverter" name="inverter[]"
                                        style="width: 100%" >
                                        @foreach ($inverters as $inverter)
                                            <option value="{{ $inverter->info_id }}"
                                                @if (old('inverter') == '{{ $inverter->info_id }}') selected @endif>
                                                {{ $inverter->inverter_name }} {{ $inverter->inverter_brand }}
                                                {{ $inverter->kw }} kw
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_inverter_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-success"
                                style="display: flex;
                            justify-content: center;
                            align-items: center;
                            gap: 10px;
                            "
                                name="add_inverter_btn" id="add_inverter_btn">
                                Add<i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- * cable Repeater --}}
                <div class="row my-2">
                    <div class="col-12">
                        <h2 class="d-block"><strong>Cable</strong></h2>
                        {{-- <label for="exampleInputPassword1">cable</label> --}}
                        <div id="cable_id">
                            <div class="cable_repeater row">
                                <div class="form-group col">
                                    <span>Select cable</span>
                                    <select class="form-control select2" id="cable" name="cable[]"
                                        style="width: 100%" >
                                        @foreach ($cables as $cable)
                                            <option value="{{ $cable->info_id }}"
                                                @if (old('cable') == '{{ $cable->info_id }}') selected @endif>
                                                {{ $cable->cable_type }} {{ $cable->cable_length }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_cable_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-success"
                                style="display: flex;
                            justify-content: center;
                            align-items: center;
                            gap: 10px;
                            "
                                name="add_cable_btn" id="add_cable_btn">
                                Add<i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- * wiring Repeater --}}
                <div class="row my-2">
                    <div class="col-12">
                        <h2 class="d-block"><strong>Wiring</strong></h2>
                        <div id="wiring_id">
                            <div class="wiring_repeater row">
                                <div class="form-group col">
                                    <span>Select wiring</span>
                                    <select class="form-control select2" id="wiring" name="wiring[]"
                                        style="width: 100%" >
                                        @foreach ($wirings as $wiring)
                                            <option value="{{ $wiring->info_id }}"
                                                @if (old('wiring') == '{{ $wiring->info_id }}') selected @endif>
                                                {{ $wiring->accessories_name }} {{ $wiring->unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_wiring_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-success"
                                style="display: flex;
                            justify-content: center;
                            align-items: center;
                            gap: 10px;
                            "
                                name="add_wiring_btn" id="add_wiring_btn">
                                Add<i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="form-group p-4" style="display: flex;justify-content: flex-end;align-items: center;">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            
                        var addForm = $("#Addmaterial");
            addForm.validate({
                errorElement: 'span',
                errorClass: 'error-message',
                submitHandler: function(form) {
                    $(form).submit();
                }
            });
            
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
                                    <span>Select Structure</span>
                                    <select class="form-control select2" id="structure" name="structure[]"
                                        style="width: 100%" >
                                        @foreach ($structures as $structure)
                                            <option value="{{ $structure->info_id }}"
                                                @if (old('structure') == '{{ $structure->info_id }}') selected @endif>
                                                {{ $structure->accessories_name }} {{ $structure->unit }}
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

            // * panel_repeater
            document.getElementById('add_panel_btn').addEventListener('click', function() {
                addPanel();
            });

            function addPanel() {

                const panels = document.getElementById('panels_id');

                // Create a new div for the contact person
                const newContactPerson = document.createElement('div');
                newContactPerson.classList.add('panel_repeater', 'row');

                // Append input fields for a contact person (similar to your existing structure)
                newContactPerson.innerHTML = `
                <div class="form-group col">
                                    <span>Select Panel</span>
                                    <select class="form-control select2" id="panel" name="panel[]" style="width: 100%"
                                        >
                                        @foreach ($panels as $panel)
                                            <option value="{{ $panel->info_id }}"
                                                @if (old('panel') == '{{ $panel->info_id }}') selected @endif>
                                                {{ $panel->panel_name }} {{ $panel->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_panel_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                `;

                // Append the new contact person div
                panels.appendChild(newContactPerson);
                disableCancelButtonIfNeededPanel();
            }

            // Event delegation to handle dynamically added cancel buttons
            document.getElementById('panels_id').addEventListener('click', function(event) {
                const target = event.target;

                if (target.matches('#cancel_btn')) {
                    const contactPersonRow = target.closest('.panel_repeater');
                    if (contactPersonRow) {
                        contactPersonRow.remove();
                        disableCancelButtonIfNeededPanel();
                    }
                }
            });

            function disableCancelButtonIfNeededPanel() {
                const panel_repeater = document.querySelectorAll('.panel_repeater');
                const cancelButtons = document.querySelectorAll(
                    '.panel_repeater .btn-danger'); // Select cancel buttons inside contact person rows

                if (panel_repeater.length === 1) {
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


            // * inverter_repeater
            document.getElementById('add_inverter_btn').addEventListener('click', function() {
                addInverter();
            });

            function addInverter() {

                const inverters = document.getElementById('inverter_id');

                // Create a new div for the contact person
                const newContactPerson = document.createElement('div');
                newContactPerson.classList.add('inverter_repeater', 'row');

                // Append input fields for a contact person (similar to your existing structure)
                newContactPerson.innerHTML = `
                <div class="form-group col">
                                    <span>Select inverter</span>
                                    <select class="form-control select2" id="inverter" name="inverter[]"
                                        style="width: 100%" >
                                        @foreach ($inverters as $inverter)
                                            <option value="{{ $inverter->info_id }}"
                                                @if (old('inverter') == '{{ $inverter->info_id }}') selected @endif>
                                                {{ $inverter->inverter_name }} {{ $inverter->inverter_brand }}
                                                {{ $inverter->kw }} kw
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_inverter_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                `;

                // Append the new contact person div
                inverters.appendChild(newContactPerson);
                disableCancelButtonIfNeededInverter();
            }

            // Event delegation to handle dynamically added cancel buttons
            document.getElementById('inverter_id').addEventListener('click', function(event) {
                const target = event.target;

                if (target.matches('#cancel_btn')) {
                    const contactPersonRow = target.closest('.inverter_repeater');
                    if (contactPersonRow) {
                        contactPersonRow.remove();
                        disableCancelButtonIfNeededInverter();
                    }
                }
            });

            function disableCancelButtonIfNeededInverter() {
                const inverter_repeater = document.querySelectorAll('.inverter_repeater');
                const cancelButtons = document.querySelectorAll(
                    '.inverter_repeater .btn-danger'); // Select cancel buttons inside contact person rows

                if (inverter_repeater.length === 1) {
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


            // * cable_repeater
            document.getElementById('add_cable_btn').addEventListener('click', function() {
                addCable();
            });

            function addCable() {
                const cables = document.getElementById('cable_id');
                // Create a new div for the contact person
                const newContactPerson = document.createElement('div');
                newContactPerson.classList.add('cable_repeater', 'row');

                // Append input fields for a contact person (similar to your existing structure)
                newContactPerson.innerHTML = `
                <div class="form-group col">
                                    <span>Select cable</span>
                                    <select class="form-control select2" id="cable" name="cable[]"
                                        style="width: 100%" >
                                        @foreach ($cables as $cable)
                                            <option value="{{ $cable->info_id }}"
                                                @if (old('cable') == '{{ $cable->info_id }}') selected @endif>
                                                {{ $cable->cable_type }} {{ $cable->cable_length }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_cable_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                `;

                // Append the new contact person div
                cables.appendChild(newContactPerson);
                disableCancelButtonIfNeededCable();
            }

            // Event delegation to handle dynamically added cancel buttons
            document.getElementById('cable_id').addEventListener('click', function(event) {
                const target = event.target;

                if (target.matches('#cancel_btn')) {
                    const contactPersonRow = target.closest('.cable_repeater');
                    if (contactPersonRow) {
                        contactPersonRow.remove();
                        disableCancelButtonIfNeededCable();
                    }
                }
            });

            function disableCancelButtonIfNeededCable() {
                const cable_repeater = document.querySelectorAll('.cable_repeater');
                const cancelButtons = document.querySelectorAll(
                    '.cable_repeater .btn-danger'); // Select cancel buttons inside contact person rows

                if (cable_repeater.length === 1) {
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

            // * wiring_repeater
            document.getElementById('add_wiring_btn').addEventListener('click', function() {
                addWiring();
            });

            function addWiring() {
                const wirings = document.getElementById('wiring_id');
                // Create a new div for the contact person
                const newContactPerson = document.createElement('div');
                newContactPerson.classList.add('wiring_repeater', 'row');

                // Append input fields for a contact person (similar to your existing structure)
                newContactPerson.innerHTML = `
                <div class="form-group col">
                                    <span>Select wiring</span>
                                    <select class="form-control select2" id="wiring" name="wiring[]"
                                        style="width: 100%" >
                                        @foreach ($wirings as $wiring)
                                            <option value="{{ $wiring->info_id }}"
                                                @if (old('wiring') == '{{ $wiring->info_id }}') selected @endif>
                                                {{ $wiring->accessories_name }} {{ $wiring->unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <span>Quantity</span>
                                    <input type="text" class="form-control" id="quantity" name="total_wiring_qty[]"
                                        placeholder="Enter quantity" >
                                </div>
                                <div class="form-group col-1">
                                    <span>&nbsp;</span>
                                    <button type="button" class="btn btn-danger" name="cancel_btn" id="cancel_btn"
                                        disabled>Cancel</button>
                                </div>
                `;

                // Append the new contact person div
                wirings.appendChild(newContactPerson);
                disableCancelButtonIfNeededWiring();
            }

            // Event delegation to handle dynamically added cancel buttons
            document.getElementById('wiring_id').addEventListener('click', function(event) {
                const target = event.target;

                if (target.matches('#cancel_btn')) {
                    const contactPersonRow = target.closest('.wiring_repeater');
                    if (contactPersonRow) {
                        contactPersonRow.remove();
                        disableCancelButtonIfNeededWiring();
                    }
                }
            });

            function disableCancelButtonIfNeededWiring() {
                const wiring_repeater = document.querySelectorAll('.wiring_repeater');
                const cancelButtons = document.querySelectorAll(
                    '.wiring_repeater .btn-danger'); // Select cancel buttons inside contact person rows

                if (wiring_repeater.length === 1) {
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
