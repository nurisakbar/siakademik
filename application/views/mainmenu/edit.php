<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Edit Record</li>
    </ol>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
      <?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[id_mainmenu]'>";
$level=array(1=>'Admin',2=>'Pihak Jurusan',3=>'Dosen');
$class      ="class='form-control' id='level'";
?>
<table class="table table-bordered">
    
       <tr>
    <td width="150">Nama Main Menu</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama Main Menu ..', 1, $r['nama_mainmenu'],'');?>
    </td>
    </tr>
    
      <tr>
    <td width="150">Link</td><td>
        <?php echo inputan('text', 'link','col-sm-5','Link ...', 1, $r['link'],'');?>
    </td>
    </tr>
   
      <tr>
    <td width="150">Icon</td><td>
        <?php echo inputan('text', 'icon','col-sm-2','Icon', 0, $r['icon'],'');?>
    </td>
    </tr>
        <tr>
    <td width="150">Level</td><td>
        <div class="col-sm-3">
        <?php echo form_dropdown('level',$level,$r['level'],$class);?>
        </div>  
    </td>
    </tr>
    <tr><td></td><td> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger">
             <?php
          echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));
          ?>
        </td></tr>
</table>
  </div></div>
</form>