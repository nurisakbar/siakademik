<?php
$status=array(0=>'Lunas',1=>'Pembayaran Ke 1',2=>'Pembayaran Ke 2',3=>'Pembayaran Ke 3',4=>'Pembayaran Ke 4');
echo form_open('keuangan/jurnalkhusus');
?>
<table class="table table-bordered">
    <tr class="success"><td colspan="2">JURNAL KHUSUS</td></tr>
    <tr><td width="150">Tanggal Mulai</td><td><?php echo inputan('text', 'tanggal1','col-sm-3','Tanggal Awal ..', 1, $tanggal1,array('id'=>'datepicker'));?></td></tr>
     <tr><td>Tanggal Sampai</td><td><?php echo inputan('text', 'tanggal2','col-sm-3','Tanggal Akhir ..', 1, $tanggal2,array('id'=>'datepicker1'));?></td></tr>
     <tr><td colspan="2"><input type="submit" name="submit" value="Preview" class="btn btn-danger  btn-sm"> 
              <?php echo anchor(base_url().'keuangan/cetakjurnalkhusus/'.$tanggal1.'/'.$tanggal2.'/cetak','cetak',array('class'=>'btn btn-danger   btn-sm','target'=>'_blank'))?>
             <?php echo anchor(base_url().'keuangan/cetakjurnalkhusus/'.$tanggal1.'/'.$tanggal2.'/download','Export Ke Ms.Word',array('class'=>'btn btn-danger   btn-sm','target'=>'_blank'))?>
         </td></tr>
</table>
</form>
<?php
if(isset($_POST['submit']))
{
?>
<table class="table table-bordered">
  <tr>
    <th width="15" rowspan="2">No</th>
    <th rowspan="2">Tanggal</th>
    <th colspan="3"><p  align="center">Keterangan</p></th>
    <th colspan="3"><p  align="center">Kas (Debit)</p> </th>
    <th rowspan="2"><p  align="center">Pendapatan Kredit </p></th>
  </tr>
  <tr>
    <th>Nim</th>
    <th>Nama</th>
    <th >Jenis Pembayaran </th>
   
    <th>Biaya Kuliah Reguler </th>
    <th>Biaya Wisuda </th>
    <th>Lain Lain </th>
  
  </tr>
      <?php
    $no=1;
    $jumlah=0;
    $totalsmpp=0;
    $totalwisuda=0;
    $totallain=0;
    foreach ($transaksi as $r)
    {
        $spp=testing($r->jenis_bayar_id ,3,$r->jumlah);
        $wisuda=testing($r->jenis_bayar_id ,7,$r->jumlah);
        $lain=testing2($r->jenis_bayar_id ,$r->jumlah);
  echo "<tr>
    <td>$no</td>
    <td width='90'>".  tgl_indo($r->tanggal)."</td>
    <td width='40'>".  strtoupper($r->nim)."</td>
    <td>". strtoupper($r->nama)."</td>
    <td>".  strtoupper($r->jenis_bayar)."</td>
    <td>".$spp  ."</td>

 
    <td>". $wisuda ."</td>
    <td>". $lain ."</td>
   <td>$r->jumlah</td>
  </tr>";
  $no++;
  $totallain=$totallain+$lain;
  $totalsmpp=$totalsmpp+$spp;
  $totalwisuda=$totalwisuda+$wisuda;
    }
    ?>
    <tr>
    <td colspan=5><p align="right" >Total</p></td>
    <td><?php echo rp((int)$totalsmpp);?></td>
     <td><?php echo rp($wisuda);?></td>
     <td><?php echo rp($totallain);?></td>
    <td><?php echo rp($totalsmpp+$totallain+$totalwisuda);?></td>

  </tr>
  <tr>
      <td colspan="5"><p align="right" >Jumlah Debit</p></td>
      <td colspan="3"><p align="right" ><?php echo rp($totalsmpp+$totallain+$totalwisuda);?></p></td>

      <td><?php echo rp($totalsmpp+$totallain+$totalwisuda);?></td>
  </tr>
</table>
<?php } ?>


