<?php
echo anchor($this->uri->segment(1),'Kembali',array('class'=>'btn btn-danger'));
?> 
<hr>
<table class="table table-bordered">
    <tr><td width="100">Nama Prodi</td><td>  : <?php echo strtoupper($j['nama_prodi']);?></td></tr>
     <tr><td>Ketua</td><td>: <?php echo strtoupper($j['ketua']);?></td></tr>
      <tr><td>Izin</td><td>: <?php echo strtoupper($j['no_izin']);?></td></tr>
</table>
<div class="table-responsive">
    <?php
    echo $table;
    ?>
</div>
<?php
echo $pagination;
?>