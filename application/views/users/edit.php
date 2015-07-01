<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<script src="<?php echo base_url();?>assets/js/1.8.2.min.js"></script>
<script>
  $( document ).ready(function() {
    $( "#jurusan" ).hide();
  });
  </script>
  <script>
$(document).ready(function(){
    $("#level").change(function(){
        var level = $("#level").val();  
        if(level==2)
            {
                 $( "#jurusan" ).show();
            }
            else
            {
                   $( "#jurusan" ).hide();  
            }
  });
});
</script>
<?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[id_users]'>";
$level=array(1=>'Admin',2=>'Pihak Jurusan',3=>'Dosen');
$class      ="class='form-control' id='level'";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
  
    <tr>
    <td width="150">username</td><td>
        <?php echo inputan('text', 'username','col-sm-4','Username ..', 1, $r['username'],'');?>
    </td>
    </tr>
    <tr>
        <tr>
    <td width="150">Password</td><td>
        <?php echo inputan('password', 'password','col-sm-3','Password ..', 1, '','');?>
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