<?php

namespace App\Http\Controllers;

use App\Models\Log_Infos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function add_user()
    {
        return view('admin.add_user');
    }
    public function manage_user()
    {
        $users = User::query()->orderBy('id', 'desc')->where('status', '!=', 'deleted')->get();

        // dd($user);
        return view('admin.manage_user', compact('users'));
    }
    public function insert_user(Request $request)
    {
        $rules = [
            'fname' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|digits:10',
            'pwd' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/',
            'pwd_confirmation' => 'required',
        ];

        $request->validate($rules, [
            'fname.required' => 'Name name cannot be empty',
            'fname.max' => 'Name name must be at maximum 40 chracters',
            'fname.min' => 'Name name must be at lethan 3 characters',

            'email.required' => 'Email address cannot be empty',
            'email.email' => 'Invalid email address',
            'email.unique' => 'Email address already registered',

            'mobile_number.required' => 'Mobile number cannot be empty',
            'mobile_number.digits' => 'Mobile number must contain only 10 digits',

            'pwd.required' => 'Password cannot be empty',
            'pwd.regex' => 'Password must contain one digit,one character both upper and lower and a special character',
            'pwd.confirmed' => 'Password and Confirm Password must match',

            'pwd_confirmation.required' => 'Confirm Password cannot be empty',
        ]);
        $randomKeySha1 = sha1(uniqid());
        $info_id = 'User-' . $randomKeySha1;

        $info = new Log_Infos();
        $info->table_id = $info_id;
        $info->created_ip = $request->ip();
        $info->created_name = $request->fname;
        $info->created_email = $request->email;
        $info->created_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');

        $info->save();
        // * End Info Log

        $user = new User();
        $user->info_id = $info_id;
        $user->name = $request->fname;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        if (session()->has('admin')) {
            $user->role = $request->role;
        }
        $user->password = Hash::make($request->pwd_confirmation);

        // $session_data = session()->get('admin');

        if ($user->save() || session()->has('admin')) {
            session()->flash('success', 'Account created Successfully.');
            return redirect()->route('admin.manage_user');
        } else {
            session()->flash('success', 'Account created Successfully.');
            return redirect()->route('guest.login');
        }
    }
    public function edit_user($id)
    {
        $user = User::query()->where('id', $id)->first();
        return view('admin.update_user', compact('user'));
    }
    public function update_user(Request $request)
    {
        $rules = [
            'fname' => 'required|min:3|max:40',
            'email' => 'required|email',
            'mobile_number' => 'required|digits:10',

        ];

        $request->validate($rules, [
            'fname.required' => 'Name name cannot be empty',
            'fname.max' => 'Name name must be at maximum 40 chracters',
            'fname.min' => 'Name name must be at lethan 3 characters',

            'email.required' => 'Email address cannot be empty',
            'email.email' => 'Invalid email address',

            'mobile_number.required' => 'Mobile number cannot be empty',
            'mobile_number.digits' => 'Mobile number must contain only 10 digits',
        ]);
        $user_data = User::query()->whereRaw('id = ?', [$request->id])->first();
        // * Log Update
        $log_data = Log_Infos::query()->whereRaw('table_id = ?', [$user_data->info_id])->first();
        $email = session()->get('admin');
        // $id = User::where('email', $email)->first()->id;
        $data = User::where('email', $email)->first();

        if (!$log_data->updated_ip) {
            $log_data->update([
                'updated_ip' => $request->ip(),
                'updated_name' => $data->name,
                'updated_email' => $email,
                'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
            ]);
        }
        else{
            $info = new Log_Infos();
            $info->table_id = $log_data->table_id;
            $info->updated_ip = $request->ip();
            $info->updated_name = $data->name;
            $info->updated_email = $email;
            $info->updated_date = Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A');
            $info->save();
        }
        // $email = session()->get('admin');
        // $data = User::query()->where('email', $email)->first();
        // // $data = User::where('id', $id)->first();

        // $log_data->update([
        //     'updated_ip' => $request->ip(),
        //     'updated_name' => $data->name,
        //     'updated_email' => $email,
        //     'updated_date' => Carbon::now('Asia/Kolkata')->format('Y-m-d h:i:s A'),
        // ]);
        // * End Log Update

        $User = User::query()->where('id', $request->id)
            ->update([
                'name' => $request->fname,
                'mobile_number' => $request->mobile_number,
                'role' => $request->role,
            ]);

        if ($User) {
            session()->flash('success', 'User updated successfully.');
            return redirect()->route('admin.manage_user');
        } else {
            session()->flash('error', 'Error in updating User.');
            // return redirect()->route('admin.edit_user');
            return redirect()->route('admin.edit_user', ['id' => $request->id]);

        }
    }

    public function delete_user($id)
    {
        $User = User::query()->whereRaw('id = ?', [$id])->first();
        $User->update([
            'status' => 'deleted',
        ]);
        if (!$User) {
            session()->flash('error', 'User not found.');
            return response()->json(['Error' => 'Error User Not Found']);
        }
        session()->flash('success', 'User deleted successfully.');
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function update_user_status($id, $status)
    {
        $User = User::query()->where('id', $id)->update(['status' => $status]);

        if (!$User) {
            session()->flash('error', 'Error in updating User status.');
            return response()->json(['Error' => 'Error in updating User status']);
        } else {
            session()->flash('success', 'User status updated successfully.');
            return response()->json(['message' => 'User status updated successfully']);
        }
    }
}