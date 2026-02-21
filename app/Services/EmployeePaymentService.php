<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Client_Document;
use App\Models\Log_Infos;
use App\Models\Payment;
use App\Models\payment_log;
use App\Models\User;
use App\Repository\EmployeePaymentRepo;
use App\Repository\EmployeeRepo;
use App\Repository\GuestRepo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmployeePaymentService implements EmployeePaymentRepo
{ 
    var $compact_data;
    
    public function add_payment()
    {
        try {
            $consumer_number = decrypt(request('authUser'));
            // dd($consumer_number);
            $Client_Document_Data = Client_Document::query()->whereRaw('consumer_number = ?', [$consumer_number])->first();
            $payment = payment_log::query()->whereRaw('consumer_number = ?', [$consumer_number]);
            $this->compact_data['Client_Document_Data'] = $Client_Document_Data;
            $this->compact_data['payment'] = $payment;
            return $this->compact_data;
        } catch (Exception $e) {
            dd($e->getMessage());
            return $e->getMessage();
        }
    }

    public function manage_payment()
    {
        try {
            $d_data = decrypt(request('authUser'));
            // $payment = Payment::query()->where('consumer_number', $d_data)->first();
            $payment = payment_log::query()->whereRaw('consumer_number = ?', [$d_data]);

            $consumer_number_Of_client_documentsTable = Client_Document::query()->whereRaw('consumer_number = ?', [$d_data])->first();
            $this->compact_data['consumer_number'] = encrypt($d_data);
            $this->compact_data['payment'] = $payment;
            $this->compact_data['consumer_number_Of_client_documentsTable'] = $consumer_number_Of_client_documentsTable;

            return $this->compact_data;
        } catch (Exception $e) {
            dd($e->getMessage());
            return $e->getMessage();
        }
    }

    public function insert_client_payment(Request $request)
    {
        // dd($request->all());
        try {
            $randomKeySha1 = sha1(uniqid());
            $info_id = 'Payment-' . $randomKeySha1;

            $email = session()->get('employee');
            $data = User::query()->whereRaw('email = ?', [$email])->first();

            $info = new Log_Infos();
            $info->table_id = $info_id;
            $info->created_ip = $request->ip();
            $info->created_name = $data->name;
            $info->created_email = $email;
            $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');

            // dd($info);
            $info->save();
            // * End Info Log

            $Client_Document_Data = Client_Document::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
            // $Payment = Payment::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
            // dd($Client_Document_Data->final_confirm_amount);

            $Payment = payment_log::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->first();
            // $Payment2 = Payment::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->latest();
            // dd($Payment2->due_amount);

            // TODO: Payment log
            if ($Payment) {
                $Payment2 = payment_log::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->latest()->first();
                $due_amount = $Payment2->due_amount;

                $Total = $Payment2->total_amount + $request->amount;

                $total_due_amt = $due_amount - $request->amount;
                $total_due_amount = $request->various_amount + $total_due_amt;
            }

            $client_payment = new payment_log();


            $client_payment->info_id = $info_id;
            $client_payment->type_of_various = $request->various;
            $client_payment->consumer_number = $request->consumer_number;
            $client_payment->payment_date = $request->payment_date;
            $client_payment->various_amount = $request->various_amount;
            $client_payment->reason = $request->reason;
            $client_payment->payment_mode = $request->payment_mode;
            $client_payment->cheque_number = $request->cheque_number;
            $client_payment->bank_name = $request->bank_name;
            $client_payment->type_of_payment = $request->type_of_payment;
            $client_payment->transaction_number = $request->transaction_number;
            $client_payment->recieved_amount = $request->amount;


            // dd($client_payment);
            if (!$Payment) {
                $client_payment->final_confirm_amount = $Client_Document_Data->final_confirm_amount + $request->various_amount;
                $client_payment->deposit = $Client_Document_Data->deposit;

                $client_payment->due_amount = $request->various_amount + $Client_Document_Data->due_amount - $request->amount;
                $client_payment->total_amount = $Client_Document_Data->deposit + $request->total_amount;
            } else {
                // if ($request->various_amount) {
                //     $p2 = Payment::query()
                //         ->whereRaw('consumer_number = ?', [$request->consumer_number])
                //         ->latest('final_confirm_amount')
                //         ->first();
                //     $p = $p2->final_confirm_amount;
                //     $client_payment->final_confirm_amount = $p + $request->various_amount;
                // }

                if ($request->various == "=") {
                    $client_payment->due_amount = $total_due_amount;
                    $client_payment->total_amount = $Total;
                }

                if ($request->various == "+") {
                    $p2 = payment_log::query()
                        ->whereRaw('consumer_number = ?', [$request->consumer_number])
                        ->latest('final_confirm_amount')
                        ->first();
                    $p = $p2->final_confirm_amount;
                    $client_payment->final_confirm_amount = $p + $request->various_amount;

                    $client_payment->due_amount = $total_due_amount;
                    $client_payment->total_amount = $Total;
                }

                if ($request->various == "-") {
                    $p2 = payment_log::query()
                        ->whereRaw('consumer_number = ?', [$request->consumer_number])
                        ->latest('final_confirm_amount')
                        ->first();
                    $p = $p2->final_confirm_amount;
                    $client_payment->final_confirm_amount = $p - $request->various_amount;

                    $Payment_due = payment_log::query()->whereRaw('consumer_number = ?', [$request->consumer_number])->latest()->first();
                    $decrement = $request->amount + $request->various_amount;
                    // dd();
                    $client_payment->due_amount = $decrement - $Payment_due->due_amount;
                    $client_payment->total_amount = $Total;
                }
            }

            return $client_payment->save() ? "true" : "false";
        } catch (Exception $e) {
            dd("payment : " . $e->getMessage());
            session()->flash('error', 'Error in Updating Client Payment: ' . $e->getMessage());
        }
    }
}