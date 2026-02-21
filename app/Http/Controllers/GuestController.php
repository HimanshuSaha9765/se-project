<?php

namespace App\Http\Controllers;

use App\Models\BranchLocation;
use App\Models\delete_token;
use App\Models\User;
use App\Repository\GuestRepo;
use App\Services\BranchLocationService;
use App\Services\GuestService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class GuestController extends Controller implements GuestRepo
{
    public GuestService $guestService;
    public BranchLocationService $BranchLocationService;

    public function __construct(GuestService $guestService, BranchLocationService $BranchLocationService)
    {
        $this->guestService = $guestService;
        $this->BranchLocationService = $BranchLocationService;
    }
    var $compact_data;
    public function home()
    {
        return view("guest.home");
    }
    public function about()
    {
        return view("guest.about");
    }
    public function service()
    {
        return view("guest.service");
    }
    public function gallery()
    {
        return view("guest.gallery");
    }
    public function contact()
    {
        $result = $this->BranchLocationService->manage_branch_location();
        return view("guest.contact",$result);
    }
    public function career()
    {
        return view("guest.career");
    }
    public function login()
    {
        return view("guest.login");
    }
    public function register()
    {
        return view("guest.register");
    }
    public function branches()
    {
        $result = $this->BranchLocationService->manage_branch_location();

        return view("guest.Branch", $result);
    }

    public function getBranchData($id)
    {
        $branch = BranchLocation::find($id);

        if (!$branch) {
            return response()->json(['error' => 'Branch not found'], 404);
        }

        return response()->json(['data' => $branch]);
    }

    public function get_a_quote(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:40',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric|digits:10',
            'service' => 'required',
            'running_bill' => 'required',
            'kilowatt' => 'required',
            'address' => 'required|min:3|max:40',
        ];

        $errorMessages = [
            'name.required' => 'Name cannot be empty',
            'name.max' => 'Name must be at maximum 40 characters',
            'name.min' => 'Name must be at least 3 characters',

            'email.required' => 'Email address cannot be empty',
            'email.email' => 'Invalid email address',

            'mobile_number.required' => 'Mobile number cannot be empty',
            'mobile_number.digits' => 'Mobile number must contain exactly 10 digits',
            'mobile_number.numeric' => 'Mobile number must contain digits only',

            'service.required' => 'Service field cannot be empty',

            'running_bill.required' => 'Bill field cannot be empty',
            'kilowatt.required' => 'Kilowatt field cannot be empty',

            'address.required' => 'Address cannot be empty',
            'address.max' => 'Address must be at maximum 40 characters',
            'address.min' => 'Address must be at least 3 characters',
        ];
        $request->validate($rules, $errorMessages);

        $this->compact_data = $this->guestService->get_a_quote($request);
        if ($this->compact_data) {
            session()->flash('success', 'Quotation has been submitted successfully.');
            return back();
            // return redirect()->route('guest.home');
        } else {
            session()->flash('error', 'Quotation submission failed. Please try again.');
            return back();
            // return redirect()->route('guest.home');
        }
        // } catch (\Exception $e) {
        //     session()->flash('error', 'An error occurred while processing your request.');
        //     return redirect()->route('guest.home');
        // }

    }

    public function details($id)
    {
        $branch_location_details = BranchLocation::query()
        ->where('id', $id)
        ->whereRaw('status != ?', ['deleted'])
        ->first();
        return view("guest.details", compact('branch_location_details'));
    }
    public function branch()
    {
        $branches = [
            [
                'name' => '5G Phones - Falla Store',
                'address' => '18, Ganesh Complex, Near Ashapura Hotel, Jamnagar rajkot Highway, Falla, Jamnagar - 361120',
                'phone' => '1234567890',
                'lat' => 22.4700,
                'lng' => 70.0570,
            ],
            [
                'name' => '5G Phones - Dwarka Store',
                'address' => 'Shivrajinh road, Opp Damji Hotel, Dwarka-361335',
                'phone' => '0987654321',
                'lat' => 22.2400,
                'lng' => 68.9700,
            ],
            [
                'name' => '5G Phones - Meghraj Store',
                'address' => 'Opp. Market yard, Near. Khabharat general store, Meghraj – 383350',
                'phone' => '1122334455',
                'lat' => 23.0000,
                'lng' => 73.0000,
            ],
        ];
        return view("guest.Branch", compact('branches'));
    }

    public function goldi_solar()
    {
        return view("guest.dealer_ship.goldi_solar");
    }
    //* Step : 1 Forgot password email send View
    public function forgot_password()
    {
        return view("guest.forgot_password");
    }
    //* Step : 2 Forgot password view action
    public function forgot_password_form_submit(Request $request)
    {
        // dd($request->all());
        date_default_timezone_set("Asia/Kolkata");
        $current_time = Carbon::now();
        delete_token::where('expiry_time', '<', $current_time)->delete();
        $rules = ['em' => 'required|email'];
        $errors = [
            'em.required' => 'Email addrss is a required field',
            'em.email' => 'Enter a valid email address'
        ];
        $request->validate($rules, $errors);
        $em = $request->em;
        $data = User::where('email', $em)->first();
        // dd($data->name);
        if ($data) {
            $data1 = delete_token::where('email', $em)->first();
            if ($data1) {
                session()->flash('warning', 'A Password reset link is already sent to your mail please check. New link will be generated after old link expires');
            } else {
                date_default_timezone_set("Asia/Kolkata");
                $s_time = date("Y-m-d G:i:s");

                $token = hash('sha512', $s_time);
                $otp = mt_rand(100000, 999999);

                try {
                    $data2 = ['name' => $data->name, 'email' => $em, 'token' => $token, 'otp' => $otp];
                    Mail::send('mail_forget_pwd', ['data2' => $data2], function ($message) use ($data2) {
                        // $message->to('brightenergy2021@gmail.com',$data['name']);
                        $message->to($data2['email'], $data2['name']);
                        $message->subject('Password Reset Link');
                    });
                } catch (Exception $th) {
                    // dd('Error : ' . $th->getMessage());
                }

                $expiry_time = Carbon::now()->addMinutes(2);
                // dd($em,$otp,$token,$expiry_time);
                $token_ins = new delete_token();
                $token_ins->email = $em;
                $token_ins->otp = $otp;
                $token_ins->token = $token;
                $token_ins->expiry_time = $expiry_time;
                // dd($token_ins);
                if ($token_ins->save()) {
                    session()->flash('success', 'Password reset tokens sent to your registered email address');
                }
            }
        } else {
            session()->flash('error', 'Sorry the email address you entered is not registered.');
        }
        return redirect()->route('guest.forgot_password');
    }
    //* Step : 3 Forgot password OTP View
    public function verify_forget_pwd_otp($email, $token)
    {
        date_default_timezone_set("Asia/Kolkata");
        session()->put('forget_pwd_email', $email);
        session()->put('forget_pwd_token', $token);
        $current_time = Carbon::now();
        delete_token::where('expiry_time', '<', $current_time)->delete();
        $data1 = delete_token::where('email', $email)->first();
        if ($data1) {
            return view('guest.verify_otp_forget_pwd');
        } else {
            session()->flash('error', 'Password reset token expired. Please Generate the link again by submitting the form');
            return redirect()->route('guest.forgot_password');
        }
    }
    //* Step : 4 Forgot password OTP action with reset password view
    public function verify_forget_pwd_otp_action(Request $request)
    {
        // dd($request->all());
        $request->validate(['otp' => 'required|size:6'], ['otp.required' => 'OTP cannot be empty', 'otp.size' => 'OTP must have 6 digits only']);
        $otp = $request->otp;
        if (session('forget_pwd_token') && session('forget_pwd_email')) {
            $email = session()->get('forget_pwd_email');
            $token = session()->get('forget_pwd_token');
        }
        $data = delete_token::where('email', $email)->where('token', $token)->first();
        if ($data) {
            if ($data->otp == $otp) {
                session()->flash('success', 'OTP Match Successfully');
                return view('guest.reset_password');
            } else {
                session()->flash('error', 'The OTP doesn`t match.');
                return view('guest.verify_otp_forget_pwd');
            }
        } else {
            session()->flash('error', 'Password reset token expired. Please Generate the link again by submitting the form');
            return redirect()->route('guest.forgot_password');
        }
    }
    //* Step : 5 Forgot password action
    public function reset_password(Request $request)
    {
        $rules = [
            'npwd' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/|confirmed',
            'npwd_confirmation' => 'required',
        ];

        $errors = [
            'npwd.required' => 'Password field cannot be empty',
            'npwd.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (#?!@$%^&*-), and must be 8-20 characters long',
            'npwd.confirmed' => 'Password and Confirm Password must match',
            'npwd_confirmation.required' => 'Confirm Password must not be empty'
        ];

        $request->validate($rules, $errors);
        if (session('forget_pwd_token') && session('forget_pwd_email')) {
            $email = session()->get('forget_pwd_email');
            $token = session()->get('forget_pwd_token');
        }
        date_default_timezone_set("Asia/Kolkata");
        $current_time = Carbon::now();
        delete_token::where('expiry_time', '<', $current_time)->delete();
        $data = delete_token::where('email', $email)->where('token', $token)->first();
        if ($data) {
            $data1 = User::where('email', $email)->update(array('password' => Hash::make($request->npwd_confirmation)));
            if ($data1) {
                delete_token::where('email', $email)->delete();
                session()->flash('success', 'Password changed successfully');
                return redirect()->route('guest.login');
            }
        } else {
            session()->flash('error', 'Password reset token expired. Please Generate the link again by submitting the form');
            return redirect()->route('guest.forgot_password');
        }
    }
}
