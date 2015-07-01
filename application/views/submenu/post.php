<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<?php
echo form_open_multipart($this->uri->segment(1).'/post');
$level=array(1=>'Admin',2=>'Pihak Jurusan',3=>'Pegawai');
$class      ="class='form-control' id='level'";
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    
    <tr>
    <td width="150">Nama Submenu</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama Sub Menu ..', 1, '','');?>
    </td>
    </tr>
        <tr>
    <td width="150">Mainmenu</td><td>
        <?php echo buatcombo('mainmenu','mainmenu','col-sm-3','nama_mainmenu','id_mainmenu','',''); ?>
    </td>
    </tr>
      <tr>
    <td width="150">Link</td><td>
        <?php echo inputan('text', 'link','col-sm-5','Link ...', 1, '','');?>
    </td>
    </tr>
   
      <tr>
    <td width="150">Icon</td><td>
        <?php echo inputan('text', 'icon','col-sm-2','Icon', 0, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Level</td><td>
        <div class="col-sm-3">
        <?php echo form_dropdown('level',$level,'',$class);?>
        </div>  
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
</form>