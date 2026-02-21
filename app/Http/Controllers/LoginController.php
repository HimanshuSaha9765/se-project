<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login_authentication(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];

        $errors = [
            'email.required' => 'Email address cannot be empty',
            'email.email' => 'Enter a valid email address',
            'email.exists' => 'No account with this email address was found.',
            'password.required' => 'Password field cannot be empty'
        ];
        // $validator = validator::make($request->all(), $rules, $errors);
        $request->validate($rules, $errors);

        $credentials = $request->only(['email', 'password']);

        // dd($credentials);

        $user = User::where('email', $credentials['email'])->first();


        if ($user->status == 'active') {
            if ($user && Hash::check($credentials['password'], $user->password)) {
                if (auth()->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                    // Authentication successful
                    session()->put('token', auth()->tokenById($user->id));

                    // *Admin
                    if ($user->role == "admin") {
                        session()->put('admin', $user->email);
                        session()->put('adminToken', auth()->tokenById($user->id));

                        $user->update([
                            'ip_address' => $request->ip(),
                            'last_login_time' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
                        ]);

                        return redirect()->route('admin.dashboard');
                    }
                } else {
                    session()->flash('error', 'Valide Username and password');
                    return redirect()->route('guest.login');
                }
            } else {
                session()->flash('error', 'Password is incorrect');
                return redirect()->route('guest.login');
            }

            // *employee
            if ($user && Hash::check($credentials['password'], $user->password)) {
                if (auth()->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                    // Authentication successful
                    session()->put('token', auth()->tokenById($user->id));
                    if ($user->role == "employee") {
                        session()->put('employee', $user->email);
                        session()->put('employeeToken', auth()->tokenById($user->id));

                        $email = session()->get("employee");
                        $id = User::where("email", $email)->first()->id;

                        $data = User::where('id', $id)->first();
                        // dd($data);
                        $data->where('id', $id)->update(
                            array(
                                'ip_address' => $request->ip(),
                                'last_login_time' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
                            )
                        );
                        // dd($employee_email);
                        return redirect()->route('employee.dashboard');
                    }
                } else {
                    session()->flash('error', 'Valide Username and password');
                    return redirect()->route('guest.login');
                }
            } else {
                session()->flash('error', 'Password is incorrect');
                return redirect()->route('guest.login');
            }


            // *Dealer
            if ($user && Hash::check($credentials['password'], $user->password)) {
                if ($user->role == "dealer") {
                    session()->put('dealer', $user->email);
                    session()->put('dealerToken', auth()->tokenById($user->id));

                    $email = session()->get("dealer");
                    $id = User::where("email", $email)->first()->id;

                    $data = User::where('id', $id)->first();
                    // dd($data);
                    $data->where('id', $id)->update(
                        array(
                            'ip_address' => $request->ip(),
                            'last_login_time' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
                        )
                    );
                    // dd($employee_email);
                    return redirect()->route('dealer.dashboard');
                }
            } else {
                session()->flash('error', 'Password is incorrect');
                return redirect()->route('guest.login');
            }

            // *Installer
            if ($user && Hash::check($credentials['password'], $user->password)) {
                if ($user->role == "installer") {
                    session()->put('installer', $user->email);
                    session()->put('installerToken', auth()->tokenById($user->id));

                    $email = session()->get("installer");
                    $id = User::where("email", $email)->first()->id;

                    $data = User::where('id', $id)->first();
                    // dd($data);
                    $data->where('id', $id)->update(
                        array(
                            'ip_address' => $request->ip(),
                            'last_login_time' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
                        )
                    );
                    // dd($employee_email);
                    return redirect()->route('installer.dashboard');
                }
            } else {
                session()->flash('error', 'Password is incorrect');
                return redirect()->route('guest.login');
            }
        } else {
            session()->flash('error', 'If you want to activate your account kindly contact the administrator');
            return redirect()->route('guest.login');
        }
        return redirect()->back();
    }

    
    public function AdminLogout(Request $request)
    {
        session()->forget('adminToken');
        session()->forget('admin');

        session()->flash('success', 'Your account was logged out successfully');
        return redirect()->route('guest.login');
    }

    public function EmployeeLogout(Request $request)
    {
        session()->forget('employeeToken');
        session()->forget('employee');

        session()->flash('success', 'Your account was logged out successfully');
        return redirect()->route('guest.login');
    }
    public function DealerLogout(Request $request)
    {
        session()->forget('dealerToken');
        session()->forget('dealer');

        session()->flash('success', 'Your account was logged out successfully');
        return redirect()->route('guest.login');
    }
    public function InstallerLogout(Request $request)
    {
        session()->forget('installerToken');
        session()->forget('installer');

        session()->flash('success', 'Your account was logged out successfully');
        return redirect()->route('guest.login');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
