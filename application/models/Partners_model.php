<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partners_model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

    }

    public function insert_partners($data)
    {

        if (empty($data)) {
            return false;
        }

        return $this->db->insert('partner', $data);
    }


    public function get_partners($cr = NULL, $bool = NULL)
    {

        if (!empty($cr)) {

            $this->db->where($cr);
        }

        if (!$bool) {
            $result = $this->db->get('partner')->result_array();
        } else {

            $result = $this->db->get('partner')->row_array();
        }

        return $result;
    }

    function get_one_partner($data)
    {
        if (empty($data)) {
            return false;
        }

        $this->db->where('id', $data['id']);
        $this->db->select('email,first_name,last_name,type,id');
        $this->db->from('partner');
        $result = $this->db->get()->result_array();
        return $result;
    }

    function remove_partner_info($data)
    {
        if (empty($data)) {
            return false;
        }
        $this->db->where('id', $data->id);
        return $this->db->delete('partner');
    }

    function update_partner_info($data)
    {
        if (empty($data)) {
            return false;
        }

        $id = $data->id;
        unset($data->id);

        $this->db->set($data);
        $this->db->where('id', $id);

        return $this->db->update('partner');
    }

    function mail_exists($email){
        $this->db->where('email',$email);
        $query = $this->db->get('partner');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}