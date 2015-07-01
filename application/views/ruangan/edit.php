 <!-- Datatables -->
<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
     <?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[ruangan_id]'>";
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    
    <tr>
    <td width="150">Nama Ruangan</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama ruangan ..', 1, $r['nama_ruangan'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Gedung</td><td>
        <?php echo editcombo('gedung','app_gedung','col-sm-7','nama_gedung','gedung_id','','',$r['gedung_id']); ?>
    </td>
    </tr>
    <tr>
    <td width="150">Kapasitas</td><td>
        <?php echo inputan('text', 'kapasitas','col-sm-3','Kapastitas ..', 0, $r['kapasitas'],'');?>
    </td>
    </tr>
      <tr>
    <td width="150">Keterangan</td><td>
        <?php echo inputan('text', 'keterangan','col-sm-10','Keterangan ..', 0, $r['keterangan'],'');?>
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
 </div>
</div>
</form>