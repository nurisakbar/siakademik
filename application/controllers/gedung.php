<?php
class gedung extends CI_Controller{
    
    var $folder =   "gedung";
    var $tables =   "app_gedung";
    var $pk     =   "gedung_id";
    var $title  =   "Daftar Gedung";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['pk']=  $this->pk;
        $data['record'] =  $this->db->get($this->tables)->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $data   =   array('nama_gedung'=>$nama);
            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $id     = $this->input->post('id');
            $nama   =   $this->input->post('nama');
            $data   =   array('nama_gedung'=>$nama);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    function delete()
    {
        $id     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
        if($chekid>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
    }
}