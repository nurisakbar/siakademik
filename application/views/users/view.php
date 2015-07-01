<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<?php
echo anchor($this->uri->segment(1).'/post','Tambah Data',array('class'=>'btn btn-danger   btn-sm'))
?>
                    <table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="7">No</th>
                                <th>Username</th>
                                <th width="80">Level</th>
                                <th width="150">Last Login</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            $i=1;
                            foreach ($record as $r)
                            {
                            ?>
                            
                            <tr>
                                <td width="80" class="text-center">
                                    <div class="btn-group">
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->id_users;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->id_users;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </div>
                                <td><?php echo $i;?></td>
                                <td><?php echo $r->username;?></a></td>
                                <td>
                                    <?php
                                    if($r->level==1)
                                    {
                                        echo "Admin";
                                    }
                                    elseif($r->level==2)
                                    {
                                        echo "Jurusan";
                                    }
                                    elseif($r->level==3)
                                    {
                                        echo "Dosen";
                                    }
                                    ?>
                                </td>
                                <td><?php echo tgl_indo($r->last_login);?></td>
                                <td><?php echo users_keterangan($r->level, $r->keterangan)?></td>
                            </tr>
                            <?php $i++;}?>
                            
                            
                        </tbody>
                    </table>
                    <!-- END Datatables -->