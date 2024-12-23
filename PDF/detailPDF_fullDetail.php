<?php

require_once __DIR__ . '/../Models/Penyewa.php';
require_once __DIR__ . '/../Models/Tempahan.php';
require_once __DIR__ . '/../Models/Jobsheet.php';
require_once __DIR__ . '/../Models/Kerja.php';

// $tempahan_id = 2;

// $bookings = new Tempahan();
// $tempahan = $bookings->findByTempahanId($tempahan_id);

// $penyewa_id = $tempahan['penyewa_id'];

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
            padding: 8px;
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
            <p>NAMA: <span>Ahmad Bin Ali</span></p>
            <p>ALAMAT: <span>123 Jalan Kenaf, Kuala Lumpur</span></p>
            <p>NO TEL: <span>012-3456789</span></p>
            <p>EMAIL: <span>ahmad.ali@example.com</span></p>
        </div>
        <div>
            <h4>MAKLUMAT TEMPAHAN</h4>
            <p>LUAS TANAH: <span>5 Hektar</span></p>
            <p>LOKASI TANAH: <span>Jalan Tembakau 2, Kelantan</span></p>
            <p>CATATAN: <span>Projek Tanaman Kenaf</span></p>
    </section>

    <section class="kerja-detail">
        <h4>MAKLUMAT PENGESAHAN</h4>
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

    <section class="jobsheet-detail">
        <h4>JOBSHEET 1</h4>

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