@extends('employee.employee_layout')

@section('page-title')
    Add Client Tracking Data
@endsection

@section('title')
    Add Client Tracking Data
@endsection

@section('content')
    <style>
        .hidden {
            display: none;
        }

        .accordion-button::after {
            color: #fff;
        }

        .accordion-button:not(.collapsed)::after {
            color: #fff;
        }

        /* style="background: #63E6BE;color: white;font-weight: 700;" */
    </style>

<div class="accordion" id="accordionExample">
    @if ($Client_Document)
        @if (!empty($Client_tracking_Data) && $Client_tracking_Data->consumer_number == decrypt(request('authUser')))
            {{-- IMAGE MODAL --}}
            <div class="modal fade bs-example-modal-lg" id="clientImgModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Image Preview</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center">
                            <a href="" class="hyperlink" download><img src=""
                                    class="img_modal img-fluid"></a>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-outline-secondary cl" data-dismiss="modal">
                                Close
                            </button>
                            <a href="" class="hyperlink" download>
                                <button type="button" class="btn btn-secondary">
                                    Download
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            {{-- *1 --}}
            @if (!$Client_tracking_Data->application_number_1)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Application Status #1
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />

                                <div class="mb-3">
                                    <label for="feasibility" class="form-label">Application No.</label>
                                    <input class="form-control number_field" type="text" id="feasibility"
                                        placeholder="Enter Application Number" name="application_number_1" required />
                                </div>
                                <div class="mb-3">
                                    <label for="appication_1" class="form-label">Application Submitted</label>
                                    <input class="form-control" type="file" id="appication_1" name="appication_1" />
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Amount</label>
                                    <input class="form-control number_field" type="text" id="amount_1"
                                        name="amount_1" placeholder="Enter Amount" required />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingOne_update">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapseOne_update" aria-expanded="true"
                                aria-controls="collapseOne_update">
                                Application Status #1
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne_update" class="collapse" aria-labelledby="headingOne_update"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />

                                <div class="mb-3">
                                    <label for="feasibility" class="form-label">Application No.</label>
                                    <input class="form-control number_field" type="text" id="feasibility"
                                        placeholder="Enter Application Number" name="application_number_1"
                                        value="{{ $Client_tracking_Data->application_number_1 }}" required />
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="appication_1" class="form-label">Old Application PDF</label>
                                        <div class="mb-3">
                                            <iframe
                                                src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->appication_1 }}"
                                                frameborder="0" width="800" height="400"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="appication_1" class="form-label">Application Submitted</label>
                                            <input class="form-control" type="file" id="appication_1"
                                                name="appication_1" />
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Amount</label>
                                    <input class="form-control number_field" type="text" id="amount_1"
                                        name="amount_1" placeholder="Enter Amount"
                                        value="{{ $Client_tracking_Data->amount_1 }}" required />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Application Status
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            {{-- *2 --}}
            @if (!$Client_tracking_Data->document_verified_2)
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Document Verified #2
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />
                                <div class="mb-3 w-50">
                                    <div class="documentVerify">
                                        <select class="form-control" id="document_verified_2"
                                            name="document_verified_2" style="width: 100%" required>
                                            <option selected>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="mb-3 w-50 hidden" id="description-wrapper">
                                    <label for="description" class="form-label">Application Submitted</label>
                                    <input class="form-control" type="text" id="description" name="resion_2"
                                        placeholder="Enter Description" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo_update" aria-expanded="false"
                                aria-controls="collapseTwo_update">
                                Document Verified #2
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo_update" class="collapse" aria-labelledby="headingTwo_update"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />
                                <div class="mb-3 w-50">
                                    <div class="documentVerify">
                                        <select class="form-control" id="document_verified_12"
                                            name="document_verified_2" style="width: 100%" required>
                                            <option value="Yes" @if ($Client_tracking_Data->document_verified_2 == 'Yes') selected @endif>
                                                Yes
                                            </option>
                                            <option value="No" @if ($Client_tracking_Data->document_verified_2 == 'No') selected @endif>No
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="mb-3 w-50" id="application_submitted">
                                    <label for="resion_2" class="form-label">Application Submitted</label>
                                    <input class="form-control" type="text" id="resion_2" name="resion_2"
                                        placeholder="Enter Description"
                                        value="{{ $Client_tracking_Data->resion_2 }}" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Document Verified
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            {{-- *3 --}}
            @if (!$Client_tracking_Data->metter_fee_3)
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Meter Fee #3
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />

                                <div class="mb-3">
                                    <label for="approval_self_certification" class="form-label">Meter Fee</label>
                                    <input class="form-control number_field" type="text" id="metter_fee_3"
                                        name="metter_fee_3" placeholder="Enter Meter Fee" required />
                                </div>
                                {{-- <div class="mb-3">
                         <!--TODO: Fetch this meter fee from step 1's amount -->
                         <label for="approval_self_certification" class="form-label">Amount</label>
                         <input class="form-control" type="text" id="approval_self_certification"
                             placeholder="Enter Amount" readonly value="10000" />
                     </div> --}}
                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Meter Fee #3
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />

                                <div class="mb-3">
                                    <label for="approval_self_certification" class="form-label">Meter Fee</label>
                                    <input class="form-control number_field" type="text" id="metter_fee_3"
                                        name="metter_fee_3" placeholder="Enter Meter Fee"
                                        value="{{ $Client_tracking_Data->metter_fee_3 }}" required />
                                </div>
                                {{-- <div class="mb-3">
                     <!--TODO: Fetch this meter fee from step 1's amount -->
                     <label for="approval_self_certification" class="form-label">Amount</label>
                     <input class="form-control" type="text" id="approval_self_certification"
                         placeholder="Enter Amount" readonly value="10000" />
                 </div> --}}
                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Metter Fee
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            {{-- *4 --}}
            @if (!$Client_tracking_Data->fesibility_approved_4)
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Feasibility Approved #4
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />

                                <div class="mb-3 w-50">
                                    <div class="feasibilityApproved">

                                        <select class="form-control " id="fesibility_approved_4"
                                            name="fesibility_approved_4" style="width: 100%" required>
                                            <option selected>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 w-50 hidden" id="feasibility-wrapper">
                                    <label for="resion_4" class="form-label">Feasibility Resion</label>
                                    <input class="form-control" type="text" id="resion_4"
                                        placeholder="Enter Resion" name="resion_4" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Feasibility Approved #4
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />

                                <div class="mb-3 w-50">
                                    <div class="feasibilityApproved">
                                        <div class="documentVerify">
                                            <select class="form-control" id="fesibility_approved_14"
                                                name="fesibility_approved_4" style="width: 100%" required>
                                                <option value="Yes"
                                                    @if ($Client_tracking_Data->fesibility_approved_4 == 'Yes') selected @endif>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    @if ($Client_tracking_Data->fesibility_approved_4 == 'No') selected @endif>No
                                                </option>
                                            </select>

                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3 w-50 hidden" id="feasibility-wrapper-update">
                                    <label for="resion_4" class="form-label">Feasibility Resion</label>
                                    <input class="form-control" type="text" id="resion_4"
                                        placeholder="Enter Resion" name="resion_4"
                                        value="{{ $Client_tracking_Data->resion_4 }}" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Feasibility
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            {{-- *5 --}}
            @if (!$Client_tracking_Data->structure_image_5)
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Structure Work #5
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Structure Work Image</label>
                                    <input class="form-control" type="file" id="formFile"
                                        name="structure_image_5" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Structure Work #5
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />

                                <img class="client_img"
                                    src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->structure_image_5 }}"
                                    width="150" height="150"
                                    data-image="{{ $Client_tracking_Data->structure_image_5 }}">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Structure Work Image</label>
                                    <input class="form-control" type="file" id="formFile"
                                        name="structure_image_5" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Structure Image
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            {{-- *6 --}}
            @if (!$Client_tracking_Data->make_of_module_6)
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Module Mount Details #6
                                {{-- (Installer Can Also fill this) --}}
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />

                                <div class="mb-3">
                                    <label for="make_of_module_6" class="form-label">Make of Module</label>
                                    <input class="form-control" type="text" id="make_of_module_6"
                                        placeholder="Enter Make of Module" name="make_of_module_6" />
                                </div>
                                <div class="mb-3">
                                    <label for="sr_no_module_6" class="form-label">SR No. Module</label>
                                    <input class="form-control" type="text" id="sr_no_module_6"
                                        placeholder="Enter SR No. of Module" name="sr_no_module_6" />
                                </div>
                                <div class="mb-3">
                                    <label for="module_mount_image_6" class="form-label">Module Mount Image</label>
                                    <input class="form-control" type="file" id="module_mount_image_6"
                                        name="module_mount_image_6" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Module Mount Details #6
                                {{-- (Installer Can Also fill this) --}}
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />

                                <div class="mb-3">
                                    <label for="make_of_module_6" class="form-label">Make of Module</label>
                                    <input class="form-control" type="text" id="make_of_module_6"
                                        placeholder="Enter Make of Module" name="make_of_module_6"
                                        value="{{ $Client_tracking_Data->make_of_module_6 }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="sr_no_module_6" class="form-label">SR No. Module</label>
                                    <input class="form-control" type="text" id="sr_no_module_6"
                                        placeholder="Enter SR No. of Module" name="sr_no_module_6"
                                        value="{{ $Client_tracking_Data->sr_no_module_6 }}" />
                                </div>

                                <img class="client_img"
                                    src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->module_mount_image_6 }}"
                                    width="150" height="150"
                                    data-image="{{ $Client_tracking_Data->module_mount_image_6 }}">

                                <div class="mb-3">
                                    <label for="module_mount_image_6" class="form-label">Module Mount Image</label>
                                    <input class="form-control" type="file" id="module_mount_image_6"
                                        name="module_mount_image_6" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Module Mount Details
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
                          {{-- *7 --}}
            @if (!$Client_tracking_Data->inverter_image7)
                          <div class="card">
                            <div class="card-header" id="headingSeven">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        Inverter Details #7
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
        
                                        <input type="hidden" id="consumer_number1" name="consumer_number"
                                            value="{{ decrypt(request('authUser')) }}" />
        
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Inverter Image</label>
                                            <input class="form-control" type="file" id="inverter_image7" name="inverter_image7" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Serial Number Of Image</label>
                                            <input class="form-control" type="file" id="serial_number_image7" name="serial_number_image7" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Serial Number</label>
                                            <input class="form-control" type="text" id="serial_number7" name="serial_number7"
                                                placeholder="Enter Serial Number" />
                                        </div>
                                        <button class="btn" style="background: #63e6be; color: white">
                                            Upload
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        {{-- *Update --}}
                        <div class="card">
                            <div class="card-header" id="headingSeven">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        Inverter Details #7
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
        
                                        <input type="hidden" id="consumer_number1" name="consumer_number"
                                            value="{{ $Client_tracking_Data->consumer_number }}" />
        
                                            <img class="client_img"
                                    src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->inverter_image7 }}"
                                    width="150" height="150"
                                    data-image="{{ $Client_tracking_Data->inverter_image7 }}">

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Inverter Image</label>
                                            <input class="form-control" type="file" id="inverter_image7" name="inverter_image7" />
                                        </div>

                                        <img class="client_img"
                                    src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->serial_number_image7 }}"
                                    width="150" height="150"
                                    data-image="{{ $Client_tracking_Data->serial_number_image7 }}">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Serial Number Of Image</label>
                                            <input class="form-control" type="file" id="serial_number_image7" name="serial_number_image7"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Serial Number</label>
                                            <input class="form-control" type="text" id="serial_number7" name="serial_number7"
                                                placeholder="Enter Serial Number" value="{{ $Client_tracking_Data->serial_number7 }}" />
                                        </div>
                                        <button class="btn" style="background: #63e6be; color: white">
                                            Upload
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
            {{-- *8 --}}
            @if (!$Client_tracking_Data->perform_8)
                <div class="card">
                    <div class="card-header" id="headingEight">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                Meter Details #8
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Perform</label>
                                    <input class="form-control image_field" type="file" id="perform_8"
                                        name="perform_8" />
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Form - 16</label>
                                    <input class="form-control image_field" type="file" id="form_16_8"
                                        name="form_16_8" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingEight">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                Meter Details #8
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />

                                <img class="client_img"
                                    src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->perform_8 }}"
                                    width="150" height="150"
                                    data-image="{{ $Client_tracking_Data->perform_8 }}">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Perform</label>
                                    <input class="form-control" type="file" id="perform_8" name="perform_8" />
                                </div>
                                <img class="client_img"
                                    src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->form_16_8 }}"
                                    width="150" height="150"
                                    data-image="{{ $Client_tracking_Data->form_16_8 }}">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Form - 16</label>
                                    <input class="form-control" type="file" id="form_16_8" name="form_16_7" />
                                </div>
                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Meter Details
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            {{-- *9 --}}
            @if (!$Client_tracking_Data->jr_form_9)
                <div class="card">
                    <div class="card-header" id="headingnine">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">
                                Subsidy Clamp #9
                            </button>
                        </h2>
                    </div>
                    <div id="collapsenine" class="collapse" aria-labelledby="headingnine"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ decrypt(request('authUser')) }}" />

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">JR Form</label>
                                    <input class="form-control" type="file" id="jr_form_9" name="jr_form_9" />
                                </div>

                                <div class="mb-3">
                                    <div class="subsidyClamp">
                                        <label for="Clamp" class="form-label">Subsidy Clamp</label>
                                        <select class="form-control " id="subsidy_clamp_9" name="subsidy_clamp_9"
                                            style="width: 100%" required>
                                            <option selected>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 hidden" id="amount-wrapper">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input class="form-control" type="text" id="amount_9" name="amount_9"
                                        placeholder="Enter Amount" />
                                </div>

                                <div class="mb-3 hidden" id="desc-wrapper">
                                    <label for="description_9" class="form-label">Description</label>
                                    <input class="form-control" type="text" id="description_9"
                                        placeholder="Enter Description" name="description_9" />
                                </div>

                                <div class="mb-3">
                                    <div class="Received">
                                        <label for="Received" class="form-label">Received</label>

                                        <select class="form-control " id="recived_9" name="recived_9"
                                            style="width: 100%" required>
                                            <option selected>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 hidden" id="pdf-wrapper">
                                    <label for="formFile" class="form-label">PDF</label>
                                    <input class="form-control" type="file" id="pdf_9" name="pdf_9" />
                                </div>

                                <button class="btn" style="background: #63e6be; color: white">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- *Update --}}
                <div class="card">
                    <div class="card-header" id="headingnine">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">
                                Subsidy Clamp #9
                            </button>
                        </h2>
                    </div>
                    <div id="collapsenine" class="collapse" aria-labelledby="headingnine"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <form id="AppicationForm" action="{{ route('employee.update_client_tracking') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="consumer_number1" name="consumer_number"
                                    value="{{ $Client_tracking_Data->consumer_number }}" />

                                <img class="client_img"
                                    src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->jr_form_9 }}"
                                    width="150" height="150"
                                    data-image="{{ $Client_tracking_Data->jr_form_9 }}">

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">JR Form</label>
                                    <input class="form-control" type="file" id="jr_form_9" name="jr_form_9" />
                                </div>

                                <div class="mb-3">
                                    <div class="subsidyClamp">
                                        <label for="Clamp" class="form-label">Subsidy Clamp</label>

                                        <select class="form-control" id="subsidy_clamp_9" name="subsidy_clamp_9"
                                            style="width: 100%" required>
                                            <option value="Yes" @if ($Client_tracking_Data->subsidy_clamp_9 == 'Yes') selected @endif>
                                                Yes
                                            </option>
                                            <option value="No" @if ($Client_tracking_Data->subsidy_clamp_9 == 'No') selected @endif>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 hidden" id="amount-wrapper">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input class="form-control" type="text" id="amount_9" name="amount_9"
                                        placeholder="Enter Amount" value="{{ $Client_tracking_Data->amount_9 }}" />
                                </div>

                                <div class="mb-3 hidden" id="desc-wrapper">
                                    <label for="description_9" class="form-label">Description</label>
                                    <input class="form-control" type="text" id="description_9"
                                        placeholder="Enter Description" name="description_9"
                                        value="{{ $Client_tracking_Data->description_9 }}" />
                                </div>

                                <div class="mb-3">
                                    <div class="Received">
                                        <label for="Received" class="form-label">Received</label>
                                        <select class="form-control" id="recived_9" name="recived_9"
                                            style="width: 100%" required>
                                            <option value="Yes" @if ($Client_tracking_Data->recived_9 == 'Yes') selected @endif>
                                                Yes
                                            </option>
                                            <option value="No" @if ($Client_tracking_Data->recived_9 == 'No') selected @endif>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" id="pdf-wrapper">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="pdf_9" class="form-label">Old Application PDF</label>
                                        <div class="mb-3">
                                            <iframe
                                                src="{{ URL::to('/') }}/images/Client_tracking/{{ $Client_tracking_Data->pdf_9 }}"
                                                frameborder="0" width="900" height="400"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3 hidden">
                                            <label for="formFile" class="form-label">PDF</label>
                                            <input class="form-control" type="file" id="pdf_9"
                                                name="pdf_9" />
                                        </div>
                                    </div>
                                </div>


                                <button class="btn" style="background: #63e6be; color: white">
                                    Update Subsidy Clamp
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @else
            {{-- *1 --}}
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Application Status #1
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3">
                                <label for="feasibility" class="form-label">Application No.</label>
                                <input class="form-control number_field" type="text" id="feasibility"
                                    placeholder="Enter Application Number" name="application_number_1" required />
                            </div>
                            <div class="mb-3">
                                <label for="appication_1" class="form-label">Application Submitted</label>
                                <input class="form-control" type="file" id="appication_1" name="appication_1" />
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Amount</label>
                                <input class="form-control number_field" type="text" id="amount_1"
                                    name="amount_1" placeholder="Enter Amount" required />
                            </div>
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *2 --}}
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Document Verified #2
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />
                            <div class="mb-3 w-50">
                                <div class="documentVerify">
                                    <select class="form-control" id="document_verified_2" name="document_verified_2"
                                        style="width: 100%" required>
                                        <option selected>Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                </div>
                            </div>
                            <div class="mb-3 w-50 hidden" id="description-wrapper">
                                <label for="description" class="form-label">Application Submitted</label>
                                <input class="form-control" type="text" id="description" name="resion_2"
                                    placeholder="Enter Description" />
                            </div>
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *3 --}}
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Meter Fee #3
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3">
                                <label for="approval_self_certification" class="form-label">Meter Fee</label>
                                <input class="form-control number_field" type="text" id="metter_fee_3"
                                    name="metter_fee_3" placeholder="Enter Meter Fee" required />
                            </div>
                            {{-- <div class="mb-3">
                 <!--TODO: Fetch this meter fee from step 1's amount -->
                 <label for="approval_self_certification" class="form-label">Amount</label>
                 <input class="form-control" type="text" id="approval_self_certification"
                     placeholder="Enter Amount" readonly value="10000" />
             </div> --}}
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *4 --}}
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Feasibility Approved #4
                        </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3 w-50">
                                <div class="feasibilityApproved">

                                    <select class="form-control " id="fesibility_approved_4"
                                        name="fesibility_approved_4" style="width: 100%" required>
                                        <option selected>Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 w-50 hidden" id="feasibility-wrapper">
                                <label for="resion_4" class="form-label">Feasibility Resion</label>
                                <input class="form-control" type="text" id="resion_4" placeholder="Enter Resion"
                                    name="resion_4" />
                            </div>
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *5 --}}
            <div class="card">
                <div class="card-header" id="headingFive">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Structure Work #5
                        </button>
                    </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Structure Work Image</label>
                                <input class="form-control" type="file" id="formFile"
                                    name="structure_image_5" />
                            </div>
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *6 --}}
            <div class="card">
                <div class="card-header" id="headingSix">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Module Mount Details #6
                            {{-- (Installer Can Also fill this) --}}
                        </button>
                    </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3">
                                <label for="make_of_module_6" class="form-label">Make of Module</label>
                                <input class="form-control" type="text" id="make_of_module_6"
                                    placeholder="Enter Make of Module" name="make_of_module_6" />
                            </div>
                            <div class="mb-3">
                                <label for="sr_no_module_6" class="form-label">SR No. Module</label>
                                <input class="form-control" type="text" id="sr_no_module_6"
                                    placeholder="Enter SR No. of Module" name="sr_no_module_6" />
                            </div>
                            <div class="mb-3">
                                <label for="module_mount_image_6" class="form-label">Module Mount Image</label>
                                <input class="form-control" type="file" id="module_mount_image_6"
                                    name="module_mount_image_6" />
                            </div>
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *7 --}}
            <div class="card">
                <div class="card-header" id="headingSeven">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Inverter Details #7
                        </button>
                    </h2>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Inverter Image</label>
                                <input class="form-control" type="file" id="inverter_image7" name="inverter_image7" />
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Serial Number Of Image</label>
                                <input class="form-control" type="file" id="serial_number_image7" name="serial_number_image7" />
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Serial Number</label>
                                <input class="form-control" type="text" id="serial_number7" name="serial_number7"
                                    placeholder="Enter Serial Number" />
                            </div>
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *8 --}}
            <div class="card">
                <div class="card-header" id="headingEight">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            Meter Details #8
                        </button>
                    </h2>
                </div>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Perform</label>
                                <input class="form-control image_field" type="file" id="perform_8"
                                    name="perform_8" />
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Form - 16</label>
                                <input class="form-control image_field" type="file" id="form_16_8"
                                    name="form_16_8" />
                            </div>
                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- *9 --}}
            <div class="card">
                <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            Subsidy Clamp #9
                        </button>
                    </h2>
                </div>
                <div id="collapseNine" class="collapse" aria-labelledby="headingNine"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="AppicationForm" action="{{ route('employee.insert_client_tracking') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="consumer_number1" name="consumer_number"
                                value="{{ decrypt(request('authUser')) }}" />

                            <div class="mb-3">
                                <label for="formFile" class="form-label">JR Form</label>
                                <input class="form-control" type="file" id="jr_form_9" name="jr_form_9" />
                            </div>

                            <div class="mb-3">
                                <div class="subsidyClamp">
                                    <label for="Clamp" class="form-label">Subsidy Clamp</label>
                                    <select class="form-control " id="subsidy_clamp_9" name="subsidy_clamp_9"
                                        style="width: 100%" required>
                                        <option selected>Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 hidden" id="amount-wrapper">
                                <label for="amount" class="form-label">Amount</label>
                                <input class="form-control" type="text" id="amount_9" name="amount_9"
                                    placeholder="Enter Amount" />
                            </div>

                            <div class="mb-3 hidden" id="desc-wrapper">
                                <label for="description_9" class="form-label">Description</label>
                                <input class="form-control" type="text" id="description_9"
                                    placeholder="Enter Description" name="description_9" />
                            </div>

                            <div class="mb-3">
                                <div class="Received">
                                    <label for="Received" class="form-label">Received</label>

                                    <select class="form-control " id="recived_9" name="recived_9"
                                        style="width: 100%" required>
                                        <option selected>Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 hidden" id="pdf-wrapper">
                                <label for="formFile" class="form-label">PDF</label>
                                <input class="form-control" type="file" id="pdf_9" name="pdf_9" />
                            </div>

                            <button class="btn" style="background: #63e6be; color: white">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @else
        <h1 style="text-align: center; align-items: center">Please Add Document First.</h1>
    @endif
</div>
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
                    title: '<h1>{{ session('error') }}</h1>',
                })
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {

            $(".client_img").click(function() {
                var img = $(this).data('image');
                var imgURL = `{{ URL::to('/') }}/images/Client_tracking/${img}`
                var hyperlink = $('.hyperlink')
                var img_modal = $(".img_modal");
                img_modal.attr('src', imgURL);
                hyperlink.attr('href', imgURL);
                $('#clientImgModal').modal('show');
            });


            toggleFields();

            // Event listener for type change
            $('#document_verified_12').change(function() {
                toggleFields();
            });

            function toggleFields() {
                var selectedType = $('#document_verified_12').val();
                // console.log(selectedType);
                if (selectedType === 'No') {
                    $('#application_submitted').show();
                } else {
                    $('#application_submitted').hide();
                    $('#resion_2').val("");
                }
            }

            toggleFields_fesibility_approved_14();

            // Event listener for type change
            $('#fesibility_approved_14').change(function() {
                toggleFields_fesibility_approved_14();
            });

            function toggleFields_fesibility_approved_14() {
                var selectedType = $('#fesibility_approved_14').val();
                // console.log(selectedType);
                if (selectedType === 'No') {
                    $('#feasibility-wrapper-update').show();
                } else {
                    $('#feasibility-wrapper-update').hide();
                    $('#resion_4').val("");
                }
            }
            toggleFieldssubsidy_clamp_8();

            // Event listener for type change
            $('#subsidy_clamp_8').change(function() {
                toggleFieldssubsidy_clamp_8();
            });

            function toggleFieldssubsidy_clamp_8() {
                var selectedType = $('#subsidy_clamp_8').val();
                // console.log(selectedType);
                if (selectedType === 'Yes') {
                    $('#amount-wrapper').show();
                } else {
                    $('#amount-wrapper').hide();
                    $('#amount_8').val("");
                }
            }
            toggleFieldssubsidy_clamp_no_8();

            // Event listener for type change
            $('#subsidy_clamp_8').change(function() {
                toggleFieldssubsidy_clamp_no_8();
            });

            function toggleFieldssubsidy_clamp_no_8() {
                var selectedType = $('#subsidy_clamp_8').val();
                // console.log(selectedType);
                if (selectedType === 'No') {
                    $('#desc-wrapper').show();
                } else {
                    $('#desc-wrapper').hide();
                    $('#description_8').val("");
                }
            }
            toggleFieldssubsidy_recived_8();

            // Event listener for type change
            $('#recived_8').change(function() {
                toggleFieldssubsidy_recived_8();
            });

            function toggleFieldssubsidy_recived_8() {
                var selectedType = $('#recived_8').val();
                // console.log(selectedType);
                if (selectedType === 'No') {
                    $('#pdf-wrapper').show();
                } else {
                    $('#pdf-wrapper').hide();
                    $('#pdf_8').val("");
                }
            }

            var addForm = $("#AppicationForm");
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
            // $('.image_field').on('input', function(event) {
            //     let inputValue = $(this).val();
            //     let numericValue = inputValue.replace(/\.(jpg|jpeg|png|gif)$/i);
            //     $(this).val(numericValue);
            // })

            $('.image_field').on('change', function(event) {
                let fileInput = event.target;
                let file = fileInput.files[0];

                // Regular expression to match allowed image file extensions
                let allowedExtensions = /\.(jpg|jpeg|png|gif)$/i;

                // Check if the file name matches the allowed extensions
                if (!allowedExtensions.test(file.name)) {
                    // Display error message or take other actions
                    alert('Please select a valid image file (JPEG, PNG, or GIF)');
                    fileInput.value = ''; // Clear the file input
                }
            });

        });


        document.querySelector(".documentVerify").addEventListener("change", (e) => {
            if (e.target.value == "No") {
                document.getElementById("description-wrapper").classList.remove("hidden");
            } else {
                document.getElementById("description-wrapper").classList.add("hidden");
            }
        });

        document.querySelector(".feasibilityApproved").addEventListener("change", (e) => {
            if (e.target.value == "No") {
                console.log("No");
                document.getElementById("feasibility-wrapper").classList.remove("hidden");
            } else {
                console.log("Yes");
                document.getElementById("feasibility-wrapper").classList.add("hidden");
            }
        });

        document.querySelector(".subsidyClamp").addEventListener("change", (e) => {
            if (e.target.value === "Yes") {
                document.getElementById("desc-wrapper").classList.add("hidden");
                document
                    .getElementById("amount-wrapper")
                    .classList.remove("hidden");
            } else if (e.target.value === "No") {
                document.getElementById("desc-wrapper").classList.remove("hidden");
                document.getElementById("amount-wrapper").classList.add("hidden");
            } else {
                document.getElementById("desc-wrapper").classList.add("hidden");
                document.getElementById("amount-wrapper").classList.add("hidden");
            }
        });

        document.querySelector(".Received").addEventListener("change", (e) => {
            if (e.target.value == "No") {
                document.getElementById("pdf-wrapper").classList.remove("hidden");
            } else {
                document.getElementById("pdf-wrapper").classList.add("hidden");
                console.log("JR COMPLETED");
            }
        });
    </script>
@endsection
