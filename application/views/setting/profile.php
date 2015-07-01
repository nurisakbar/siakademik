<?php
echo form_open($this->uri->segment(1).'/profilekampus');
echo "<input type='hidden' name='id' value='$r[id]'>";
$class="class='form-control'";
?>
<table class="table table-bordered">
    <tr class="success"><td colspan="2">PROFILE KAMPUS</td></tr>
    <tr>
    <td width="150">Nama Kampus</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama Lengkap ..', 1, $r['nama_kampus'],'');?>
    </td>
    </tr>
 
            <tr>
    <td width="150">Alamat</td><td>
        <?php echo textarea('alamat', '', 'col-sm-5', 2, $r['alamat_kampus']);?>
    </td>
    </tr>
      <tr>
    <td width="150">No Telpon</td><td>
        <?php echo inputan('text', 'telpon','col-sm-4','No Telpon ..', 1, $r['telpon'],'');?>
    </td>
    </tr>
           
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
</form>