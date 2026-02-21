<?php
    namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;

interface GuestRepo{
    function get_a_quote(Request $request);
}

