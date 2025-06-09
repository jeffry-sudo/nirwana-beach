<?php
error_reporting(0);
ini_set('display_errors', 0);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Parkir_" . date('Y-m-d') . ".xls");
?>

<div id="laporan">
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

</table>

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>LAPORAN KENDARAAN PARKIR</h4></center><br/></td>
</tr>
                       
</table>
 
<table border="0" align="center" style="width:900px;border:none;">
        <tr>
            <th style="text-align:left"></th>
        </tr>
</table>
<table border="1" align="center" style="width:900px;margin-bottom:20px;">
<thead>
<tr>
<th colspan="9"  style="text-align:center;">Laporan Dari Tanggal <?php echo $mulai ?> Sampai <?php echo $sampai ?> </th>
</tr>
    <tr>
        <th>Kode Karcis</th>
        <th>No Plat</th>
        <th>Jenis Kendaraan</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Keluar </th>
        <th>Lama Parkir</th>
        <th>Jumlah Orang</th>
        <th>Harga Tarif</th>
        <th>Total Tarif</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($laporan as $row) { ?>
    <tr>
        <td style="text-align:center;"><?php echo $row['kd_masuk'];?></td>
        <td style="text-align:center;"><?php echo $row['plat_masuk'];?></td>
        <td style="text-align:center;"><?php echo $row['nama_kendaraan'];?></td>
        <td style="text-align:center"><?php echo $row['tgl_jam_masuk'];?></td>
        <td style="text-align:center;"><?php echo $row['tgl_jam_keluar'];?></td>
        <td style="text-align:center;"><?php echo $row['lama_parkir_keluar'];?></td>
        <td style="text-align:center;"><?php echo $row['jml_org'];?></td>
        <td style="text-align:center;"><?php echo 'Rp '.number_format($row['tarif_keluar']);?></td>
        <td style="text-align:left;"><?php echo 'Rp '.number_format($row['total_keluar']);?></td>
    </tr>
    <?php } ?>
</tbody>
<tfoot>

    <tr>
        <td colspan="8" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:left;"><b><?php echo 'Rp '.number_format($total);?></b></td>
    </tr>
</tfoot>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Sulaa, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right">( <?php echo $this->session->userdata('username_admin');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
</body>
</html>