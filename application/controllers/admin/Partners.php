<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Partners extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("Partners_model");
    }

    public function add_partner()
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

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        if (empty($req->pass)) {
            $response['message'] = 'Partner password is required';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        if (empty($req->type)) {
            $response['message'] = 'Partner type is required';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        if (empty($req->first_name)) {
            $response['message'] = 'Partner first name is required';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        if (empty($req->last_name)) {
            $response['message'] = 'Partner last name is required';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        if (empty($req->email)) {
            $response['message'] = 'Partner email is required';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        $password = $this->encrypt_pass($req->pass);

        $insert_data = [
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'password' => $password,
            'type' => $req->type,
        ];

        $result = $this->Partners_model->insert_partners($insert_data);

        if (!$result) {
            $response['message'] = 'Data not saved please try again.';
            $response['status'] = '0';
        }

        echo json_encode($response);
    }

    public function get_partners()
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

        $result = $this->Partners_model->get_partners();

        if (empty($result)) {
            $response['message'] = 'Empty Data';
            $response['status'] = '0';
        }

        $response['result'] = $result;
        echo json_encode($response);

    }

    function get_one_partner(){


        $data = $this->input->get();
        $result = $this->Partners_model->get_one_partner($data);

        if (empty($result)) {
            $response['message'] = 'Empty Data';
            $response['status'] = '0';
        }

        $response['result'] = $result;
        echo json_encode($response);
    }

    public function partner_login()
    {

        $response = [
            'status' => '0',
            'message' => [],
            'result' => []
        ];

        if ($this->input->method() != 'post') {

            $response['message'] = 'error!';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }


        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        if (empty($req->email)) {
            $response['message'] = 'Please set email';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        if (empty($req->pass)) {
            $response['message'] = 'Please set password';
            $response['status'] = '0';
            echo json_encode($response);
            return false;
        }

        $check_data = [
            'email' => $req->email,
            'password' => $password = $this->encrypt_pass($req->pass),
        ];

        $response['result'] = $this->_check_login($check_data);

        if (!empty($response['result'])) {
            $response['status'] = 1;
        }

        echo json_encode($response);
    }

    public function _check_login($check_data)
    {

        $partner_info = $this->Partners_model->get_partners($check_data, true);

        if (empty($partner_info)) {
            return false;
        }

        $data = [
            'id' => $partner_info['id'],
            'email' => $partner_info['email'],
            'name' => $partner_info['first_name'] . $partner_info['last_name'],
            'type' => $partner_info['type']
        ];

        $this->session->set_userdata($data);

        $return_data = [
            'status' => 1,
            'admin_inf' => $data
        ];

        return $return_data;

    }

    private function encrypt_pass($pass)
    {

        if (empty($pass)) {
            return false;
        }

        $salt = $this->config->item('salt');

        $pass = sha1($pass . $salt);

        return $pass;
    }

    public function login()
    {
        $response = [
            'status' => '0',
            'message' => [],
            'result' => []
        ];

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        if (!$req || !$req->loginned) {
            echo json_encode($response);
            return false;
        }

        if ($req->loginned) {
            $response['message'] = 'login has been successfully';
            $response['status'] = '1';
            $response['result'] = [
                'name' => 'asd',
                'email' => 'a@a.ru',
            ];
        }
        echo json_encode($response);
        return false;
    }

    public function registration()
    {
        $response = [
            'status' => '0',
            'message' => [],
            'result' => []
        ];

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        if (!$req->loginned) {
            echo json_encode($response);
            return false;
        }

        if ($req->loginned) {
            $response['message'] = 'User registration has been successfully';
            $response['status'] = '1';
            echo json_encode($response);
        }
        echo json_encode($response);
        return false;
    }

    public function home()
    {
        $response = [
            'status' => '1',
            'message' => [],
            'result' => [],
            'count'  =>  5,
        ];

        $response['result'] = [
            0 => [
                'id'   => 1,
                'title' => 'title1',
                'metatitle' => 'metatitle1',
                'img' => 'img1.jpg',
                'like' => 0,
                'view' => 15,
                'love' => 10,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfioghk',
                'creted_date' => '21.06.18'
            ],
            1 => [
                'id'    => 2,
                'title' => 'title2',
                'metatitle' => 'metatitle2',
                'img' => 'img2.jpg',
                'like' => 41,
                'view' => 4,
                'love' => 85,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            2 => [
                'id'    => 3,
                'title' => 'title3',
                'metatitle' => 'metatitle3',
                'img' => 'img3.jpg',
                'like' => 11,
                'view' => 4,
                'love' => 25,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            3 => [
                'id'    => 4,
                'title' => 'title4',
                'metatitle' => 'metatitle4',
                'img' => 'img4.jpg',
                'like' => 10,
                'view' => 4,
                'love' => 32,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            4 => [
                'id'   => 5,
                'title' => 'title5',
                'metatitle' => 'metatitle4',
                'img' => 'img5.jpg',
                'like' => 14,
                'view' => 36,
                'love' => 102,
                'desc' => 'Lorem ispom sdfsdf dfgg dgf',
                'creted_date' => '21.06.18'
            ],
        ];

        echo json_encode($response);
    }

    public function single($id= Null)
    {

        if(empty($id)){
            $response = [
                'status' => '0',
                'message' => ["please check post"],
                'result' => [],
                'count'  =>  0,
            ];
            echo json_encode($response);
            return false;
        }

        $response = [
            'status' => '1',
            'message' => [],
            'result' => [],
            'post_count'  =>  20,
            'comment_count'  =>  20,
        ];

        $arr = [
            0 => [
                'id'   => 1,
                'title' => 'title1',
                'metatitle' => 'metatitle1',
                'img' => 'img1.jpg',
                'like' => 0,
                'view' => 15,
                'love' => 10,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfioghk',
                'creted_date' => '21.06.18'
            ],
            1 => [
                'id'    => 2,
                'title' => 'title2',
                'metatitle' => 'metatitle2',
                'img' => 'img2.jpg',
                'like' => 41,
                'view' => 4,
                'love' => 85,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            2 => [
                'id'    => 3,
                'title' => 'title3',
                'metatitle' => 'metatitle3',
                'img' => 'img3.jpg',
                'like' => 11,
                'view' => 4,
                'love' => 25,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            3 => [
                'id'    => 4,
                'title' => 'title4',
                'metatitle' => 'metatitle4',
                'img' => 'img4.jpg',
                'like' => 10,
                'view' => 4,
                'love' => 32,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            4 => [
                'id'   => 5,
                'title' => 'title5',
                'metatitle' => 'metatitle4',
                'img' => 'img5.jpg',
                'like' => 14,
                'view' => 36,
                'love' => 102,
                'desc' => 'Lorem ispom sdfsdf dfgg dgf',
                'creted_date' => '21.06.18'
            ],
        ];

        $response['result']['related'] = [
            0 => [
                'id'   => 1,
                'title' => 'title1',
                'metatitle' => 'metatitle1',
                'img' => 'img1.jpg',
                'like' => 0,
                'view' => 15,
                'love' => 10,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfioghk',
                'creted_date' => '21.06.18'
            ],
            1 => [
                'id'    => 2,
                'title' => 'title2',
                'metatitle' => 'metatitle2',
                'img' => 'img2.jpg',
                'like' => 41,
                'view' => 4,
                'love' => 85,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            2 => [
                'id'    => 3,
                'title' => 'title3',
                'metatitle' => 'metatitle3',
                'img' => 'img3.jpg',
                'like' => 11,
                'view' => 4,
                'love' => 25,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
        ];

        $response['result']['post'] = $arr[$id+1];
        $response['result']['comment'] = [
            0 => [
                'id'   => 1,
                'name' => 'Jane Doe',
                'img' => 'avatar.jpg',
                'comment' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece',
                'creted_date' => '16.04.14'
            ],
            1 => [
                'id'   => 2,
                'name' => 'Jane Doe2',
                'img' => 'avatar2.jpg',
                'comment' => 'Contrary to sds belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
                'creted_date' => '16.04.20'
            ],
            2 => [
                'id'   => 3,
                'name' => 'Jane Doe2',
                'img' => 'avatar2.jpg',
                'comment' => 'Contrary to sdsds belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
                'creted_date' => '16.09.14'
            ],
            3 => [
                'id'   => 4,
                'name' => 'Jane Doe2',
                'img' => 'avatar2.jpg',
                'comment' => 'Contrary to fdgdf belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
                'creted_date' => '20.04.14'
            ],
        ];

        echo json_encode($response);
    }

    public function lastet()
    {


        $response = [
            'status' => '1',
            'message' => [],
            'result' => [],
            'post_count'  =>  20,
            'comment_count'  =>  20,
        ];

        $response['result'] = [
            0 => [
                'id'   => 1,
                'title' => 'title1',
                'metatitle' => 'metatitle1',
                'img' => 'img1.jpg',
                'like' => 0,
                'view' => 15,
                'love' => 10,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfioghk',
                'creted_date' => '21.06.18'
            ],
            1 => [
                'id'    => 2,
                'title' => 'title2',
                'metatitle' => 'metatitle2',
                'img' => 'img2.jpg',
                'like' => 41,
                'view' => 4,
                'love' => 85,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            2 => [
                'id'    => 3,
                'title' => 'title3',
                'metatitle' => 'metatitle3',
                'img' => 'img3.jpg',
                'like' => 11,
                'view' => 4,
                'love' => 25,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            3 => [
                'id'    => 4,
                'title' => 'title4',
                'metatitle' => 'metatitle4',
                'img' => 'img4.jpg',
                'like' => 10,
                'view' => 4,
                'love' => 32,
                'desc' => 'sadssssssssssssssssssssssssdgt rehng frg9ojkgo dfiogh dfsdf fdgdf dfggk',
                'creted_date' => '21.06.18'
            ],
            4 => [
                'id'   => 5,
                'title' => 'title5',
                'metatitle' => 'metatitle4',
                'img' => 'img5.jpg',
                'like' => 14,
                'view' => 36,
                'love' => 102,
                'desc' => 'Lorem ispom sdfsdf dfgg dgf',
                'creted_date' => '21.06.18'
            ],
        ];

        echo json_encode($response);
    }

    public function add_comment(){

        $response = [
            'status' => '0',
            'message' => [],
            'result' => ''
        ];

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        if (!$req->comment) {
            $response['response'] = 'Message cann`t be empty';
            echo json_encode($response);
            return false;
        }

        $response['result'] = [
            'comment' => $req->comment,
            'name' => $req->name,
            'email' => $req->email,
        ];
        echo json_encode($response);
    }

    public function comment()
    {

        $response = [
            'status' => '1',
            'message' => [],
            'result' => [],
        ];

        $response['result'] = [
            0 => [
                'id'   => 5,
                'name' => 'Jane Doe5',
                'img' => 'avatar.jpg',
                'comment' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece',
                'creted_date' => '16.04.14'
            ],
            1 => [
                'id'   => 6,
                'name' => 'Jane Doe6',
                'img' => 'avatar2.jpg',
                'comment' => 'Contrary to sds belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
                'creted_date' => '16.04.20'
            ],
            2 => [
                'id'   => 7,
                'name' => 'Jane Doe7',
                'img' => 'avatar2.jpg',
                'comment' => 'Contrary to sdsds belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
                'creted_date' => '16.09.14'
            ],
            3 => [
                'id'   => 8,
                'name' => 'Jane Doe8',
                'img' => 'avatar2.jpg',
                'comment' => 'Contrary to fdgdf belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
                'creted_date' => '20.04.14'
            ],
        ];

        echo json_encode($response);
    }

    function update_partner_info(){
        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);
        $password = $this->encrypt_pass($req->pass);
        $req->password = $password;
        unset($req->pass);

        $result = $this->Partners_model->update_partner_info($req);

        echo json_encode($result);
    }

    function remove_partner_info(){
        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        $result = $this->Partners_model->remove_partner_info($req);
        if (!$result) {
            $response['message'] = 'Data not removed please try again.';
            $response['status'] = '0';
        } else {
            $result = $this->Partners_model->get_partners();
        }
        echo json_encode($result);
    }
}
