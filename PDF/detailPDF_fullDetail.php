<?php

require_once __DIR__ . '/../Models/Penyewa.php';
require_once __DIR__ . '/../Models/Tempahan.php';
require_once __DIR__ . '/../Models/Jobsheet.php';
require_once __DIR__ . '/../Models/Kerja.php';
require_once __DIR__ . '/../Models/Tugasan.php';

$tempahan_id = $_GET['tempahan_id'];

$bookings = new Tempahan();
$tempahan = $bookings->findByTempahanId($tempahan_id);

$penyewa_id = $tempahan['penyewa_id'];

$penyewas = new Penyewa();
$penyewa = $penyewas->findById($penyewa_id);



$imagePath = __DIR__ . '/../assets/images/logo/logo_lktn.png'; // Path to your PNG file
$imageData = base64_encode(file_get_contents($imagePath)); // Encode the image
$imgSrc = 'data:image/png;base64,' . $imageData; // Add appropriate data URI


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 20px;
            margin: 10px 0;
        }

        h4 {
            margin-top: 20px;
            text-decoration: underline;
        }

        section {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        table th {
            background-color: #f4f4f4;
        }

        tfoot td {
            font-weight: bold;
        }


        .detail p {
            margin: 5px 0;
        }

        .jobsheet-detail h4 {
            margin-top: 30px;
        }

        tfoot td:empty {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <section class="title">
        <div>
            <img src="<?php echo $imgSrc ?>" alt="Logo">
            <h1>LEMBAGA KENAF DAN TEMBAKAU NEGARA</h1>
        </div>
        <hr>
        <h1>BORANG BUTIRAN TEMPAHAN</h1>
    </section>

    <section class="detail">
        <div>
            <h4>MAKLUMAT PENYEWA</h4>
            <p>NAMA : <span><?= $penyewa['nama'] ?></span></p>
            <p>ALAMAT : <span><?= $penyewa['alamat'] ?></span></p>
            <p>NO TEL : <span><?= $penyewa['contact_no'] ?></span></p>
            <p>EMAIL : <span><?= !empty($penyewa['email']) ? $penyewa['email'] : 'Tiada Email' ?></span></p>

        </div>
        <div>
            <h4>MAKLUMAT TEMPAHAN</h4>
            <p>LUAS TANAH : <span><?= $tempahan['luas_tanah'] ?></span></p>
            <p>LOKASI TANAH : <span><?= $tempahan['lokasi_tanah'] ?></span></p>
            <p>CATATAN : <span><?= !empty($tempahan['catatan']) ? $tempahan['catatan'] : 'Tiada Catatan' ?></span></p>

    </section>

    <section class="kerja-detail">
        
        <table>
            <thead>
                <tr>
                    <th>NAMA KERJA</th>
                    <th>CADANGAN TARIKH KERJA</th>
                    <th>HARGA (RM/JAM)</th>
                    <th>TOTAL JAM</th>
                    <th>TOTAL HARGA (RM)</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $kerja = new Kerja();
                $kerjas = $kerja->findByTempahanId($tempahan_id);

                foreach ($kerjas as $kerja) { 

                    $tugasan = new Tugasan();
                    $nama_kerja = $kerja['nama_kerja'];
                    $tugasans = $tugasan->getRateByName($nama_kerja);
                    $rateharga = $tugasans['harga_per_jam'];
                    
                    ?>

                    <tr>
                        <td><?= $nama_kerja ?></td>
                        <td><?= $kerja['cadangan_tarikh_kerja'] ?></td>
                        <td><?= $rateharga ?></td>
                        <td><?= $kerja['total_jam'] . ' Jam ' . $kerja['total_minit'] . ' Minit '  ?></td>
                        <td><?= $kerja['total_harga'] ?></td>
                    </tr>

                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>TOTAL</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= $tempahan['total_harga_sebenar'] ?></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="jobsheet-detail">

        <h4>BUTIRAN JOBSHEET</h4>

        <p><span>TARIKH KERJA</span>: <span>Jalan Tembakau 2, Kelantan</span></p>
        <p><span>NAMA PEMANDU</span>: <span>Projek Tanaman Kenaf</span></p>
        <p><span>NO JENTERA</span>: <span>Projek Tanaman Kenaf</span></p>
        <table>
            <thead>
                <tr>
                    <th>NAMA KERJA</th>
                    <th>TARIKH KERJA</th>
                    <th>HARGA (RM/JAM)</th>
                    <th>TOTAL JAM</th>
                    <th>TOTAL HARGA (RM)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Piring Batas Besar</td>
                    <td>2024-01-15</td>
                    <td>100</td>
                    <td>5</td>
                    <td>500</td>
                </tr>
                <tr>
                    <td>Rotor</td>
                    <td>2024-01-20</td>
                    <td>100</td>
                    <td>3</td>
                    <td>300</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>TOTAL</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>800</td>
                </tr>
            </tfoot>
        </table>
    </section>
</body>

</html>