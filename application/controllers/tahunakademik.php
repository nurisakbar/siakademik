<?php
class tahunakademik extends CI_Controller
{
    var $folder =   "tahunakademik";
    var $tables =   "akademik_tahun_akademik";
    var $pk     =   "tahun_akademik_id";
    var $title   =   "Tahun Akademik";
    
    function __construct() {
        parent::__construct();
    }
    
    
    function index()
    {
        $data['title']=  $this->title;
        $data['desc']="";
        $data['record']=  $this->db->get($this->tables)->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    
    function post()
    {
        if(isset($_POST['submit']))
        {
            $tahun  =   $this->input->post('tahun');
            $batas  =   $this->input->post('batas');
            $data   =   array('keterangan'=>$tahun,'status'=>'n','batas_registrasi'=>$batas);
            $this->db->insert($this->tables,$data);
            // ambil id tahun akademik
            $angkatan_id=  getField('student_angkatan', 'angkatan_id', 'aktif', 'y');
            // foreach konsentrasi
            $konsentrasi=  $this->db->get('akademik_konsentrasi')->result();
            foreach ($konsentrasi as $k)
            {
                // foreach jenis biaya  kuliah
                $jenis_biaya=  $this->db->get('keuangan_jenis_bayar')->result();
                foreach ($jenis_biaya as $j)
                {
                    // insert data ke tabel keuangan_biaya_kuliah
                    $data=array(    'angkatan_id'=>$angkatan_id,
                                    'jenis_bayar_id'=>$j->jenis_bayar_id,
                                    'konsentrasi_id'=>$k->konsentrasi_id,
                                    'jumlah'=>0);
                                $this->db->insert('keuangan_biaya_kuliah',$data);
                }
            }
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
            $tahun  =   $this->input->post('tahun');
            $status = $this->input->post('status');
            $batas  =   $this->input->post('batas');
            $id     = $this->input->post('id');
            $data   =   array('keterangan'=>$tahun,'status'=>$status,'batas_registrasi'=>$batas);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
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
    
    
    function status()
    {
        $id     =  $this->uri->segment(4);
        $status =  $this->uri->segment(3);
        if($status=='y')
        {
           $this->db->query("update akademik_tahun_akademik set status='n'"); 
        }
        $this->mcrud->update($this->tables,array('status'=>$status), $this->pk,$id);
        redirect($this->uri->segment(1));
    }
}