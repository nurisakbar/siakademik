<?php
class konsentrasi extends CI_Controller{
    
    var $folder =   "konsentrasi";
    var $tables =   "akademik_konsentrasi";
    var $pk     =   "konsentrasi_id";
    var $title  =   "Konsentrasi";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $query="SELECT ak.*,ap.nama_prodi
                FROM akademik_konsentrasi as ak,akademik_prodi as ap
                WHERE ak.prodi_id=ap.prodi_id";
        $data['record']=  $this->db->query($query)->result();
        $data['title']  = $this->title;
        $data['desc']    =   "";
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama       =   $this->input->post('nama');
            $ketua      =   $this->input->post('ketua');
            $prodi      =   $this->input->post('prodi');
            $kode       =   $this->input->post('kode');
            $gelar      =   $this->input->post('gelar');
            $jenjang    =   $this->input->post('jenjang');
            $semester   =   $this->input->post('semester');
            $data       =   array(  'nama_konsentrasi'=>$nama,
                                    'ketua'=>$ketua,
                                    'kode_nomor'=>$kode,
                                    'gelar'=>$gelar,
                                    'jenjang'=>$jenjang,
                                    'jml_semester'=>$semester,
                                    'prodi_id'=>$prodi);
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
            $nama       =   $this->input->post('nama');
            $ketua      =   $this->input->post('ketua');
            $prodi      =   $this->input->post('prodi');
            $kode       =   $this->input->post('kode');
            $gelar      =   $this->input->post('gelar');
            $jenjang    =   $this->input->post('jenjang');
            $semester   =   $this->input->post('semester');
            $data       =   array(  'nama_konsentrasi'=>$nama,
                                    'ketua'=>$ketua,
                                    'kode_nomor'=>$kode,
                                    'gelar'=>$gelar,
                                    'jenjang'=>$jenjang,
                                    'jml_semester'=>$semester,
                                    'prodi_id'=>$prodi);
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
        if($chekid->num_rows()>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
    }
}