<?php

namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;
// php artisan make:interface Interface\Interface_name
interface ClientRepo{
    // function get_a_quote(Request $request);
    public function manage_client();
    public function add_client();
    public function insert_client($request);
    public function edit_client($id);
    public function update_client($request);
    public function delete_client($id);
    public function update_client_status($id,$status);
    public function update_client_permision($id,$permision);
    public function client_details($consumer_number);
    public function add_client_tracking();
    public function insert_client_tracking($request);
    public function update_client_tracking($request);
    public function add_client_document();
    public function insert_client_document($request);
    public function edit_client_document($consumer_number);
    public function update_client_document($request);
    public function download_document_and_update();
}