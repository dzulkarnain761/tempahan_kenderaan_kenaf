<?php
session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'X') {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Booking</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
        /* 
	---------------------------------------------
	global styles
	--------------------------------------------- 
	*/
        html,
        body {
            background: #fff;
            font-family: 'Poppins', sans-serif;
        }

        ::selection {
            background: #4da6e7;
            color: #fff !important;
        }

        ::-moz-selection {
            background: #4da6e7;
            color: #fff !important;
        }

        @media (max-width: 991px) {

            html,
            body {
                overflow-x: hidden;
            }

            .mobile-top-fix {
                margin-top: 30px;
                margin-bottom: 0px;
            }

            .mobile-bottom-fix {
                margin-bottom: 30px;
            }

            .mobile-bottom-fix-big {
                margin-bottom: 60px;
            }
        }

        .page-section {
            margin-top: 120px;
        }

        .section-heading h6 {
            font-size: 15px;
            font-weight: 700;
            color: #4da6e7;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .section-heading h4 {
            color: #2a2a2a;
            font-size: 35px;
            font-weight: 700;
            text-transform: capitalize;
            margin-bottom: 25px;
        }

        .section-heading .line-dec {
            width: 50px;
            height: 2px;
            background-color: #4da6e7;
        }

        .border-first-button button {
            display: inline-block !important;
            padding: 10px 20px !important;
            color: #4da6e7 !important;
            border: 1px solid #4da6e7 !important;
            border-radius: 23px;
            font-weight: 500 !important;
            letter-spacing: 0.3px !important;
            transition: all .5s;
            background-color: #fff;
        }

        .border-first-button button:hover {
            background-color: #4da6e7;
            color: #fff !important;
        }

        /* 
	---------------------------------------------
	header
	--------------------------------------------- 
	*/

        .pre-header {
            background-color: #efefef;
            height: 60px;
            padding: 15px 0px;
        }

        .pre-header ul li {
            display: inline-block;
        }

        .pre-header ul.info li {
            margin-right: 45px;
        }

        .pre-header ul.info li a {
            color: #afafaf;
            font-size: 14px;
            transition: all .3s;
        }

        .pre-header ul.info li a:hover {
            color: #4da6e7;
        }

        .pre-header ul.info li a i {
            font-size: 18px;
            margin-right: 8px;
        }

        .pre-header ul.social-media {
            text-align: right;
        }

        .pre-header ul.social-media li {
            margin-left: 5px;
        }

        .pre-header ul.social-media li a {
            background-color: #afafaf;
            color: #fff;
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            font-size: 14px;
            transition: all .3s;
        }

        .pre-header ul.social-media li a:hover {
            background-color: #4da6e7;
        }

        .background-header {
            background-color: #fff !important;
            height: 80px !important;
            position: fixed !important;
            top: 0px;
            left: 0px;
            right: 0px;
            box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.03);
        }

        .background-header .logo,
        .background-header .main-nav .nav li a {
            color: #fff;
        }

        .background-header .main-nav .nav li:hover a {
            color: #4da6e7;
        }

        .background-header .nav li a.active {
            position: relative;
            color: #fff;
        }

        .background-header .nav li a.active:after {
            position: absolute;
            width: 100%;
            height: 1px;
            background-color: #4da6e7;
            content: '';
            left: 50%;
            bottom: -20px;
            transform: translateX(-50%);
        }

        .background-header .nav li:last-child a.active:after {
            background-color: transparent;
        }

        .header-area {
            background-color: #fff;
            box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.03);
            position: absolute;
            left: 0px;
            right: 0px;
            z-index: 100;
            height: 100px;
            -webkit-transition: all .5s ease 0s;
            -moz-transition: all .5s ease 0s;
            -o-transition: all .5s ease 0s;
            transition: all .5s ease 0s;
        }

        .header-area .main-nav {
            min-height: 80px;
            background: transparent;
        }

        .header-area .main-nav .logo {
            float: left;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .header-area .main-nav .logo {
            line-height: 100px;
            float: left;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .background-header .main-nav .logo {
            line-height: 80px;
        }

        .background-header .main-nav .nav {
            margin-top: 20px !important;
        }

        .header-area .main-nav .nav {
            float: right;
            margin-top: 30px;
            margin-right: 0px;
            background-color: transparent;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            position: relative;
            z-index: 999;
        }

        .header-area .main-nav .nav li {
            padding-left: 20px;
            padding-right: 20px;
        }

        .header-area .main-nav .nav li:last-child {
            padding-right: 0px;
            padding-left: 40px;
        }

        .header-area .main-nav .nav li:last-child a,
        .background-header .main-nav .nav li:last-child a {
            padding: 0px 20px !important;
            font-weight: 400;
        }

        .header-area .main-nav .nav li:last-child a:hover,
        .background-header .main-nav .nav li:last-child a:hover {
            color: #fff !important;
        }

        .header-area .main-nav .nav li a {
            display: block;
            font-weight: 500;
            font-size: 15px;
            color: #2a2a2a;
            text-transform: capitalize;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            height: 40px;
            line-height: 40px;
            border: transparent;
            letter-spacing: 1px;
        }

        .header-area .main-nav .nav li:hover a,
        .header-area .main-nav .nav li a.active {
            color: #4da6e7 !important;
        }

        .background-header .main-nav .nav li:hover a,
        .background-header .main-nav .nav li a.active {
            color: #4da6e7 !important;
            opacity: 1;
        }

        .header-area .main-nav .nav li.submenu {
            position: relative;
            padding-right: 30px;
        }

        .header-area .main-nav .nav li.submenu:after {
            font-family: FontAwesome;
            content: "\f107";
            font-size: 12px;
            color: #2a2a2a;
            position: absolute;
            right: 18px;
            top: 12px;
        }

        .background-header .main-nav .nav li.submenu:after {
            color: #2a2a2a;
        }

        .header-area .main-nav .nav li.submenu ul {
            position: absolute;
            width: 200px;
            box-shadow: 0 2px 28px 0 rgba(0, 0, 0, 0.06);
            overflow: hidden;
            top: 50px;
            opacity: 0;
            transform: translateY(+2em);
            visibility: hidden;
            z-index: -1;
            transition: all 0.3s ease-in-out 0s, visibility 0s linear 0.3s, z-index 0s linear 0.01s;
        }

        .header-area .main-nav .nav li.submenu ul li {
            margin-left: 0px;
            padding-left: 0px;
            padding-right: 0px;
        }

        .header-area .main-nav .nav li.submenu ul li a {
            opacity: 1;
            display: block;
            background: #f7f7f7;
            color: #2a2a2a !important;
            padding-left: 20px;
            height: 40px;
            line-height: 40px;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            position: relative;
            font-size: 13px;
            font-weight: 400;
            border-bottom: 1px solid #eee;
        }

        .header-area .main-nav .nav li.submenu ul li a:hover {
            background: #fff;
            color: #4da6e7 !important;
            padding-left: 25px;
        }

        .header-area .main-nav .nav li.submenu ul li a:hover:before {
            width: 3px;
        }

        .header-area .main-nav .nav li.submenu:hover ul {
            visibility: visible;
            opacity: 1;
            z-index: 1;
            transform: translateY(0%);
            transition-delay: 0s, 0s, 0.3s;
        }

        .header-area .main-nav .menu-trigger {
            cursor: pointer;
            display: block;
            position: absolute;
            top: 33px;
            width: 32px;
            height: 40px;
            text-indent: -9999em;
            z-index: 99;
            right: 40px;
            display: none;
        }

        .background-header .main-nav .menu-trigger {
            top: 23px;
        }

        .header-area .main-nav .menu-trigger span,
        .header-area .main-nav .menu-trigger span:before,
        .header-area .main-nav .menu-trigger span:after {
            -moz-transition: all 0.4s;
            -o-transition: all 0.4s;
            -webkit-transition: all 0.4s;
            transition: all 0.4s;
            background-color: #2a2a2a;
            display: block;
            position: absolute;
            width: 30px;
            height: 2px;
            left: 0;
        }

        .background-header .main-nav .menu-trigger span,
        .background-header .main-nav .menu-trigger span:before,
        .background-header .main-nav .menu-trigger span:after {
            background-color: #2a2a2a;
        }

        .header-area .main-nav .menu-trigger span:before,
        .header-area .main-nav .menu-trigger span:after {
            -moz-transition: all 0.4s;
            -o-transition: all 0.4s;
            -webkit-transition: all 0.4s;
            transition: all 0.4s;
            background-color: #2a2a2a;
            display: block;
            position: absolute;
            width: 30px;
            height: 2px;
            left: 0;
            width: 75%;
        }

        .background-header .main-nav .menu-trigger span:before,
        .background-header .main-nav .menu-trigger span:after {
            background-color: #2a2a2a;
        }

        .header-area .main-nav .menu-trigger span:before,
        .header-area .main-nav .menu-trigger span:after {
            content: "";
        }

        .header-area .main-nav .menu-trigger span {
            top: 16px;
        }

        .header-area .main-nav .menu-trigger span:before {
            -moz-transform-origin: 33% 100%;
            -ms-transform-origin: 33% 100%;
            -webkit-transform-origin: 33% 100%;
            transform-origin: 33% 100%;
            top: -10px;
            z-index: 10;
        }

        .header-area .main-nav .menu-trigger span:after {
            -moz-transform-origin: 33% 0;
            -ms-transform-origin: 33% 0;
            -webkit-transform-origin: 33% 0;
            transform-origin: 33% 0;
            top: 10px;
        }

        .header-area .main-nav .menu-trigger.active span,
        .header-area .main-nav .menu-trigger.active span:before,
        .header-area .main-nav .menu-trigger.active span:after {
            background-color: transparent;
            width: 100%;
        }

        .header-area .main-nav .menu-trigger.active span:before {
            -moz-transform: translateY(6px) translateX(1px) rotate(45deg);
            -ms-transform: translateY(6px) translateX(1px) rotate(45deg);
            -webkit-transform: translateY(6px) translateX(1px) rotate(45deg);
            transform: translateY(6px) translateX(1px) rotate(45deg);
            background-color: #2a2a2a;
        }

        .background-header .main-nav .menu-trigger.active span:before {
            background-color: #2a2a2a;
        }

        .header-area .main-nav .menu-trigger.active span:after {
            -moz-transform: translateY(-6px) translateX(1px) rotate(-45deg);
            -ms-transform: translateY(-6px) translateX(1px) rotate(-45deg);
            -webkit-transform: translateY(-6px) translateX(1px) rotate(-45deg);
            transform: translateY(-6px) translateX(1px) rotate(-45deg);
            background-color: #2a2a2a;
        }

        .background-header .main-nav .menu-trigger.active span:after {
            background-color: #2a2a2a;
        }

        .header-area.header-sticky {
            min-height: 80px;
        }

        .header-area .nav {
            margin-top: 30px;
        }

        .header-area.header-sticky .nav li a.active {
            color: #4da6e7;
        }

        @media (max-width: 1200px) {
            .header-area .main-nav .nav li {
                padding-left: 12px;
                padding-right: 12px;
            }

            .header-area .main-nav:before {
                display: none;
            }
        }

        @media (max-width: 992px) {

            .header-area .main-nav .nav li:last-child,
            .background-header .main-nav .nav li:last-child {
                display: none;
            }

            .header-area .main-nav .nav li:nth-child(6),
            .background-header .main-nav .nav li:nth-child(6) {
                padding-right: 0px;
            }

            .background-header .nav li a.active:after {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .pre-header ul.info li:last-child {
                display: none;
            }

            .background-header .main-nav .nav {
                margin-top: 80px !important;
            }

            .header-area .main-nav .logo {
                color: #1e1e1e;
            }

            .header-area.header-sticky .nav li a:hover,
            .header-area.header-sticky .nav li a.active {
                color: #4da6e7 !important;
                opacity: 1;
            }

            .header-area.header-sticky .nav li.search-icon a {
                width: 100%;
            }

            .header-area {
                background-color: #fff;
                padding: 0px 15px;
                height: 100px;
                box-shadow: none;
                text-align: center;
                box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.03);
            }

            .header-area .container {
                padding: 0px;
            }

            .header-area .logo {
                margin-left: 30px;
            }

            .header-area .menu-trigger {
                display: block !important;
            }

            .header-area .main-nav {
                overflow: hidden;
            }

            .header-area .main-nav .nav {
                float: none;
                width: 100%;
                display: none;
                -webkit-transition: all 0s ease 0s;
                -moz-transition: all 0s ease 0s;
                -o-transition: all 0s ease 0s;
                transition: all 0s ease 0s;
                margin-left: 0px;
            }

            .background-header .nav {
                margin-top: 80px;
            }

            .header-area .main-nav .nav li:first-child {
                border-top: 1px solid #eee;
            }

            .header-area.header-sticky .nav {
                margin-top: 100px;
            }

            .header-area .main-nav .nav li {
                width: 100%;
                background: #fff;
                border-bottom: 1px solid #e7e7e7;
                padding-left: 0px !important;
                padding-right: 0px !important;
            }

            .header-area .main-nav .nav li a {
                height: 50px !important;
                line-height: 50px !important;
                padding: 0px !important;
                border: none !important;
                background: #f7f7f7 !important;
                color: #191a20 !important;
            }

            .header-area .main-nav .nav li a:hover {
                background: #eee !important;
                color: #4da6e7 !important;
            }

            .header-area .main-nav .nav li.submenu ul {
                position: relative;
                visibility: inherit;
                opacity: 1;
                z-index: 1;
                transform: translateY(0%);
                transition-delay: 0s, 0s, 0.3s;
                top: 0px;
                width: 100%;
                box-shadow: none;
                height: 0px;
            }

            .header-area .main-nav .nav li.submenu ul li a {
                font-size: 12px;
                font-weight: 400;
            }

            .header-area .main-nav .nav li.submenu ul li a:hover:before {
                width: 0px;
            }

            .header-area .main-nav .nav li.submenu ul.active {
                height: auto !important;
            }

            .header-area .main-nav .nav li.submenu:after {
                color: #3B566E;
                right: 25px;
                font-size: 14px;
                top: 15px;
            }

            .header-area .main-nav .nav li.submenu:hover ul,
            .header-area .main-nav .nav li.submenu:focus ul {
                height: 0px;
            }
        }

        @media (min-width: 767px) {
            .header-area .main-nav .nav {
                display: flex !important;
            }
        }


        /* 
	---------------------------------------------
	profile
	--------------------------------------------- 
	*/
        .padding {
            padding: 3rem !important
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px;
            max-width: auto;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#1e4c9e), to(#709ae0));
            background: linear-gradient(to right, #1e4c9e, #709ae0);
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
            width: 150px;
            height: 150px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px) {
            p {
                font-size: 14px;
            }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 18px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
            color: black;
            margin-top: 30px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 20px;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
            font-weight: bold;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        /* 
	---------------------------------------------
	preloader
	--------------------------------------------- 
	*/

        .js-preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            opacity: 1;
            visibility: visible;
            z-index: 9999;
            -webkit-transition: opacity 0.25s ease;
            transition: opacity 0.25s ease;
        }

        .js-preloader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        @-webkit-keyframes dot {
            50% {
                -webkit-transform: translateX(96px);
                transform: translateX(96px);
            }
        }

        @keyframes dot {
            50% {
                -webkit-transform: translateX(96px);
                transform: translateX(96px);
            }
        }

        @-webkit-keyframes dots {
            50% {
                -webkit-transform: translateX(-31px);
                transform: translateX(-31px);
            }
        }

        @keyframes dots {
            50% {
                -webkit-transform: translateX(-31px);
                transform: translateX(-31px);
            }
        }

        .preloader-inner {
            position: relative;
            width: 142px;
            height: 40px;
            background: #fff;
        }

        .preloader-inner .dot {
            position: absolute;
            width: 16px;
            height: 16px;
            top: 12px;
            left: 15px;
            background: #4da6e7;
            border-radius: 50%;
            -webkit-transform: translateX(0);
            transform: translateX(0);
            -webkit-animation: dot 2.8s infinite;
            animation: dot 2.8s infinite;
        }

        .preloader-inner .dots {
            -webkit-transform: translateX(0);
            transform: translateX(0);
            margin-top: 12px;
            margin-left: 31px;
            -webkit-animation: dots 2.8s infinite;
            animation: dots 2.8s infinite;
        }

        .preloader-inner .dots span {
            display: block;
            float: left;
            width: 16px;
            height: 16px;
            margin-left: 16px;
            background: #4da6e7;
            border-radius: 50%;
        }
		a {
			color: #0d6efd;
			text-decoration: none;
		}
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="profil.php" class="logo">
                            <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
                            <img src="assets/images/logo.jpeg" alt="logoLKTN" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="bayaran.php">Bayaran</a></li>
                            <li class="scroll-to-section"><a href="profil.php" class="active">Profil</a></li>
                            <li class="scroll-to-section">
                                <div class="border-first-button">
                                    <button id="logoutButton">Logout</button>
                                </div>
                            </li>
                        </ul>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Profile ***** -->
    <div class="page-content page-container d-flex justify-content-center align-items-center wow fadeIn"
        data-wow-duration="0.75s" data-wow-delay="0s" id="page-content" style="min-height: 100vh;">
        <div class="row container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-xl-8 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white d-flex justify-content-center align-items-center"
                                style="height: 100%;">
                                <div class="m-b-25">
                                    <img src="assets/images/profil.png" class="img-radius" alt="User-Profile-Image"
                                        style="width: 170px; height: 170px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600" style="font-size: 1.5rem;">Maklumat</h6>
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nama Penuh</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;">NAMA PENUH BINTI NAMA PENUH
                                </h6>
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Kad Pengenalan</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;">000000-00-0000</h6>
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Telefon</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;">000-0000000</h6>
                                <div class="text-end border-first-button">
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#changePasswordModal">
                                        Tukar Kata Laluan
                                    </button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#changeEditModal">
                                        Kemaskini
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tukar Kata Laluan -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Tukar Kata Laluan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Kata Laluan Semasa</label>
                            <input type="password" class="form-control" id="currentPassword"
                                placeholder="Masukkan kata laluan semasa">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Kata Laluan Baru</label>
                            <input type="password" class="form-control" id="newPassword"
                                placeholder="Masukkan kata laluan baru">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Sahkan Kata Laluan Baru</label>
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Sahkan kata laluan baru">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade" id="changeEditModal" tabindex="-1" aria-labelledby="changeEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeEditModalLabel">Edit Maklumat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentName" class="form-label">Nama Penuh</label>
                            <input type="text" class="form-control" id="currentName"
                                value="NAMA PENUH BINTI NAMA PENUH">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoKp" class="form-label">Nombor Kad Pengenalan</label>
                            <input type="text" class="form-control" id="currentNoKp" value="000000-00-0000">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">Nombor Telefon</label>
                            <input type="text" class="form-control" id="currentNoTel" value="000-0000000">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <script>
        const logoutButton = document.getElementById('logoutButton');

        // Add a click event listener to the logout button
        logoutButton.addEventListener('click', function() {
            // Show the confirmation dialog
            Swal.fire({
                title: "Log Keluar",
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Log Keluar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Handle the logout logic here (e.g., redirecting to a logout route)
                    // Example: window.location.href = '/logout';

                    // Show the success dialog
                    Swal.fire({
                        title: "Logged out!",
                        text: "You have been successfully logged out.",
                        icon: "success"
                    }).then(() => {
                        // Optionally, redirect the user after the success dialog
                        window.location.href = 'controller/auth/logout.php'; // Update with your actual logout URL
                    });
                }
            });
        });
    </script>
</body>

</html>