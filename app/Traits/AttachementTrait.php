<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait AttachementTrait
{
    public function verifyAndUpload(Request $request, $fieldname = 'image', $directory = 'images')
    {
        if ($request->hasFile($fieldname)) {
            if (!$request->file($fieldname)->isValid()) {
                session()->flash('Invalid Image!');
                return redirect()->back()->withInput();
            }
            $image_name = $fieldname. '.' .uniqid() . '.' . $request->file($fieldname)->extension();
            $request->file($fieldname)->move(public_path('images'), $image_name);
            return $image_name;
            // return $request->file($fieldname)->store($directory, $image_name);
        }
        return null;
    }
    public function verifyAndUpload_client_tracking(Request $request, $fieldname = 'image', $directory = 'images')
    {
        if ($request->hasFile($fieldname)) {
            if (!$request->file($fieldname)->isValid()) {
                session()->flash('Invalid Image!');
                return redirect()->back()->withInput();
            }
            $image_name = $fieldname. '.' .uniqid() . '.' . $request->file($fieldname)->extension();
            $request->file($fieldname)->move(public_path('images/Client_tracking'), $image_name);
            return $image_name;
            // return $request->file($fieldname)->store($directory, $image_name);
        }
        return null;
    }
}
