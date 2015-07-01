<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Combobox
 *
 * @author Noeriz
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generatehtml {
     
     

    public function vbuatcombo($nama,$table,$class,$field,$pk,$id,$kondisi)
    {
        $CI =& get_instance();
        $CI->load->model('mcrud');
        if($kondisi==null)
        {
          $data=$CI->mcrud->getAll($table)->result();  
        }
        else
        {
            $data=$CI->db->get_where($table,$kondisi)->result();
        }
        echo"<div class='$class'><select name='".$nama."' id='".$id."' class='form-control'>
            <option value=''></option>
           ";
        foreach ($data as $r)
        {
            echo" <option value=".$r->$pk.">".strtoupper($r->$field)."</option>";
        }
            echo"</select></div>";
    }
    
       public function veditcombo($nama,$table,$class,$field,$pk,$id,$kondisi,$value)
    {
        $CI =& get_instance();
        $CI->load->model('mcrud');
         if($kondisi==null)
        {
          $data=$CI->mcrud->getAll($table)->result();  
        }
        else
        {
            $data=$CI->db->get_where($table,$kondisi)->result();
        }
        echo"<div class='$class'><select class='form-control' name='".$nama."' id='".$id."'>
           <option value=''></option>";
        foreach ($data as $r)
        {
            echo"<option value='".$r->$pk."' ";
	    echo $r->$pk==$value?"selected='selected'":"";
	    echo">".strtoupper($r->$field)."</option>";
        }
            echo"</select></div>";
    }
    
    
    
    
    
        public function buatcombo2($nama,$table,$field,$pk,$id,$kondisi)
    {
        $CI =& get_instance();
        $CI->load->model('mcrud');
        if($kondisi==null)
        {
          $data=$CI->db->query("select distinct ".$field.",".$pk." from  ".$table." group by ".$field."")->result();  
        }
        else
        {
            $data=$CI->db->get_where($table,$kondisi)->result();
        }
        echo"<select name=".$nama." id='".$id."'>
           <option value=''></option>";
        foreach ($data as $r)
        {
            echo" <option value=".$r->$pk.">".strtoupper($r->$field)."</option>";
        }
            echo"</select>";
    }
    
    
    
    public function editcombo2($nama,$table,$field,$pk,$id,$kondisi,$value)
    {
        $CI =& get_instance();
        $CI->load->model('mcrud');
        if($kondisi==null)
        {
          $data=$CI->db->query("select distinct ".$field.",".$pk." from  ".$table." group by ".$field."")->result();  
        }
        else
        {
            $data=$CI->db->get_where($table,$kondisi)->result();
        }
        echo"<select name=".$nama." id='".$id."'>
           <option value=''></option>";
        foreach ($data as $r)
        {
            echo" <option value=".$r->$pk." ";
	    echo $r->$pk==$value?"selected='selected'":"";
	    echo">".strtoupper($r->$field)."</option>";
        }
            echo"</select>";
    }







// untuk gelar
    public function buatcombo3($nama,$table,$field,$pk,$id,$kondisi)
    {
        $CI =& get_instance();
        $CI->load->model('mcrud');
        if($kondisi==null)
        {
          $data=$CI->mcrud->getAll($table)->result();  
        }
        else
        {
            $data=$CI->db->get_where($table,$kondisi)->result();
        }
        echo"<select name=".$nama." id='".$id."' class='input-small'>
           <option value=''></option>";
        foreach ($data as $r)
        {
            echo" <option value=".$r->$pk.">".$r->$field."</option>";
        }
            echo"</select>";
    }
    
       public function editcombo3($nama,$table,$field,$pk,$id,$kondisi,$value)
    {
        $CI =& get_instance();
        $CI->load->model('mcrud');
         if($kondisi==null)
        {
             
          $data=$CI->db->get($table)->result();  
        }
        else
        {
            $query="select * from ".$table." order by gelar ASC";
            //$data=$CI->db->get_where($table,$kondisi)->result();
            $data=  $CI->db->query($query)->result();
        }
        echo"<select name=".$nama." id='".$id."' class='input-small'>
           <option value=''></option>";
        foreach ($data as $r)
        {
            echo"<option value='".$r->$pk."' ";
	    echo $r->$pk==$value?"selected='selected'":"";
	    echo">".$r->$field."</option>";
        }
            echo"</select>";
    }
}


/* End of file Someclass.php */

?>
