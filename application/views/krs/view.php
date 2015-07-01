<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
 
 <script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>

<script>
$(document).ready(function(){
          loadjurusan();
         
  });
</script>

<script>
$(document).ready(function(){
  $("#prodi").change(function(){
      loadjurusan()
  });
});
</script>

<script>
$(document).ready(function(){
  $("#konsentrasi").change(function(){
      loadmahasiswa();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#tahun_angkatan").change(function(){
      loadjurusan()
  });
});
</script>

<script>
$(document).ready(function(){
  $("#input").click(function(){
      loadtablemapel();
  });
});
</script>

<script type="text/javascript">
function loadmahasiswa()
{
    var konsentrasi=$("#konsentrasi").val();
    var tahun_angkatan=$("#tahun_angkatan").val();
    $.ajax({
    url:"<?php echo base_url();?>krs/tampilkanmahasiswa",
    data:"konsentrasi=" + konsentrasi + "&tahun_angkatan=" + tahun_angkatan ,
    success: function(html)
       {
          $("#list").html(html);
       }
       });
}
</script>

<script type="text/javascript">


function loadjurusan()
{
    var prodi=$("#prodi").val();
    $.ajax({
	url:"<?php echo base_url();?>mahasiswa/tampilkankonsentrasi",
	data:"prodi=" + prodi ,
	success: function(html)
	{
            $("#konsentrasi").html(html);
            loadmahasiswa();
	}
	});
}
</script>


<script type="text/javascript">
function loaddata(mahasiswa_id)
{
        $.ajax({
	url:"<?php echo base_url();?>krs/loaddata",
	data:"id_mahasiswa=" + mahasiswa_id ,
	success: function(html)
	{
            $("#daftarkrs").html(html);
	}
	});
}


function loadtablemapel(id)
{
    var konsentrasi=$("#konsentrasi").val();
    $.ajax({
	url:"<?php echo base_url();?>krs/loadmapel",
	data:"konsentrasi=" + konsentrasi +"&mahasiswa_id="+id,
	success: function(html)
	{
            $("#daftarkrs").html(html); 
	}
	});
}


function ambil(jadwal_id,mahasiswa_id)
{
    $.ajax({
	url:"<?php echo base_url();?>krs/post",
	data:"jadwal_id=" + jadwal_id+"&mahasiswa_id="+mahasiswa_id ,
	success: function(html)
	{
            $("#hide"+jadwal_id).hide(300);   
	}
	});
   
}


function hapus(krs_id)
{
        $.ajax({
	url:"<?php echo base_url();?>krs/delete",
	data:"krs_id=" + krs_id ,
	success: function(html)
	{
            $("#krshide"+krs_id).hide(300);   
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
    <tr><td>Prodi<?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', $param, array('id'=>'prodi'))?></td></tr>
    <tr><td>Konsentrasi<?php echo combodumy('konsentrasi', 'konsentrasi')?></td></tr>
    <tr><td>Tahun Angkatan
            <?php echo buatcombo('tahun_angkatan', 'student_angkatan', '', 'keterangan', 'angkatan_id', '', array('id'=>'tahun_angkatan'))?>
        </td></tr>
    <tr><td>
             
                    <select id="list" name="example-select-multiple" class="form-control" multiple>
                    </select>
                

        </td></tr>

</table>
</div>

<div class="col-sm-8">
    <div id="daftarkrs"></div>
</div>




