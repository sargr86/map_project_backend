<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tours extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("Tours_model");
        $this->load->helper('show_error_json');
        $this->load->helper('validation_errors_array');
    }

    public function add_tours()
    {

        $req = $this->input->post();
        $res = $this->validateTour($req);

        if ($res['status'] == '0') {
            show_error_json($res['message']);
        } else {

            $url = '../uploads/tour';

            if (!is_dir($url)) {
                mkdir($url, 0775, TRUE);
            }

            $config['upload_path'] = $url;
            $config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png|png';
            $config['max_size'] = 4096;
            $config['file_name'] = random_string('numeric', 10);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('upload_image') == false) {

                $res['message'] = $this->upload->display_errors();
                $res['status'] = '0';
                show_error_json($res['message']);
            } else {
                $file_info = $this->upload->data();


                $request_body = $this->input->post();
                $request_body['img'] = $file_info['file_name'];

                $result = $this->Tours_model->insert_tours($request_body);

                if (!$result) {
                    $res['message'] = 'Data not saved please try again.';
                    $res['status'] = '0';
                }

                echo json_encode($res);

                return false;
            }


        }

        return false;
    }

    function update_tour()
    {
        $req = $this->input->post();

        $this->load->library('form_validation');

        $res = $this->validateTour($req, true);


        if ($res['status'] == '0') {
            show_error_json($res['message']);
        } else {

            $result = $this->Tours_model->update_tour($req);

            echo json_encode($result);
        }


    }

    function validateTour($req, $update = false)
    {

        $response = [
            'status' => '1',
            'message' => [],
            'result' => []
        ];

        if ($this->input->method() != 'post') {

            $response['message'] = 'error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        if (empty($req['partner_id'])) {
            $response['message'] = 'Partner is required';
            $response['status'] = '0';
        }

        if (empty($req['tours_type_id'])) {
            $response['message'] = 'Tour type is required';
            $response['status'] = '0';
        }

        if (empty($req['address'])) {
            $response['message'] = 'Tour address is required';
            $response['status'] = '0';
        }

        if (empty($req['lng'])) {
            $response['message'] = 'Tour longitude is required';
            $response['status'] = '0';
        } else {
            if (!preg_match(LONGITUDE_PATTERN, $req['lng'])) {
                $response['message'] = 'Tour longitude is invalid';
                $response['status'] = 0;
            }
        }


        if (empty($req['lat'])) {
            $response['message'] = 'Tour latitude is required';
            $response['status'] = '0';
        } else {
            if (!preg_match(LATITUDE_PATTERN, $req['lat'])) {
                $response['message'] = 'Tour latitude is invalid';
                $response['status'] = 0;
            }
        }


        if (empty($req['name'])) {
            $response['message'] = 'Tour name is required';
            $response['status'] = '0';
        }


        return $response;
    }

    public function add_tour_type()
    {

        $response = [
            'status' => '1',
            'message' => [],
            'result' => []
        ];

        if ($this->input->method() != 'post') {

            $response['message'] = 'error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }
//
//        $mixinf = $this->session->userdata('id') . $this->session->userdata('name') . $this->input->ip_address();
//        $admin_mixinf = $this->encrypt_admin_pass($mixinf);

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

//        if (empty($req->mixinf != $admin_mixinf)) {
//            $response['message'] = 'Error!';
//            $response['status'] = '0';
//            echo json_encode($response);
//            return false;
//        }

        if (empty($req->tour_name)) {
            $response['message'] = 'Tour type name is required';
            $response['status'] = '0';

            show_error_json($response['message']);
        }

        $insert_data = [
            'tour_name' => $req->tour_name
        ];

        $result = $this->Tours_model->insert_tours_type($insert_data);

        if (!$result) {
            $response['message'] = 'Data not saved please try again.';
            $response['status'] = '0';
        }

        echo json_encode($response);

    }

    public function get_tour_type()
    {


        $response = [
            'status' => '1',
            'message' => []
        ];

        if ($this->input->method() != 'get') {

            $response['message'] = 'error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        $result = $this->Tours_model->get_tours_type();

        if (empty($result)) {
            $response['message'] = 'Empty Data';
            $response['status'] = '0';
        }

        $response['result'] = $result;
        echo json_encode($response);
    }

    public function get_tour()
    {
        $response = [
            'status' => '1',
            'message' => []
        ];

        if ($this->input->method() != 'get') {

            $response['message'] = 'error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        $result = $this->Tours_model->get_tours_and_type();

        if (empty($result)) {
            $response['message'] = 'Empty Data';
            $response['status'] = '0';
        }

        $response['result'] = $result;
        echo json_encode($response);
    }

    private function encrypt_admin_pass($pass)
    {

        if (empty($pass)) {
            return false;
        }

        $salt = $this->config->item('salt');

        $pass = sha1($pass . $salt);

        return $pass;
    }

    function get_one_tour()
    {
        $data = $this->input->get();
        $result = $this->Tours_model->get_one_tour($data);
        echo json_encode($result);
    }

    function get_one_tour_type()
    {
        $data = $this->input->get();
        $result = $this->Tours_model->get_one_tour_type($data);
        echo json_encode($result);
    }

    public function remove_tour()
    {
        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        $result = $this->Tours_model->remove_tour($req);
        if (!$result) {
            $response['message'] = 'Data not removed please try again.';
            $response['status'] = '0';
        } else {
            $result = $this->Tours_model->get_tours_and_type();
        }
        echo json_encode($result);
    }

    function update_tour_type()
    {
        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        $result = $this->Tours_model->update_tour_type($req);

        echo json_encode($result);
    }

    function remove_tour_type(){
        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        $result = $this->Tours_model->remove_tour_type($req);
        if (!$result) {
            $response['message'] = 'Data not removed please try again.';
            $response['status'] = '0';
        } else {
            $result = $this->Tours_model->get_tours_type();
        }
        echo json_encode($result);
    }
}