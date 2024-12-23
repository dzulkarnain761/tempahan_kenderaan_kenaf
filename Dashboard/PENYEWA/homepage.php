<?php include 'controller/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
	
<style>


h6 {
    color: #00BFFF;
    font-weight: bold;
	font-size: 50px;
    margin-bottom: 15px;
}

h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
}

p {
    font-size: 1.2rem;
    line-height: 1.5;
    margin-bottom: 20px;
}

button {
    background-color: #00FF7F;
    color: white;
    padding: 10px 20px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #00C970;
}

.back-dropdown {
    margin-top: 20px;
}

.right-image img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: auto;
}

.page-title-box {
    text-align: center;
    margin-bottom: 30px;
}

.container-fluid {
    padding: 20px;
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

<?php include 'partials/head.php'; ?>
	


<body style="background-image: url(../../assets/images/logo/auth-bg.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;" class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">
        <?php include 'partials/left-sidemenu.php'; ?>
        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                
                               <h4 class="page-title" style="color: white; text-align: left;">LAMAN UTAMA</h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
					
					  <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                        <h6>SELAMAT DATANG <?php echo $first_name ?> !</h6>
                                        <h2 style="color: white;">TEMPAHAN JENTERA LEMBAGA KENAF DAN TEMBAKAU NEGARA</h2>
                                        <p style="color: white;">Selamat datang ke laman tempahan jentera kami! Kami menawarkan pelbagai
                                            pilihan kerja untuk memenuhi keperluan anda. Terima kasih.</p>
                                <div class="back-dropdown">
								<div class="border-first-button scroll-to-section">
									<button class="gradient-button" onclick="window.location.href='tempah_khidmat_jentera.php'">TEMPAH SEKARANG</button>
								</div>
							</div>
<style>
.gradient-button {
    background: linear-gradient(45deg, #98FB91, #08B118); /* Gradient */
    border: none;
    color: #355d9b;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px; 
    transition: background 0.3s ease;
}

.gradient-button:hover {
    background: linear-gradient(45deg, #08B118, #98FB91); /*  bila hover */
}
</style>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="../../assets/images/logo/farmer with tractor.png" alt="Farm Tractor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                   <!-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    
                                    1.<a href="tempah_khidmat_jentera.php">Tempah Servis Jentera</a>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>-->
                    <!-- end row 
					
					

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>

        
    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>


</body>

</html>