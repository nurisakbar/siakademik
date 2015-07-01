<style type="text/css">
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
        padding: 4px;
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
<h3 style="border: 1px solid #000;padding: 10px;">JADWAL KULIAH <BR>SEMESTER GENAP TAHUN AKADEMIK 2014-2015</h3>
<table>
    <tr>
        <td rowspan="3"><img src="<?php echo base_url()?>assets/images/logo.png" width="100" style="float: left;margin-right: 10px;">
            <h3>POLITEKNIK TEDC BANDUNG</h3>
                        Jl.Politeknik - Pasantren,Km. 2 Cibabat - Cimahi Utara 40513, Jawa Barat<br>				
                        Telp / Fax : 022 - 6645951<br>							
                        Email : poltek_tedc@yahoo.com</td>
        <td style="font-weight: bold">Program Studi</td><td style="font-weight: bold">: <?php echo $prodi;?></td>
    </tr>
    <tr style="font-weight: bold"><td>Konsentrasi</td><td>: <?php echo $konsentrasi;?></td></tr>
     <tr style="font-weight: bold"><td>Semester</td><td> : <?php echo $semester;?></td></tr>
</table>

<br>
<table border="1" cellspacing="0" style="border: 1px solid #000;">
    <tr><th>NO</th>
    <?php
    for($i=1;$i<=7;$i++)
    {
        echo "<th width=160>".  strtoupper($hari[$i])."</th>";
    }
    ?>
    </tr>
    <?php
    for($i=1;$i<=5;$i++)
    {
        echo "<tr><td>$i</td>";
        for($h=1;$h<=7;$h++)
        {
            echo "<td style='text-align: center'>".  chek_jadwal_kuliah($konsen, $h, $tahun,$semester,$i-1)."</td>";
        }
        echo"</tr>";
    }
    ?>
</table>

<table style="font-weight: bold;">
    <tr><td>Ket</td><td>:1 SKS Teori adalah 1 jam =  40 menit<br> 1 SKS Praktek adalah 2 Jam    = 80 menit</td></tr>
    <tr><td>Catatan</td><td>: Pergantian Jadwal Kuliah baik Dosen maupun Jurusan harap menghubungi bag. Akademik</td></tr>
</table>

<table style="font-weight: bold;">
    <tr><td width="500">Mengetahui<br>Pembantu Direktur I<br>Bidang Akademik</td><td>Cimahi, Januari 2014<br>Ka. Jurusan<br>Sekretaris Jurusan</td></tr>
    <tr><td height="100">Dendin Supriadi, S.Pd.,MT</td><td>Wali Muhammad, ST., M.Kom</td></tr>
</table>