<?php

namespace App\Controllers;

use App\Core\MyController;
use App\Models\Sitefunction;
use CodeIgniter\API\ResponseTrait;

class User extends MyController
{
    use ResponseTrait;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->utc_time = date('Y-m-d H:i:s');
        $this->utc_date = date('Y-m-d');
    }

    public function fetch_lat_long()
    {
        $model = new Sitefunction();
        $data['coordinates'] = $model->get_all_rows(TBL_COORDINATES, '*');
        echo view('index/fetch_lat_long', $data);
    }

    public function add_new_coordinate()
    {
        $requestData = $this->request->getJson();
        $latitude = $requestData->latitude;
        $longitude = $requestData->longitude;
        $status = $requestData->status;
        $model = new Sitefunction();
        $check_if_coordinate_exists = $model->get_all_rows(TBL_COORDINATES, '*', array('latitude' => $latitude, 'longitude' => $longitude));
        if (sizeof($check_if_coordinate_exists) == 0) {
            $data_to_insert = array(
                'latitude' => $latitude,
                'longitude' => $longitude,
                'status' => $status,
                'created' => $this->utc_time,
                'updated' => $this->utc_time
            );
            $model = new Sitefunction();
            $model->protect(false);
            $insert_id_check = $model->insert_data(TBL_COORDINATES, $data_to_insert);
            if ($insert_id_check) {
                echo json_encode(array('status' => true, 'message' => 'Coordinates added successfully'));
            } else {
                echo json_encode(array('status' => false, 'message' => 'Error occured'));
            }
        } else {
            echo json_encode(array('status' => false, 'message' => 'Coordinates already exists'));
        }
    }

    public function fetch_coordinate_details()
    {
        $requestData = $this->request->getJson();
        $id = $requestData->id;
        $model = new Sitefunction();
        $coordinate_result = $model->get_single_row(TBL_COORDINATES, '*', array('id' => $id));
        echo json_encode($coordinate_result);
    }

    public function update_coordinate()
    {
        $requestData = $this->request->getJson();
        $latitude = $requestData->latitude;
        $longitude = $requestData->longitude;
        $status = $requestData->status;
        $id = $requestData->id;
        $model = new Sitefunction();
        $where = array(
            'latitude' => $latitude,
            'longitude' => $longitude,
            'id != ' => $id
        );
        $check_if_coordinate_exists = $model->get_all_rows(TBL_COORDINATES, '*', $where);
        if (sizeof($check_if_coordinate_exists) == 0) {
            $data_to_update = array(
                'latitude' => $latitude,
                'longitude' => $longitude,
                'status' => $status,
                'updated' => $this->utc_time
            );
            $model = new Sitefunction();
            $model->protect(false);
            $update_id_check = $model->update_data(TBL_COORDINATES, $data_to_update, array('id' => $id));
            if ($update_id_check) {
                echo json_encode(array('status' => true, 'message' => 'Coordinates updated successfully'));
            } else {
                echo json_encode(array('status' => false, 'message' => 'Error occured'));
            }
        } else {
            echo json_encode(array('status' => false, 'message' => 'Coordinates already exists'));
        }
    }

    public function calculate_distance()
    {
        echo view('index/calculate_distance');
    }
}
