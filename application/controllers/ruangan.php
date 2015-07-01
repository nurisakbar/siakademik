<?php
class ruangan extends CI_Controller{
    
    var $folder =   "ruangan";
    var $tables =   "app_ruangan";
    var $pk     =   "ruangan_id";
    var $title  =   "Daftar Ruangan";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $query="SELECT ar.keterangan,ar.nama_ruangan,ar.kapasitas,ag.nama_gedung,ar.ruangan_id
                FROM app_ruangan as ar,app_gedung as ag 
                WHERE ar.gedung_id=ag.gedung_id order by ar.nama_ruangan asc";
        $data['record']=  $this->db->query($query)->result();
        $data['title']  = $this->title;
        $data['desc']    =   "";
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $gedung =   $this->input->post('gedung');
            $ket    =   $this->input->post('keterangan');
            $kapas  =   $this->input->post('kapasitas');
            $data   =   array('nama_ruangan'=>$nama,'gedung_id'=>$gedung,'kapasitas'=>$kapas,'keterangan'=>$ket);
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
            $gedung =   $this->input->post('gedung');
            $kapas  =   $this->input->post('kapasitas');
            $ket    =   $this->input->post('keterangan');
            $data   =   array('nama_ruangan'=>$nama,'gedung_id'=>$gedung,'kapasitas'=>$kapas,'keterangan'=>$ket);
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