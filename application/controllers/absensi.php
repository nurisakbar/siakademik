<?php

class absensi extends CI_Controller{
    
    var $folder =   "absensi";
    var $tables =   "student_absen";
    var $pk     =   "absen_id";
    var $title  =   "Absensi Mahasiswa";
    
    function __construct() {
        parent::__construct();
    }
    
    
    function index()
    {
        $dosen  =  $this->session->userdata('keterangan');
        $thn    = get_tahun_ajaran_aktif('tahun_akademik_id');
        $query="SELECT mm.nama_makul,jk.jadwal_id
                FROM akademik_jadwal_kuliah as jk,makul_matakuliah as mm
                WHERE mm.makul_id=jk.makul_id and jk.dosen_id=$dosen and jk.tahun_akademik_id=$thn";
        $data['title']="Absen";
        $data['kelas']=  $this->db->query($query)->result();
        $this->template->load('template', $this->folder.'/view',$data);
    }
    
    
        function load_mahasiswa()
    {
        $jadwal_id=  $_GET['jadwal_id'];
        $tanggal  =$_GET['tanggal'];
        $thn      =  get_tahun_ajaran_aktif('tahun_akademik_id');
        $d        =  $this->db->query("SELECT ad.nama_lengkap,mm.nama_makul 
                    FROM app_dosen as ad,makul_matakuliah as mm,akademik_jadwal_kuliah as jk 
                    WHERE jk.makul_id=mm.makul_id and jk.dosen_id=ad.dosen_id and jk.jadwal_id=$jadwal_id")->row_array();
        $sql="  SELECT sm.nim,sm.nama,kh.mutu,kh.khs_id,kh.tugas,kh.kehadiran,kh.grade
                FROM akademik_krs as ak,student_mahasiswa as sm,akademik_khs as kh,akademik_jadwal_kuliah as jk
                WHERE kh.krs_id=ak.krs_id and sm.nim=ak.nim and ak.jadwal_id='$jadwal_id' and jk.jadwal_id=ak.jadwal_id and jk.tahun_akademik_id='$thn'";
        echo " <table class='table table-bordered'>
              <tr class='success'><th colspan=2>MATAKULIAH</th></tr>
               <tr><td width=120>Matakuliah</td><td>".  strtoupper($d['nama_makul'])."</td></tr>
               <tr><td>Dosen Pengapu</td><td>".  strtoupper($d['nama_lengkap'])."</td></tr>
               </table>
               <table class='table table-bordered'>
               <tr class='success'><th colspan=6>DATA MAHASISWA</th></tr>
               <tr><th>No</th><th>NIM</th><th>NAMA MAHASISWA</th><th width=120>Kehadiran</th></tr>";
        $data=  $this->db->query($sql)->result();
        $no=1;
        foreach ($data as $r)
        {
            $absen=array('h'=>'Hadir','a'=>'Alpa','i'=>'Izin');
            echo "<tr>
                <td width='7'>$no</td>
                <td width='70'>".  strtoupper($r->nim)."</td>
                <td>".  strtoupper($r->nama)."</td>
                <td align='center' width='90'><div class='cols-4'>";
                $absensi=  $this->db->get_where('student_absen_detail',array('nim'=>$r->nim,'absen_id'=>  getField('student_absen', 'absen_id', 'tanggal', $tanggal)));
                if($absensi->num_rows()>0)
                {
                    $absensi=$absensi->row_array();
                    echo form_dropdown('absen',$absen,$absensi['kehadiran'],"class='form-control' id='absenid".$absensi['detail_id']."' onChange='simpanabsen(".$absensi['detail_id'].")'");
                    //echo inputan('text', '','col-sm-12','Kehadiran', 0, $r->kehadiran,array('onkeyup'=>'simpankehadiran('.$r->khs_id.')','id'=>'ambilkehadiran'.$r->khs_id)).'</td>';
                }
                else
                {
                    echo form_dropdown('absen',$absen,'',"class='form-control' onChange='belumabsen()'");
                    //echo inputan('text', '','col-sm-12','Kehadiran', 0, $r->kehadiran,array('onkeyup'=>'simpankehadiran('.$r->khs_id.')','id'=>'ambilkehadiran'.$r->khs_id)).'</td>';
                }
                echo"</div></tr>";
            $no++;
        }
        echo"  </table>";
    }
    
    
    function autosave()
    {
        $tanggal    =  $this->input->post('tanggal2');
        $makul      =  $this->input->post('jadwal');
        $materi     =  $this->input->post('materi');
        $data       =  array('jadwal_id'=>$makul,'tanggal'=>$tanggal,'keterangan'=>$materi);
        $this->db->insert($this->tables,$data);
        $id=  $this->db->get_where($this->tables,$data)->row_array();
        // foreach mahasiswa yang mengambil matakuliah x
        $mahasiswa=$this->db->get_where('akademik_krs',array('jadwal_id'=>$makul))->result();
        foreach ($mahasiswa as $m)
        {
            $data=array('absen_id'=>$id['absen_id'],'nim'=>$m->nim,'kehadiran'=>'h','keterangan'=>'');
            $this->db->insert('student_absen_detail',$data);
        }
        redirect('absensi');
    }
    
    function chek_absen()
    {
        $tanggal=$_GET['tanggal'];
        $jadwal=$_GET['jadwal'];
        $chek=$this->db->get_where('student_absen',array('tanggal'=>$tanggal,'jadwal_id'=>$jadwal))->num_rows();
        if($chek>0)
        {
            echo "Sudah Absen";
        }
        else
        {
            echo "Belum Absen";
        }
    }
    
    function simpan_absen()
    {
        $id=$_GET['id'];
        $nilai=$_GET['nilai'];
        $this->mcrud->update('student_absen_detail',array('kehadiran'=>$nilai), 'detail_id',$id);
    }
}