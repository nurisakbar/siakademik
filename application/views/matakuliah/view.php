<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
 
 <script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>
<script>
$(document).ready(function(){
    loadkonsentrasi();
});
</script>

<script>
$(document).ready(function(){
  $("#konsentrasi").change(function(){
      loadsemester();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#prodi").change(function(){
      loadkonsentrasi();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#semester").change(function(){
      tampilmakul();
  });
});
</script>

<script type="text/javascript">
function loadkonsentrasi()
{
    var prodi=$("#prodi").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilkonsentrasi",
    data:"prodi=" + prodi ,
    success: function(html)
    { 
       $("#konsentrasi").html(html);
       loadsemester();
    }
          });
}

function hapus(id)
{
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/delete",
    data:"id=" + id ,
    success: function(html)
    { 
       $("#hide"+id).hide(300);
    }
          });   
}

function ubahstatus(id)
{
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/ubahstatus",
    data:"id=" + id ,
    success: function(html)
    { 
        tampilmakul();
    }
          });  
}
function loadsemester()
{
    var konsentrasi=$("#konsentrasi").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilsemester",
    data:"konsentrasi=" + konsentrasi ,
    success: function(html)
    { 
       $("#semester").html(html);
       tampilmakul();
    }
          });
    
}


function tampilmakul()
{
    var konsentrasi=$("#konsentrasi").val();
    var semester=$("#semester").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilmakul",
    data:"konsentrasi=" + konsentrasi +"&semester="+semester ,
    success: function(html)
    { 
       $("#makul").html(html);
      
    }
          });
    
}
</script>

<?php
if($this->session->userdata('level')==1)
{
    $param="";
}
else
{
    $param=array('prodi_id'=>$this->session->userdata('keterangan'));
}
?>
<div class="col-sm-3">
    <table class="table table-bordered">
       
    <tr><td>Program Studi <?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', $param, array('id'=>'prodi'))?></td></tr>
    <tr><td>Konsentrasi <?php echo combodumy('konsentrasi', 'konsentrasi')?></td></tr>
    <tr><td>Semester <?php echo combodumy('semester', 'semester')?></td></tr>
    <tr><td><?php echo anchor('matakuliah/post','<span class="glyphicon glyphicon-plus"></span> Input Data',array('class'=>'btn btn-primary  btn-sm'));?> 
        <?php //echo anchor('matakuliah/#','<span class="glyphicon glyphicon-print"></span> Cetak Data',array('class'=>'btn btn-primary  btn-sm'));?></td></tr>
</table>
</div>

<div class="col-sm-9">
    
    <table class="table table-bordered" id="makul">
        <tr><th width="5">No</th><th width="100">Kode</th><th width="50">Kelompok</th><th>Matakuliah</th><th width="40">SKS</th><th colspan="3">Operasi</th></tr>
    </table>
</div>
