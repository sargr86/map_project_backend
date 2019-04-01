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


        $this->load->library('form_validation');

        if ($this->form_validation->run('add_tour') == FALSE) {

            $errors = validation_errors_array(validation_errors());
            if (!empty($errors) > 0) {
                show_error_json(reset($errors));
            }
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

                $response['message'] = $this->upload->display_errors();
                $response['status'] = '0';

            }

            $file_info = $this->upload->data();


            if ($response['status'] == '0') {
                show_error_json($response['message']);
            } else {


                $request_body = $this->input->post();
                $request_body['img'] = $file_info['file_name'];

                $result = $this->Tours_model->insert_tours($request_body);

                if (!$result) {
                    $response['message'] = 'Data not saved please try again.';
                    $response['status'] = '0';
                }

                echo json_encode($response);
            }

            return false;
        }

        return false;
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

        $mixinf = $this->session->userdata('id') . $this->session->userdata('name') . $this->input->ip_address();
        $admin_mixinf = $this->encrypt_admin_pass($mixinf);

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        if (empty($req->mixinf != $admin_mixinf)) {
            $response['message'] = 'Error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        if (empty($req->name)) {
            $response['message'] = 'Tour type name is required';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        $insert_data = [
            'tour_name' => $req->name
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

    function update_tour()
    {
        $req = $this->input->post();

        $result = $this->Tours_model->update_tour($req);

        echo json_encode($result);
    }

    function show_error($message, $status_code = 500)
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        header("HTTP/1.1 500 Internal Server Error");

        echo json_encode(
            array(
                'status' => FALSE,
                'error' => 'Internal Server Error',
                'message' => $message
            )
        );

        exit;
    }
}