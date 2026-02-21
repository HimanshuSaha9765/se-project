<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsCondition;
class TermsConditionController extends Controller
{
    public function edit()
    {
        $terms = TermsCondition::first();
        return view('admin.TermsCondition.edit-page', compact('terms'));
    }

    public function update(Request $request)
    {
        $request->validate(['content' => 'required']);

        $terms = TermsCondition::firstOrCreate([]);
        $terms->content = $request->content;
        $terms->save();

        return redirect()->back()->with('success', 'Terms and Conditions updated successfully.');
    }   
}
