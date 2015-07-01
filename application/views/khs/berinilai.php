 <script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>
<script>
$(document).ready(function(){
          loadmahasiswa();    
  });
  
  function simpan(id)
  {
      var nilai=$("#ambil"+id).val();
      $.ajax({
      url:"<?php echo base_url();?>khs/simpan_nilai",
      data:"id=" + id+"&nilai="+nilai ,
      success: function(html)
       {
           loadmahasiswa();
           //alert(id);
       }
       });
  }
  
  function simpangrade(id)
  {
      var nilai=$("#ambilgrade"+id).val();
      $.ajax({
      url:"<?php echo base_url();?>khs/simpan_grade",
      data:"id=" + id+"&nilai="+nilai ,
      success: function(html)
       {
           loadmahasiswa();
           //alert(id);
       }
       });
  }
  
  
  function simpankehadiran(id)
  {
      var nilai=$("#ambilkehadiran"+id).val();
      $.ajax({
      url:"<?php echo base_url();?>khs/simpan_kehadiran",
      data:"id=" + id+"&nilai="+nilai ,
      success: function(html)
       {
           loadmahasiswa();
           //alert(id);
       }
       });
  }
  
  function simpantugas(id)
  {
      var nilai=$("#ambiltugas"+id).val();
      $.ajax({
      url:"<?php echo base_url();?>khs/simpan_tugas",
      data:"id=" + id+"&nilai="+nilai ,
      success: function(html)
       {
           loadmahasiswa();
           //alert(id);
       }
       });
  }
  
  function loadmahasiswa()
  {
      var jadwal_id=$("#jadwal").val();
      $.ajax({
      url:"<?php echo base_url();?>khs/form_berinilai",
      data:"jadwal_id=" + jadwal_id ,
      success: function(html)
       {
          $("#mahasiswa").html(html);
       }
       });
  }
</script>
<script>
$(document).ready(function(){
  $("#jadwal").change(function(){
      loadmahasiswa();
  });
});
</script>


<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
<div class="col-md-3">
    <table class="table table-bordered">
        <tr class="success"><th>Kelas Ajar</th></tr>
        <tr><th>Tahun Akademik <?php echo get_tahun_ajaran_aktif('keterangan')?></th></tr>
        <td>
            <div class="col-md-14">
                <select id="jadwal" class="form-control">
                    <?php
                    foreach ($kelas as $k)
                    {
                        echo "<option value='$k->jadwal_id'>".  strtoupper($k->nama_makul)."</option>";
                    }
                    ?>
                </select>
            </div>
        </td>
    </table>
    <div id="hasil"></div>
</div>
<div class="col-md-8">
    <div id="mahasiswa"></div>
</div>

