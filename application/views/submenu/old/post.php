<?php
echo form_open_multipart($this->uri->segment(1).'/post');
?>
<table class="table table-bordered">
    <tr class="success"><td colspan="2">INPUT SUBMENU</td></tr>
    <tr>
    <td width="150">Nama Submenu</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama Sub Menu ..', 1, '','');?>
    </td>
    </tr>
        <tr>
    <td width="150">Mainmenu</td><td>
        <?php echo $this->generatehtml->buatcombo('mainmenu','mainmenu','col-sm-3','nama_mainmenu','id_mainmenu','',''); ?>
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
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
</form>