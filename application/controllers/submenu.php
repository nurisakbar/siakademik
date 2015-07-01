<?php
class submenu extends CI_Controller{
    
    var $folder =   "submenu";
    var $tables =   "submenu";
    var $pk     =   "id_submenu";
    
    function __construct() {
        parent::__construct();
        
    }
    
    function index()
    {
        $sql=   "SELECT s.*,m.nama_mainmenu
                FROM submenu as s,mainmenu as m 
                WHERE s.id_mainmenu=m.id_mainmenu";
        $data['record']  =  $this->db->query($sql)->result();
        $data['title']   =  "Data Submenu";
        $data['desc']    =  "Full DataTables Integration";
        $this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $link   =   $this->input->post('link');
            $main   =   $this->input->post('mainmenu');
            $icon   =   $this->input->post('icon');
            $data   =   array('nama_submenu'=>$nama,'icon'=>$icon,'link'=>$link,'id_mainmenu'=>$main,'aktif'=>'y');
            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']   =  "Data Submenu";
            $data['desc']    =  "Full DataTables Integration";
            $this->template->load('template', $this->folder.'/post',$data);
            
        }
    }
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $link   =   $this->input->post('link');
            $main   =   $this->input->post('mainmenu');
            $icon   =   $this->input->post('icon');
            $id     = $this->input->post('id');
            $data   =   array('nama_submenu'=>$nama,'icon'=>$icon,'link'=>$link,'id_mainmenu'=>$main);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $data['title']   =  "Data Submenu";
            $data['desc']    =  "Full DataTables Integration";
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    
    
    function delete()
    {
        $id     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
         if($chekid->num_rows()>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
    }
    
    function status()
    {
        $id     =  $this->uri->segment(4);
        $status =  $this->uri->segment(3);
        $this->mcrud->update($this->tables,array('aktif'=>$status), $this->pk,$id);
        redirect($this->uri->segment(1));
    }
}