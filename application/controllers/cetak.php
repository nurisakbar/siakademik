<?php
class cetak extends CI_Controller
{
    function __construct() {
        parent::__construct();
         $this->load->library('cfpdf');
    }
    
    function cetakkhs()
    {
        $mahasiswa  =   $this->uri->segment(4);
        $semester   =   $this->uri->segment(3);
        $sqlMHS     =   "SELECT ap.nama_prodi,ak.nama_konsentrasi,sm.nama,sm.nim,sm.semester_aktif
                        FROM student_mahasiswa as sm,akademik_prodi as ap,akademik_konsentrasi as ak
                        WHERE sm.konsentrasi_id=ak.konsentrasi_id and ak.prodi_id=ap.prodi_id and sm.mahasiswa_id=$mahasiswa";
        $m          =  $this->db->query($sqlMHS)->row_array();
        $khs        =   "select kh.grade,mm.kode_makul,mm.nama_makul,mm.sks,ad.nama_lengkap,kh.mutu,kh.confirm,kh.khs_id,kh.tugas,kh.kehadiran
                         FROM makul_matakuliah as mm,akademik_jadwal_kuliah as jk,akademik_krs as ak,
                         app_dosen as ad,akademik_khs as kh
                         WHERE mm.makul_id=jk.makul_id and ad.dosen_id=jk.dosen_id and jk.jadwal_id=ak.jadwal_id 
                         and ak.nim='$m[nim]' and kh.krs_id=ak.krs_id and ak.semester='$semester' ";
        $pdf = new FPDF('p','mm','A5');
        $pdf->AddPage();
       // head
       $pdf->SetFont('TIMES','',12);
       $pdf->Cell(130, 5, 'POLITEKNIK TEDC BANDUNG', 0, 1, 'C');
       $pdf->SetFont('TIMES','',10);
       $pdf->Cell(130, 5, 'Jalan Pesantren. 2 Cibabaat - Cimahi Utara 40513 ,Jawa Barat', 0, 1, 'C');
       $pdf->Cell(130, 5, 'Telp.(022) 6645951 ,Fax(022)6645951', 0, 1, 'C');
       $pdf->Cell(130, 5, 'E-mail : http://www.poltektedc.ac.id', 0, 1, 'C');
       $pdf->Line(11, 31, 140, 31);
       
       $pdf->Image(base_url().'/assets/images/logo.png', 10, 10, 20);
       
       $pdf->SetFont('TIMES','B',12);
       $pdf->Cell(1,2,'',0,1);
       $pdf->Cell(100, 5, 'KARTU HASIL STUDI', 0, 1, 'C');
       $pdf->Cell(2, 2,'',0,1);
       $pdf->SetFont('TIMES','B',9);
       // buat tabel disini
       $pdf->SetFont('TIMES','B',9);
       
       $pdf->Cell(30,5,'SEMESTER',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['semester_aktif']),0,1);
       $pdf->Cell(30,5,'PROGRAM STUDI',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nama_prodi']),0,1);
       $pdf->Cell(30,5,'KONSENTRASI',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nama_konsentrasi']),0,1);
       $pdf->Cell(30,5,'NAMA ',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nama']),0,1);
       $pdf->Cell(30,5,'NIM',0,0);
       $pdf->Cell(20,5,' : '.  strtoupper($m['nim']),0,1);
       
       // kasi jarak
       $pdf->Cell(3,2,'',0,1);
       
       $pdf->Cell(7, 5, 'NO', 1, 0);
       $pdf->Cell(15, 5, 'KODE', 1, 0);
       $pdf->Cell(65, 5, 'MATA KULIAH', 1, 0);
       $pdf->Cell(15, 5, 'SKS', 1, 0);
       $pdf->Cell(15, 5, 'NILAI', 1, 0);
       $pdf->Cell(15, 5, 'MUTU', 1, 1);
   
       $pdf->SetFont('times','',9);
       $i=1;
       $sks=0;
       $mutu=0;
       foreach ($this->db->query($khs)->result() as $r)
       {
            $pdf->Cell(7, 5, $i, 1, 0);
            $pdf->Cell(15, 5, strtoupper($r->kode_makul), 1, 0);
            $pdf->Cell(65, 5, strtoupper($r->nama_makul), 1, 0);
            $pdf->Cell(15, 5, $r->sks, 1, 0,'C');    
            $pdf->Cell(15, 5, $r->grade, 1, 0,'C');
            $pdf->Cell(15, 5, $r->mutu, 1, 1,'C');
            $i++;
            $sks=$sks+$r->sks;
            $mutu=$mutu+$r->mutu;
       }
       
       $pdf->Cell(35, 5, 'SKS Kontrak : '.$sks, 0, 0);
       $pdf->Cell(35, 5, 'SKS Selesai : '.$sks, 0, 0);
       $pdf->Cell(35, 5, 'Mutu : '.$mutu.',00', 0, 0);
       $pdf->Cell(35, 5, 'IP : ' ,0, 1);
       
       // tanda tangan
       $pdf->Cell(95, 5, '', 0, 1);
       $pdf->Cell(95, 15, '', 0, 0);
       $pdf->Cell(25, 5, 'Cimahi, '.  tgl_indo(waktu()), 0, 1);
       $pdf->Cell(95, 5, '', 0, 0);
       $pdf->Cell(25, 5, 'Pembantu Direktur 1,', 0, 1);
       $pdf->Cell(95, 10, '', 0, 0);
       $pdf->Cell(25, 10, '', 0, 1);
       $pdf->Cell(95, 5, '', 0, 0);
       $pdf->Cell(25, 5, 'Dendin Supriadi,S.Pd.M.T,', 0, 0);
       $pdf->Output();
    }
    
    
    function kum()
    {
        $id        =  $this->uri->segment(3);
        $profileSQL=    "SELECT sm.nama,sm.nim,ak.nama_konsentrasi,ap.nama_prodi FROM 
                        student_mahasiswa  as sm,akademik_prodi as ap,akademik_konsentrasi as ak
                        WHERE sm.konsentrasi_id=ak.konsentrasi_id and ap.prodi_id=ak.prodi_id and sm.mahasiswa_id=1";
        $profile   = $this->db->query($profileSQL)->row_array();
        $pdf = new FPDF('L','mm','A5');
        $pdf->AddPage();
        $pdf->SetFont('TIMES','',17);
        $pdf->Cell(100,2,'POLITEKNIK TEDC BANDUNG',0,1);
        
        $pdf->SetFont('TIMES','',10);
        $pdf->Cell(100, 6, 'Jalan Pesantren. 2 Cibabat - Cimahi ,Jawa Barat 40513', 0, 1, 'L');
         $pdf->Cell(100, 3, 'E-mail : poltek_tedc@yahoo.com ; Website : http://www.poltektedc.ac.id', 0, 1, 'L');
        $pdf->Cell(100, 5, 'Telp / Fax : (022)6645951', 0, 1, 'L');
        $pdf->Line(11, 27, 120, 27);
        
        $pdf->Image(base_url().'/assets/images/bgkum.png', 128, 15, 70);
        $pdf->SetFont('TIMES','',12);
        $pdf->Text(131, 23, 'KARTU UJIAN MAHASSISWA');
        $pdf->Text(131, 28, 'UJIAN TENGAH SEMESTER');
        $pdf->Text(131, 33, 'SEMESTER GANJIL T.A  2012/2013');
        $pdf->SetFont('TIMES','',10);
        
        // biodata
        $pdf->Cell(0, 3,'',0,1);
        $pdf->Cell(40, 5, 'NAMA', 0, 0);
        $pdf->Cell(40, 5, ' : '. strtoupper($profile['nama']), 0, 1);
        $pdf->Cell(40, 5, 'NIM', 0, 0);
        $pdf->Cell(40, 5, ' : '.  strtoupper($profile['nim']), 0, 1);
        $pdf->Cell(40, 5, 'PROGRAM STUDI', 0, 0);
        $pdf->Cell(40, 5, ' : '.  strtoupper($profile['nama_prodi']), 0, 1);
        $pdf->Cell(40, 5, 'KONSENTRASI', 0, 0);
        $pdf->Cell(40, 5, ' : '.  strtoupper($profile['nama_konsentrasi']), 0, 1);
        
        $pdf->Cell(10, 3,'',0,1);
        $pdf->SetFont('TIMES','B',10);
        $pdf->Cell(40, 5, 'DAFTAR MATA KULIAH KONTRAK', 0, 1);
        $pdf->SetFont('TIMES','b',10);
        
        
        // data matakuliah
        // kasi jarak
       $pdf->Cell(20,3,'',0,1);
       
       $pdf->Cell(7, 5, 'NO', 1, 0);
       $pdf->Cell(15, 5, 'SMT', 1, 0,'C');
       $pdf->Cell(75, 5, 'MATA KULIAH', 1, 0);
       $pdf->Cell(55, 5, 'DOSEN', 1, 0);
       $pdf->Cell(30, 5, 'TANDA TANGAN', 1, 1);
   
       $pdf->SetFont('times','',10);
       $i=1;
       $krs            =   "select ak.krs_id,mm.kode_makul,mm.nama_makul,mm.sks,ad.nama_lengkap
                            FROM makul_matakuliah as mm,akademik_jadwal_kuliah as jk,akademik_krs as ak,app_dosen as ad
                            WHERE mm.makul_id=jk.makul_id and ad.dosen_id=jk.dosen_id and jk.jadwal_id=ak.jadwal_id 
                            and jk.tahun_akademik_id='1' and ak.nim='".$this->uri->segment(3)."' and ak.semester='".$this->uri->segment(4)."'";
       foreach ($this->db->query($krs)->result() as $r)
       {
            $pdf->Cell(7, 5, $i, 1, 0);
            $pdf->Cell(15, 5, 'SMT '.$this->uri->segment(4), 1, 0,'C');
            $pdf->Cell(75, 5, strtoupper($r->nama_makul), 1, 0);
            $pdf->Cell(55, 5, strtoupper($r->nama_lengkap), 1, 0);
            $pdf->Cell(30, 5, '', 1, 1);
            $i++;
       }
       
       $pdf->SetFont('times','b',9);
       $pdf->Cell(300,5,'Catatan : selama ujian berlangsung KUM wajib dibawa dan mintalah tanda tangan kepada dosen',0,1);
       $pdf->Cell(300,3,'                 atau pengawas ujian,jika KUM tidak dibawa harus minta surat keterangan dari akademik.',0,1);
        $pdf->SetFont('times','',10);
       $pdf->Text(155, 110, 'Cimahi , '.  tgl_indo(waktu()));
       $pdf->Text(155, 115, 'Pembantu Direktur I');
       
       $pdf->Text(155, 130, 'Dendin Supriadi,S.Pd.M.T');
       $pdf->Output();
    }
    
}