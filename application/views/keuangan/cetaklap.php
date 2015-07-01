<body onload="window.print()">    
</body><style type="text/css">
    body
    {
        font-family: sans-serif;
        font-size: 14px;
    }
    th{
        padding: 5px;
        font-weight: bold;
        font-size: 12px;
        border-color: #7E7E7E;
    }
    td{
        font-size: 12px;
        padding: 3px;
    }
    h2{
        text-align: left;
        margin-bottom: 13px;
    }
    .potong
    {
        page-break-after:always;
    }
</style>
<h3>LAPORAN KEUANGAN POLITEKNIK TEDC BANDUNG</h3>

<?php
if($tahun_akademik==0)
{
    foreach ($tahun as $t)
    {
        ?>




<table  border="1" cellspacing="0" width="600">
    <tr><td width="140">TAHUN AKADEMIK</td><td>: <?php echo strtoupper(getField('student_angkatan', 'keterangan', 'angkatan_id', $t->angkatan_id))?></td></tr>
    <tr><td>KONSENTRASI</td><td>: <?php echo strtoupper(getField('akademik_konsentrasi', 'nama_konsentrasi', 'konsentrasi_id', $konsentrasi_id))?></td></tr>
</table>
<BR>
<table border="1" cellspacing="0" bordercolor="#7E7E7E">
    <tr><th rowspan="2">No</th><th rowspan="2">NIM</th><th rowspan="2" width="150">NAMA</th>
    <?php
    foreach ($jenis_bayar->result() as $j)
    {
        echo "<th colspan='2'>".strtoupper($j->keterangan)."</th>";
    }
    ?>
        <th rowspan="2">Tunggakan</th>
    </tr>
    <tr>
            <?php
    foreach ($jenis_bayar->result() as $j)
    {
        echo "<th width='50'>02</th><th  width='50'>03</th>";
    }
    ?>
    </tr>
    <?php
    $no=1;
    $tunggakan_total=0;
    $mahasiswa=$this->db->query("select nim,nama from student_mahasiswa where konsentrasi_id='$konsentrasi_id' and angkatan_id='$t->angkatan_id'")->result();
    foreach ($mahasiswa as $m)
    {
        echo "<tr><td>$no</td>
            <td>".  strtoupper($m->nim)."</td>
             <td>".  strtoupper($m->nama)."</td>";
        
        // jenis bayar
        $tunggakanms=0;
        foreach ($jenis_bayar->result() as $j)
        {
            $jml_bayar=  chek_bayar($m->nim, $j->jenis_bayar_id, 01);
            $sdh_bayar=  chek_bayar($m->nim, $j->jenis_bayar_id, 02);
            $tunggakan=$jml_bayar-$sdh_bayar;
            echo "<td align='right'>".rp((int) $sdh_bayar)."</td><td align='right'>".rp((int) $tunggakan)."</td>";
            $tunggakanms=$tunggakanms+$tunggakan;
        }
        $tunggakan_total=$tunggakan_total+ $tunggakanms;
        echo "<td align='right'>".rp((int) $tunggakanms)."</td></tr>";
        $no++;
    }
    ?>
    <tr><td colspan="3"></td><td align="right" colspan="<?php echo $jenis_bayar->num_rows()*2?>">Total Tunggakan</td><td align="right"><?php echo rp((int) $tunggakan_total)?></td></tr>
</table>
<Br>
<?php
$jml_semester=$this->db->query("SELECT max(semester_aktif) as max_semester FROM `student_mahasiswa` WHERE konsentrasi_id='$konsentrasi_id' and angkatan_id='$t->angkatan_id'")->row_array();
$jml_semester=$jml_semester['max_semester'];
?>
<table border="1" cellspacing="0" bordercolor="#7E7E7E">
    <tr><th>No</th><th>NIM</th><th>NAMA</th>
    <?php
for($i=1;$i<=$jml_semester;$i++)
{
    echo "<th>SEMESTER  $i</th>";
}
    ?><th>Tunggakan</th>
    </tr>
    <?php
    $i=1;
  
    $tunggakan_spp=0;
foreach ($mahasiswa as $m)
{$tunggakan=0;
    echo "<tr><td>$i</td>
        <td>".  strtoupper($m->nim)."</td>
        <td>".  strtoupper($m->nama)."</td>";
    for($i=1;$i<=$jml_semester;$i++)
{
        $jml_spp= jml_spp_konsentrasi2($konsentrasi_id, $t->angkatan_id);
        $sdh_bayar=chek_bayar_semester($m->nim, $i);
    echo "<td align='right'>". rp((int) $sdh_bayar)."</td>";
            $tunggakan=$tunggakan+($jml_spp-$sdh_bayar);
}
echo "<td align='right'>".rp((int) $tunggakan)."</td>";
$tunggakan_spp=$tunggakan_spp+$tunggakan;
    $i++;
}
    ?>
    
</tr>
<tr><td colspan="<?php echo $jml_semester+3?>"></td><td align="right"><?php echo rp((int) $tunggakan_spp)?></td></tr>
</table>


<hr>


<?php
    }
}
else
{
?>
<table  border="1" cellspacing="0" width="600">
    <tr><td width="140">TAHUN AKADEMIK</td><td>: <?php echo strtoupper(getField('student_angkatan', 'keterangan', 'angkatan_id', $tahun_akademik))?></td></tr>
    <tr><td>KONSENTRASI</td><td>: <?php echo strtoupper(getField('akademik_konsentrasi', 'nama_konsentrasi', 'konsentrasi_id', $konsentrasi_id))?></td></tr>
</table>
<BR>
<table border="1" cellspacing="0" bordercolor="#7E7E7E">
    <tr><th rowspan="2">No</th><th rowspan="2">NIM</th><th rowspan="2" width="150">NAMA</th>
    <?php
    foreach ($jenis_bayar->result() as $j)
    {
        echo "<th colspan='2'>".strtoupper($j->keterangan)."</th>";
    }
    ?>
        <th rowspan="2">Tunggakan</th>
    </tr>
    <tr>
            <?php
    foreach ($jenis_bayar->result() as $j)
    {
        echo "<th width='50'>02</th><th  width='50'>03</th>";
    }
    ?>
    </tr>
    <?php
    $no=1;
    $tunggakan_total=0;
    $mahasiswa=$this->db->query("select nim,nama from student_mahasiswa where konsentrasi_id='$konsentrasi_id' and angkatan_id='$tahun_akademik'")->result();
    foreach ($mahasiswa as $m)
    {
        echo "<tr><td>$no</td>
            <td>".  strtoupper($m->nim)."</td>
             <td>".  strtoupper($m->nama)."</td>";
        
        // jenis bayar
        $tunggakanms=0;
        foreach ($jenis_bayar->result() as $j)
        {
            $jml_bayar=  chek_bayar($m->nim, $j->jenis_bayar_id, 01);
            $sdh_bayar=  chek_bayar($m->nim, $j->jenis_bayar_id, 02);
            $tunggakan=$jml_bayar-$sdh_bayar;
            echo "<td align='right'>".rp((int) $sdh_bayar)."</td><td align='right'>".rp((int) $tunggakan)."</td>";
            $tunggakanms=$tunggakanms+$tunggakan;
        }
        $tunggakan_total=$tunggakan_total+ $tunggakanms;
        echo "<td align='right'>".rp((int) $tunggakanms)."</td></tr>";
        $no++;
    }
    ?>
    <tr><td colspan="3"></td><td align="right" colspan="<?php echo $jenis_bayar->num_rows()*2?>">Total Tunggakan</td><td align="right"><?php echo rp((int) $tunggakan_total)?></td></tr>
</table>
<Br>
<?php
$jml_semester=$this->db->query("SELECT max(semester_aktif) as max_semester FROM `student_mahasiswa` WHERE konsentrasi_id='$konsentrasi_id' and angkatan_id='$tahun_akademik'")->row_array();
$jml_semester=$jml_semester['max_semester'];
?>
<table border="1" cellspacing="0" bordercolor="#7E7E7E">
    <tr><th>No</th><th>NIM</th><th>NAMA</th>
    <?php
for($i=1;$i<=$jml_semester;$i++)
{
    echo "<th>SEMESTER  $i</th>";
}
    ?><th>Tunggakan</th>
    </tr>
    <?php
    $i=1;
  
    $tunggakan_spp=0;
foreach ($mahasiswa as $m)
{$tunggakan=0;
    echo "<tr><td>$i</td>
        <td>".  strtoupper($m->nim)."</td>
        <td>".  strtoupper($m->nama)."</td>";
    for($i=1;$i<=$jml_semester;$i++)
{
        $jml_spp= jml_spp_konsentrasi2($konsentrasi_id, $tahun_akademik);
        $sdh_bayar=chek_bayar_semester($m->nim, $i);
    echo "<td align='right'>". rp((int) $sdh_bayar)."</td>";
            $tunggakan=$tunggakan+($jml_spp-$sdh_bayar);
}
echo "<td align='right'>".rp((int) $tunggakan)."</td>";
$tunggakan_spp=$tunggakan_spp+$tunggakan;
    $i++;
}
    ?>
    
</tr>
<tr><td colspan="<?php echo $jml_semester+3?>"></td><td align="right"><?php echo rp((int) $tunggakan_spp)?></td></tr>
</table>
<?php
}
?>