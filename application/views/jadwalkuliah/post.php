 <h3 class="page-header page-header-top"> <?php echo $title;?> <small><?php echo $desc;?></small> </h3>
 
 <script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>
<script>
$(document).ready(function(){
    loadkonsentrasi();
});
</script>


<script>
$(document).ready(function(){
  $("#prodi").change(function(){
      loadkonsentrasi();
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

</script>


<div class="col-sm-3">
    <table class="table table-bordered">
    <tr><td>Tahun Akademik <?php echo buatcombo('tahun_akademik', 'akademik_tahun_akademik', '', 'keterangan', 'tahun_akademik_id', '', array('id'=>'tahun_akademik_id'))?></td></tr>
    <tr><td>Program Studi <?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', '', array('id'=>'prodi'))?></td></tr>
    <tr><td>Konsentrasi <?php echo combodumy('konsentrasi', 'konsentrasi')?></td></tr>
    
    <tr><td><?php echo anchor('jadwalkuliah','<span class="glyphicon glyphicon-plus"></span> Kembali',array('class'=>'btn btn-primary  btn-sm'));?> 
        </td></tr>
</table>
</div>

<div class="col-sm-9">
    <table class="table table-bordered" id="makul">
        <tr><td width="150">Matakuliah</td><td>
                 <div class="col-md-6">
                    <select id="example-select-chosen-multiple" class="form-control select-chosen">
                        <option selected>html</option>
                        <option>css</option>
                        <option>javascript</option>
                        <option>php</option>
                        <option>mysql</option>
                    </select>
                </div>

            </td></tr>
        <tr><td>Dosen Pengapu</td><td>
                        <div class="col-md-6">
                    <select id="example-select-chosen-multiple" class="form-control select-chosen">
                        <?php
                        foreach ($dosen as $d)
                        {
                            echo "<option>".  strtoupper($d->nama_lengkap)."</option>";
                        }
                        ?>
                    </select>
                </div>
            </td></tr>
        <tr><td>Hari, Jam</td><td>
                <?php echo buatcombo('hari','app_hari','col-sm-3','hari','hari_id','',''); ?>
                <?php echo buatcombo('jam','akademik_waktu_kuliah','col-sm-4','keterangan','id_waktu','',''); ?>
            </td></tr>
        <tr><td>Ruangan</td><td>
                <?php echo buatcombo('ruangan','app_ruangan','col-sm-3','nama_ruangan','ruangan_id','',''); ?>
            </td></tr>
        <tr><td colspan="2"><button id="simpan" class="btn btn-primary  btn-sm">Simpan Data</button></td></tr>
    </table>
</div>
