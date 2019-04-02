<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Ferry extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->load->model("Ferry_model");
        $this->load->helper('show_error_json');
        $this->load->helper('validation_errors_array');

    }

    public function insert_ferry()
    {

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        $res = $this->validateFerry($req);

        if ($res['status'] == '0') {
            show_error_json($res['message']);
        } else {


            $insert_data = [
                'name' => $req->name,
                'email' => $req->email,
                'max_people' => $req->max_people,
                'min_people' => $req->min_people,
                'phone' => $req->phone,
                'address' => $req->address,
                'type' => $req->type,
                'partner_id' => $req->partner_id,
                'lat' => $req->lat,
                'lng' => $req->lng,
            ];


            $result = $this->Ferry_model->insert_ferry($insert_data);

            if (!$result) {
                $res['message'] = 'Data not saved please try again.';
                $res['status'] = '0';
                show_error_json($res['message']);
            } else echo json_encode($res);
        }


    }

    function validateFerry($req, $update = false)
    {

        $response = [
            'status' => '1',
            'message' => []
        ];

        if ($this->input->method() != 'post') {

            $response['message'] = 'error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }


        if (empty($req->partner_id)) {
            $response['message'] = 'Ferry partner is required';
            $response['status'] = '0';
        }

        if (empty($req->type) && !$update) {
            $response['message'] = 'Type is required';
            $response['status'] = '0';
        }
        if (empty($req->address)) {
            $response['message'] = 'Ferry address is required';
            $response['status'] = '0';
        }

        if (empty($req->phone)) {
            $response['message'] = 'Ferry phone is required';
            $response['status'] = '0';
        }

        if (empty($req->lng)) {
            $response['message'] = 'Longitude is required';
            $response['status'] = '0';
        }
        if (empty($req->lat)) {
            $response['message'] = 'Latitude is required';
            $response['status'] = '0';
        }
        if ($req->min_people > $req->max_people) {
            $response['message'] = 'Min People is greater than Max people';
            $response['status'] = '0';
        }
        if (empty($req->max_people)) {
            $response['message'] = 'Max People is required';
            $response['status'] = '0';
        }
        if (empty($req->min_people)) {
            $response['message'] = 'Min People is required';
            $response['status'] = '0';
        }
        if (empty($req->email)) {
            $response['message'] = 'Ferry Email  is required';
            $response['status'] = '0';
        }
        if (empty($req->name)) {
            $response['message'] = 'Ferry name is required';
            $response['status'] = '0';
        }

        if ($this->Ferry_model->mail_exists($req->email)) {
            $response['message'] = 'Ferry email exists';
            $response['status'] = '0';
        }

        return $response;
    }

    public function get_all_ferry()
    {

        $response = [
            'status' => '1',
            'message' => []
        ];

        $req_method = $this->input->method();

        if ($req_method != 'get' && $req_method != 'delete') {

            $response['message'] = 'error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        $result = $this->Ferry_model->get_ferry();

        if (empty($result)) {
            $response['message'] = 'Empty Data';
            $response['status'] = '0';
        }

        $response['result'] = $result;
        echo json_encode($response);
    }

    function get_one_ferry()
    {
        $data = $this->input->get();
        $result = $this->Ferry_model->get_one_ferry($data);
        echo json_encode($result);
    }


    function update_ferry()
    {
        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        $res = $this->validateFerry($req, true);

        if ($res['status'] == '0') {
            show_error_json($res['message']);
        } else {

            $result = $this->Ferry_model->update_ferry($req);

            echo json_encode($result);
        }
    }


    function remove_ferry()
    {
        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        $result = $this->Ferry_model->remove_ferry($req);
        if (!$result) {
            $response['message'] = 'Data not removed please try again.';
            $response['status'] = '0';
        } else {
            $result = $this->Ferry_model->get_ferry();
        }
        echo json_encode($result);
    }
}