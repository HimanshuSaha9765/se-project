<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DealerClientService;
use Illuminate\Http\Request;
use App\Traits\AttachementTrait;

class DealerClientController extends Controller
{
    use AttachementTrait;

    public DealerClientService $dealerClientService;
    public function __construct(DealerClientService $dealerClientService)
    {
        $this->dealerClientService = $dealerClientService;
    }
    var $consumer_number;
    var $compact_data;
    public function manage_client()
    {
        $this->compact_data = $this->dealerClientService->manage_client();
        return view("dealer.Client.manage_client", $this->compact_data);
    }
    public function add_client()
    {
        $this->compact_data = $this->dealerClientService->add_client();
        return view("dealer.Client.add_client")->with('User_data', $this->compact_data);
    }
    public function insert_client(Request $request)
    {
        $this->compact_data = $this->dealerClientService->insert_client($request);
        if ($this->compact_data == "true") {
            session()->flash('success', 'Client Added Successfully.');
            return redirect()->route('dealer.manage_client');
        } else {
            session()->flash('error', 'Error in adding client added.');
            return redirect()->route('dealer.add_user');
        }
    }
    public function edit_client($id)
    {
        $this->compact_data = $this->dealerClientService->edit_client($id);
        return view('dealer.Client.update_client', $this->compact_data);
    }
    public function update_client(Request $request)
    {
        $this->compact_data = $this->dealerClientService->update_client($request);
        if ($this->compact_data == "true") {
            session()->flash('success', 'Client updated successfully.');
            return redirect()->route('dealer.manage_client');
        } else {
            session()->flash('error', 'Error in updating client.');
            return redirect()->route('dealer.edit_client', ['id' => $this->compact_data]);
        }
    }
    public function delete_client($id)
    {
        $this->compact_data = $this->dealerClientService->delete_client($id);
        if (!$this->compact_data == "false") {
            session()->flash('error', 'Client not found.');
            return response()->json(['Error' => 'Error Client Not Found']);
        }
        session()->flash('success', 'Client deleted successfully.');
        return response()->json(['message' => 'Client deleted successfully']);
    }
    public function update_client_status($id, $status)
    {
        $this->compact_data = $this->dealerClientService->update_client_status($id,  $status);
        if (!$this->compact_data == "false") {
            session()->flash('error', 'Error in updating client status.');
            return response()->json(['Error' => 'Error in updating client status']);
        } else {
            session()->flash('success', 'Client status updated successfully.');
            return response()->json(['message' => 'Client status updated successfully']);
        }
    }
    public function update_client_permision($id, $permision)
    {
        $this->compact_data = $this->dealerClientService->update_client_permision($id, $permision);
        if (!$this->compact_data == "false") {
            session()->flash('error', 'Error in updating client permision.');
            return response()->json(['Error' => 'Error in updating client permision']);
        } else {
            session()->flash('success', 'Client permision updated successfully.');
            return response()->json(['message' => 'Client permision updated successfully']);
        }
    }
    // *Client Details Module
    public function client_details($consumer_number)
    {
        $this->compact_data = $this->dealerClientService->client_details($consumer_number);
        return view('dealer.Client.client_details', $this->compact_data);
    }
    //* Client Tracking Module
    public function add_client_tracking()
    {
        $this->compact_data = $this->dealerClientService->add_client_tracking();
        return view('dealer.Client.add_client_tracking', $this->compact_data);
    }

    public function insert_client_tracking(Request $request)
    {
        $this->compact_data = $this->dealerClientService->insert_client_tracking($request);
        return redirect()->route('dealer.add_client_tracking', ['authUser' => $this->compact_data]);
    }

    public function update_client_tracking(Request $request)
    {
        $this->compact_data = $this->dealerClientService->update_client_tracking($request);
        return redirect()->route('dealer.add_client_tracking', ['authUser' => $this->compact_data]);
    }

    // public function insert_client_tracking(Request $request)
    // {
    //     // $consumer_number_tracking = decrypt(request('authUser'));
    //     // dd($consumer_number_tracking);
    //     $Client_tracking_Data = client_tracking::query()->whereRaw('consumer_number  = ?', [$request->consumer_number])->first();
    //     // dd($Client_tracking_Data);
    //     if (!$Client_tracking_Data) {
    //         $appication_1 = $this->verifyAndUpload_client_tracking($request, 'appication_1');

    //         $client_tracking = new client_tracking();
    //         $client_tracking->consumer_number = $request->consumer_number;
    //         $client_tracking->application_number_1 = $request->application_number_1;
    //         $client_tracking->appication_1 = $appication_1;
    //         $client_tracking->amount_1 = $request->amount_1;

    //         if ($client_tracking->save()) {
    //             session()->flash('success', 'Client Tracking add Successfully.');
    //             return redirect()->route('dealer.add_client_tracking', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     } else {

    //         if ($request->document_verified_2 || $request->resion_2) {
    //             $Track2 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //             $Track2->update([
    //                 'document_verified_2' => $request->document_verified_2,
    //                 'resion_2' => $request->resion_2,
    //             ]);

    //             if ($Track2) {
    //                 session()->flash('success', 'Client Tracking add Successfully.');
    //                 return redirect()->route('dealer.add_client_tracking', ['authUser' => encrypt($request->consumer_number)]);
    //             }

    //         }

    //         if ($request->metter_fee_3) {
    //             $Track3 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //             $Track3->update([
    //                 'metter_fee_3' => $request->metter_fee_3,
    //             ]);

    //             if ($Track3) {
    //                 session()->flash('success', 'Client Tracking add Successfully.');
    //                 return redirect()->route('dealer.add_client_tracking', ['authUser' => encrypt($request->consumer_number)]);
    //             }
    //         }

    //         if ($request->fesibility_approved_4 || $request->resion_4) {
    //             $Track4 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();

    //             $Track4->update([
    //                 'fesibility_approved_4' => $request->fesibility_approved_4,
    //                 'resion_4' => $request->resion_4,
    //             ]);

    //             if ($Track4) {
    //                 session()->flash('success', 'Client Tracking add Successfully.');
    //                 return redirect()->route('dealer.add_client_tracking', ['authUser' => encrypt($request->consumer_number)]);
    //             }

    //         }

    //         if ($request->structure_image_5) {
    //             $structure_image_5 = $this->verifyAndUpload_client_tracking($request, 'structure_image_5');
    //             $Track5 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //             $Track5->update([
    //                 'structure_image_5' => $structure_image_5,
    //             ]);

    //             if ($Track5) {
    //                 session()->flash('success', 'Client Tracking add Successfully.');
    //                 return redirect()->route('dealer.add_client_tracking', ['authUser' => encrypt($request->consumer_number)]);
    //             }
    //         }


    //         if ($request->make_of_module_6 || $request->sr_no_module_6 || $request->module_mount_image_6) {
    //             $Track6 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //             $module_mount_image_6 = $this->verifyAndUpload_client_tracking($request, 'module_mount_image_6');

    //             $Track6->update([
    //                 'make_of_module_6' => $request->make_of_module_6,
    //                 'sr_no_module_6' => $request->sr_no_module_6,
    //                 'module_mount_image_6' => $module_mount_image_6,
    //             ]);

    //             if ($Track6) {
    //                 session()->flash('success', 'Client Tracking add Successfully.');
    //                 return redirect()->route('dealer.add_client_tracking', ['authUser' => encrypt($request->consumer_number)]);
    //             }

    //         }


    //         if ($request->perform_7 || $request->form_16_7) {
    //             $Track7 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //             $perform_7 = $this->verifyAndUpload_client_tracking($request, 'perform_7');
    //             $form_16_7 = $this->verifyAndUpload_client_tracking($request, 'form_16_7');

    //             $Track7->update([
    //                 'perform_7' => $perform_7,
    //                 'form_16_7' => $form_16_7,
    //             ]);

    //             if ($Track7) {
    //                 session()->flash('success', 'Client Tracking add Successfully.');
    //                 return redirect()->route('dealer.add_client_tracking', ['authUser' => encrypt($request->consumer_number)]);
    //             }

    //         }


    //         if ($request->jr_form_8 || $request->subsidy_clamp_8 || $request->amount_8 || $request->description_8 || $request->recived_8 || $request->pdf_8) {
    //             $Track8 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //             $jr_form_8 = $this->verifyAndUpload_client_tracking($request, 'jr_form_8');
    //             $pdf_8 = $this->verifyAndUpload_client_tracking($request, 'pdf_8');

    //             $Track8->update([
    //                 'jr_form_8' => $jr_form_8,
    //                 'subsidy_clamp_8' => $request->subsidy_clamp_8,
    //                 'amount_8' => $request->amount_8,
    //                 'description_8' => $request->description_8,
    //                 'recived_8' => $request->recived_8,
    //                 'pdf_8' => $pdf_8,
    //             ]);
    //             if ($Track8) {
    //                 session()->flash('success', 'Client Tracking add Successfully.');
    //                 return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //             }
    //         }

    //     }
    // }

    // public function update_client_tracking(Request $request)
    // {
    //     // $client_tracking_update_data = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //     if ($request->application_number_1 || $request->appication_1 || $request->amount_1) {
    //         $Track1 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();

    //         if ($request->hasFile('appication_1')) {
    //             $oldFilePath = public_path('images/Client_tracking/' . $Track1['appication_1']);
    //             if (File::exists($oldFilePath)) {
    //                 File::delete($oldFilePath);
    //             }
    //             $appication_1 = $this->verifyAndUpload_client_tracking($request, 'appication_1');
    //             $Track1->where('consumer_number', $request->consumer_number)->update(['appication_1' => $appication_1]);
    //         } else {
    //             $appication_1 = $Track1->appication_1;
    //         }


    //         $Track1->update([
    //             'application_number_1' => $request->application_number_1,
    //             'appication_1' => $appication_1,
    //             'amount_1' => $request->amount_1,
    //         ]);
    //         if ($Track1) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }

    //     if ($request->document_verified_2 || $request->resion_2) {
    //         $Track2 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //         $Track2->update([
    //             'document_verified_2' => $request->document_verified_2,
    //             'resion_2' => $request->resion_2,
    //         ]);
    //         if ($Track2) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }

    //     if ($request->metter_fee_3) {
    //         $Track3 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();

    //         $Track3->update([
    //             'metter_fee_3' => $request->metter_fee_3,
    //         ]);
    //         if ($Track3) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }

    //     if ($request->fesibility_approved_4 || $request->resion_4) {
    //         $Track4 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //         $Track4->update([
    //             'fesibility_approved_4' => $request->fesibility_approved_4,
    //             'resion_4' => $request->resion_4,
    //         ]);
    //         if ($Track4) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }

    //     if ($request->structure_image_5) {
    //         $Track5 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();
    //         if ($request->hasFile('structure_image_5')) {
    //             $oldFilePath = public_path('images/Client_tracking/' . $Track5['structure_image_5']);
    //             if (File::exists($oldFilePath)) {
    //                 File::delete($oldFilePath);
    //             }
    //             $structure_image_5 = $this->verifyAndUpload_client_tracking($request, 'structure_image_5');
    //             $Track5->where('consumer_number', $request->consumer_number)->update(['structure_image_5' => $structure_image_5]);
    //         } else {
    //             $structure_image_5 = $Track5->structure_image_5;
    //         }
    //         $Track5->update([
    //             'structure_image_5' => $structure_image_5,
    //         ]);
    //         if ($Track5) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }


    //     if ($request->make_of_module_6 || $request->sr_no_module_6 || $request->module_mount_image_6) {
    //         $Track6 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();

    //         if ($request->hasFile('module_mount_image_6')) {
    //             $oldFilePath = public_path('images/Client_tracking/' . $Track6['module_mount_image_6']);
    //             if (File::exists($oldFilePath)) {
    //                 File::delete($oldFilePath);
    //             }
    //             $module_mount_image_6 = $this->verifyAndUpload_client_tracking($request, 'module_mount_image_6');
    //             $Track6->where('consumer_number', $request->consumer_number)->update(['module_mount_image_6' => $module_mount_image_6]);
    //         } else {
    //             $module_mount_image_6 = $Track6->module_mount_image_6;
    //         }

    //         $Track6->update([
    //             'make_of_module_6' => $request->make_of_module_6,
    //             'sr_no_module_6' => $request->sr_no_module_6,
    //             'module_mount_image_6' => $module_mount_image_6,
    //         ]);
    //         if ($Track6) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }


    //     if ($request->perform_7 || $request->form_16_7) {
    //         $Track7 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();

    //         if ($request->hasFile('perform_7')) {
    //             $oldFilePath = public_path('images/Client_tracking/' . $Track7['perform_7']);
    //             if (File::exists($oldFilePath)) {
    //                 File::delete($oldFilePath);
    //             }
    //             $perform_7 = $this->verifyAndUpload_client_tracking($request, 'perform_7');
    //             $Track7->where('consumer_number', $request->consumer_number)->update(['perform_7' => $perform_7]);
    //         } else {
    //             $perform_7 = $Track7->perform_7;
    //         }

    //         if ($request->hasFile('form_16_7')) {
    //             $oldFilePath = public_path('images/Client_tracking/' . $Track7['form_16_7']);
    //             if (File::exists($oldFilePath)) {
    //                 File::delete($oldFilePath);
    //             }
    //             $form_16_7 = $this->verifyAndUpload_client_tracking($request, 'form_16_7');
    //             $Track7->where('consumer_number', $request->consumer_number)->update(['form_16_7' => $form_16_7]);
    //         } else {
    //             $form_16_7 = $Track7->form_16_7;
    //         }

    //         $Track7->update([
    //             'perform_7' => $perform_7,
    //             'form_16_7' => $form_16_7,
    //         ]);
    //         if ($Track7) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }

    //     if ($request->jr_form_8 || $request->subsidy_clamp_8 || $request->amount_8 || $request->description_8 || $request->recived_8 || $request->pdf_8) {
    //         $Track8 = client_tracking::query()->where('consumer_number', $request->consumer_number)->first();

    //         if ($request->hasFile('jr_form_8')) {
    //             $oldFilePath = public_path('images/Client_tracking/' . $Track8['jr_form_8']);
    //             if (File::exists($oldFilePath)) {
    //                 File::delete($oldFilePath);
    //             }
    //             $jr_form_8 = $this->verifyAndUpload_client_tracking($request, 'jr_form_8');
    //             $Track8->where('consumer_number', $request->consumer_number)->update(['jr_form_8' => $jr_form_8]);
    //         } else {
    //             $jr_form_8 = $Track8->jr_form_8;
    //         }

    //         if ($request->hasFile('pdf_8')) {
    //             $oldFilePath = public_path('images/Client_tracking/' . $Track8['pdf_8']);
    //             if (File::exists($oldFilePath)) {
    //                 File::delete($oldFilePath);
    //             }
    //             $pdf_8 = $this->verifyAndUpload_client_tracking($request, 'pdf_8');
    //             $Track8->where('consumer_number', $request->consumer_number)->update(['pdf_8' => $pdf_8]);
    //         } else {
    //             $pdf_8 = $Track8->pdf_8;
    //         }

    //         $Track8->update([
    //             'jr_form_8' => $jr_form_8,
    //             'subsidy_clamp_8' => $request->subsidy_clamp_8,
    //             'amount_8' => $request->amount_8,
    //             'description_8' => $request->description_8,
    //             'recived_8' => $request->recived_8,
    //             'pdf_8' => $pdf_8,
    //         ]);

    //         if ($Track8) {
    //             session()->flash('success', 'Client Tracking update Successfully.');
    //             return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //         }
    //     }

    //     // if ($client_tracking_update_data) {
    //     //     session()->flash('success', 'Client Tracking Updated Successfully.');
    //     //     return redirect()->route('dealer.client_details', ['authUser' => encrypt($request->consumer_number)]);
    //     // }
    // }

    // *Client Document CRUD
    public function add_client_document()
    {
        $this->compact_data = $this->dealerClientService->add_client_document();
        return view("dealer.Client.add_client_document", $this->compact_data);
    }
    public function insert_client_document(Request $request)
    {
        $this->compact_data = $this->dealerClientService->insert_client_document($request);

        // dd($client_document);
        if ($this->compact_data == "true") {
            session()->flash('error', 'Error in Adding Client Document Added.');
            return redirect()->route('dealer.add_client_document');
        } else {
            session()->flash('success', 'Client Document Added Successfully.');
            return redirect()->route('dealer.client_details', ['consumer_number' => $this->compact_data]);
        }
    }
    public function manage_client_document()
    {
    }

    public function edit_client_document($consumer_number)
    {
        $this->compact_data = $this->dealerClientService->edit_client_document($consumer_number);
        // dd($this->compact_data);
        return view('dealer.Client.update_client_document', $this->compact_data);
    }

    public function update_client_document(Request $request)
    {
        $this->compact_data = $this->dealerClientService->update_client_document($request);
        return redirect()->route('dealer.download_document_and_update', ['authUser' => $this->compact_data]);
    }
    public function download_document_and_update()
    {
        $this->compact_data = $this->dealerClientService->download_document_and_update();
        return view("dealer.Client.download_document_and_update", $this->compact_data);
    }
}
