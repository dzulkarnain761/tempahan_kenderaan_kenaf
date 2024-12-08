<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //   die("Connection failed: " . mysqli_connect_error());
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

$resit_id = $_GET['resit_id'];


// Ensure you escape the ID to prevent SQL injection
$resit_id = mysqli_real_escape_string($conn, $resit_id);

$sqlTempahan = "SELECT r.*,t.* FROM resit_pembayaran r
                LEFT JOIN tempahan t ON r.tempahan_id = t.tempahan_id
                WHERE r.resit_id = $resit_id";
$resultTempahan = mysqli_query($conn, $sqlTempahan);

// Fetch the Pemandu member's data
if ($resultTempahan && mysqli_num_rows($resultTempahan) > 0) {
    $tempahan = mysqli_fetch_assoc($resultTempahan);
} else {
    // Handle the case where no Pemandu member is found
    echo "Tiada Resit";
    exit;
}

$penyewa_id = $tempahan['penyewa_id'];

$sqlPenyewa = "SELECT * FROM `penyewa` WHERE id = $penyewa_id";
$resultPenyewa = mysqli_query($conn, $sqlPenyewa);

if ($resultPenyewa && mysqli_num_rows($resultPenyewa) > 0) {
    $penyewa = mysqli_fetch_assoc($resultPenyewa);
} else {
    // Handle the case where no Pemandu member is found
    echo "Tiada Penyewa Dijumpai";
    exit;
}

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
                // SQL query to select all tasks for the booking
                $sqlKerja = "SELECT * FROM `tempahan_kerja` 
                                        WHERE tempahan_id = $tempahan_id";

                $resultKerja = mysqli_query($conn, $sqlKerja);

                // Loop through the result set
                while ($rowKerja = mysqli_fetch_assoc($resultKerja)) {
                    $nama_kerja = $rowKerja['nama_kerja'];

                    $sqltugasan = "SELECT * FROM `tugasan` WHERE kerja = '$nama_kerja'";
                    $resulttugasan = mysqli_query($conn, $sqltugasan);

                    if ($resulttugasan && mysqli_num_rows($resulttugasan) > 0) {
                        $fetchTugasan = mysqli_fetch_assoc($resulttugasan);
                        $rateharga = $fetchTugasan['harga_per_jam'];
                    }
                ?>
					<?php if($tempahan['jenis_pembayaran'] == 'bayaran penuh'){ ?>
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
             <?php if($tempahan['jenis_pembayaran'] == 'bayaran penuh'){ ?> 
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