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
?>



<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Record</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered">
   
    <tr>
    <td width="150">Grade</td><td>
        <?php echo inputan('text', 'grade','col-sm-4','Grade ..', 1, '','');?>
    </td>
    </tr>
       <tr>
    <td width="150">Dari ,Sampai</td><td>
        <?php echo inputan('text', 'dari','col-sm-3','Example 7.9 ..', 1, '','');?> 
         <?php echo inputan('text', 'sampai','col-sm-3','Example 6.0', 1, '','');?>
    </td>
    </tr>
   <tr>
    <td width="150">Keterangan</td><td>
        <?php echo inputan('text', 'keterangan','col-sm-14','Keterangan ..', 1, '','');?>
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