<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('generatehtml'))
{
	function rp($x)
       {
            if(is_int($x)==FALSE)
            {
                return '';
            }
            else
            {
           return number_format((int)$x,0,",",".");
            }
       }
       
       function waktu()
       {
           date_default_timezone_set('Asia/Jakarta');
           return date("Y-m-d H:i:s");
       }
              
       function tgl_indo($tgl)
       {
            return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2)).' '.substr($tgl, 0, 4);
       }
    
    function tgl_indojam($tgl,$pemisah)
    {
        return substr($tgl, 8, 2).' '.getbln(substr($tgl, 5,2)).' '.substr($tgl, 0, 4).' '.$pemisah.' '.  substr($tgl, 11,8);
    }
    
    
    function getbln($bln)
    {
        switch ($bln) 
        {
            
            case 1:
                return "Januari";
            break;
        
            case 2:
                return "Februari";
            break;
        
            case 3:
                return "Maret";
            break;
        
            case 4:
                return "April";
            break;
        
            case 5:
                return "Mei";
            break;
        
            case 6:
                return "Juni";
            break;
        
            case 7:
                return "Juli";
            break;
        
            case 8:
                return "Agustus";
            break;
        
            case 9:
                return "September";
            break;
        
             case 10:
                return "Oktober";
            break;
        
            case 11:
                return "November";
            break;
        
            case 12:
                return "Desember";
            break;
        }
        
    }
    
    function selisihTGl($tgl1,$tgl2)
    {
        $pecah1 = explode("-", $tgl1);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0];

        // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
        // dari tanggal kedua

        $pecah2 = explode("-", $tgl2);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 =  $pecah2[0];

        // menghitung JDN dari masing-masing tanggal

        $jd1 = GregorianToJD($month1, $date1, $year1);
        $jd2 = GregorianToJD($month2, $date2, $year2);

        // hitung selisih hari kedua tanggal

        $selisih = $jd2 - $jd1;
        return $selisih;
    }
    
    function seoString($s) 
    {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }
    
    
    function breacumb($link)
    {
        $CI =& get_instance();
        $main=$CI->db->get_where('mainmenu',array('link'=>$link));
        if($main->num_rows()>0)
        {
            $main=$main->row_array();
            return $main['nama_mainmenu'];
        }
        else
        {
            $sub=$CI->db->get_where('submenu',array('link'=>$link));
            if($sub->num_rows()>0)
            {
                $sub=$sub->row_array();
                return $sub['nama_submenu'];
            }
            else
            {
                return 'tidak diketahui';
            }
        }
    }
    
    function jmlPaging()
    {
        return 10;
    }
    
    function getusersLogin($idusers,$field)
    {
        $CI =& get_instance();
        $row=$CI->db->get_where('app_users',array('id_users'=>$idusers));
        if($row->num_rows()>0)
        {
            $row=$row->row_array();
            return $row[$field];
        }
        else
        {
            return '';
        }
    }
    
    
    function getTahunAjaran()
    {
        $CI =& get_instance();
        $row=$CI->db->get_where('academic_tahun_ajaran',array('status'=>1))->row_array();
        return $row['tahun_ajaran_id'];
    }
    
        function getField($tables,$field,$pk,$value)
    {
        $CI =& get_instance();
        $data=$CI->db->query("select $field from $tables where $pk='$value'");
        if($data->num_rows()>0)
        {
            $data=$data->row_array();
            return $data[$field];
        }
        else
        {
            return '';
        }
    }
    
    
    function hitungsiswa($id)
    {
        $CI =& get_instance();
        return $CI->db->get_where('student_rombel',array('kelas_id'=>$id))->num_rows();
    }
    
    
    function faktur()
    {
        $CI =& get_instance();
        $query = "SELECT max(coba) as coba FROM test";
        $hasil = mysql_query($query);
        $data  = @mysql_fetch_array($hasil);
        $data=$CI->db->query($query)->row_array();
        $kodeUSER = $data['coba'];
        $noUrut = (int) substr($kodeUSER, 18, 6);
        $noUrut++;
        $char = ""; //Aktifkan, Jika ingin menggunakan karakter di depan USER_ID
        $newID = $char . sprintf("%04s", $noUrut);
        return $newID;
    }
    
    
    function kode_daftar($tingkat,$gender)
    {
        $CI =& get_instance();
        $query=$CI->db->query("SELECT max(kode_daftar) as kode_daftar FROM pmb_student where gender='$gender' and tingkat='$tingkat'");
        if($query->num_rows()>0)
        {
            $query=$query->row_array();
            $kode=$query['kode_daftar'];
            $noUrut = (int) substr($kode, 9,3);
            $noUrut++;
            //return $noUrut;
            return sprintf("%03s", $noUrut);
            //return (int) $query['kode_daftar'];
        }
        else
        {
            return "001";
        }        
    }
    
    
    function ubahtanggal($tanggal)
    {
        return $newtanggal= substr($tanggal,8,2).'-'.substr($tanggal, 5,2).'-'.substr($tanggal, 0,4);
    }
    
    function ubahtanggal2($tanggal)
    {
        return $newtanggal=substr($tanggal,8,2 ).'/'.  substr($tanggal, 5,2).'/'.  substr($tanggal, 0,4);
    }
    
    function keteranganlulus($keterangan)
    {
        if($keterangan=='tidaklulus')
        {
            return "TIDAK LULUS";
        }
        elseif($keterangan=='lulus')
        {
            return "LULUS";
        }
        else
        {
            return "SEMUA DATA";
        }
    }
    
    function psb_hitungssiswa($gender,$tingkat)
    {
        $CI =& get_instance();
        $genderid=$tingkat=='smp'?1:2;
        return $CI->db->get_where('pmb_student',array('gender'=>$gender,'tingkat'=>$genderid))->num_rows();
    }
    
    function validasi_psb($id,$data)
    {
        $CI =& get_instance();
        $stack = array();
        $query = $CI->db->query(  "SELECT nama,
                                    tempat_lahir,
                                    tanggal_lahir,
                                    golongan_darah_id,
                                    kabupaten_id,
                                    jumlah_saudara_kandung,
                                    alamat_rumah,
                                    desa,
                                    kecamatan,
                                    nisn,tahun_lulus,
                                    nama_sekolah,
                                    alamat_sekolah,
                                    kabupaten_id_sekolah,
                                    nama_ayah,
                                    pekerjaan_ayah,
                                    nama_ibu,
                                    pekerjaan_ibu,
                                    alamat_orang_tua,
                                    desa_alamat_ortu,
                                    kecamatan_alamat_ortu,
                                    kabupaten_id_ortu,
                                    orangtua_hp_resmi
                                    FROM pmb_student where id_pmb='$id'");
        $r  =   $query->row_array();
        foreach ($query->list_fields() as $field)
            {
             
                if(empty($r[$field]))
                {
                    $pesan=$field." masih kosong";
                    array_push($stack, $pesan);
                } 
            }
        $find=array('jumlah_saudara_kandung');
        $replace    =   array('jumlah saudara kandung');
        $hasil      =   str_replace($find, $replace,$stack);
        $jumlah     =   count($stack)-1;

        echo "<ul>";
            for($i=0;$i<=$jumlah;$i++)
            {
                echo "<li>$hasil[$i]</li>";
            }
            echo "</ul>";
            
         
            
        if($data=='jumlah')
        {
            return $jumlah;
        }
        else
        {
            return $hasil;
        }
        
    }
    
    
        function status_bayar($id)
    {
        if($id==0)
        {
            return "Lunas";
        }
        else
        {
            return "Pembayaran Ke $id";
        }
    }
    
    
    
    function get_tahun_ajaran_aktif($field)
    {
         $CI =& get_instance();
         $query2     = "  SELECT * FROM akademik_tahun_akademik WHERE status='y'";
         $r          = $CI->db->query($query2)->row_array();
         return $r[$field];
    }
    
    function get_biaya_kuliah($tahun_akademik,$jenis_biaya_kuliah,$konsentrasi,$field)
    {
        $CI =& get_instance();
        $where  =   array(  'angkatan_id'=>$tahun_akademik,
                            'jenis_bayar_id'=>$jenis_biaya_kuliah,
                            'konsentrasi_id'=>$konsentrasi);
        $r      =  $CI->db->get_where('keuangan_biaya_kuliah',$where);
        if($r->num_rows()>0)
        {
            $r=$r->row_array();
            return $r[$field];
        }
        else
        {
            return 0;
        }
    }
    
    function get_persentase_pembayaran($jumlah_bayar,$sudah_bayar)
    {
        if(empty($jumlah_bayar) || empty($sudah_bayar))
        {
            return 0;
        }
        else
        {
            return ($sudah_bayar/$jumlah_bayar)*100;
        }
        
    }
    
    function get_biaya_sudah_bayar($nim,$jenis_bayar_id)
    {
        $CI     =   & get_instance();
        $query  =   "SELECT sum(jumlah) as jumlah 
                    from keuangan_pembayaran_detail 
                    where nim='$nim' and jenis_bayar_id='$jenis_bayar_id' 
                    group by jenis_bayar_id";
        $data   =   $CI->db->query($query);
        if($data->num_rows()>0)
        {
            $r  =   $data->row_array();
            return $r['jumlah'];
        }
        else
        {
            return 0;
        }
    }
    
    function get_semester_sudah_bayar($nim,$semester)
    {
        $CI     =   & get_instance();
        $query  =   "SELECT sum(jumlah) as jumlah 
                    from keuangan_pembayaran_detail 
                    where nim='$nim' and jenis_bayar_id='3' and semester='$semester' 
                    group by jenis_bayar_id";
        $data   =   $CI->db->query($query);
        if($data->num_rows()>0)
        {
            $r  =   $data->row_array();
            return $r['jumlah'];
        }
        else
        {
            return 0;
        }
    }
    
    
    function get_tahun_akademik()
    {
        $CI     =   & get_instance();
        $data   =   $CI->db->get_where('akademik_tahun_akademik',array('status'=>'y'))->row_array();
        return $data['tahun_akademik_id'];
    }
    
    function chek_bayar($nim,$jenis_bayar,$kode)
    {
        // 01 jumlah harus bayar dan 02 jumlah yang sudah dibayar
        $CI     =   & get_instance();
        $m      =   $CI->db->query("select konsentrasi_id,angkatan_id from student_mahasiswa where nim='$nim'")->row_array();
        if($kode==01)
        {

            $j=$CI->db->get_where('keuangan_biaya_kuliah',array( 'jenis_bayar_id'=>$jenis_bayar,'angkatan_id'=>$m['angkatan_id'],'konsentrasi_id'=>$m['konsentrasi_id']))->row_array();
            return  $j['jumlah'];
        }
        else
        {
            $sql="SELECT sum(jumlah) as total from keuangan_pembayaran_detail where nim='$nim' and jenis_bayar_id=$jenis_bayar";
            $data=$CI->db->query($sql);
            if($data->num_rows()>0)
            {
                $r=$data->row_array();
                return $r['total'];
            }
            else
            {
                return 0;
            }
        }
    }
    
    function chek_bayar_semester($nim,$semester)
    {
        $CI     =   & get_instance();
        $sql="  SELECT sum(jumlah) as jumlah 
                FROM keuangan_pembayaran_detail 
                WHERE nim='$nim' and jenis_bayar_id='3' and semester='$semester'";
        $data=$CI->db->query($sql);
        if($data->num_rows()>0)
        {
            $r  =   $data->row_array();
            return $r['jumlah'];
        }
        else
        {
            return 0;
        }
    }
    
    function jml_spp_konsentrasi($konsentrasi_id,$tahun_akademik_id)
    {
        $CI     =   & get_instance();
        $tahun=  getField('akademik_tahun_akademik', 'tahun_akademik_id', 'tahun', $tahun_akademik_id);
        $data=$CI->db->get_where('keuangan_biaya_kuliah',array('jenis_bayar_id'=>3,'konsentrasi_id'=>$konsentrasi_id,'angkatan_id'=>$tahun_akademik_id));
        if($data->num_rows()>0)
        {
            $r=$data->row_array();
            return $r['jumlah'];
        }
        else
        {
            return 'empty';
        }
        //return $tahun_akademik_id;
    }
    
    
    
        function jml_spp_konsentrasi2($konsentrasi_id,$tahun_akademik_id)
    {
        $CI     =   & get_instance();
        $tahun=  getField('akademik_tahun_akademik', 'tahun_akademik_id', 'tahun', $tahun_akademik_id);
        $data=$CI->db->get_where('keuangan_biaya_kuliah',array('jenis_bayar_id'=>3,'konsentrasi_id'=>$konsentrasi_id,'angkatan_id'=>$tahun_akademik_id));
        if($data->num_rows()>0)
        {
            $r=$data->row_array();
            return $r['jumlah'];
        }
        else
        {
            return 'empty';
        }
        //return $tahun_akademik_id;
    }
    
    
    function status_registrasi($tahun_akademik_id,$nim,$field)
    {
        $CI     =   & get_instance();
        $data=$CI->db->get_where('akademik_registrasi',array('nim'=>$nim,'tahun_akademik_id'=>$tahun_akademik_id));
        if($data->num_rows()<0)
        {
            return '';
        }
        else
        {
            $r=$data->row_array();
            return $r[$field];
        }
    }

    function users_keterangan($level,$keterangan)
    {
        if($level==2)
        {
            
            return getField('akademik_prodi', 'nama_prodi', 'prodi_id', $keterangan);
        }
        elseif($level==3)
        {
            return getField('app_dosen', 'nama_lengkap', 'dosen_id', $keterangan);
        }
        else
        {
            return '';
        }
    }
    
    function akses_admin()
    {
         $CI     =   & get_instance();
        $sess=$CI->session->userdata('level');
        if($sess!=1)
        {
            redirect('message'); 
        }
    }
    
    function akses_dosen()
    {
        $CI     =   & get_instance();
        $sess   =   $CI->session->userdata('level');
        $dosen  =   $CI->session->userdata('keterangan');
        if($sess==3)
        {
            // chek id ada atau tidak
            $chek   =$CI->db->get_where('app_dosen',array('dosen_id'=>$dosen))->num_rows();
            if($chek<1)
            {
                redirect('auth/login');
            }
        }
        else
        {
            redirect('auth/login');
        }
    }
    
    function chek_jadwal_kuliah($konsentrasi,$hari,$tahun_akademik,$semester,$no)
    {
        $CI     =   & get_instance();
        $sql="  SELECT jk.jam_mulai,jk.jam_selesai,ah.hari,mm.nama_makul,ar.nama_ruangan,ad.nama_lengkap
                FROM akademik_jadwal_kuliah as jk,app_hari as ah,makul_matakuliah as mm,app_ruangan as ar,app_dosen as ad 
                WHERE jk.hari_id=ah.hari_id and mm.makul_id=jk.makul_id and ar.ruangan_id=jk.ruangan_id and ad.dosen_id=jk.dosen_id 
                and jk.tahun_akademik_id='$tahun_akademik' and jk.konsentrasi_id='$konsentrasi' and jk.semester='$semester' and jk.hari_id='$hari' limit $no,1";
        $data=$CI->db->query($sql);
        if($data->num_rows()>0)
        {
            $r=$data->row_array();
            return $r['nama_makul'].'<br>'.  strtoupper($r['nama_lengkap']).'<br><b>'.  strtoupper($r['hari']).', '.$r['jam_mulai'].' - '.$r['jam_selesai'].'</b><br>RUANGAN '.  strtoupper($r['nama_ruangan']);
        }
        else
        {
            return '';
        }
    }
}
