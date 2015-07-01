<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>


<script src="<?php echo base_url();?>assets/js/1.8.2.min.js"></script>
 
  <script>
  $( document ).ready(function() { 
      hidesemster();
  });
</script>

  <script type="text/javascript">
$(document).ready(function(){
  $("#jenis_pembayaran").change(function(){
       hidesemster();
  });
});
</script>

<script type="text/javascript">
function hidesemster()
{
     var jenis_pembayaran=$("#jenis_pembayaran").val();
        if(jenis_pembayaran==3)
            {
                $("#semester").show()
            }
            else
                {
                     $("#semester").hide()
                }
}
</script>
<?php
echo $this->session->flashdata('pesan');
$status=array(0=>'Lunas',1=>'Pembayaran Ke 1',2=>'Pembayaran Ke 2',3=>'Pembayaran Ke 3',4=>'Pembayaran Ke 4');
?>
<?php
echo form_open('keuangan/pembayaran');
?>
<div class="col-sm-6">    
<table class="table table-bordered">
    <tr  class="success"><th colspan="3">Data Mahasiswa </th></tr>
    <tr><td width="120">NIM Mahasiswa</td><td> <?php echo inputan('text', 'nim','col-sm-6','Masukan Nim ..', 1, '','');?> <input type="submit" value="OK" name="submit" class="btn btn-danger"> <?php echo anchor('keuangan/reset','Reset',array('class'=>'btn btn-danger'));?></td>
        <td wisth="90" align="center" rowspan="3"><img src="<?php echo base_url()?>assets/images/noprofile.gif" width="85"></td>
    </tr>
    <tr><td>Nama</td><td>  : <?php echo $statuss=="kosong"?"":strtoupper($profile['nama'])?></td></tr>
    <tr><td>Prodi /Konsentrasi</td><td> : <?php echo $statuss=="kosong"?"":strtoupper($profile['nama_konsentrasi'].' / '.$profile['nama_prodi'])?></td></tr>
 
</table>
</form>
</div>
<?php
echo form_open('keuangan/pembayaran');
?>
<div class="col-sm-6">
    <table class="table table-bordered">
        <tr  class="success"><th colspan="2">Form Transaksi</th></tr>
        <tr><td width="130">Jenis Pembayaran</td><td>
            <?php echo buatcombo('jenis','keuangan_jenis_bayar','col-sm-6','keterangan','jenis_bayar_id','',array('id'=>'jenis_pembayaran')); ?>
                <div class="col-md-6">
                    <select name="semester" id="semester" class="form-control">
                        <?php 
                        for($sms=1;$sms<=8;$sms++)
                        {
                            echo "<option VALUE='$sms'>SEMESTER $sms</option>";
                        }
                        ?>
                    </select>
                </div>
            </td></tr>
       
        <tr><td>Jumlah Bayar</td><td><?php echo inputan('text', 'jumlah','col-sm-8','Jumlah ..', 1, '','');?> <input type="submit" name="submit2" value="Simpan" class="btn btn-danger"></td></tr>
    </table>
</div>
</form>
<?php
if($statuss!="kosong"){
?>
<table class="table table-bordered">
    <tr class="success"><th colspan="7">Riwayat Transaksi</th></tr>
    <tr><th width="10">No</th>
        <th width="240">Jenis Pembayaran</th>
        <th width="180">Harus Dibayar</th>
        <th width="180">Sudah Dibayar</th>
        <th width="80">Sisa</th>
        <th width="100">Persentase %</th>
        <th>Keterangan</th></tr>
    <?php
    
    // tahun akademik ketika masuk
    $tahun_akademik_id=  getField('student_mahasiswa', 'angkatan_id', 'nim', $nim);
    // konsentrasi
    $konsentrasi_id=getField('student_mahasiswa', 'konsentrasi_id', 'nim', $nim);
    $no=1;
        foreach ($jenis_bayar as $jb)
        {
            $jumlah_bayar   =(int) get_biaya_kuliah($tahun_akademik_id, $jb->jenis_bayar_id, $konsentrasi_id, 'jumlah');
            $sudah_bayar    = (int)get_biaya_sudah_bayar($nim, $jb->jenis_bayar_id);
            $sisa           = $jumlah_bayar-$sudah_bayar;
            $ket           = $sisa<=0?'Lunas':'Tunggakan '.rp($sisa);
            echo "<tr><td>$no</td>
                <td>".  strtoupper($jb->keterangan)."</td>
                <td>".rp($jumlah_bayar)."</td>
                <td>".rp($sudah_bayar)."</td>
                <td>".rp($sisa)."</td>
                <td>".  get_persentase_pembayaran($jumlah_bayar, $sudah_bayar)." %</td>
                <td>$ket</td>
                </tr>";
            $no++;
        }
       // get semester aktif
       $smt_aktif = getField('student_mahasiswa', 'semester_aktif', 'nim', $nim);
        // looping semester
        for($i=1;$i<=$smt_aktif;$i++)
        {
            $spp            =   (int) get_biaya_kuliah($tahun_akademik_id, 3, $konsentrasi_id, 'jumlah');
            $spp_udah_bayar =   (int)get_semester_sudah_bayar($nim, $i);
            $sisa           =   $spp-$spp_udah_bayar;
            $keterangan           =   $sisa<=0?'Lunas':'Tunggakan '.$sisa;
            echo "<tr><td>$no</td>
                <td>SPP SEMESTER $i</td>
                <td>".rp($spp)."</td>
                <td>".rp($spp_udah_bayar)."</td>
                <td>$sisa</td>
                <td>".  rp(get_persentase_pembayaran($spp, $spp_udah_bayar))." %</td>
                <td>$keterangan</td></tr>";
            $no++;
        }
    ?>
    <tr><td colspan="7"><?php echo anchor('keuangan/cetakpersonal','Cetak Data',array('class'=>'btn btn-danger','target'=>'new'))?></td></tr>
</table>

<table class="table table-bordered">
    <tr class="success"><th colspan="7">Riwayat Transaksi Detail</th></tr>
    <tr><th width="10">No</th>
        <th width="500">Jenis Pembayaran</th>
        <th width="120">Tanggal</th>
        <th width="160">Jumlah</th>
        <th width="200">Petugas</th><th width="10">Operasi</th></tr>
    <?php
    $i=1;
    
    foreach ($transaksi as $r)
    {
        $smt=$r->jenis_bayar_id==3?$r->semester:'';
        echo "<tr>
            <td>$i</td>
            <td>".  strtoupper($r->keterangan)." $smt</td>
            <td>".  tgl_indo($r->tanggal)."</td>
            <td>Rp .".rp((int)$r->jumlah)."</td>
            <td>".  strtoupper($r->nama)."</td>
            <td align='center'>".anchor('keuangan/delete/'.$r->pembayara_detail_id,'<i class="fa fa-trash-o"></i>',array('title'=>'Hapus Catatan'))."</td></tr>";
        $i++;
    }
    ?> 
</table>


<?php
}
else
{
?>

<?php } ?>
