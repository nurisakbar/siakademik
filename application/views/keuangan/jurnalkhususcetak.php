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