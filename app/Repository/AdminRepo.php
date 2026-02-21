<?php
namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;

interface AdminRepo{
    public function dashboard();
    public function manage_user();
    public function material_report($request);
}
