 <script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>

<script>
$(document).ready(function(){
  $("#datepicker").change(function(){
      loadmahasiswa();
  });
});
</script>
<script>
$(document).ready(function(){
          loadmahasiswa();    
  });
  

  
  function simpanabsen(id)
  {
      var nilai=$("#absenid"+id).val();
      $.ajax({
      url:"<?php echo base_url();?>absensi/simpan_absen",
      data:"id=" + id+"&nilai="+nilai ,
      success: function(html)
       {
           //loadmahasiswa();
       }
       });
  }
  
  function belumabsen()
  {
      alert('Silahkan Lakukan Autosave Terlebih Dahulu');
  }
  
  function chekabsen()
  {
      var tanggal=$("#datepicker").val();
      var kels_ajar=$("#jadwal").val();
      $.ajax({
      url:"<?php echo base_url();?>absensi/chek_absen",
      data:"tanggal=" + tanggal+"&jadwal="+kels_ajar ,
      success: function(html)
       {
           $("#status").html(html);
       }
       });
  }
  

  
  function loadmahasiswa()
  {
      var jadwal_id=$("#jadwal").val();
      var tanggal=$("#datepicker").val();
      $.ajax({
      url:"<?php echo base_url();?>absensi/load_mahasiswa",
      data:"jadwal_id=" + jadwal_id +"&tanggal="+tanggal,
      success: function(html)
       {
          $("#mahasiswa").html(html);
          chekabsen();
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
        <tr class="success"><th colspan="2">Kelas Anda</th></tr>
        <tr><th colspan="2">Tahun Akademik </th></tr>
        <td colspan="2">
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
        <tr><td width="120"><?php echo inputan('text', 'tanggal', 'col-md-14', 'Tanggal', 1, $this->session->userdata('sess_login_absen'), array('id'=>'datepicker'))?>
                
            </td>
            <td id="status"></td>
        </tr>
        <tr><td colspan="2">
                 <a href="#example-modal" class="btn btn-primary btn-sm" data-toggle="modal">Autosave</a>
            </td></tr>
    </table>
    <div id="hasil"></div>
</div>
<div class="col-md-9">
    <div id="mahasiswa"></div>
</div>

<?php
echo form_open('absensi/autosave');
?>


            <!-- Modal itself -->
            <div id="example-modal" class="modal">
                <!-- Modal Dialog -->
                <div class="modal-dialog">
                    <!-- Modal Content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4>Autosave</h4>
                        </div>
                        <div class="modal-body">
                                                     <table class="table table-bordered">
                            <tr><td>Tanggal</td><td><?php echo inputan('text', 'tanggal2', 'col-md-4', 'Tanggal', 1,'', array('id'=>'datepicker2'))?></td><tr>
                             <tr><td>Matakuliah</td><td>
                <select name="jadwal" class="form-control">
                    <?php
                    foreach ($kelas as $k)
                    {
                        echo "<option value='$k->jadwal_id'>".  strtoupper($k->nama_makul)."</option>";
                    }
                    ?>
                </select>
            </td><tr>
                             <tr><td colspan="2"><textarea class="form-control" placeholder="Judul Materi" name="materi"></textarea></td></tr>
                            </table>
                            
                                    
                        </div>
                       
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-success">Autosave</button>
                        </div>
                    </div>
                    <!-- END Modal Content -->
                </div>
                <!-- END Modal Dialog -->
            </div>
 </form>