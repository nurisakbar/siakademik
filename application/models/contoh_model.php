<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contoh_model
 *
 * @author nuris akbar
 */
class contoh_model extends ci_model{
    //put your code here
    
    
    function select_all()
    {
        return $this->db->get('mainmenu');
    }
    
    function delete($id)
    {
        $this->db->where('id_mainmenu',$id);
        $this->db->delete('mainmenu');
    }
    
    
    function update($id, $data)
    {
        $this->db->where('id_mainmenu',$id);
        $this->db->update('mainmenu',$data);
    }
    
    
    function tampil_satu($id)
    {
        return $this->db->get_where('mainmenu',array('id_mainmenu'=>$id));
    }
}

?>
