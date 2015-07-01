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
    }
    td{
        font-size: 12px;
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
<table>
    <tr><td width="100">NIM</td><td>: <?php echo strtoupper($biodata['nim'])?></td></tr>
     <tr><td>NAMA</td><td>: <?php echo strtoupper($biodata['nama'])?></td></tr>
      <tr><td>KONSENTRASI</td><td>: <?php echo strtoupper($biodata['nama_konsentrasi'])?></td></tr>
</table>
<hr style="color: black;">
<table border="1" cellspacing="0">
   
    <tr><th width="10">No</th>
        <th width="500">Jenis Pembayaran</th>
        <th width="160">Jumlah Bayar</th>
        <th width="200">Sudah Bayar</th>
    <th width="150">Sisa</th>
    </tr>
        
    <?php
    // tahun akademik ketika masuk
    $tahun_akademik_id=  getField('student_mahasiswa', 'angkatan_id', 'nim', $biodata['nim']);
    // konsentrasi
    $konsentrasi_id=getField('student_mahasiswa', 'konsentrasi_id', 'nim', $biodata['nim']);
    $no=1;
    $sisa_total=0;
        foreach ($jenis_bayar as $jb)
        {
            $jumlah_bayar   =(int) get_biaya_kuliah($tahun_akademik_id, $jb->jenis_bayar_id, $konsentrasi_id, 'jumlah');
            $sudah_bayar    = (int)get_biaya_sudah_bayar($biodata['nim'], $jb->jenis_bayar_id);
            $sisa           = $jumlah_bayar-$sudah_bayar;
            $ket           = $sisa<=0?'Lunas':'Tunggakan '.rp($sisa);
            echo "<tr><td>$no</td>
                <td>".  strtoupper($jb->keterangan)."</td>
                <td>".rp($jumlah_bayar)."</td>
                <td>".rp($sudah_bayar)."</td>
                <td>".rp($sisa)."</td>
                </tr>";
            $no++;
            $sisa_total=$sisa_total+$sisa;
        }
        // looping semester
        for($i=1;$i<=$semester;$i++)
        {
            $spp            =   (int) get_biaya_kuliah($tahun_akademik_id, 3, $konsentrasi_id, 'jumlah');
            $spp_udah_bayar =   (int)get_semester_sudah_bayar($biodata['nim'], $i);
            $sisa           =   $spp-$spp_udah_bayar;
            $keterangan           =   $sisa<=0?'Lunas':'Tunggakan '.$sisa;
            echo "<tr><td>$no</td>
                <td>SPP SEMESTER $i</td>
                <td>".rp($spp)."</td>
                <td>".rp($spp_udah_bayar)."</td>
                <td>".rp($sisa)."</td>";
            $sisa_total=$sisa_total+$sisa;
            $no++;
        }
    ?>
    <tr><td colspan="4" align="left">Total Yang Belum Dibayar</td><td><?php echo  rp($sisa_total);?></td></tr>
</table>

<br><br>
Cimahi, <?php echo tgl_indo(substr(waktu(), 0,10))?><br>
Bagian Keuangan<BR></br><br><br><br>
(...........................)