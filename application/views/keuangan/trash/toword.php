
<?php
        header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=laporan pembayaran perpriode.doc");
?>

<style type="text/css">
    body
    {
        font-family: sans-serif;
        font-size: 14px;
    }
    th{
        padding: 5px;
        font-weight: bold;
        font-size: 12px;
    }
    td{
        font-size: 12px;
    }
    h2{
        text-align: left;
        margin-bottom: 13px;
    }
    .potong
    {
        page-break-after:always;
    }
</style>
<p>
<img src="<?php echo base_url()?>assets/images/logo.png" width="60" height="60" style="float: left;margin-right: 10px;">
<h2>LAPORAN PEMBAYARAN MAHASISWA</h2></p>
<p style="font-size: 14px;">
Tanggal <?php echo tgl_indo($tanggal1);?> sampai <?php echo tgl_indo($tanggal2);?>
</p>
<div style="clear: both"></div>
<hr>

<table  border="1" cellspacing="0">
  
    <tr><th>No</th><th width="300">Jenis Pembayaran</th><th width="125">Status Pembayaran</th><th width="75">Tanggal</th><th width="95">Jumlah</th></tr>
    <?php
    $i=1;
    foreach ($transaksi as $r)
    {
        echo "<tr>
            <td>$i</td>
                <td>$r->keterangan</td>
                    <td>".status_bayar($r->status)."</td>
                    <td>".  tgl_indo($r->tanggal)."</td>
                        <td>Rp .$r->jumlah</td>
                            </tr>";
        $i++;
    }
    ?>
    

    
</table>