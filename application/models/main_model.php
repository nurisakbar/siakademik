<?php
class Main_model extends CI_Model
{          
    function get_state(){
        $this->db->order_by("state_id", "ASC");
        return $this->db->get("master_state");       
    }
     
    function get_city() {
        $this->db->order_by("city_id", "ASC");
        return $this->db->get("master_city");       
    }
     
    function get_country() {
        $this->db->order_by("country_id", "ASC");
        return $this->db->get("master_country");       
    }
     
    function get_city_by_state($id) {
        $this->db->order_by("city_name", "ASC");
        $this->db->where("city_state_id", $id);
        $query = $this->db->get("master_city");
        if ($query->num_rows() > 0) return $query->result();             
    }
     
    function get_state_by_country($id) {
        $this->db->order_by("state_name", "ASC");
        $this->db->where("state_country_id", $id);
        $query = $this->db->get("master_state");
        if ($query->num_rows() > 0) return $query->result();             
    }  
}
?>