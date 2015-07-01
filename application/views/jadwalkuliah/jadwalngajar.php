<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>



<div class="col-md-14">
    <table class="table table-bordered">
        <tr><th width="150">Nama Dosen</th><th> : <?php echo getField('app_dosen', 'nama_lengkap', 'dosen_id', $dosen)?></th></tr>
        <tr><th>Tahun Akdemik</th><th> : <?php echo get_tahun_ajaran_aktif('keterangan')?></th></tr>
    </table>
    <table class="table table-bordered">
        <tr class="success"><th colspan="8">Jadwal Mengajar</th></tr>
        <tr><th>No</th><th>Jurusan</th><th>Kode</th><th>Matakuliah</th><th>Hari</th><th>Ruangan</th><th>Jam</th><th>SKS</th></tr>
        <?php
        $no=1;
        foreach ($jadwal as $j)
        {
            echo"<tr>
                <td width='10'>$no</td>
                <td>".  strtoupper($j->jenjang.' - '.$j->nama_konsentrasi)."</td>
                <td>$j->kode_makul</td>
                <td>".  strtoupper($j->nama_makul)."</td>
                <td width='130'>".  strtoupper($j->hari)."</td>
                <td width='130'>".  strtoupper($j->nama_ruangan)."</td>
                <td width='160'>$j->jam_mulai - $j->jam_selesai</td>
                <td width='60'>$j->sks SKS</td>
                </tr>";
        $no++;
        }
        ?>
    </table>
</div>