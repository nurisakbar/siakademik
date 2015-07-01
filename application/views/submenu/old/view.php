<div class="col-sm-2">
    <?php
echo anchor($this->uri->segment(1).'/post','Tambah Data',array('class'=>'btn btn-danger'));
?>
</div>
<div class="col-sm-9">
    <?php
echo form_open('submenu');
?>
<?php
echo inputan('text', 'key', 'col-sm-4', 'Kata Kunci Pencarian', 1, '', '');
?>
    <input type="submit" name="submit" value="Cari Data" class="btn btn-danger">
</form>
    
</div>
<hr>

<hr>
<div class="table-responsive">
    <?php
    echo $table;
    ?>
</div>
<?php
echo $pagination;
?>