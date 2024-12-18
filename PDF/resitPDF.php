<?php


require_once __DIR__ . '/../Models/Penyewa.php';
require_once __DIR__ . '/../Models/Tempahan.php';
require_once __DIR__ . '/../Models/Resit.php';
require_once __DIR__ . '/../Models/Kerja.php';
require_once __DIR__ . '/../Models/Tugasan.php';

$resit_id = $_GET['resit_id'];


$resit = new Resit();
$tempahan = $resit->getResitDetails($resit_id);

$penyewa_id = $tempahan['penyewa_id'];

$penyewa_detail = new Penyewa();
$penyewa = $penyewa_detail->findById($penyewa_id);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <div style="width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #ccc; padding: 20px;">
        <!-- Header Section -->
        <div style="text-align: center;">
            <h2 style="margin: 0;">LEMBAGA KENAF DAN TEMBAKAU</h2>
            <p style="margin: 5px 0;">Kubang Kerian,
                16150 Kota Bharu, Kelantan Darul Naim.</p>
            <p style="margin: 5px 0;">Tel: +609-766 8000</p>
            <p style="margin: 5px 0;">Tarikh : <?php echo date('d/m/Y', strtotime($tempahan['updated_at'])); ?></p>
            <hr style="border: 1px solid #ccc;">
            <p style="margin: 5px 0;">Bill No : <?php echo sprintf('%05d', $tempahan['tempahan_id']); ?></p>
            <hr style="border: 1px solid #ccc;">
        </div>


        <!-- Customer Info -->
        <div style="margin-bottom: 20px;">
            <p><strong>Nama :</strong> <?php echo $penyewa['nama']; ?> </p>
            <p><strong>Alamat :</strong> <?php echo strtoupper($penyewa['alamat']) ?></p>
            <p><strong>Email :</strong> <?php echo ($penyewa['email'] ?? 'Tiada Email') ?></p>
            <p><strong>Jenis Pembayaran :</strong> <?php echo $tempahan['jenis_pembayaran'] ?></p>
            <p><strong>Cara Bayar :</strong> <?php echo $tempahan['cara_bayar'] ?></p>
        </div>

        <!-- Table with items -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: left;">Nama Kerja</th>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: right;">Jam</th>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: right;">Minit</th>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: right;">Harga/Jam</th>
                    <th style="border: 1px solid #ccc; padding: 8px; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $tempahan_id = $tempahan['tempahan_id'];
                $kerja = new Kerja();
                $task = $kerja->findByTempahanId($tempahan_id);

                // Loop through the result set
                foreach($task as $rowKerja){
                    $nama_kerja = $rowKerja['nama_kerja'];

                    $tugasan = new Tugasan();
                    $tugasans = $tugasan->getRateByName($nama_kerja);
                    $rateharga = $tugasans['harga_per_jam'];

                ?>
					<?php if($tempahan['jenis_pembayaran'] == 'bayaran muka'){ ?>
                    <tr>
                        <td style="border: 1px solid #ccc; padding: 8px;"><?php echo $rowKerja['nama_kerja'] ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;"><?php echo $rowKerja['jam_anggaran'] ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;"><?php echo $rowKerja['minit_anggaran'] ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;">RM <?php echo $rateharga ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;">RM <?php echo $rowKerja['harga_anggaran'] ?></td>
                    </tr>
					<?php }else{ ?>
					<tr>
                        <td style="border: 1px solid #ccc; padding: 8px;"><?php echo $rowKerja['nama_kerja'] ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;"><?php echo $rowKerja['total_jam'] ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;"><?php echo $rowKerja['total_minit'] ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;">RM <?php echo $rateharga ?></td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: right;">RM <?php echo $rowKerja['total_harga'] ?></td>
                    </tr>
					<?php } ?>
					
                <?php
                   
                }
                ?>

            </tbody>
        </table>

        <!-- Totals Section -->
        <div style="text-align: right;">
             <?php if($tempahan['jenis_pembayaran'] == 'bayaran muka'){ ?> 
            <p><strong>Total : </strong> RM <?php echo $tempahan['total_harga_anggaran'] ?></p>
			 <?php }elseif($tempahan['jenis_pembayaran'] == 'bayaran tambahan'){ ?>
			<p><strong>Total: </strong> RM <?php echo $tempahan['total_harga_sebenar'] ?></p>
            <p><strong>Sudah Bayar: </strong>- RM <?php echo $tempahan['total_harga_anggaran'] ?></p>
            <p><strong>Total Bayaran: </strong> RM <?php echo $tempahan['total_baki'] ?></p>
			<?php }else{ ?>
			<p><strong>Total: </strong> RM <?php echo $tempahan['total_harga_sebenar'] ?></p>
			<p><strong>Sudah Bayar: </strong>- RM <?php echo $tempahan['total_harga_anggaran'] ?></p>
			<p><strong>Total Refund: </strong> RM <?php echo $tempahan['total_baki'] ?></p>
			
			<?php } ?>
        </div>

        <!-- Footer Section -->
        <div style="text-align: center; margin-top: 20px;">
            <hr style="border: 1px solid #ccc;">
            <p style="margin: 5px 0;">Thank you for your business!</p>
            <p style="margin: 5px 0;">If you have any questions, feel free to contact us.</p>
        </div>
    </div>

</body>

</html>