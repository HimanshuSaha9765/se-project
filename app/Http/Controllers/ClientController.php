<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Client_Document;
use App\Models\client_tracking;
use App\Models\Log_Infos;
use App\Models\Payment;
use App\Models\references;
use App\Models\User;
use App\Repository\ClientRepo;
use App\Services\ClientService;
use App\Traits\AttachementTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Lcobucci\JWT\Decoder;
use Lcobucci\JWT\Encoder;


class ClientController extends Controller
{
    use AttachementTrait;

    public ClientService $clientService;
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    var $consumer_number;
    var $compact_data;
    public function manage_client()
    {
        $this->compact_data = $this->clientService->manage_client();
        return view("Client.manage_client", $this->compact_data);
    }
    public function add_client()
    {
        $this->compact_data = $this->clientService->add_client();
        return view("Client.add_client", $this->compact_data);
    }
    public function insert_client(Request $request)
    {
        // try {
        $rules = [
            'consumer_number' => 'required|digits:11|unique:clients,consumer_number',
            'client_name' => 'required|min:3|max:40',
            'mobile_number' => 'required|digits:10',
            // 'email' => 'required|email|unique:clients,email',
            // 'bill_amount' => 'required|numeric',
            // 'kw' => 'required|numeric',
            // 'structure_length' => 'required|numeric',
            // 'structure_width' => 'required|numeric',
            // 'quotation_amount' => 'required|numeric',
            // 'structure_image' => 'required|max:35000|mimes:jpg,png,gif',
            // 'address' => 'required|min:3|max:40',
        ];

        $request->validate($rules, [
            'consumer_number.required' => 'Consumer number is required',
            'consumer_number.digits' => 'Consumer number must be 11 digits',
            'consumer_number.unique' => 'Consumer number already registered',

            'client_name.required' => 'Name cannot be empty',
            'client_name.max' => 'Name must be at maximum 40 characters',
            'client_name.min' => 'Name must be at least 3 characters',

            'mobile_number.required' => 'Mobile number cannot be empty',
            'mobile_number.digits' => 'Mobile number must contain exactly 10 digits',

            // 'email.required' => 'Email address cannot be empty',
            // 'email.email' => 'Invalid email address',
            // 'email.unique' => 'Email address already registered',

            // 'bill_amount.required' => 'Bill amount is required',
            // 'bill_amount.numeric' => 'Bill amount must be a number',

            // 'kw.required' => 'KW is required',
            // 'kw.numeric' => 'KW must be a number',

            // 'structure_length.required' => 'Structure length is required',
            // 'structure_length.numeric' => 'Structure length must be a number',

            // 'structure_width.required' => 'Structure width is required',
            // 'structure_width.numeric' => 'Structure width must be a number',

            // 'quotation_amount.required' => 'Quotation amount is required',
            // 'quotation_amount.numeric' => 'Quotation amount must be a number',

            // 'structure_image.required' => 'Please select a file to upload',
            // 'structure_image.max' => 'Select a file of maximum 35 KB',
            // 'structure_image.mimes' => 'Select a jpg, png, or gif file to upload',

            // 'address.required' => 'Address cannot be empty',
            // 'address.min' => 'Address must be at least 3 characters',
            // 'address.max' => 'Address must be at maximum 40 characters',
        ]);

        $this->compact_data = $this->clientService->insert_client($request);


        if ($this->compact_data->save()) {
            session()->flash('success', 'Client Added Successfully.');
            return redirect()->route('admin.manage_client');
        } else {
            session()->flash('error', 'Error in adding client added.');
            return redirect()->route('admin.add_user');
        }
        // } 
        // catch (Exception $th) {
        //     dd($th->getMessage());
        // }

    }
    public function edit_client($id)
    {
        $this->compact_data = $this->clientService->edit_client($id);

        return view('Client.update_client', $this->compact_data);
    }
    public function update_client(Request $request)
    {
        // dd($request->id);
        $this->compact_data = $this->clientService->update_client($request);
        if ($this->compact_data == "true") {
            session()->flash('success', 'Client updated successfully.');
            return redirect()->route('admin.manage_client');
        } else {
            session()->flash('error', 'Error in updating client');
            return redirect()->route('admin.edit_client', ['id' => $request->id]);
        }
    }
    public function delete_client($id)
    {
        $this->compact_data = $this->clientService->delete_client($id);
        // dd($this->compact_data);
        if ($this->compact_data == "false") {
            session()->flash('error', 'Client not found.');
            return response()->json(['Error' => 'Error Client Not Found']);
        }
        session()->flash('success', 'Client deleted successfully.');
        return response()->json(['message' => 'Client deleted successfully']);
    }

    public function update_client_status($id, $status)
    {
        $this->compact_data = $this->clientService->update_client_status($id, $status);

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
        $this->compact_data = $this->clientService->update_client_permision($id, $permision);

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
        $this->compact_data = $this->clientService->client_details($consumer_number);
        return view('Client.client_details', $this->compact_data);
    }

    //* Client Tracking Module
    public function add_client_tracking()
    {
        $this->compact_data = $this->clientService->add_client_tracking();
        return view('Client.add_client_tracking', $this->compact_data);
    }
    public function insert_client_tracking(Request $request)
    {
        // $consumer_number_tracking = decrypt(request('authUser'));
        // dd($consumer_number_tracking);
        $this->compact_data = $this->clientService->insert_client_tracking($request);
        return redirect()->route('admin.add_client_tracking', ['authUser' => $this->compact_data]);
    }

    public function update_client_tracking(Request $request)
    {
        $this->compact_data = $this->clientService->update_client_tracking($request);
        return redirect()->route('admin.add_client_tracking', ['authUser' => $this->compact_data]);
    }

    // *Client Document CRUD
    public function add_client_document()
    {
        $this->compact_data = $this->clientService->add_client_document();
        return view("Client.add_client_document", $this->compact_data);
    }
    public function insert_client_document(Request $request)
    {
        $this->compact_data = $this->clientService->insert_client_document($request);
        if ($this->compact_data == "true") {
            return redirect()->route('admin.add_client_document');
        } else {
            return redirect()->route('admin.client_details', $this->compact_data);
        }
    }

    public function manage_client_document() {}

    public function edit_client_document($consumer_number)
    {
        $this->compact_data = $this->clientService->edit_client_document($consumer_number);
        return view('Client.update_client_document', $this->compact_data);
    }

    public function update_client_document(Request $request)
    {
        $this->compact_data = $this->clientService->update_client_document($request);
        session()->flash('success', 'Document Update Successfully.');
        return redirect()->route('admin.download_document_and_update', ['authUser' => $this->compact_data]);
    }
    public function download_document_and_update()
    {
        $this->compact_data = $this->clientService->download_document_and_update();
        return view("Client.download_document_and_update", $this->compact_data);
    }
}
