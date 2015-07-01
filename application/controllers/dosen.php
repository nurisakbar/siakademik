<?php

class dosen extends CI_Controller{
    
    var $folder =   "dosen";
    var $tables =   "app_dosen";
    var $pk     =   "dosen_id";
    var $title  =   "Data Dosen";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        if($this->session->userdata('level')==2)
        {
            $sess=$this->session->userdata('keterangan');
            $param="and ap.prodi_id='$sess'";
        }
        else
        {
            $param="";
        }
        $sql    =   "SELECT ad.hp,ad.email,ad.dosen_id,ad.nama_lengkap,ad.nip,ap.nama_prodi
                    FROM app_dosen as ad,akademik_prodi as ap
                    WHERE ad.prodi_id=ap.prodi_id and dosen_id not in('0') $param";
        $data['title']=  $this->title;
        $data['desc']="";
        $data['record']=  $this->db->query($sql)->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    
    
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama           =   $this->input->post('nama');
            $nidn           =   $this->input->post('nidn');
            $nip            =   $this->input->post('nip');
            $tempat_lahir   =   $this->input->post('tempat_lahir');
            $tanggal_lahir  =   $this->input->post('tanggal_lahir');
            $gender         =   $this->input->post('gender');
            $agama          =   $this->input->post('agama');
            $kawin          =   $this->input->post('kawin');
            $alamat         =   $this->input->post('alamat');
            $hp             =   $this->input->post('hp');
            $email          =   $this->input->post('email');
            $data           =   array(  'nama_lengkap'=>$nama,
                                        'nidn'=>$nidn,
                                        'nip'=>$nip,
                                        'tempat_lahir'=>$tempat_lahir,
                                        'tanggal_lahir'=>$tanggal_lahir,
                                        'gender'=>$gender,
                                        'agama_id'=>$agama,
                                        'status_kawin'=>$kawin,
                                        'alamat'=>$alamat,'hp'=>$hp,
                                        'email'=>$email);
            $username       =   $this->input->post('username');
            $password       =   $this->input->post('password');
            $this->db->insert($this->tables,$data);
            $id             = getField('app_dosen', 'dosen_id', 'nama_lengkap', $nama);
            $account        = array('username'=>$username,'password'=>  md5($password),'keterangan'=>$id,'level'=>3);
            $this->db->insert('app_users',$account);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
            $data['desc']="Input Dosen";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $id     = $this->input->post('id');
            $nama           =   $this->input->post('nama');
            $nidn           =   $this->input->post('nidn');
            $nip            =   $this->input->post('nip');
            $tempat_lahir   =   $this->input->post('tempat_lahir');
            $tanggal_lahir  =   $this->input->post('tanggal_lahir');
            $gender         =   $this->input->post('gender');
            $agama          =   $this->input->post('agama');
            $kawin          =   $this->input->post('kawin');
            $alamat         =   $this->input->post('alamat');
            $hp             =   $this->input->post('hp');
            $email          =   $this->input->post('email');
            $data           =   array(  'nama_lengkap'=>$nama,
                                        'nidn'=>$nidn,
                                        'nip'=>$nip,
                                        'tempat_lahir'=>$tempat_lahir,
                                        'tanggal_lahir'=>$tanggal_lahir,
                                        'gender'=>$gender,
                                        'agama_id'=>$agama,
                                        'status_kawin'=>$kawin,
                                        'alamat'=>$alamat,'hp'=>$hp,
                                        'email'=>$email);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
            $data['desc']="Edit Dosen";
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