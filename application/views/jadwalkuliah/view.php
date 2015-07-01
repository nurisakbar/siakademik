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
    loadkonsentrasi();
    loadkonsentrasi2();
    //tampilmakul();
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
  $("#prodi2").change(function(){
      loadkonsentrasi2()
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
function loadkonsentrasi2()
{
    var prodi=$("#prodi2").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilkonsentrasi",
    data:"prodi=" + prodi ,
    success: function(html)
    { 
       $("#konsentrasi2").html(html);
       
    }
          });
}

function simpanhari(id)
{
    var nilaihari=$("#hariid"+id).val();
    var nilaijam=$("#jamid"+id).val();
    var nilairuang=$("#ruangid"+id).val();
    $.ajax({
    url:"<?php echo base_url();?>jadwalkuliah/simpanhari",
    data:"id=" + id +"&nilaihari="+nilaihari+"&nilai_jam="+nilaijam+"&nilai_ruang="+nilairuang  ,
    success: function(html)
    { 
        loadkonsentrasi();
         $("#hasil").html(html);
    }
          });   
}

function simpanruang(id)
{
     var nilairuang=$("#ruangid"+id).val();
     var nilaijam=$("#jamid"+id).val();
     var nilaihari=$("#hariid"+id).val();
    $.ajax({
    url:"<?php echo base_url();?>jadwalkuliah/simpanruang",
    data:"id=" + id +"&nilai_ruang="+nilairuang+"&nilai_jam="+nilaijam+"&nilaihari="+nilaihari ,
    success: function(html)
    { 
         loadkonsentrasi();
         $("#hasil").html(html);
    }
          });  
}

function simpandosen(id)
{
     var nilaidosen=$("#dosenid"+id).val();
    $.ajax({
    url:"<?php echo base_url();?>jadwalkuliah/simpandosen",
    data:"id=" + id +"&nilai_dosen="+nilaidosen ,
    success: function(html)
    { 
         $("#hasil").html(html);
    }
          });  
}



function simpanjam(id)
{
     var nilaijam=$("#jamid"+id).val();
     var nilairuang=$("#ruangid"+id).val();
     var nilaihari=$("#hariid"+id).val();
     var jumlah=nilaijam.length;
     if(jumlah==5)
     {
        $.ajax({
        url:"<?php echo base_url();?>jadwalkuliah/simpanjam",
        data:"id=" + id +"&nilai_ruang="+nilairuang+"&nilai_jam="+nilaijam+"&nilaihari="+nilaihari ,
        success: function(html)
        { 
            loadkonsentrasi();
            $("#hasil").html(html);
        }
              });      
     }   
}



function loadsemester()
{
    var konsentrasi_id=$("#konsentrasi").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilsemester",
    data:"konsentrasi=" + konsentrasi_id ,
    success: function(html)
    { 
        $("#semester").html(html);
        tampilmakul();
    }
          });  
}

function tampilmakul()
{
    var konsentrasi     =$("#konsentrasi").val();
    var semester        =$("#semester").val();
    var tahun_akademik  =$("#tahun_akademik_id").val();

    $.ajax({
    url:"<?php echo base_url();?>jadwalkuliah/tampiljadwal",
    data:"konsentrasi=" + konsentrasi +"&semester="+semester+"&tahun_akademik="+tahun_akademik ,
    success: function(html)
    { 
       $("#jadwal").html(html);
      
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
<?php
echo form_open('jadwalkuliah/cetak');
?>
<div class="col-sm-3">
    <table class="table table-bordered">
    <tr><td>Tahun Akademik <?php echo buatcombo('tahun_akademik', 'akademik_tahun_akademik', '', 'keterangan', 'tahun_akademik_id', '', array('id'=>'tahun_akademik_id'))?></td></tr>
    <tr><td>Program Studi <?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', $param, array('id'=>'prodi'))?></td></tr>
    <tr><td>Konsentrasi <?php echo combodumy('konsentrasi', 'konsentrasi')?></td></tr>
    <tr><td>Semester <?php echo combodumy('semester', 'semester')?></td></tr>
    <tr><td><?php echo anchor('#example-modal','Autosetup',array('class'=>'btn btn-primary  btn-sm','data-toggle'=>'modal'));?> 
            <button type="submit" class="btn btn-primary  btn-sm"><span class="glyphicon glyphicon-print"></span> Cetak Data</button>
        <?php //echo anchor('matakuliah/#','<span class="glyphicon glyphicon-print"></span> Cetak Data',array('class'=>'btn btn-primary  btn-sm'));?></td></tr>
</table>
    <div id="hasil"></div>
</div>
</form>
<div class="col-sm-9">
    <div id="pesan"></div>
    <table class="table table-bordered" id="jadwal">
        <tr><th width="5">No</th><th>Hari</th><th width="100">Kode</th><th>Matakuliah</th><th width="40">SKS</th><th>Ruang</th><th>Jam</th><th>Dosen</th><th colspan="3">Operasi</th></tr>
    </table>
</div>


<?php
echo form_open('jadwalkuliah/autosetup');
?>
<!-- Modal itself -->
            <div id="example-modal" class="modal">
                <!-- Modal Dialog -->
                <div class="modal-dialog">
                    <!-- Modal Content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4>Autosetup Jadwal Kuliah</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tr><td width="180">Tahun Akademik </td><td><?php echo buatcombo('tahun_akademik', 'akademik_tahun_akademik', '', 'keterangan', 'tahun_akademik_id', '', array('id'=>'tahun_akademik_id'))?></td></tr>
                                <tr><td>Program Studi </td><td><?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', '', array('id'=>'prodi2'))?></td></tr>
                                <tr><td>Konsentrasi </td><td><?php echo combodumy('konsentrasi', 'konsentrasi2')?></td></tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-danger">Mulai Proses Autosetup</button>
                        </div>
                    </div>
                    <!-- END Modal Content -->
                </div>
                <!-- END Modal Dialog -->
            </div>
            <!-- END Modal itself -->
 </form>
 
 <!-- 
 <table class="table table-borderedb">
     <tr><th>Matakuliah</th><th>Jam Mulai</th><th>Jumlah Jam</th><th>Jam selesai</th></tr>
     <tr><td>Pemograman Web</td>
         <td><?php echo inputan('text', 'nama_ayah','col-sm-6','Nama Ayah ..', 0, '','');?></td>
         <td>4</td>
         <td><?php echo inputan('text', 'nama_ayah','col-sm-6','Nama Ayah ..', 0, '','');?></td></tr>
 </table>END Modal itself -->