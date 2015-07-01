<?php
class mahasiswa extends CI_Controller{
    
    var $folder =   "mahasiswa";
    var $tables =   "student_mahasiswa";
    var $pk     =   "mahasiswa_id";
    var $title  =   "Daftar Mahasiswa";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $tahun="SELECT ta.keterangan,ta.tahun_akademik_id
                FROM student_mahasiswa as sm,akademik_tahun_akademik as ta
                WHERE ta.tahun_akademik_id=sm.tahun_akademik_id
                group by ta.tahun_akademik_id";
        $data['title']=  $this->title;
        $data['desc']="";
        $data['tahun_angkatan']=  $this->db->get('akademik_tahun_akademik')->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    
    
    function post()
    {
        if(isset($_POST['submit']))
        {
            // pribadi
            $nama               =   $this->input->post('nama');
            $nim                =   $this->input->post('nim');
            $alamat             =   $this->input->post('alamat');
            $konsentrasi        =   $this->input->post('konsentrasi');
            $tahun              =   $this->input->post('tahun_angkatan');
            $tempat_lahir       =   $this->input->post('tempat_lahir');
            $tgl_lahir          =   $this->input->post('tanggal_lahir');
            $agama              =   $this->input->post('agama');
            $gender             =   $this->input->post('gender');
            $angkatan   =   $this->input->post('tahun_angkatan');
            // orang tua
            $nama_ayah          =   $this->input->post('nama_ayah');
            $nama_ibu           =   $this->input->post('nama_ibu');
            $pekerjaan_ayah     =   $this->input->post('pekerjan_ayah');
            $pekerjaan_ibu      =   $this->input->post('pekerjaan_ibu');
            $alamat_ayah        =   $this->input->post('alamat_ayah');
            $alamat_ibu         =   $this->input->post('alamat_ibu');
            $penghsln_ayah      =   $this->input->post('penghasilan_ayah');
            $penghsln_ibu       =   $this->input->post('penghasilan_ibu');
            $no_hp_ortu         =   $this->input->post('no_hp_ortu');
            
            // sekolah
            $sekolah_nama       =   $this->input->post('sekolah_nama');
            $sekolah_telpon     =   $this->input->post('sekolah_telpon');
            $sekolah_alamat     =   $this->input->post('sekolah_alamat');
            $sekolah_jurus      =   $this->input->post('sekolah_jurusan');
            $sekolah_tahun      =   $this->input->post('sekolah_tahun');
            // kampus
            $kampus_nama        =   $this->input->post('kampus_nama');
            $kampus_telpon      =   $this->input->post('kampus_telpon');
            $kampus_alamat      =   $this->input->post('kampus_alamat');
            $kampus_jurus       =   $this->input->post('kampus_jurusan');
            $kampus_tahun       =   $this->input->post('kampus_tahun');
            // instansi
            $instansi_nama      =   $this->input->post('instansi_nama');
            $instansi_telpon    =   $this->input->post('instansi_telpon');
            $instansi_alamat    =   $this->input->post('instansi_alamat');
            $instansi_mulai     =   $this->input->post('instansi_mulai');
            $instansi_sampai    =   $this->input->post('instansi_sampai');
            // institusi
            $institusi_nama     =   $this->input->post('institusi_nama');
            $institusi_telpon   =   $this->input->post('institusi_telpon');
            $institusi_alamat   =   $this->input->post('institusi_alamat');
            $instansi           =   array(  'instansi_nama'=>$instansi_nama,
                                            'instansi_telpon'=>$instansi_telpon,
                                            'instansi_alamat'=>$instansi_alamat,
                                            'instansi_mulai'=>$instansi_mulai,
                                            'instansi_sampai'=>$instansi_sampai);
            $institusi          =   array(  'institusi_nama'=>$institusi_nama,
                                            'institusi_telpon'=>$institusi_telpon,
                                            'institusi_alamat'=>$institusi_alamat);
            //$angkatan           = getField('student_angkatan', 'angkatan_id', 'aktif', 'y');
            $pribadi            =   array(  'nama'=>$nama,
                                            'semester_aktif'=>0,
                                            'agama_id'=>$agama,
                                            'gender'=>$gender,
                                            'tempat_lahir'=>$tempat_lahir,
                                            'tanggal_lahir'=>$tgl_lahir,
                                            'nim'=>$nim,
                                            'konsentrasi_id'=>$konsentrasi,
                                            'alamat'=>$alamat,
                                            'angkatan_id'=> $angkatan);
            
            $sekolah            =   array(  'sekolah_nama'=>$sekolah_nama,
                                            'sekolah_telpon'=>$sekolah_telpon,
                                            'sekolah_alamat'=>$sekolah_alamat,
                                            'sekolah_tahun_lulus'=>$sekolah_tahun,
                                            'sekolah_jurusan'=>$sekolah_jurus);
            $kampus             =   array(  'kampus_nama'=>$sekolah_nama,
                                            'kampus_telpon'=>$sekolah_telpon,
                                            'kampus_alamat'=>$sekolah_alamat,
                                            'kampus_tahun_lulus'=>$sekolah_tahun,
                                            'kampus_jurusan'=>$sekolah_jurus);
            
            $orangtua           =   array(  'nama_ayah'=>$nama_ayah,
                                            'nama_ibu'=>$nama_ibu,
                                            'pekerjaan_id_ayah'=>$pekerjaan_ayah,
                                            'pekerjaan_id_ibu'=>$pekerjaan_ibu,
                                            'alamat_ayah'=>$alamat_ayah,
                                            'no_hp_ortu'=>$no_hp_ortu,
                                            'alamat_ibu'=>$alamat_ibu,
                                            'penghasilan_ayah'=>$penghsln_ayah,
                                            'penghasilan_ibu'=>$penghsln_ibu);
            $data               =array_merge($orangtua,$kampus,$sekolah,$pribadi,$instansi,$institusi);
            $this->db->insert($this->tables,$data);
            $this->session->set_flashdata('pesan', "<div class='alert alert-success'>Data $nama Sudah Tersimpan </div>");
            redirect('mahasiswa/post');
        }
        else
        {
            $data['title']=  $this->title;
            $data['desc']="";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $id     = $this->input->post('id');
                        // pribadi
            $nama               =   $this->input->post('nama');
            $nim                =   $this->input->post('nim');
            $alamat             =   $this->input->post('alamat');
            $konsentrasi        =   $this->input->post('konsentrasi');
            $tahun              =   $this->input->post('tahun_angkatan');
            $tempat_lahir       =   $this->input->post('tempat_lahir');
            $tgl_lahir          =   $this->input->post('tanggal_lahir');
            $agama              =   $this->input->post('agama');
            $gender             =   $this->input->post('gender');
            // orang tua
            $nama_ayah          =   $this->input->post('nama_ayah');
            $nama_ibu           =   $this->input->post('nama_ibu');
            $pekerjaan_ayah     =   $this->input->post('pekerjan_ayah');
            $pekerjaan_ibu      =   $this->input->post('pekerjaan_ibu');
            $alamat_ayah        =   $this->input->post('alamat_ayah');
            $alamat_ibu         =   $this->input->post('alamat_ibu');
            $penghsln_ayah      =   $this->input->post('penghasilan_ayah');
            $penghsln_ibu       =   $this->input->post('penghasilan_ibu');
            $no_hp_ortu         =   $this->input->post('no_hp_ortu');
            
            // sekolah
            $sekolah_nama       =   $this->input->post('sekolah_nama');
            $sekolah_telpon     =   $this->input->post('sekolah_telpon');
            $sekolah_alamat     =   $this->input->post('sekolah_alamat');
            $sekolah_jurus      =   $this->input->post('sekolah_jurusan');
            $sekolah_tahun      =   $this->input->post('sekolah_tahun');
            // kampus
            $kampus_nama        =   $this->input->post('kampus_nama');
            $kampus_telpon      =   $this->input->post('kampus_telpon');
            $kampus_alamat      =   $this->input->post('kampus_alamat');
            $kampus_jurus       =   $this->input->post('kampus_jurusan');
            $kampus_tahun       =   $this->input->post('kampus_tahun');
            // instansi
            $instansi_nama      =   $this->input->post('instansi_nama');
            $instansi_telpon    =   $this->input->post('instansi_telpon');
            $instansi_alamat    =   $this->input->post('instansi_alamat');
            $instansi_mulai     =   $this->input->post('instansi_mulai');
            $instansi_sampai    =   $this->input->post('instansi_sampai');
            // institusi
            $institusi_nama     =   $this->input->post('institusi_nama');
            $institusi_telpon   =   $this->input->post('institusi_telpon');
            $institusi_alamat   =   $this->input->post('institusi_alamat');
            
            $instansi           =   array(  'instansi_nama'=>$instansi_nama,
                                            'instansi_telpon'=>$instansi_telpon,
                                            'instansi_alamat'=>$instansi_alamat,
                                            'instansi_mulai'=>$instansi_mulai,
                                            'instansi_sampai'=>$instansi_sampai);
            $institusi          =   array(  'institusi_nama'=>$institusi_nama,
                                            'institusi_telpon'=>$institusi_telpon,
                                            'institusi_alamat'=>$institusi_alamat);
            
            $pribadi            =   array(  'nama'=>$nama,
                                            'agama_id'=>$agama,
                                            'gender'=>$gender,
                                            'tempat_lahir'=>$tempat_lahir,
                                            'tanggal_lahir'=>$tgl_lahir,
                                            'nim'=>$nim,
                                            'konsentrasi_id'=>$konsentrasi,
                                            'alamat'=>$alamat
                                            );
            
            $sekolah            =   array(  'sekolah_nama'=>$sekolah_nama,
                                            'sekolah_telpon'=>$sekolah_telpon,
                                            'sekolah_alamat'=>$sekolah_alamat,
                                            'sekolah_tahun_lulus'=>$sekolah_tahun,
                                            'sekolah_jurusan'=>$sekolah_jurus);
            
            $kampus             =   array(  'kampus_nama'=>$sekolah_nama,
                                            'kampus_telpon'=>$sekolah_telpon,
                                            'kampus_alamat'=>$sekolah_alamat,
                                            'kampus_tahun_lulus'=>$sekolah_tahun,
                                            'kampus_jurusan'=>$sekolah_jurus);
            
            $orangtua           =   array(  'nama_ayah'=>$nama_ayah,
                                            'nama_ibu'=>$nama_ibu,
                                            'pekerjaan_id_ayah'=>$pekerjaan_ayah,
                                            'pekerjaan_id_ibu'=>$pekerjaan_ibu,
                                            'alamat_ayah'=>$alamat_ayah,
                                            'alamat_ibu'=>$alamat_ibu,
                                            'no_hp_ortu'=>$no_hp_ortu,
                                            'penghasilan_ayah'=>$penghsln_ayah,
                'penghasilan_ibu'=>$penghsln_ibu);
            $data               =array_merge($orangtua,$kampus,$sekolah,$pribadi,$instansi,$institusi);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
            $data['desc']="";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    function delete()
    {
        $id     =  $_GET['id'];
        $this->mcrud->delete($this->tables,  $this->pk,  $id);
 
    }
    
    
    function tampilkankonsentrasi()
    {
        $prodi  =   $_GET['prodi'];
        $data   = $this->db->get_where('akademik_konsentrasi',array('prodi_id'=>$prodi))->result();
        foreach ($data as $r)
        {
            echo "<option value='$r->konsentrasi_id'>".  strtoupper($r->nama_konsentrasi)."</option>";
        }
    }
    
    
    function tampilkanmahasiswa()
    {
        $konsentrasi    =   $_GET['konsentrasi'];
        $tahun_angkatan =   $_GET['tahun_angkatan'];
        $data           =   $this->db->get_where('student_mahasiswa',array('konsentrasi_id'=>$konsentrasi,'angkatan_id'=>$tahun_angkatan))->result();
        echo "<tr><th width='5'>No</th><th width='70'>NIM</th><th>NAMA</th>
            <th width=100>Gender</th><th>Alamat</th>
            <th width='10' colspan='2'>Operasi</th></tr>";
        $no=1;
        foreach ($data as $r)
        {
            $gender=$r->gender==1?'Laki Laki':'Perempuan';
            echo "<tr id='hide$r->mahasiswa_id'>
                <td>$no</td>
                <td>".  strtoupper($r->nim)."</td>
                <td>".  strtoupper($r->nama)."</td>
                <td>$gender</td>
                <td>".  strtoupper($r->alamat)."</td>
                <td width=5>".anchor('mahasiswa/edit/'.$r->mahasiswa_id,'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit data'))."</td>
                <td width=5><i class='fa fa-trash-o' onclick='hapus($r->mahasiswa_id)'></i></td>";
                //<td width=5>".anchor('mahasiswa/cetak/'.$r->mahasiswa_id,'<i class="fa fa-print"></i>',array('title'=>'Cetak data'))."</td>
                echo"</tr>";
            $no++;
            // 
        }
        
    }
}