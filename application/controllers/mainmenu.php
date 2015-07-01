<?php
class mainmenu extends CI_Controller{
    
    var $folder =   "mainmenu";
    var $tables =   "mainmenu";
    var $pk     =   "id_mainmenu";
    var $title  =   "Main Menu";
    
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
        
	$record=  $this->mcrud->getList($this->tables,$config['per_page'],$page,'nama_mainmenu','ASC')->result();
        $option=array('data' => 'Option', 'colspan' => 3,'width'=>30);
        $nomber          =array('data'=>'No','width'=>15);
        $link            =array('data'=>'Link','width'=>365);
        $icon            =array('data'=>'Icon','width'=>65);
        $aktif           =array('data'=>'Aktif','width'=>65);
        $level           =array('data'=>'Level','width'=>85);
	$this->table->set_heading($nomber,'Nama Mainmenu',$level,$link,$icon,$aktif,$option);
	foreach ($record as $r) 
            {
                $pk=  $this->pk;
                $aktif          =$r->aktif=='y'?'Aktif':'Tidak';
                $iconaktif      =$edit=  array('data' => anchor($this->uri->segment(1).'/status/y/'.$r->$pk,'<span class="fa fa-eye"></span>'), 'width' => 10,'title'=>'Aktifkan');
                $iconnonaktif   =$edit=  array('data' => anchor($this->uri->segment(1).'/status/t/'.$r->$pk,'<span class="fa fa-eye-slash"></span>'), 'width' => 10,'title'=>'Non Aktifkan');
                $icon           =$r->aktif=='y'?$iconnonaktif:$iconaktif;
                $delete         =array('data' => anchor($this->uri->segment(1).'/delete/'.$r->$pk,'<span class="hi hi-trash"></span>',array('onclick'=>"return confirm('anda yakin akan menghapus data ini ?')")), 'width' => 10,'title'=>'Hapus data');
                $edit           =array('data' => anchor($this->uri->segment(1).'/edit/'.$r->$pk,'<span class="hi hi-share"></span>'), 'width' => 10,'title'=>'Edit Data');
                $this->table->add_row(
                        $no,
                        strtoupper($r->nama_mainmenu),
                        $this->level($r->level),
                        anchor($r->link,  base_url().''.$r->link),
                        "<span class='".$r->icon."'></span>",
                        $aktif,
                        $icon,
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
    
    
    function level($id)
    {
        if($id==1)
        {
            return "Admin";
        }
        elseif($id==2)
        {
            return "Jurusan";
        }
        elseif($id==3)
        {
            return 'Dosen';
        }
        else
        {
            return "Mahasiswa";
        }
            
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
            $nama   =   $this->input->post('nama');
            $link   =   $this->input->post('link');
            $icon   =   $this->input->post('icon');
            $level   =   $this->input->post('level');
            $data   =   array('nama_mainmenu'=>$nama,'icon'=>$icon,'link'=>$link,'aktif'=>'y','level'=>$level);
            $this->db->insert($this->tables,$data);
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
            $nama   =   $this->input->post('nama');
            $link   =   $this->input->post('link');
            $icon   =   $this->input->post('icon');
            $level   =   $this->input->post('level');
            $id     = $this->input->post('id');
            $data   =   array('nama_mainmenu'=>$nama,'icon'=>$icon,'link'=>$link,'level'=>$level);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $id          =  $this->uri->segment(3);
            $data['title']=  $this->title;
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
    
    function status()
    {
        $id     =  $this->uri->segment(4);
        $status =  $this->uri->segment(3);
        $this->mcrud->update($this->tables,array('aktif'=>$status), $this->pk,$id);
        redirect($this->uri->segment(1));
    }
}