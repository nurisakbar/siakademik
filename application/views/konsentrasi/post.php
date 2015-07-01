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
$jenjang    =array('d1'=>'D1','d2'=>'D2','d3'=>'D3','d4'=>'D4','s1'=>'S1');
$semester   =array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8);
$class      ="class='form-control'";
?><div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
   
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
        <?php echo inputan('text', 'ketua','col-sm-4','Ketua ..', 0, '','');?>
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
        <?php echo inputan('text', 'gelar','col-sm-2','Gelar ..', 0, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Kode No</td><td>
        <?php echo inputan('text', 'kode','col-sm-3','Kode Nomor ..', 0, '','');?>
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