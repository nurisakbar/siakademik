<?php
$method=$this->uri->segment(5);
if($method=='cetak')
{
    ?>

<body onload="window.print()">
    
<?php

}
else
{
    header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=laporan pembayaran.doc");
}
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
<table><tr><td><img src='<?php echo base_url();?>assets//images/logo.png' width=50 height=50></td>
						<td style='vertical-align:middle;font-size:16px;padding:10px;'><b>LAPORAN PEMBAYARAN MAHASISWA</b><br>
                                                    Tanggal <?php echo tgl_indo($this->uri->segment(3))?> Sampai <?php echo tgl_indo($this->uri->segment(4))?></td></tr>
</table><hr>
<br><table border="1" cellspacing="0">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th width="60">NIM</th>
		<th width="120">Nama Mahasiswa</th>
		<th width="130">Program Studi</th>
		<th width="120">Jenis Pembayaran</th>
		<th width="90">Total</th>
	</tr>
        <?php
        $no=1;
        $total=0;
        foreach ($transaksi as $r)
        {
            echo"<tr><td>$no</td>
                <td>". tgl_indo($r->tanggal)."</td>
                <td>".  strtoupper($r->nim)."</td>
                <td>".  strtoupper($r->nama)."</td>
                <td>".  strtoupper($r->nama_konsentrasi)."</td>
                <td>".  strtoupper($r->keterangan)."</td>
                <td align='right'>".rp((int) $r->jumlah)."</td>
                </tr>";
            $no++;
            $total=$total+$r->jumlah;
        }
        ?>
	<tr>
	<td align='right' colspan='6'><b>Grand Total</b></td>
	<td align='right'><b><?php echo rp($total);?></b></td>
	</tr></table>