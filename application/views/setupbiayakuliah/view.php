<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
 
<script src="<?php echo base_url();?>assets/js/1.8.2.min.js"></script>
 
  <script>
 
  $( document ).ready(function() {
      loaddata();
  });
 
  </script>
 
  <script type="text/javascript">
$(document).ready(function(){
  $("#tahun_akademik").change(function(){
      loaddata();
      
  });
});
</script>
  
 <script type="text/javascript">
 
 function loaddata()
 {
     var tahun_akademik=$("#tahun_akademik").val();
     $.ajax({
        url:"<?php echo base_url();?>setupbiayakuliah/loaddata",
        data:"tahun_akademik=" + tahun_akademik  ,
                success: function(html)
                {
                    $("#table").html(html);
                }
            });
 }
 </script>
 
<div class="col-sm-3">
    <table class="table table-bordered">
        <tr class="success"><th>Pilih Data</th></tr>
        <tr><td>Tahun Akademik
              <?php echo buatcombo('tahun_angkatan', 'student_angkatan', '', 'keterangan', 'angkatan_id', '', array('id'=>'tahun_akademik'))?>
            </td></tr>
         <tr><td><?php echo anchor('setupbiayakuliah/post','Setup',array('class'=>'btn btn-primary'))?> <?php //echo anchor('','Cetak',array('class'=>'btn btn-primary'))?></td></tr>
    </table>
</div>

<div class="col-md-9">
    <table class="table table-bordered" id="table">
</table>
</div>