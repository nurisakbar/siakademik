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
                                <th width="170">NIP</th>
                                <th>Nama Lengkap</th>
                                <th width="130">Email</th>
                                <th width="120">Handphone</th>
                                <th width="250">Prodi</th>
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
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->dosen_id;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->dosen_id;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </div>
                                <td><?php echo $i;?></td>
                                <td><?php echo strtoupper($r->nip);?></a></td>
                                <td><?php echo strtoupper($r->nama_lengkap);?></td>
                                <td><?php echo $r->email;?></td>
                                <td><?php echo $r->hp;?></td>
                                <td><?php echo strtoupper($r->nama_prodi);?></td>
                            </tr>
                            <?php $i++;}?>
                            
                            
                        </tbody>
                    </table>
                    <!-- END Datatables -->