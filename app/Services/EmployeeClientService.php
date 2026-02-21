<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Client_Document;
use App\Models\client_tracking;
use App\Models\Log_Infos;
use App\Models\Payment;
use App\Models\references;
use App\Models\User;
use App\Repository\EmployeeClientRepo;
use App\Repository\GuestRepo;
use App\Traits\AttachementTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;


class EmployeeClientService implements EmployeeClientRepo
{
    use AttachementTrait;
    var $compact_data;
    public function manage_client()
    {
        $clients = Client::query()->orderBy('id', 'desc')->whereRaw('status != ?', ['deleted'])->get();
        $this->compact_data['clients'] = $clients;
        return $this->compact_data;
    }
    public function add_client()
    {
        $User_data = references::query()->whereRaw('status != ?', ['deleted'])->get();
        $this->compact_data['User_data'] = $User_data;
        return $this->compact_data;
    }

    public function insert_client(Request $request)
    {
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'Client-' . $randomKeySha1;

        $email = session()->get('employee');
        $data = User::query()->whereRaw('email = ?', [$email])->first();
        // dd($data->name);
        // $data = User::where('id', $id)->first();

        $info = new Log_Infos();
        $info->table_id = $info_id;
        $info->created_ip = $request->ip();
        $info->created_name = $data->name;
        $info->created_email = $email;
        $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');

        // dd($info);
        $info->save();
        // * End Info Log

        $Image = $this->verifyAndUpload($request, 'structure_image');

        $references_data = references::query()->whereRaw('email_assign = ?', [$request->reference_by])->first();

        $client = new Client();

        $client->info_id = $info_id;
        $client->consumer_number = $request->consumer_number;
        $client->user_email_id = $references_data->email_assign;
        $client->name = $request->client_name;
        $client->mobile_number = $request->mobile_number;
        $client->email = $request->email;
        $client->bill_amount = $request->bill_amount;
        $client->kw = $request->kw;
        $client->structure_length = $request->structure_length;
        $client->structure_width = $request->structure_width;
        $client->structure_height = $request->structure_height;
        $client->quotation_amount = $request->quotation_amount;
        $client->reference_by = $references_data->name;
        $client->structure_image = $Image;
        $client->address = $request->address;

        // dd($client);
        if ($client->save()) {
            return "true";
        } else {
            return "false";
        }
        // } 
        // catch (Exception $th) {
        //     dd($th->getMessage());
        // }

    }

    public function edit_client($id)
    {
        $User_data = references::query()->whereRaw('status != ?', ['deleted'])->get();
        $client = Client::query()->whereRaw('id = ?', [$id])->first();
        $this->compact_data['User_data'] = $User_data;
        $this->compact_data['client'] = $client;
        return $this->compact_data;
    }

    public function update_client(Request $request)
    {
        try {
            $client = Client::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

            // * Start Log Update
            $client_data = Client::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();


            // * Log Update
            $log_data = Log_Infos::query()->whereRaw('table_id = ?', [$client_data->info_id])->first();
            $email = session()->get('employee');
            // $id = User::where('email', $email)->first()->id;
            $data = User::where('email', $email)->first();

            if (!$log_data->updated_ip) {
                $log_data->update([
                    'updated_ip' => $request->ip(),
                    'updated_name' => $data->name,
                    'updated_email' => $email,
                    'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
                ]);
            } else {
                $info = new Log_Infos();
                $info->table_id = $log_data->table_id;
                $info->updated_ip = $request->ip();
                $info->updated_name = $data->name;
                $info->updated_email = $email;
                $info->updated_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
                $info->save();
            }
            // * End Log Update


            if ($request->hasFile('structure_image')) {
                $oldFilePath = public_path('images/' . $client['structure_image']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $Image = $this->verifyAndUpload($request, 'structure_image');

                $client->where('id', $request->id)->update(['structure_image' => $Image]);
            } else {
                $Image = $client->structure_image;
            }

            $references_data = references::query()->whereRaw('email_assign = ?', [$request->reference_by])->first();

            $client->update([
                'user_email_id' => $request->reference_by,
                'name' => $request->client_name,
                'mobile_number' => $request->mobile_number,
                'bill_amount' => $request->bill_amount,
                'kw' => $request->kw,
                'structure_length' => $request->structure_length,
                'structure_width' => $request->structure_width,
                'structure_height' => $request->structure_height,
                'quotation_amount' => $request->quotation_amount,
                'reference_by' => $references_data->name,
                'structure_image' => $Image,
                'address' => $request->address,
            ]);
            return "true";
        } catch (Exception $e) {
            return "false";
            // dd($e->getMessage());
            // session()->flash('error', 'Error in updating client: ' . $e->getMessage());
            // return redirect()->route('employee.edit_client', ['id' => $request->id]);
        }
    }

    public function delete_client($id)
    {
        $Client = Client::query()->whereRaw('id = ?', [$id])->first();
        $Client->update([
            'status' => 'deleted',
        ]);
        if (!$Client) {
            return "false";
        }
        return "true";
    }

    public function update_client_status($id, $status)
    {
        $Client = Client::query()->whereRaw('id = ?', [$id])->update(['status' => $status]);

        if (!$Client) {
            return "false";
        } else {
            return "true";
        }
    }

    public function update_client_permision($id, $permision)
    {
        $Client = Client::query()->whereRaw('id = ?', [$id])->update(['process_of_client' => $permision]);

        if (!$Client) {
            return "fasle";
        } else {
            return "true";
        }
    }

    public function client_details($consumer_number)
    {
        try {
            $Client_Data = Client::query()->whereRaw('consumer_number  = ?', [$consumer_number])->first();
            // dd($Client_Data);
            $Client_tracking_Data = client_tracking::query()->whereRaw('consumer_number  = ?', [$consumer_number])->first();
            $Client_Document_Data = Client_Document::query()->whereRaw('consumer_number  = ?', [$consumer_number])->first();

            $consumer_number = encrypt($consumer_number);

            $this->compact_data['consumer_number'] = $consumer_number;
            $this->compact_data['Client_Data'] = $Client_Data;
            $this->compact_data['Client_tracking_Data'] = $Client_tracking_Data;
            $this->compact_data['Client_Document_Data'] = $Client_Document_Data;
            return $this->compact_data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function add_client_tracking()
    {
        try {
            $consumer_number = decrypt(request('authUser'));
            $Client_tracking_Data = client_tracking::query()->whereRaw('consumer_number  = ?', [$consumer_number])->first();
            $Client_Document = Client_Document::query()->whereRaw('consumer_number = ?', [$consumer_number])->first();
            $this->compact_data['consumer_number'] = $consumer_number;
            $this->compact_data['Client_Document'] = $Client_Document;
            $this->compact_data['Client_tracking_Data'] = $Client_tracking_Data;

            return $this->compact_data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert_client_tracking(Request $request)
    {
        // $consumer_number_tracking = decrypt(request('authUser'));
        // dd($consumer_number_tracking);
        $Client_tracking_Data = client_tracking::query()->whereRaw('consumer_number  = ?', [$request->consumer_number])->first();
        // dd($Client_tracking_Data);
        if (!$Client_tracking_Data) {
            $appication_1 = $this->verifyAndUpload_client_tracking($request, 'appication_1');

            $client_tracking = new client_tracking();
            $client_tracking->consumer_number = $request->consumer_number;
            $client_tracking->application_number_1 = $request->application_number_1;
            $client_tracking->appication_1 = $appication_1;
            $client_tracking->amount_1 = $request->amount_1;

            if ($client_tracking->save()) {
                session()->flash('success', 'Client Tracking add Successfully.');
            }
        } else {
            if ($request->document_verified_2 || $request->resion_2) {
                $Track2 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
                $Track2->update([
                    'document_verified_2' => $request->document_verified_2,
                    'resion_2' => $request->resion_2,
                ]);

                if ($Track2) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }

            if ($request->metter_fee_3) {
                $Track3 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
                $Track3->update([
                    'metter_fee_3' => $request->metter_fee_3,
                ]);

                if ($Track3) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }

            if ($request->fesibility_approved_4 || $request->resion_4) {
                $Track4 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

                $Track4->update([
                    'fesibility_approved_4' => $request->fesibility_approved_4,
                    'resion_4' => $request->resion_4,
                ]);

                if ($Track4) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }

            if ($request->structure_image_5) {
                $structure_image_5 = $this->verifyAndUpload_client_tracking($request, 'structure_image_5');
                $Track5 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
                $Track5->update([
                    'structure_image_5' => $structure_image_5,
                ]);

                if ($Track5) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }

            if ($request->make_of_module_6 || $request->sr_no_module_6 || $request->module_mount_image_6) {
                $Track6 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
                $module_mount_image_6 = $this->verifyAndUpload_client_tracking($request, 'module_mount_image_6');

                $Track6->update([
                    'make_of_module_6' => $request->make_of_module_6,
                    'sr_no_module_6' => $request->sr_no_module_6,
                    'module_mount_image_6' => $module_mount_image_6,
                ]);

                if ($Track6) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }

            if ($request->inverter_image7 || $request->serial_number_image7 || $request->serial_number7) {
                $Track8 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
                $inverter_image7 = $this->verifyAndUpload_client_tracking($request, 'inverter_image7');
                $serial_number_image7 = $this->verifyAndUpload_client_tracking($request, 'serial_number_image7');

                $Track8->update([
                    'inverter_image7' => $inverter_image7,
                    'serial_number_image7' => $serial_number_image7,
                    'serial_number7' => $request->serial_number7,
                ]);

                if ($Track8) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }

            if ($request->perform_8 || $request->form_16_8) {
                $Track8 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
                $perform_8 = $this->verifyAndUpload_client_tracking($request, 'perform_8');
                $form_16_8 = $this->verifyAndUpload_client_tracking($request, 'form_16_8');

                $Track8->update([
                    'perform_8' => $perform_8,
                    'form_16_8' => $form_16_8,
                ]);

                if ($Track8) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }

            if ($request->jr_form_9 || $request->subsidy_clamp_9 || $request->amount_9 || $request->description_9 || $request->recived_9 || $request->pdf_9) {
                $Track9 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
                $jr_form_9 = $this->verifyAndUpload_client_tracking($request, 'jr_form_9');
                $pdf_9 = $this->verifyAndUpload_client_tracking($request, 'pdf_9');

                $Track9->update([
                    'jr_form_9' => $jr_form_9,
                    'subsidy_clamp_9' => $request->subsidy_clamp_9,
                    'amount_9' => $request->amount_9,
                    'description_9' => $request->description_9,
                    'recived_9' => $request->recived_9,
                    'pdf_9' => $pdf_9,
                ]);
                if ($Track9) {
                    session()->flash('success', 'Client Tracking add Successfully.');
                }
            }
        }
        return $this->compact_data = encrypt($request->consumer_number);
    }

    public function update_client_tracking(Request $request)
    {

        if ($request->application_number_1 || $request->appication_1 || $request->amount_1) {
            $Track1 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

            if ($request->hasFile('appication_1')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track1['appication_1']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $appication_1 = $this->verifyAndUpload_client_tracking($request, 'appication_1');
                $Track1->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['appication_1' => $appication_1]);
            } else {
                $appication_1 = $Track1->appication_1;
            }


            $Track1->update([
                'application_number_1' => $request->application_number_1,
                'appication_1' => $appication_1,
                'amount_1' => $request->amount_1,
            ]);
            if ($Track1) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }

        if ($request->document_verified_2 || $request->resion_2) {
            $Track2 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
            $Track2->update([
                'document_verified_2' => $request->document_verified_2,
                'resion_2' => $request->resion_2,
            ]);
            if ($Track2) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }

        if ($request->metter_fee_3) {
            $Track3 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

            $Track3->update([
                'metter_fee_3' => $request->metter_fee_3,
            ]);
            if ($Track3) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }

        if ($request->fesibility_approved_4 || $request->resion_4) {
            $Track4 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
            $Track4->update([
                'fesibility_approved_4' => $request->fesibility_approved_4,
                'resion_4' => $request->resion_4,
            ]);
            if ($Track4) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }

        if ($request->structure_image_5) {
            $Track5 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
            if ($request->hasFile('structure_image_5')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track5['structure_image_5']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $structure_image_5 = $this->verifyAndUpload_client_tracking($request, 'structure_image_5');
                $Track5->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['structure_image_5' => $structure_image_5]);
            } else {
                $structure_image_5 = $Track5->structure_image_5;
            }
            $Track5->update([
                'structure_image_5' => $structure_image_5,
            ]);
            if ($Track5) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }


        if ($request->make_of_module_6 || $request->sr_no_module_6 || $request->module_mount_image_6) {
            $Track6 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

            if ($request->hasFile('module_mount_image_6')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track6['module_mount_image_6']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $module_mount_image_6 = $this->verifyAndUpload_client_tracking($request, 'module_mount_image_6');
                $Track6->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['module_mount_image_6' => $module_mount_image_6]);
            } else {
                $module_mount_image_6 = $Track6->module_mount_image_6;
            }

            $Track6->update([
                'make_of_module_6' => $request->make_of_module_6,
                'sr_no_module_6' => $request->sr_no_module_6,
                'module_mount_image_6' => $module_mount_image_6,
            ]);
            if ($Track6) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }

        if ($request->inverter_image7 || $request->serial_number_image7 || $request->serial_number7) {

            $Track7 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

            if ($request->hasFile('inverter_image7')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track7['inverter_image7']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $inverter_image7 = $this->verifyAndUpload_client_tracking($request, 'inverter_image7');
                $Track7->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['inverter_image7' => $inverter_image7]);
            } else {
                $inverter_image7 = $Track7->inverter_image7;
            }

            if ($request->hasFile('serial_number_image7')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track7['serial_number_image7']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $serial_number_image7 = $this->verifyAndUpload_client_tracking($request, 'serial_number_image7');
                $Track7->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['serial_number_image7' => $serial_number_image7]);
            } else {
                $serial_number_image7 = $Track7->serial_number_image7;
            }
            $Track7->update([
                'inverter_image7' => $inverter_image7,
                'serial_number_image7' => $serial_number_image7,
                'serial_number7' => $request->serial_number7,
            ]);
            if ($Track7) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }

        if ($request->perform_8 || $request->form_16_8) {
            $Track8 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

            if ($request->hasFile('perform_8')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track8['perform_8']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $perform_8 = $this->verifyAndUpload_client_tracking($request, 'perform_8');
                $Track8->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['perform_8' => $perform_8]);
            } else {
                $perform_8 = $Track8->perform_8;
            }

            if ($request->hasFile('form_16_8')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track8['form_16_8']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $form_16_8 = $this->verifyAndUpload_client_tracking($request, 'form_16_8');
                $Track8->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['form_16_8' => $form_16_8]);
            } else {
                $form_16_8 = $Track8->form_16_8;
            }


            $Track8->update([
                'perform_8' => $perform_8,
                'form_16_8' => $form_16_8,
            ]);
            if ($Track8) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }


        if ($request->jr_form_9 || $request->subsidy_clamp_9 || $request->amount_9 || $request->description_9 || $request->recived_9 || $request->pdf_9) {
            $Track9 = client_tracking::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();

            if ($request->hasFile('jr_form_9')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track9['jr_form_9']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $jr_form_9 = $this->verifyAndUpload_client_tracking($request, 'jr_form_9');
                $Track9->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['jr_form_9' => $jr_form_9]);
            } else {
                $jr_form_9 = $Track9->jr_form_9;
            }

            if ($request->hasFile('pdf_9')) {
                $oldFilePath = public_path('images/Client_tracking/' . $Track9['pdf_9']);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $pdf_9 = $this->verifyAndUpload_client_tracking($request, 'pdf_9');
                $Track9->whereRaw('consumer_number = ?', [$request->consumer_number])->update(['pdf_9' => $pdf_9]);
            } else {
                $pdf_9 = $Track9->pdf_9;
            }

            $Track9->update([
                'jr_form_9' => $jr_form_9,
                'subsidy_clamp_9' => $request->subsidy_clamp_9,
                'amount_9' => $request->amount_9,
                'description_9' => $request->description_9,
                'recived_9' => $request->recived_9,
                'pdf_9' => $pdf_9,
            ]);

            if ($Track9) {
                session()->flash('success', 'Client Tracking update Successfully.');
            }
        }
        return $this->compact_data = encrypt($request->consumer_number);
    }

    public function add_client_document()
    {
        try {
            $consumer_number = decrypt(request('authUser'));
            $Client_Data = Client::query()->whereRaw('consumer_number  = ?', [$consumer_number])->first();
            $this->compact_data['consumer_number'] = $consumer_number;
            $this->compact_data['Client_Data'] = $Client_Data;
            return $this->compact_data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert_client_document(Request $request)
    {
        try {
            $randomKeySha1 = sha1(uniqid());
            $info_id = 'Client_Document-' . $randomKeySha1;

            $email = session()->get('employee');
            $data = User::query()->where('email', $email)->first();

            $info = new Log_Infos();
            $info->table_id = $info_id;
            $info->created_ip = $request->ip();
            $info->created_name = $data->name;
            $info->created_email = $email;
            $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');

            // dd($info);
            $info->save();
            // * End Info Log

            $adharcard_image = $this->verifyAndUpload($request, 'adharcard_image');
            $light_bill = $this->verifyAndUpload($request, 'light_bill');
            $text_bill = $this->verifyAndUpload($request, 'text_bill');
            $passport_size_image = $this->verifyAndUpload($request, 'passport_size_image');
            $pancard = $this->verifyAndUpload($request, 'pancard');
            $bank_proof = $this->verifyAndUpload($request, 'bank_proof');

            // dd($adharcard_image, $light_bill, $text_bill, $passport_size_image, $pancard, $bank_proof);

            $client_document = new Client_Document();

            $client_document->info_id = $info_id;
            $client_document->consumer_number = $request->consumer_number;
            $client_document->adharcard_number = $request->adharcard_number;
            $client_document->adharcard_image = $adharcard_image;
            $client_document->light_bill = $light_bill;
            $client_document->text_bill = $text_bill;
            $client_document->passport_size_image = $passport_size_image;
            $client_document->pancard = $pancard;
            $client_document->bank_proof = $bank_proof;
            $client_document->final_confirm_amount = $request->final_confirm_amount;
            $client_document->deposit = $request->deposit;
            $client_document->due_amount = $request->due_amount;

            // dd($client_document);
            if ($client_document->save()) {
                return "true";
            } else {
                return "false";
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            session()->flash('error', 'Error in updating client document: ' . $e->getMessage());
        }
    }

    public function edit_client_document($consumer_number)
    {
        try {
            $document_data = Client_Document::query()->whereRaw('consumer_number = ? ', [$consumer_number])->first();
            $this->compact_data['document_data'] = $document_data;
            return $this->compact_data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_client_document(Request $request)
    {
        // * Start Log Update
        $document_data = Client_Document::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
        // * Log Update
        $log_data = Log_Infos::query()->whereRaw('table_id = ?', [$document_data->info_id])->first();
        $email = session()->get('employee');
        $data = User::query()->whereRaw('email = ?', [$email])->first();

        $log_data->update([
            'updated_ip' => $request->ip(),
            'updated_name' => $data->name,
            'updated_email' => $email,
            'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
        ]);
        // * End Log Update

        if ($request->hasFile('adharcard_image')) {
            $oldFilePath = public_path('images/' . $document_data['adharcard_image']);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $adharcard_image = $this->verifyAndUpload($request, 'adharcard_image');
            $document_data->where('consumer_number', $request->consumer_number)->update(['adharcard_image' => $adharcard_image]);
        } else {
            $adharcard_image = $document_data->adharcard_image;
        }

        if ($request->hasFile('light_bill')) {
            $oldFilePath = public_path('images/' . $document_data['light_bill']);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $light_bill = $this->verifyAndUpload($request, 'light_bill');
            $document_data->where('consumer_number', $request->consumer_number)->update(['light_bill' => $light_bill]);
        } else {
            $light_bill = $document_data->light_bill;
        }

        if ($request->hasFile('text_bill')) {
            $oldFilePath = public_path('images/' . $document_data['text_bill']);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $text_bill = $this->verifyAndUpload($request, 'text_bill');
            $document_data->where('consumer_number', $request->consumer_number)->update(['text_bill' => $text_bill]);
        } else {
            $text_bill = $document_data->text_bill;
        }

        if ($request->hasFile('passport_size_image')) {
            $oldFilePath = public_path('images/' . $document_data['passport_size_image']);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $passport_size_image = $this->verifyAndUpload($request, 'passport_size_image');
            $document_data->where('consumer_number', $request->consumer_number)->update(['passport_size_image' => $passport_size_image]);
        } else {
            $passport_size_image = $document_data->passport_size_image;
        }

        if ($request->hasFile('pancard')) {
            $oldFilePath = public_path('images/' . $document_data['pancard']);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $pancard = $this->verifyAndUpload($request, 'pancard');
            $document_data->where('consumer_number', $request->consumer_number)->update(['pancard' => $pancard]);
        } else {
            $pancard = $document_data->pancard;
        }

        if ($request->hasFile('bank_proof')) {
            $oldFilePath = public_path('images/' . $document_data['bank_proof']);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $bank_proof = $this->verifyAndUpload($request, 'bank_proof');
            $document_data->where('consumer_number', $request->consumer_number)->update(['bank_proof' => $bank_proof]);
        } else {
            $bank_proof = $document_data->bank_proof;
        }
        $document_data->update([
            'adharcard_number' => $request->adharcard_number,
            'adharcard_image' => $adharcard_image,
            'text_bill' => $text_bill,
            'light_bill' => $light_bill,
            'passport_size_image' => $passport_size_image,
            'pancard' => $pancard,
            'bank_proof' => $bank_proof,
            'final_confirm_amount' => $request->final_confirm_amount,
            'deposit' => $request->deposit,
            'due_amount' => $request->due_amount,
        ]);

        return $this->compact_data = encrypt($request->consumer_number);
    }

    public function download_document_and_update()
    {
        try {
            $consumer_number = decrypt(request('authUser'));
            // dd($consumer_number);
            $Client_Document = Client_Document::query()->whereRaw('consumer_number = ?', [$consumer_number])->first();
            $payment = Payment::query()->where('consumer_number', $consumer_number);
            $this->compact_data['Client_Document'] = $Client_Document;
            $this->compact_data['payment'] = $payment;
            return $this->compact_data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
