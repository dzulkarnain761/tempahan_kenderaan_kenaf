<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>eTEMPAHAN JENTERA</title>
	<link rel="icon" type="image/x-icon" href="assets/images/logo/logo baru.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
	<style>
        
	.logo-top-left {
    display: flex;
    justify-content: flex-start; 
    align-items: center;
    position: absolute;
    top: 10px;
    left: 10px; 
    z-index: 1000;
}
	   
	    .logo-top-right {
    position: absolute;
    top: 10px;
    right: 10px; /* Ubah dari 'left' ke 'right' */
    z-index: 1000;
}

	   
	@keyframes swing {
    0% {
        transform: rotate(0deg); 
    }
    50% {
        transform: rotate(3deg); 
    }
    100% {
        transform: rotate(0deg); 
    }
}

.right-image img {
    animation: swing 4s ease-in-out infinite; 
}

	  @keyframes floatScale {
    0%, 100% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-10px) scale(1.05);
    }
}

.right-image img {
    animation: floatScale 5s ease-in-out infinite;
}
		.text-section {
        margin-top: 85px; 
        text-align: left; 
    }

    @media (max-width: 768px) {
        .text-section {
            margin-top: 100px; 
        }
    }

    .background-custom {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
		
		 @keyframes slideInFromLeft {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .text-animation {
        animation: slideInFromLeft 1s ease-out forwards;
    }

    .text-animation:nth-child(1) {
        animation-delay: 0s;
    }

    .text-animation:nth-child(2) {
        animation-delay: 0.5s;
    }

    .text-animation:nth-child(3) {
        animation-delay: 1s;
    }

    .text-animation:nth-child(4) {
        animation-delay: 1.5s;
    }
 
</style>
</head>
<body class="background-custom" style="background-image: url(assets/images/logo/auth-bg.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
	
	<div class="logo-top-right">
        <a href="index.php">
            <img src="assets/images/logo/logo baru.png" alt="ejentera" height="100" class="responsive-img">
		</a>
	</div>

<div class="container text-section">
	<div class="logo-top-left">
    <a href="">
        <img src="assets/images/logo/headlktn1.png" alt="Logo LKTN" height="30" class="responsive-img">
    </a>
</div>
    <div class="row d-flex align-items-center justify-content-center">
       
        <div class="col-12 col-md-6 text-center text-md-start mb-4 mb-md-0 px-4">
    <h3 class="text-animation" style="color: #73bd36; font-size: 20px;"><b>SELAMAT DATANG!</b></h3>
    <h2 class="text-animation" style="color: white; font-size: 37px;">TEMPAHAN JENTERA LEMBAGA KENAF DAN TEMBAKAU NEGARA</h2>
    <p class="text-animation" style="font-size: 1.2rem; color: white;">
        Selamat datang ke laman tempahan jentera kami! Kami menawarkan pelbagai pilihan kerja untuk memenuhi keperluan anda. Terima kasih.
    </p>
    <a href="login.php" class="btn btn-outline-success px-4 py-2 text-animation">LOG MASUK SISTEM</a>
</div>

       
        <div class="col-lg-6">
            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="assets/images/logo/farmer with tractor.png" alt="Farm Tractor" width="700" height="auto">
            </div>
        </div>
    </div>
</div>

</body>
</html>
