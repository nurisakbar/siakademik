<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
    <?php
echo anchor($this->uri->segment(1).'/post','Tambah Data',array('class'=>'btn btn-danger'));
?>
<hr>
<div class="table-responsive">
    <?php
    echo $table;
    ?>
</div>
<?php
echo $pagination;
?>