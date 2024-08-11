<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengesahan Permohonan</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600; /* Bold for h2 */
        }
        .table thead th {
            background-color: #2a2185;
            color: #fff;
            font-weight: 400; /* Normal weight for th */
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table td, .table th {
            text-align: center;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pengesahan Permohonan</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Pemohon</th>
                        <th>Keluasan Tanah (Hektar)</th>
                        <th>Maklumat</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh baris, ini akan dijana secara dinamik -->
                    <tr>
                        <td>Ahmad Bin Ali</td>
                        <td>5.5</td>
                        <td><a href="file.pdf" target="_blank">Lihat PDF</a></td>
                        <td>
                            <form method="POST" action="sahkan.php">
                                <input type="hidden" name="id_permohonan" value="1">
                                <button type="submit" name="tindakan" value="terima" class="btn btn-success">Terima</button>
                                <button type="submit" name="tindakan" value="tolak" class="btn btn-danger">Tolak</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
