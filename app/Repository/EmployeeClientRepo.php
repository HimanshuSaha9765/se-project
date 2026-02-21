<?php
    namespace App\Repository;

use App\Exceptions\Handler;
use Illuminate\Http\Request;

interface EmployeeClientRepo{
    public function manage_client();
    public function add_client();
    public function insert_client(Request $request);
    public function edit_client($id);
    public function update_client(Request $request);
    public function delete_client($id);
    public function update_client_status($id, $status);
    public function update_client_permision($id, $permision);
    public function client_details($consumer_number);
    public function add_client_tracking();
    public function insert_client_tracking(Request $request);
    public function update_client_tracking(Request $request)    ;
    public function add_client_document();
    public function insert_client_document(Request $request);
    public function edit_client_document($consumer_number);
    public function update_client_document(Request $request);
    public function download_document_and_update();
}

