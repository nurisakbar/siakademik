 <!-- Datatables -->
<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
<?php
echo anchor($this->uri->segment(1).'/post','Tambah Data',array('class'=>'btn btn-danger   btn-sm'))
?>
                    <table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="cell-small text-center hidden-xs hidden-sm">Nomor</th>
                                <th>Nama Submenu</th>
                                <th class="hidden-xs hidden-sm hidden-md"> Nama Mainmenu</th>
                                <th>Level</th>
                                <th>Status</th>
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
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->id_submenu;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->id_submenu;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                        <?php
                                        if($r->aktif=='y')
                                        {
                                            // disabled
                                            $link="/status/n/";
                                            $icon="<span class='fa fa-eye-slash'></span>";
                                             $title="Jangan Aktifkan";   
                                        }
                                        else
                                        {
                                            $link="/status/y/";
                                            $icon="<span class='fa fa-eye'></span>";
                                            $title="Aktifkan";
                                        }
                                        ?>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).$link.$r->id_submenu;?>" data-toggle="tooltip" title="<?php echo $title;?>" class="btn btn-xs btn-danger"><?php echo $icon;?></a>
                                    </div>
                                </td>
                                <td class="text-center hidden-xs hidden-sm"><?php echo $i;?></td>
                                <td><?php echo anchor($r->link,strtoupper($r->nama_submenu));?></a></td>
                                <td><?php echo strtoupper($r->nama_submenu);?></td>
                                <Td></td>
                                <td><?php echo $r->aktif=='y'?'Aktif':'Tidak';?></td>
                            </tr>
                            <?php $i++;}?>
                            
                            
                        </tbody>
                    </table>
                    <!-- END Datatables -->