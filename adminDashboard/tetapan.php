<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .custom-container {
            position: relative;
            width: 100%;
        }

        ul {
            all: unset;
            list-style: disc;
            /* padding-left: 20px; */
            margin: 0;
        }

        nav .breadcrumb {
            margin-left: 24px;
        }

        /* ================== Table details ============== */
        .recentOrders {
            position: relative;
            /* display: grid; */
            min-height: 500px;
            background: var(--white);
            padding: 20px 40px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .buttonSettings {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 40px;
            /* Add gap between buttons */
        }

        .buttonSettings button {
            padding: 20px 15px;
            /* Adjust padding */
            width: 100%;
            text-align: start;
            font-size: x-large;
            background-color: #fff;
            /* Set a background color */
            border: none;
            /* Remove border */
            border-radius: 8px;
            /* Add border radius */
            box-shadow: none;
            /* Remove default shadow */
            transition: box-shadow 0.3s ease-in-out;
            /* Smooth transition for shadow */
            display: flex;
            justify-content: space-between;
            /* Align text and icon */
            align-items: center;
            /* Center content vertically */
            position: relative;
            
        }

        .buttonSettings button:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            /* Add shadow on hover */
        }

        .buttonSettings button::after {
            content: "";
            display: block;
            width: 100%;
            height: 2px;
            background-color: #2a2185;
            /* Line color */
            position: absolute;
            bottom: -20px;
            /* Positioning the line */
            left: 0;
        }

        .buttonSettings div:last-child button::after {
            display: none;
            /* Remove line after the last button */
        }
    </style>

</head>

<body>
    <div class="custom-container">
        <?php
        include 'partials/navigation.php';
        ?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="userName">
                    <div class="user-name">NAMA BINTI PENUH</div>
                    <div class="user">
                        <img src="assets/images/user.png" alt="User Image">
                    </div>
                </div>
            </div>


            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>TETAPAN</h2>
                </div>

                <div class="buttonSettings">
                    <!-- <div>
                        <button onclick="window.location.href='crud_jawatan.php'">
                            Jawatan <span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div> -->
                    <div>
                        <button onclick="window.location.href='crud_lesen.php'">
                            Lesen <span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                    <div>
                        <button onclick="window.location.href='crud_tugasan.php'">
                            Tugasan<span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                    <!-- <div>
                        <button onclick="window.location.href='crud_tugasan_jengkaut.php'">
                            Tugasan Jengkaut<span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div> -->
                    <div>
                        <button onclick="window.location.href='crud_kategori_kenderaan.php'">
                            Kategori Kenderaan <span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>