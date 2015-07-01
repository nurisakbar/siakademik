<?php
class registrasi extends CI_Controller{
    
    var $folder =   "registrasi";
    var $tables =   "akademik_registrasi";
    var $pk     =   "registrasi_id";
    var $title  =   "Registrasi Ulang Mahasiswa";
    
    
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
            <th width=100>Tahun AKD</th>
            <th>Aktif</th>
            <th>Tanggal Registrasi</th>
            <th></th></tr>";
        $no=1;
        foreach ($data as $r)
        {
            // get last registrasi
            $last_id=  $this->db->query("SELECT registrasi_id FROM akademik_registrasi WHERE nim='$r->nim' order by registrasi_id desc limit 1")->row_array();
            $gender=$r->gender==1?'Laki Laki':'Perempuan';
            $tahun_akademik_id=get_tahun_ajaran_aktif('tahun_akademik_id');
            $tanggal=status_registrasi($tahun_akademik_id, $r->nim, 'tanggal_registrasi');
            $status=$tanggal==''?'Tidak':'Aktif';
            $smt_aktif=  getField('student_mahasiswa', 'semester_aktif', 'mahasiswa_id', $r->mahasiswa_id);
            $btnaktf="<button class='btn btn-primary btn-sm' onclick='registrasi($r->mahasiswa_id)'>Belum Registrasi</button>";
            $btnnon=anchor('registrasi/delete/'.$last_id['registrasi_id'],'Batalkan registrasi',array('class'=>'btn btn-success btn-sm'));
            $btn=$tanggal==''?$btnaktf:$btnnon;
            echo "<tr id='hide$r->mahasiswa_id'>
                <td>$no</td>
                <td>".  strtoupper($r->nim)."</td>
                <td>".  strtoupper($r->nama)."</td>
                <td>".  get_tahun_ajaran_aktif('keterangan')."</td>
                <td>$status</td>
                <td>". tgl_indo($tanggal)."</td>
                <td>$btn</td>
                </tr>";
            $no++;
            // 
        }
    }
    
    function pregistrasi()
    {
        $id_ms      =   $_GET['id'];
        // get batas registrasi tahun akademik yang aktif
        $thun_admk  = $this->db->get_where('akademik_tahun_akademik',array('status'=>'y'))->row_array();
        $thun_admk  = $thun_admk['batas_registrasi'];
        if(substr(waktu(),0,10)>$thun_admk)
        {
            echo "<div class='alert alert-danger'>Batas Waktu Registrasi Sudah Lewat <i class='gi gi-remove'></i> </div>";
        }
        else{
            
        $sql        =   $this->db->query("select nim,semester_aktif from student_mahasiswa where mahasiswa_id='$id_ms'")->row_array();
        $semester   =   $sql['semester_aktif']+1;
        $data       =   array( 'nim'=>$sql['nim'],
                                'tahun_akademik_id'=>  get_tahun_ajaran_aktif('tahun_akademik_id'),
                                'semester'=>$semester,
                                'tanggal_registrasi'=>  waktu());
        $this->db->insert($this->tables,$data);
        $this->mcrud->update('student_mahasiswa',array('semester_aktif'=>$semester), 'nim',$sql['nim']);
        // insert krs automatic
        $r=  $this->db->query("select semester_aktif,konsentrasi_id from student_mahasiswa where mahasiswa_id='$id_ms'")->row_array();
        $sms_aktf   =   $r['semester_aktif'];
        $konsentrasi=   $r['konsentrasi_id'];
        // load jadwal kuliah
        $jadwal="   SELECT jk.jadwal_id
                    FROM makul_matakuliah as mm, akademik_jadwal_kuliah as jk
                    WHERE jk.makul_id=mm.makul_id and mm.semester=$sms_aktf";
        $jadwal=  $this->db->query($jadwal)->result();
        foreach ($jadwal as $j)
        {
            $this->db->insert('akademik_krs',array('nim'=>$sql['nim'],'jadwal_id'=>$j->jadwal_id,'semester'=>$semester));
            // insert to khs
            $id_krs= $this->db->get_where('akademik_krs',array('nim'=>$sql['nim'],'jadwal_id'=>$j->jadwal_id))->row_array();
            $this->db->insert('akademik_khs',array('krs_id'=>$id_krs['krs_id'],'mutu'=>0,'confirm'=>'2'));
        }
         echo "<div class='alert alert-success'>Registrasi Berhasil<i class='gi gi-ok'></i> </div>"; 
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