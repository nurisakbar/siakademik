<?php
echo form_open_multipart($this->uri->segment(1).'/konsentrasipost');
$jenjang    =array(1=>'D1',2=>'D2',3=>'D3',4=>'D4');
$semester   =array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8);
$class      ="class='form-control'";
?>
<table class="table table-bordered">
    <tr class="success"><td colspan="2">INPUT KONSENTRASI</td></tr>
    <tr>
    <td width="150">Nama Prodi</td><td>
        <?php echo buatcombo('prodi', 'akademik_prodi', 'col-sm-3', 'nama_prodi', 'prodi_id', '', '');?>
    </td>
    </tr>
    <tr>
    <td width="150">Nama Konsentrasi</td><td>
        <?php echo inputan('text', 'nama','col-sm-5','Nama prodi ..', 1, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Ketua</td><td>
        <?php echo inputan('text', 'ketua','col-sm-4','Ketua ..', 1, '','');?>
    </td>
    </tr>
    
        <tr>
    <td width="150">Jenjang  / Semester</td><td>
        <div class="col-sm-2">
        <?php echo form_dropdown('jenjang',$jenjang,'',$class);?>
        </div>
        <div class='col-sm-2'>
        <?php echo form_dropdown('semester',$semester,'',$class);?>
        </div>
    </td>
    </tr>
    
        
        <tr>
    <td width="150">Gelar</td><td>
        <?php echo inputan('text', 'gelar','col-sm-2','Gelar ..', 1, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Kode No</td><td>
        <?php echo inputan('text', 'kode','col-sm-3','Kode Nomor ..', 1, '','');?>
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
</form>