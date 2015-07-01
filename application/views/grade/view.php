<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
                    <!-- END Breadcumbs -->
<?php
echo anchor($this->uri->segment(1).'/post',"<i class='fa fa-building-o'></i> New Record",array('class'=>'btn btn-danger   btn-sm','title'=>'Tambah Data'))
?>                    
                    <table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="7">No</th>
                                <th>Grade</th>
                                <th>Dari</th>
                                <th>Sampai</th>
                                <th>Keterangan</th>
                                <th width="7"></th> 
                                <th width="7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            foreach ($record as $r)
                            {
                                echo "<tr><td>$no</td>
                                    <td width='20'>".  strtoupper($r->grade)."</td>
                                    <td width='20'>$r->dari</td>
                                    <td width='20'>$r->sampai</td>
                                    <td>$r->keterangan</td>
                                    <td>".anchor($this->uri->segment(1).'/edit/'.$r->$pk,"<i class='gi gi-edit'></i>",array('title'=>'Edit'))."</td>
                                    <td>".anchor($this->uri->segment(1).'/delete/'.$r->$pk,"<i class='fa fa-trash-o'></i>",array('title'=>'Delete'))."</td>
                                    </tr>";
                                $no++;
                            }
                            ?>

                        </tbody>
                    </table>
