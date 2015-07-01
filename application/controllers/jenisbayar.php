<?php
class jenisbayar extends CI_Controller{
    
    var $folder =   "jenisbayar";
    var $tables =   "keuangan_jenis_bayar";
    var $pk     =   "jenis_bayar_id";
    var $title  =   "Jenis Pembayaran";
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $config['base_url'] = site_url($this->uri->segment(1).'/index/');
        $config['total_rows'] = $this->db->get($this->tables)->num_rows();
        $config['per_page'] =  jmlPaging();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        $no=1+$page;
        
	$record=  $this->mcrud->getList($this->tables,$config['per_page'],$page,'keterangan','ASC')->result();
        $option=array('data' => 'Option', 'colspan' => 3,'width'=>30);
        $nomber          =array('data'=>'No','width'=>15);
	$this->table->set_heading($nomber,'Jenis Pembayaran',$option);
	foreach ($record as $r) 
            {
                $pk=  $this->pk;
                $delete         =array('data' => anchor($this->uri->segment(1).'/delete/'.$r->$pk,'<i class="fa fa-trash-o"></i>',array('onclick'=>"return confirm('anda yakin akan menghapus data ini ?')")), 'width' => 10,'title'=>'Hapus data');
                $edit           =array('data' => anchor($this->uri->segment(1).'/edit/'.$r->$pk,'<i class="gi gi-new_window"></i>'), 'width' => 10,'title'=>'Edit Data');
                $this->table->add_row(
                        $no,
                        strtoupper($r->keterangan),
                        $delete,
                        $edit);
                $no++;
            }
	$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered responsive-utilities">' );
	$this->table->set_template($tmpl); 
	$data['table']=$this->table->generate();
        $data['title']=  $this->title;
	$this->template->load('template', $this->folder.'/view',$data);
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $jenis  =   $this->input->post('jenis');
            $this->db->insert($this->tables,array('keterangan'=>$jenis));
            $jns_byr=   $this->db->get_where('keuangan_jenis_bayar',array('keterangan'=>$jenis))->row_array();
            $thn_ajr= getField('student_angkatan', 'angkatan_id', 'aktif', 'y');
            // foreach konsentrasi
            $konsen =   $this->db->get('akademik_konsentrasi')->result();
            foreach ($konsen as $k)
            {
                $data   =   array(  'angkatan_id'=>$thn_ajr,
                                    'jumlah'=>0,
                                    'jenis_bayar_id'=>$jns_byr['jenis_bayar_id'],
                                    'konsentrasi_id'=>$k->konsentrasi_id);
                $this->db->insert('keuangan_biaya_kuliah',$data);
            }
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $jenis  = $this->input->post('jenis');
            $id     = $this->input->post('id');
            $data   = array('keterangan'=>$jenis);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
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