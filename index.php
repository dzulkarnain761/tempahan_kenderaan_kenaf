<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="assets/images/styles/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #c9d9f5, #538ff5);
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .main-banner {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
        }
        .container {
            max-width: 1200px;
        }
        .left-content {
            padding: 20px;
        }
        .left-content h6 {
            font-size: 1.2rem;
            color: #444;
            margin-bottom: 10px;
        }
        .left-content h2 {
            font-size: 2.5rem;
            color: #222;
            margin-bottom: 20px;
        }
        .left-content p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 30px;
        }
        .border-first-button a {
            padding: 10px 30px;
            font-size: 1rem;
            color: #fff;
            background-color: #054ced;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .border-first-button a:hover {
            background-color: #4578ed;
			text-decoration: none;
        }
        .right-image img {
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6>Selamat Datang!</h6>
                                    <h2>TEMPAHAN KENDERAAN LEMBAGA KENAF DAN TEMBAKAU</h2>
                                    <p>Selamat datang ke laman tempahan kenderaan kami! Kami menawarkan pelbagai pilihan kenderaan untuk memenuhi keperluan anda. Terima kasih.</p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-first-button scroll-to-section">
                                        <a href="login.php">Log Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <img src="assets/images/farm-tractor-concept-illustration.png" alt="Digital Media Agency">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>

</body>
</html>
