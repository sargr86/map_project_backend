<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class GPS_Location_Drawing extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("GPS_Location_Drawing_model");
    }

    public function add_drawing()
    {
        $response = [
            'status'  => '1',
            'message' => [],
            'result'  => []
        ];

        $request_body = file_get_contents('php://input');

        $req = json_decode($request_body);

        for ($i = 0; $i < count($req->drawingLatLng); $i++) {
            $insert_data = [
                'ferry_id' => $req->ferry_id,
                'lat' => $req->drawingLatLng[$i]->lat,
                'lng' => $req->drawingLatLng[$i]->lng
            ];

            $response = $this->GPS_Location_Drawing_model->add_drawing($insert_data);
        }


        $this->load->model("GPS_Location_Marker_model");
        for ($i = 0; $i < count($req->markerLatLng); $i++) {
            $insert_data = [
                'ferry_id' => $req->ferry_id,
                'lat' => $req->markerLatLng[$i]->lat,
                'lng' => $req->markerLatLng[$i]->lng
            ];

            $response = $this->GPS_Location_Marker_model->add_drawing($insert_data);
        }

        if(!$response){
            $response['message'] = 'Data not saved please try again.';
            $response['status']  = '0';
        }

        echo json_encode($response);
    }
}