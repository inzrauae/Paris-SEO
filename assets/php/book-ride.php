<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Paris Fast Transfer | Taxi Booking</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/New_Project__2_-removebg-preview.png" >

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/jquery.timepicker.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Google Maps autocomplete dropdown */
        .pac-container {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border: 1px solid #e0e0e0;
            font-family: inherit;
            z-index: 9999 !important;
        }
        .pac-item {
            padding: 8px 16px;
            font-size: 15px;
            cursor: pointer;
        }
        .pac-item:hover {
            background-color: #f5f5f5;
        }
        .pac-icon {
            margin-top: 6px;
        }

        /* Baby Seats — match .booking-form .form-control style */
        .booking-form .form-group select.form-control {
            padding: 14px 50px 14px 20px;
            border-radius: 12px;
            font-size: 18px;
            box-shadow: none;
            color: var(--body-text-color);
            border: 1px solid #dee2e6;
            background-color: #fff;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            width: 100%;
            height: auto;
        }
        .booking-form .form-group select.form-control:focus {
            border-color: var(--theme-color);
            outline: none;
        }

        /* Location Picker Styles */
        .location-input-wrapper {
            position: relative;
            display: flex !important;
            flex-direction: column;
        }

        .location-input-wrapper input {
            padding-right: 45px !important;
        }

        .location-icon-btn {
            position: absolute;
            right: 12px;
            top: 42px;
            background: none;
            border: none;
            cursor: pointer;
            color: #FF6B35;
            font-size: 18px;
            padding: 8px;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .location-icon-btn:hover {
            transform: scale(1.2);
            color: #FF5520;
        }

        .location-icon-btn:active {
            transform: scale(0.95);
        }

        /* Google Maps Modal */
        .map-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
            align-items: center;
            justify-content: center;
        }

        .map-modal.active {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .map-modal-content {
            background-color: white;
            padding: 0;
            border-radius: 12px;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .map-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid #e0e0e0;
            background: linear-gradient(135deg, #FF6B35 0%, #FF8555 100%);
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .map-modal-header h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .map-modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .map-modal-close:hover {
            transform: rotate(90deg);
        }

        .map-modal-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow: hidden;
        }

        .map-search-wrapper {
            padding: 12px 16px;
            background: #f5f5f5;
            border-bottom: 1px solid #e0e0e0;
        }

        .map-search-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .map-search-input:focus {
            border-color: #FF6B35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        #map {
            flex: 1;
            min-height: 400px;
            border-radius: 0;
        }

        .predefined-locations {
            padding: 10px 16px;
            background: #fafafa;
            border-bottom: 1px solid #e0e0e0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 8px;
            max-height: 80px;
            overflow-y: auto;
        }

        .location-btn {
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
            font-weight: 500;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .location-btn:hover {
            background: #FF6B35;
            color: white;
            border-color: #FF6B35;
        }

        .location-btn.selected {
            background: #FF6B35;
            color: white;
            border-color: #FF6B35;
        }

        .map-modal-footer {
            padding: 12px 16px;
            border-top: 1px solid #e0e0e0;
            background: #f9f9f9;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            border-radius: 0 0 12px 12px;
        }

        .map-select-btn,
        .map-cancel-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .map-select-btn {
            background: #FF6B35;
            color: white;
        }

        .map-select-btn:hover:not(:disabled) {
            background: #FF5520;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }

        .map-select-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .map-cancel-btn {
            background: #e0e0e0;
            color: #333;
        }

        .map-cancel-btn:hover {
            background: #d0d0d0;
        }

        .selected-location-info {
            padding: 8px 16px;
            background: #e8f5e9;
            border-bottom: 1px solid #c8e6c9;
            font-size: 13px;
            color: #2e7d32;
        }

        @media (max-width: 768px) {
            .map-modal-content {
                width: 95%;
                max-height: 95vh;
            }
            .predefined-locations {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            }
        }
    </style>

</head>

<body>


    <style>
        /* Make the input non-editable */
        .non-editable {
            pointer-events: none;
            /* Disables mouse and keyboard interactions */
            background-color: #f0f0f0;
            /* Optional: Change background to indicate non-editable */
            color: #666;
            /* Optional: Change text color */
        }
    </style>

    <!-- preloader -->
    <div class="preloader">
        <div class="loader-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- header area -->
    <header class="header">
        <!-- top header -->
        <!-- ========== Top Bar Start ========== -->
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrapper">
                    <!-- Left Side (Contact Info) -->
                    <div class="header-top-left">
                        <div class="header-top-contact">
                            <ul>
                                <li><a href="mailto:info@example.com"><i class="far fa-envelopes"></i>
                                        Parisfasttransfer@gmail.com</a></li>
                                <li><a href="tel:+21236547898"><i class="far fa-phone-volume"></i> +33 752 24 44 44</a>
                                </li>
                                <li><a href="#"><i class="far fa-alarm-clock"></i> Sun - Fri (08AM - 10PM)</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Language Switcher -->
            <div id="google_translate_element" style="display:none;"></div>

<!-- 🌍 FLAG SWITCHER -->
<div class="premium-lang-box">
    <img src="https://flagcdn.com/48x36/gb.png" id="flag-en" class="flag-btn" onclick="translateLanguage('en')" alt="flag">
    <img src="https://flagcdn.com/48x36/fr.png" id="flag-fr" class="flag-btn" onclick="translateLanguage('fr')" alt="flag">
    <img src="https://flagcdn.com/48x36/it.png" id="flag-it" class="flag-btn" onclick="translateLanguage('it')" alt="flag">
    <img src="https://flagcdn.com/48x36/es.png" id="flag-es" class="flag-btn" onclick="translateLanguage('es')" alt="flag">
    
</div>

<style>
/* 🌍 FLAG BUTTONS */
.premium-lang-box {
    display: flex;
    gap: 12px;
    align-items: center;
    
}

.flag-btn {
    width: 32px;
    height: 22px;
    object-fit: cover;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s ease;
    border: 2px solid transparent;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    
}

.flag-btn:hover {
    transform: translateY(-3px);
}

.flag-active {
    border-color: #007bff;
    transform: translateY(-3px);
    box-shadow: 0 0 10px rgba(0,123,255,0.7);
}

/* 🔥 HIDE GOOGLE TRANSLATE POPUP */
.goog-te-spinner-pos,
.goog-te-balloon-frame,
.goog-tooltip,
.goog-tooltip:hover,
.goog-text-highlight,
.goog-te-menu-frame,
.goog-te-banner-frame,
.skiptranslate iframe {
    display: none !important;
    opacity: 0 !important;
    visibility: hidden !important;
    height: 0 !important;
}

body { top: 0px !important; }
.goog-text-highlight { background: none !important; }
</style>

<script>
/* INIT Google Translate */
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,fr,it,es'
    }, 'google_translate_element');
}

/* FLAG CLICK → CHANGE LANGUAGE */
function translateLanguage(lang) {
    let combo = document.querySelector(".goog-te-combo");
    if (combo) {
        combo.value = lang;
        combo.dispatchEvent(new Event("change"));
    }

    // Active flag UI
    document.querySelectorAll(".flag-btn").forEach(f => f.classList.remove("flag-active"));
    document.getElementById("flag-" + lang).classList.add("flag-active");
}

/* FORCE REMOVE POPUP */
setInterval(() => {
    document.querySelectorAll(".goog-te-banner-frame, .goog-te-balloon-frame, .goog-tooltip")
        .forEach(el => el.remove());

    document.body.style.top = "0px";
}, 100);
</script>

<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>




                        <!-- Social Links -->
                        <div class="header-top-social">
                            <span>Follow Us: </span>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== Top Bar End ========== -->

        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">
                    <a class="navbar-brand" href="index.html">
                        <img src="assets/img/logo/logo-light.png" alt="Parisfasttransfer">
                    </a>
                    <div class="mobile-menu-right">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link " href="index.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="service.html">Our Services</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="taxi-rate.html">Our Rates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="partner.html">Partner</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="blog.html">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.html">Contact Us</a>
                            </li>
                        </ul>

                        <!-- Keep only Book A Taxi button -->
                        <div class="nav-right">
                            <div class="nav-right-btn mt-2">
                                <a href="#" class="theme-btn"><span class="fas fa-taxi"></span> Book A Taxi</a>
                            </div>
                        </div>
                    </div>

                    <!-- search area -->
                    <div class="search-area">
                        <form action="#">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Type Keyword...">
                                <button type="submit" class="search-icon-btn"><i class="far fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- search area end -->
                </div>
            </nav>
        </div>
    </header>
    <!-- header area end -->


    <main class="main">

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitize and validate inputs
            $pickup = htmlspecialchars(trim($_POST['pickup'])) ?? "";
            $dropoff = htmlspecialchars(trim($_POST['dropoff'])) ?? "";
            $passengers = htmlspecialchars(trim($_POST['passengers'])) ?? "";
            $pickupType = htmlspecialchars(trim($_POST['pickupType'])) ?? "";
        }
        ?>

        <!-- book ride -->
        <div class="book-ride py-120">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="booking-form">
                            <div class="book-ride-head">
                                <h4 class="booking-title">Make Your Booking Today</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using is that it has
                                    distribution of letters to using content here making it look like readable.</p>
                            </div>


                            <style>
                                .booking-info {
                                    border: 1px solid #ddd;
                                    padding: 15px;
                                    border-radius: 8px;
                                    background-color: #f9f9f9;
                                    margin-bottom: 20px;
                                }
                            </style>

                            <div class="row booking-info">
                                <div class="col-md-2 col-sm-5 pickup-address">
                                    <h5>Pickup</h5>
                                    <p> <?php echo $pickup ?? ''; ?> </p>
                                </div>
                                <div class="col-md-3 col-sm-5 drop-address">
                                    <h5>Drop Off</h5>
                                    <p> <?php echo $dropoff ?? ''; ?> </p>
                                </div>

                                <div class="col-md-3 col-sm-5 drop-address">
                                    <h5>Passengers</h5>
                                    <p>
                                        <i class="fa fa-user"></i> X <?php echo $passengers ?? '0'; ?>
                                    </p>
                                </div>

                                <div class="col-md-2 col-sm-5 booking-amount">
                                    <h5>Pickup type</h5>
                                    <h6>
                                        <span style="color: gray;"><?php echo $pickupType ?? ''; ?></span>
                                    </h6>
                                </div>

                                <div class="col-md-2 col-sm-5 booking-amount">
                                    <h5>Price</h5>
                                    <h6>
                                        <span id="price" style="color: red;"> 0 </span>
                                    </h6>
                                </div>
                            </div>


                            <form action="./assets/php/mail.php" method="POST">

                                <div class="row">
                                    

                                    <!-- Hidden fields for pickup/dropoff from previous page -->
                                    <div class="col-lg-6" style="display: none;">
                                        <div class="form-group">
                                            <label>Pick Up Location</label>
                                            <input type="text" name="pickup" class="form-control non-editable"
                                                id="br-pickup" placeholder="Type Location"
                                                value="<?php echo $pickup ?? ''; ?>">
                                            <i class="far fa-location-dot"></i>
                                        </div>
                                    </div>
                                    <div style="display: none;" class="col-lg-6">
                                        <div class="form-group">
                                            <label>Drop Off Location</label>
                                            <input require type="text" name="dropoff" class="form-control non-editable"
                                                id="br-dropoff" placeholder="Type Location"
                                                value="<?php echo $dropoff ?? ''; ?>">
                                            <i class="far fa-location-dot"></i>
                                        </div>
                                    </div>


                                    <h4 class="booking-title">PickUp Details</h4>
                                    <div class="col-lg-6">
                                        <div class="form-group location-input-wrapper">
                                            <label>Pickup Location : Address with City</label>
                                            <input type="text" name="pickupaddr" class="form-control"
                                                id="br-pickup-address" placeholder="Address with City" required>
                                            <button type="button" class="location-icon-btn" id="pickup-map-btn" title="Select from Map">
                                                <i class="fas fa-map-location-dot"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="display: none;">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input require type="text" name="price" class="form-control non-editable"
                                                id="br-price" placeholder="Type price" value="">
                                            <i class="far fa-location-dot"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group location-input-wrapper">
                                            <label>Drop Off Location : Address with City</label>
                                            <input type="text" name="dropoffaddr" class="form-control"
                                                id="br-dropoff-address" placeholder="Address with City" required>
                                            <button type="button" class="location-icon-btn" id="dropoff-map-btn" title="Select from Map">
                                                <i class="fas fa-map-location-dot"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div style="display: none;" class="col-lg-6">
                                        <div class="form-group">
                                            <label>Passengers</label>
                                            <input type="text" name="passengers" class="form-control non-editable"
                                                id="br-passengers" placeholder="Passengers"
                                                value="<?php echo $passengers ?? '0'; ?>" required>
                                            <i class="far fa-user-tie"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Pick Up Date</label>
                                            <input type="text" required name="date" class="form-control date-picker"
                                                id="br-date" placeholder="MM/DD/YY">
                                            <i class="far fa-calendar-days"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="display: none;">
                                        <div class="form-group">
                                            <label>Pick type</label>
                                            <input type="text" required name="pickuptype" id="pickupType"
                                                class="form-control non-editable"
                                                value="<?php echo $pickupType ?? ''; ?>" id="br-pickuptype"
                                                placeholder="Pick Up Type">
                                            <i class='fas fa-car'></i>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Pick Up Time</label>
                                            <input type="text" required name="time" class="form-control time-picker"
                                                id="br-time" placeholder="00:00 AM">
                                            <i class="far fa-clock"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Flight/ Train Number</label>
                                            <input type="text" required name="flight" class="form-control flight-picker"
                                                id="br-flight" placeholder="ABC 123" required>
                                            <i class="far fa-location-dot"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Baby Seats</label>
                                            <select name="babyseat" class="form-control" id="br-babyseats">
                                                <option value="0">NO</option>
                                                <option value="1">1 seat</option>
                                                <option value="2">2 seat</option>
                                                <option value="3">3 seat</option>
                                            </select>
                                            <i class="far fa-baby-carriage"></i>
                                        </div>
                                    </div>

                                    <!-- Return section: shown only when pickupType === "Return" -->
                                    <div id="return-section" class="row" style="display: none; width: 100%;">
                                        <h4 class="booking-title">Return Details</h4>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Return Pickup Location : Address with City</label>
                                                <input type="text" name="return_pickupaddr" class="form-control"
                                                    id="br-return-pickup-address" placeholder="Address with City">
                                                <i class="far fa-location-dot"></i>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Return Drop Off Location</label>
                                                <input type="text" name="return_dropoff" class="form-control"
                                                    id="br-return-dropoff" placeholder="Address with City">
                                                <i class="far fa-location-dot"></i>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Return Pick Up Date</label>
                                                <input type="text" name="return_date" class="form-control date-picker"
                                                    id="br-return-date" placeholder="MM/DD/YY">
                                                <i class="far fa-calendar-days"></i>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Return Pick Up Time</label>
                                                <input type="text" name="return_time" class="form-control time-picker"
                                                    id="br-return-time" placeholder="00:00 AM">
                                                <i class="far fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>




                                    <h4 class="booking-title">Customer Details</h4>
                                    <div class="col-lg-4">
                                        <div class="form-group">

                                            <label>Full Name</label>
                                            <input require name="name" type="text" class="form-control" id="br-name"
                                                placeholder="Your Name" required>
                                            <i class="far fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input id="br-phone" type="tel" name="phone" class="form-control"
                                                placeholder="Your Phone" required>
                                            <i class="far fa-phone"></i>
                                        </div>
                                    </div>

                                    <!-- CSS -->
                                    <link rel="stylesheet"
                                        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />

                                    <!-- JS -->
                                    <script
                                        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

                                    <script>
                                        const input = document.querySelector("#br-phone");
                                        const iti = window.intlTelInput(input, {
                                            initialCountry: "auto",
                                            separateDialCode: true, // ✅ This line shows the country code next to flag
                                            geoIpLookup: function (callback) {
                                                fetch('https://ipapi.co/json')
                                                    .then(res => res.json())
                                                    .then(data => callback(data.country_code))
                                                    .catch(() => callback("us"));
                                            },
                                            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
                                        });

                                        function updateFullNumber() {
                                            let enteredNumber = input.value.trim();

                                            // 🧹 Remove spaces and multiple "+" if any
                                            enteredNumber = enteredNumber.replace(/\s+/g, '').replace(/^(\+)+/, '+');

                                            // 🧠 If already includes "+countrycode", skip re-adding it
                                            const dialCode = iti.getSelectedCountryData().dialCode;
                                            const regex = new RegExp(`^\\+?${dialCode}`);

                                            // Remove all non-digit characters except +
                                            let digitsOnly = enteredNumber.replace(/[^0-9+]/g, '');

                                            // If it already starts with + and correct dial code, don't change
                                            if (regex.test(digitsOnly)) {
                                                input.value = digitsOnly;
                                                return;
                                            }

                                            // Remove leading 0
                                            digitsOnly = digitsOnly.replace(/^0+/, '');

                                            // ✅ Add correct full number only once
                                            input.value = `+${dialCode}${digitsOnly}`;
                                        }

                                        // When flag (country) changes or user finishes typing
                                        input.addEventListener('countrychange', updateFullNumber);
                                        input.addEventListener('blur', updateFullNumber);

                                    </script>


                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input require type="text" name="email" class="form-control" id="br-email"
                                                placeholder="Your Email" required>
                                            <i class="far fa-envelope"></i>
                                        </div>
                                    </div>

                                    
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Your Message</label>
                                            <textarea name="message" class="form-control" id="br-message" rows="5"
                                                placeholder="Write Your Message"></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="condition" required>
                                            <label class="form-check-label" for="condition">
                                                By using this form you agree to our terms & conditions.
                                            </label>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-3 mx-auto">
                                        <button class="theme-btn" type="submit">Book Your Taxi<i
                                                class="fas fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="booking-bottom"
                                style="display:flex;justify-content:flex-start;align-items:center;gap:10px;margin-top:16px;">
                                <a href="index.html"
                                    style="display:inline-flex;align-items:center;gap:8px;color:#111827;text-decoration:none;font-weight:600;">
                                    <i class="fas fa-home"></i>
                                    Back To Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- book ride end -->


    </main>



    <!-- footer area -->
    <footer class="footer-area">
        <!-- WhatsApp Button -->
        <div id="whatsapp-button" class="whatsapp-button">
            <a href="https://wa.me/+33752244444" target="_blank" rel="noopener noreferrer">
                <img src="assets/img/slider/R.png" alt="WhatsApp Icon">
            </a>
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-120 pb-70">
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">
                            <a href="#" class="footer-logo">
                                <img src="assets/img/taxi/New Project.png" alt="Parisfasttransfer">
                            </a>
                            <p class="mb-3">
                                Travelling from Charles de Gaulle Airport or other Paris airports to Disneyland or
                                around Paris has never been easier.
                                Paris Fast Transfer provides safe, reliable, and comfortable transfers with professional
                                drivers to make your journey smooth and stress-free.
                            </p>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="index.html"><i class="fas fa-caret-right"></i> Home</a></li>
                                <li><a href="about.html"><i class="fas fa-caret-right"></i> About Us</a></li>
                                <li><a href="taxi-rate.html"><i class="fas fa-caret-right"></i> Our Rates</a></li>
                                <li><a href="partner.html"><i class="fas fa-caret-right"></i>Paris Fast Transfer</a>
                                </li>
                                <li><a href="contact.html"><i class="fas fa-caret-right"></i> Contact Us</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Routes</h4>
                            <ul class="footer-list">
                                <li><a href=""><i class="fas fa-caret-right"></i> Paris</a></li>
                                <li><a href=""><i class="fas fa-caret-right"></i> Disneyland</a></li>
                                <li><a href=""><i class="fas fa-caret-right"></i> Airport Charles de Gaulle</a></li>
                                <li><a href=""><i class="fas fa-caret-right"></i> Airport Orly</a></li>
                                <li><a href=""><i class="fas fa-caret-right"></i> Airport Beauvais</a></li>
                                <li><a href=""><i class="fas fa-caret-right"></i> Parc Asterix</a></li>
                                <li><a href=""><i class="fas fa-caret-right"></i> Charles de Gaulle</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Contact Info</h4>
                            <ul class="footer-contact">
                                <li><a href="tel:+33752244444"><i class="far fa-phone"></i>+33 752 24 44 44</a></li>
                                <li><i class="far fa-map-marker-alt"></i>Paris, France</li>
                                <li><a href="mailto:pdairportcab@gmail.com"><i
                                            class="far fa-envelope"></i>Parisfasttransfer@gmail.com</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p class="copyright-text">
                            &copy; Copyright <span id="date"></span> <a href="#"> Paris Fast Transfer </a> All Rights
                            Reserved.
                        </p>

                    </div>
                    <div class="col-md-6 align-self-center">
                        <ul class="footer-social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->



    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <!-- scroll-top end -->


    <!-- js -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/jquery.appear.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/counter-up.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.timepicker.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        $(document).ready(function () {
            // Date pickers — today as minimum date
            $(".date-picker").datepicker({
                dateFormat: "mm/dd/yy",
                minDate: 0,
                changeMonth: true,
                changeYear: true,
                showAnim: "fadeIn"
            });

            // Time pickers
            $(".time-picker").timepicker({
                timeFormat: "hh:mm",
                interval: 15,
                minTime: "12:00am",
                maxTime: "11:45pm",
                defaultTime: "",
                startTime: "12:00am",
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });

        function normalize(text) {
            return text.trim().toLowerCase();
        }

        function calculatePrice(from, to, passengerCount) {
             const prices = [
                // CDG → Disneyland
                { from: "Airport CDG", to: "Disneyland", pax: 1, price: 70 },
                { from: "Airport CDG", to: "Disneyland", pax: 2, price: 75 },
                { from: "Airport CDG", to: "Disneyland", pax: 3, price: 85 },
                { from: "Airport CDG", to: "Disneyland", pax: 4, price: 90 },
                { from: "Airport CDG", to: "Disneyland", pax: 5, price: 90 },
                { from: "Airport CDG", to: "Disneyland", pax: 6, price: 95 },
                { from: "Airport CDG", to: "Disneyland", pax: 7, price: 155 },
                { from: "Airport CDG", to: "Disneyland", pax: 8, price: 160 },
                { from: "Airport CDG", to: "Disneyland", pax: 9, price: 165 },
                { from: "Airport CDG", to: "Disneyland", pax: 10, price: 170 },
                { from: "Airport CDG", to: "Disneyland", pax: 11, price: 175 },
                { from: "Airport CDG", to: "Disneyland", pax: 12, price: 180 },
                { from: "Airport CDG", to: "Disneyland", pax: 13, price: 185 },
                { from: "Airport CDG", to: "Disneyland", pax: 14, price: 185 },
                { from: "Airport CDG", to: "Disneyland", pax: 15, price: 245 },
                { from: "Airport CDG", to: "Disneyland", pax: 16, price: 250 },
                { from: "Airport CDG", to: "Disneyland", pax: 17, price: 260 },
                { from: "Airport CDG", to: "Disneyland", pax: 18, price: 265 },
                { from: "Airport CDG", to: "Disneyland", pax: 19, price: 265 },

                { from: "Disneyland", to: "Airport CDG", pax: 1, price: 70 },
                { from: "Disneyland", to: "Airport CDG", pax: 2, price: 75 },
                { from: "Disneyland", to: "Airport CDG", pax: 3, price: 85 },
                { from: "Disneyland", to: "Airport CDG", pax: 4, price: 90 },
                { from: "Disneyland", to: "Airport CDG", pax: 5, price: 90 },
                { from: "Disneyland", to: "Airport CDG", pax: 6, price: 95 },
                { from: "Disneyland", to: "Airport CDG", pax: 7, price: 155 },
                { from: "Disneyland", to: "Airport CDG", pax: 8, price: 160 },
                { from: "Disneyland", to: "Airport CDG", pax: 9, price: 165 },
                { from: "Disneyland", to: "Airport CDG", pax: 10, price: 170 },
                { from: "Disneyland", to: "Airport CDG", pax: 11, price: 175 },
                { from: "Disneyland", to: "Airport CDG", pax: 12, price: 180 },
                { from: "Disneyland", to: "Airport CDG", pax: 13, price: 185 },
                { from: "Disneyland", to: "Airport CDG", pax: 14, price: 185 },
                { from: "Disneyland", to: "Airport CDG", pax: 15, price: 245 },
                { from: "Disneyland", to: "Airport CDG", pax: 16, price: 250 },
                { from: "Disneyland", to: "Airport CDG", pax: 17, price: 260 },
                { from: "Disneyland", to: "Airport CDG", pax: 18, price: 265 },
                { from: "Disneyland", to: "Airport CDG", pax: 19, price: 265 },

                // ORLY → Disneyland
                { from: "Airport Orly", to: "Disneyland", pax: 1, price: 80 },
                { from: "Airport Orly", to: "Disneyland", pax: 2, price: 85 },
                { from: "Airport Orly", to: "Disneyland", pax: 3, price: 90 },
                { from: "Airport Orly", to: "Disneyland", pax: 4, price: 100 },
                { from: "Airport Orly", to: "Disneyland", pax: 5, price: 105 },
                { from: "Airport Orly", to: "Disneyland", pax: 6, price: 110 },
                { from: "Airport Orly", to: "Disneyland", pax: 7, price: 180 },
                { from: "Airport Orly", to: "Disneyland", pax: 8, price: 180 },
                { from: "Airport Orly", to: "Disneyland", pax: 9, price: 185 },
                { from: "Airport Orly", to: "Disneyland", pax: 10, price: 195 },
                { from: "Airport Orly", to: "Disneyland", pax: 11, price: 200 },
                { from: "Airport Orly", to: "Disneyland", pax: 12, price: 200 },
                { from: "Airport Orly", to: "Disneyland", pax: 13, price: 210 },
                { from: "Airport Orly", to: "Disneyland", pax: 14, price: 215 },
                { from: "Airport Orly", to: "Disneyland", pax: 15, price: 275 },
                { from: "Airport Orly", to: "Disneyland", pax: 16, price: 280 },
                { from: "Airport Orly", to: "Disneyland", pax: 17, price: 290 },
                { from: "Airport Orly", to: "Disneyland", pax: 18, price: 295 },
                { from: "Airport Orly", to: "Disneyland", pax: 19, price: 300 },

                { from: "Disneyland", to: "Airport Orly", pax: 1, price: 80 },
                { from: "Disneyland", to: "Airport Orly", pax: 2, price: 85 },
                { from: "Disneyland", to: "Airport Orly", pax: 3, price: 90 },
                { from: "Disneyland", to: "Airport Orly", pax: 4, price: 100 },
                { from: "Disneyland", to: "Airport Orly", pax: 5, price: 105 },
                { from: "Disneyland", to: "Airport Orly", pax: 6, price: 110 },
                { from: "Disneyland", to: "Airport Orly", pax: 7, price: 180 },
                { from: "Disneyland", to: "Airport Orly", pax: 8, price: 180 },
                { from: "Disneyland", to: "Airport Orly", pax: 9, price: 185 },
                { from: "Disneyland", to: "Airport Orly", pax: 10, price: 195 },
                { from: "Disneyland", to: "Airport Orly", pax: 11, price: 200 },
                { from: "Disneyland", to: "Airport Orly", pax: 12, price: 200 },
                { from: "Disneyland", to: "Airport Orly", pax: 13, price: 210 },
                { from: "Disneyland", to: "Airport Orly", pax: 14, price: 215 },
                { from: "Disneyland", to: "Airport Orly", pax: 15, price: 275 },
                { from: "Disneyland", to: "Airport Orly", pax: 16, price: 280 },
                { from: "Disneyland", to: "Airport Orly", pax: 17, price: 290 },
                { from: "Disneyland", to: "Airport Orly", pax: 18, price: 295 },
                { from: "Disneyland", to: "Airport Orly", pax: 19, price: 300 },


                // Beauvais → Disneyland
                { from: "Beauvais Airport", to: "Disneyland", pax: 1, price: 155 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 2, price: 160 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 3, price: 175 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 4, price: 180 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 5, price: 185 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 6, price: 185 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 7, price: 330 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 8, price: 335 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 9, price: 355 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 10, price: 350 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 11, price: 355 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 12, price: 360 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 13, price: 365 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 14, price: 365 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 15, price: 490 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 16, price: 490 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 17, price: 535 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 18, price: 535 },
                { from: "Beauvais Airport", to: "Disneyland", pax: 19, price: 535 },

                { from: "Disneyland", to: "Beauvais Airport", pax: 1, price: 155 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 2, price: 160 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 3, price: 175 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 4, price: 180 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 5, price: 185 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 6, price: 185 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 7, price: 330 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 8, price: 335 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 9, price: 355 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 10, price: 350 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 11, price: 355 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 12, price: 360 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 13, price: 365 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 14, price: 365 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 15, price: 490 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 16, price: 490 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 17, price: 535 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 18, price: 535 },
                { from: "Disneyland", to: "Beauvais Airport", pax: 19, price: 535 },

                // CDG → Paris
                { from: "Airport CDG", to: "Paris", pax: 1, price: 75 },
                { from: "Airport CDG", to: "Paris", pax: 2, price: 90 },
                { from: "Airport CDG", to: "Paris", pax: 3, price: 90 },
                { from: "Airport CDG", to: "Paris", pax: 4, price: 95 },
                { from: "Airport CDG", to: "Paris", pax: 5, price: 100 },
                { from: "Airport CDG", to: "Paris", pax: 6, price: 105 },
                { from: "Airport CDG", to: "Paris", pax: 7, price: 185 },
                { from: "Airport CDG", to: "Paris", pax: 8, price: 185 },
                { from: "Airport CDG", to: "Paris", pax: 9, price: 190 },
                { from: "Airport CDG", to: "Paris", pax: 10, price: 190 },
                { from: "Airport CDG", to: "Paris", pax: 11, price: 195 },
                { from: "Airport CDG", to: "Paris", pax: 12, price: 200 },
                { from: "Airport CDG", to: "Paris", pax: 13, price: 200 },
                { from: "Airport CDG", to: "Paris", pax: 14, price: 290 },
                { from: "Airport CDG", to: "Paris", pax: 15, price: 295 },
                { from: "Airport CDG", to: "Paris", pax: 16, price: 300 },
                { from: "Airport CDG", to: "Paris", pax: 17, price: 300 },
                { from: "Airport CDG", to: "Paris", pax: 18, price: 300 },
                { from: "Airport CDG", to: "Paris", pax: 19, price: 300 },

                { from: "Paris", to: "Airport CDG", pax: 1, price: 75 },
                { from: "Paris", to: "Airport CDG", pax: 2, price: 90 },
                { from: "Paris", to: "Airport CDG", pax: 3, price: 90 },
                { from: "Paris", to: "Airport CDG", pax: 4, price: 95 },
                { from: "Paris", to: "Airport CDG", pax: 5, price: 100 },
                { from: "Paris", to: "Airport CDG", pax: 6, price: 105 },
                { from: "Paris", to: "Airport CDG", pax: 7, price: 185 },
                { from: "Paris", to: "Airport CDG", pax: 8, price: 185 },
                { from: "Paris", to: "Airport CDG", pax: 9, price: 190 },
                { from: "Paris", to: "Airport CDG", pax: 10, price: 190 },
                { from: "Paris", to: "Airport CDG", pax: 11, price: 195 },
                { from: "Paris", to: "Airport CDG", pax: 12, price: 200 },
                { from: "Paris", to: "Airport CDG", pax: 13, price: 200 },
                { from: "Paris", to: "Airport CDG", pax: 14, price: 290 },
                { from: "Paris", to: "Airport CDG", pax: 15, price: 295 },
                { from: "Paris", to: "Airport CDG", pax: 16, price: 300 },
                { from: "Paris", to: "Airport CDG", pax: 17, price: 300 },
                { from: "Paris", to: "Airport CDG", pax: 18, price: 300 },
                { from: "Paris", to: "Airport CDG", pax: 19, price: 300 },

                // Beauvais → Paris
                { from: "Beauvais", to: "Paris", pax: 1, price: 155 },
                { from: "Beauvais", to: "Paris", pax: 2, price: 160 },
                { from: "Beauvais", to: "Paris", pax: 3, price: 165 },
                { from: "Beauvais", to: "Paris", pax: 4, price: 170 },
                { from: "Beauvais", to: "Paris", pax: 5, price: 175 },
                { from: "Beauvais", to: "Paris", pax: 6, price: 180 },
                { from: "Beauvais", to: "Paris", pax: 7, price: 330 },
                { from: "Beauvais", to: "Paris", pax: 8, price: 335 },
                { from: "Beauvais", to: "Paris", pax: 9, price: 360 },
                { from: "Beauvais", to: "Paris", pax: 10, price: 360 },
                { from: "Beauvais", to: "Paris", pax: 11, price: 360 },
                { from: "Beauvais", to: "Paris", pax: 12, price: 365 },
                { from: "Beauvais", to: "Paris", pax: 13, price: 370 },
                { from: "Beauvais", to: "Paris", pax: 14, price: 375 },
                { from: "Beauvais", to: "Paris", pax: 15, price: 515 },
                { from: "Beauvais", to: "Paris", pax: 16, price: 545 },
                { from: "Beauvais", to: "Paris", pax: 17, price: 545 },
                { from: "Beauvais", to: "Paris", pax: 18, price: 545 },
                { from: "Beauvais", to: "Paris", pax: 19, price: 545 },


                { from: "Paris", to: "Beauvais", pax: 1, price: 155 },
                { from: "Paris", to: "Beauvais", pax: 2, price: 160 },
                { from: "Paris", to: "Beauvais", pax: 3, price: 165 },
                { from: "Paris", to: "Beauvais", pax: 4, price: 170 },
                { from: "Paris", to: "Beauvais", pax: 5, price: 175 },
                { from: "Paris", to: "Beauvais", pax: 6, price: 180 },
                { from: "Paris", to: "Beauvais", pax: 7, price: 330 },
                { from: "Paris", to: "Beauvais", pax: 8, price: 335 },
                { from: "Paris", to: "Beauvais", pax: 9, price: 360 },
                { from: "Paris", to: "Beauvais", pax: 10, price: 360 },
                { from: "Paris", to: "Beauvais", pax: 11, price: 360 },
                { from: "Paris", to: "Beauvais", pax: 12, price: 365 },
                { from: "Paris", to: "Beauvais", pax: 13, price: 370 },
                { from: "Paris", to: "Beauvais", pax: 14, price: 375 },
                { from: "Paris", to: "Beauvais", pax: 15, price: 515 },
                { from: "Paris", to: "Beauvais", pax: 16, price: 545 },
                { from: "Paris", to: "Beauvais", pax: 17, price: 545 },
                { from: "Paris", to: "Beauvais", pax: 18, price: 545 },
                { from: "Paris", to: "Beauvais", pax: 19, price: 545 },

                // Disneyland → Paris
                { from: "Disneyland", to: "Paris", pax: 1, price: 85 },
                { from: "Disneyland", to: "Paris", pax: 2, price: 90 },
                { from: "Disneyland", to: "Paris", pax: 3, price: 105 },
                { from: "Disneyland", to: "Paris", pax: 4, price: 105 },
                { from: "Disneyland", to: "Paris", pax: 5, price: 105 },
                { from: "Disneyland", to: "Paris", pax: 6, price: 110 },
                { from: "Disneyland", to: "Paris", pax: 7, price: 180 },
                { from: "Disneyland", to: "Paris", pax: 8, price: 185 },
                { from: "Disneyland", to: "Paris", pax: 9, price: 215 },
                { from: "Disneyland", to: "Paris", pax: 10, price: 220 },
                { from: "Disneyland", to: "Paris", pax: 11, price: 220 },
                { from: "Disneyland", to: "Paris", pax: 12, price: 225 },
                { from: "Disneyland", to: "Paris", pax: 13, price: 230 },
                { from: "Disneyland", to: "Paris", pax: 14, price: 295 },
                { from: "Disneyland", to: "Paris", pax: 15, price: 295 },
                { from: "Disneyland", to: "Paris", pax: 16, price: 295 },
                { from: "Disneyland", to: "Paris", pax: 17, price: 295 },
                { from: "Disneyland", to: "Paris", pax: 18, price: 295 },
                { from: "Disneyland", to: "Paris", pax: 19, price: 295 },

                { from: "Paris", to: "Disneyland", pax: 1, price: 85 },
                { from: "Paris", to: "Disneyland", pax: 2, price: 90 },
                { from: "Paris", to: "Disneyland", pax: 3, price: 105 },
                { from: "Paris", to: "Disneyland", pax: 4, price: 105 },
                { from: "Paris", to: "Disneyland", pax: 5, price: 105 },
                { from: "Paris", to: "Disneyland", pax: 6, price: 110 },
                { from: "Paris", to: "Disneyland", pax: 7, price: 180 },
                { from: "Paris", to: "Disneyland", pax: 8, price: 185 },
                { from: "Paris", to: "Disneyland", pax: 9, price: 215 },
                { from: "Paris", to: "Disneyland", pax: 10, price: 220 },
                { from: "Paris", to: "Disneyland", pax: 11, price: 220 },
                { from: "Paris", to: "Disneyland", pax: 12, price: 225 },
                { from: "Paris", to: "Disneyland", pax: 13, price: 230 },
                { from: "Paris", to: "Disneyland", pax: 14, price: 295 },
                { from: "Paris", to: "Disneyland", pax: 15, price: 295 },
                { from: "Paris", to: "Disneyland", pax: 16, price: 295 },
                { from: "Paris", to: "Disneyland", pax: 17, price: 295 },
                { from: "Paris", to: "Disneyland", pax: 18, price: 295 },
                { from: "Paris", to: "Disneyland", pax: 19, price: 295 },

                // Orly → Paris
                { from: "Airport Orly", to: "Paris", pax: 1, price: 75 },
                { from: "Airport Orly", to: "Paris", pax: 2, price: 75 },
                { from: "Airport Orly", to: "Paris", pax: 3, price: 85 },
                { from: "Airport Orly", to: "Paris", pax: 4, price: 90 },
                { from: "Airport Orly", to: "Paris", pax: 5, price: 95 },
                { from: "Airport Orly", to: "Paris", pax: 6, price: 100 },
                { from: "Airport Orly", to: "Paris", pax: 7, price: 175 },
                { from: "Airport Orly", to: "Paris", pax: 8, price: 175 },
                { from: "Airport Orly", to: "Paris", pax: 9, price: 180 },
                { from: "Airport Orly", to: "Paris", pax: 10, price: 180 },
                { from: "Airport Orly", to: "Paris", pax: 11, price: 185 },
                { from: "Airport Orly", to: "Paris", pax: 12, price: 190 },
                { from: "Airport Orly", to: "Paris", pax: 13, price: 200 },
                { from: "Airport Orly", to: "Paris", pax: 14, price: 270 },
                { from: "Airport Orly", to: "Paris", pax: 15, price: 270 },
                { from: "Airport Orly", to: "Paris", pax: 16, price: 275 },
                { from: "Airport Orly", to: "Paris", pax: 17, price: 280 },
                { from: "Airport Orly", to: "Paris", pax: 18, price: 285 },
                { from: "Airport Orly", to: "Paris", pax: 19, price: 285 },

                { from: "Paris", to: "Airport Orly", pax: 1, price: 75 },
                { from: "Paris", to: "Airport Orly", pax: 2, price: 75 },
                { from: "Paris", to: "Airport Orly", pax: 3, price: 85 },
                { from: "Paris", to: "Airport Orly", pax: 4, price: 90 },
                { from: "Paris", to: "Airport Orly", pax: 5, price: 95 },
                { from: "Paris", to: "Airport Orly", pax: 6, price: 100 },
                { from: "Paris", to: "Airport Orly", pax: 7, price: 175 },
                { from: "Paris", to: "Airport Orly", pax: 8, price: 175 },
                { from: "Paris", to: "Airport Orly", pax: 9, price: 180 },
                { from: "Paris", to: "Airport Orly", pax: 10, price: 180 },
                { from: "Paris", to: "Airport Orly", pax: 11, price: 185 },
                { from: "Paris", to: "Airport Orly", pax: 12, price: 190 },
                { from: "Paris", to: "Airport Orly", pax: 13, price: 200 },
                { from: "Paris", to: "Airport Orly", pax: 14, price: 270 },
                { from: "Paris", to: "Airport Orly", pax: 15, price: 270 },
                { from: "Paris", to: "Airport Orly", pax: 16, price: 275 },
                { from: "Paris", to: "Airport Orly", pax: 17, price: 280 },
                { from: "Paris", to: "Airport Orly", pax: 18, price: 285 },
                { from: "Paris", to: "Airport Orly", pax: 19, price: 285 }
            ];


            const route = prices.find(
                r =>
                    normalize(r.from) === normalize(from) &&
                    normalize(r.to) === normalize(to) &&
                    r.pax === passengerCount
            );

            return route ? `${route.price}` : "Admin will contact you for price";

        }

        (function () {
            var priceEl = document.getElementById('price');
            var brPrice = document.getElementById('br-price');

            if (!priceEl) return;

            var from = "<?php echo $pickup ?? ''; ?>".trim();
            var to = "<?php echo $dropoff ?? ''; ?>".trim();
            var passengers = parseInt("<?php echo $passengers ?? '0'; ?>".trim(), 10) || 0;

            if (!from || !to || passengers <= 0) {
                priceEl.innerText = "€ 0";
                return;
            }

            let pickupType = document.getElementById('pickupType').value;
            var price = calculatePrice(from, to, passengers);
            brPrice.value = price.replace('€', '').trim();
            if (brPrice.value === "Admin will contact you for price") {
                priceEl.innerText = brPrice.value;
                return;
            }
            priceEl.innerText = '€ ' + (pickupType == "Return" ? brPrice.value * 2 : brPrice.value);
        })();

        // Show/hide Return Details section based on pickupType
        (function () {
            var pickupTypeEl = document.getElementById('pickupType');
            var returnSection = document.getElementById('return-section');

            function toggleReturnSection() {
                if (!pickupTypeEl || !returnSection) return;
                var isReturn = pickupTypeEl.value.trim() === 'Return';
                returnSection.style.display = isReturn ? 'flex' : 'none';

                // Enable/disable required on return fields so form doesn't block submission
                var returnInputs = returnSection.querySelectorAll('input');
                returnInputs.forEach(function(input) {
                    if (isReturn) {
                        input.setAttribute('required', 'required');
                    } else {
                        input.removeAttribute('required');
                        input.value = '';
                    }
                });
            }

            // Run on page load
            toggleReturnSection();

            // Also watch for any dynamic changes
            if (pickupTypeEl) {
                pickupTypeEl.addEventListener('change', toggleReturnSection);
                pickupTypeEl.addEventListener('input', toggleReturnSection);
            }
        })();


    </script>

    <!-- Google Maps Location Picker Modal -->
    <div id="map-modal" class="map-modal">
        <div class="map-modal-content">
            <div class="map-modal-header">
                <h5 id="map-modal-title">Select Location on Map</h5>
                <button type="button" class="map-modal-close" id="map-modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="map-modal-body">
                <div class="predefined-locations" id="predefined-locations">
                    <button type="button" class="location-btn" data-location="Paris, France">Paris</button>
                    <button type="button" class="location-btn" data-location="Disneyland Paris, France">Disneyland</button>
                    <button type="button" class="location-btn" data-location="Paris Charles de Gaulle Airport, France">CDG Airport</button>
                    <button type="button" class="location-btn" data-location="Paris Orly Airport, France">Orly Airport</button>
                    <button type="button" class="location-btn" data-location="Beauvais Airport, France">Beauvais Airport</button>
                </div>
                <div class="map-search-wrapper">
                    <input type="text" id="map-search-input" class="map-search-input" placeholder="Search location...">
                </div>
                <div id="selected-location-info" class="selected-location-info" style="display: none;">
                    Selected: <span id="selected-location-text"></span>
                </div>
                <div id="map"></div>
            </div>
            <div class="map-modal-footer">
                <button type="button" class="map-cancel-btn" id="map-cancel-btn">Cancel</button>
                <button type="button" class="map-select-btn" id="map-select-btn" disabled>Select Location</button>
            </div>
        </div>
    </div>

    <!-- Google Maps Location Picker Script -->
    <script>
        (function() {
            let map;
            let marker;
            let selectedLocation = null;
            let currentFieldType = null; // 'pickup' or 'dropoff'
            const mapModal = document.getElementById('map-modal');
            const mapCanvas = document.getElementById('map');
            const pickupBtn = document.getElementById('pickup-map-btn');
            const dropoffBtn = document.getElementById('dropoff-map-btn');
            const closeBtn = document.getElementById('map-modal-close');
            const cancelBtn = document.getElementById('map-cancel-btn');
            const selectBtn = document.getElementById('map-select-btn');
            const searchInput = document.getElementById('map-search-input');
            const modalTitle = document.getElementById('map-modal-title');
            const infoDiv = document.getElementById('selected-location-info');
            const infoText = document.getElementById('selected-location-text');
            const predefinedLocations = document.getElementById('predefined-locations');

            // Default center (Paris)
            const defaultCenter = { lat: 48.8566, lng: 2.3522 };

            // Initialize map
            function initMap() {
                map = new google.maps.Map(mapCanvas, {
                    zoom: 12,
                    center: defaultCenter,
                    styles: [
                        {
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [{"visibility": "off"}]
                        }
                    ]
                });

                // Click on map to select location
                map.addListener('click', function(event) {
                    selectLocationFromMap(event.latLng);
                });

                // Add existing location marker if available
                addMarkerToMap(defaultCenter);
            }

            function addMarkerToMap(location) {
                if (marker) {
                    marker.setMap(null);
                }
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    draggable: true
                });

                marker.addListener('dragend', function() {
                    selectLocationFromMap(marker.getPosition());
                });

                map.setCenter(location);
            }

            function selectLocationFromMap(latLng) {
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({location: latLng}, function(results, status) {
                    if (status === 'OK' && results[0]) {
                        selectedLocation = {
                            address: results[0].formatted_address,
                            lat: latLng.lat(),
                            lng: latLng.lng()
                        };
                        updateLocationDisplay();
                        addMarkerToMap(latLng);
                    }
                });
            }

            function updateLocationDisplay() {
                if (selectedLocation) {
                    infoDiv.style.display = 'block';
                    infoText.textContent = selectedLocation.address;
                    selectBtn.disabled = false;
                } else {
                    infoDiv.style.display = 'none';
                    selectBtn.disabled = true;
                }
            }

            function openMapModal(type) {
                currentFieldType = type;
                selectedLocation = null;
                searchInput.value = '';
                mapModal.classList.add('active');
                
                modalTitle.textContent = type === 'pickup' 
                    ? 'Select Pickup Location' 
                    : 'Select Drop-off Location';

                // Initialize map on open
                setTimeout(() => {
                    if (!map) {
                        initMap();
                    } else {
                        google.maps.event.trigger(map, 'resize');
                        map.setCenter(defaultCenter);
                    }
                    updateLocationDisplay();
                }, 100);
            }

            function closeMapModal() {
                mapModal.classList.remove('active');
                selectedLocation = null;
            }

            function applyLocation() {
                if (!selectedLocation || !currentFieldType) return;

                const targetField = currentFieldType === 'pickup' 
                    ? document.getElementById('br-pickup-address')
                    : document.getElementById('br-dropoff-address');

                if (targetField) {
                    targetField.value = selectedLocation.address;
                    targetField.dispatchEvent(new Event('change', { bubbles: true }));
                }
                closeMapModal();
            }

            // Event listeners for location buttons
            pickupBtn?.addEventListener('click', (e) => {
                e.preventDefault();
                openMapModal('pickup');
            });

            dropoffBtn?.addEventListener('click', (e) => {
                e.preventDefault();
                openMapModal('dropoff');
            });

            closeBtn?.addEventListener('click', closeMapModal);
            cancelBtn?.addEventListener('click', closeMapModal);
            selectBtn?.addEventListener('click', applyLocation);

            // Close modal on background click
            mapModal?.addEventListener('click', (e) => {
                if (e.target === mapModal) {
                    closeMapModal();
                }
            });

            // Predefined locations
            document.querySelectorAll('.location-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const location = btn.getAttribute('data-location');
                    const geocoder = new google.maps.Geocoder();
                    
                    geocoder.geocode({address: location}, function(results, status) {
                        if (status === 'OK' && results[0]) {
                            const loc = results[0].geometry.location;
                            selectedLocation = {
                                address: results[0].formatted_address,
                                lat: loc.lat(),
                                lng: loc.lng()
                            };
                            updateLocationDisplay();
                            addMarkerToMap(loc);
                        }
                    });

                    // Update button styling
                    document.querySelectorAll('.location-btn').forEach(b => b.classList.remove('selected'));
                    btn.classList.add('selected');
                });
            });

            // Search functionality
            searchInput?.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const query = searchInput.value.trim();
                    if (query) {
                        const geocoder = new google.maps.Geocoder();
                        geocoder.geocode({address: query}, function(results, status) {
                            if (status === 'OK' && results[0]) {
                                const loc = results[0].geometry.location;
                                selectedLocation = {
                                    address: results[0].formatted_address,
                                    lat: loc.lat(),
                                    lng: loc.lng()
                                };
                                updateLocationDisplay();
                                addMarkerToMap(loc);
                            }
                        });
                    }
                }
            });
        })();
    </script>

    <!-- Google Maps Places Autocomplete -->
    <script>
        function initGoogleMapsAutocomplete() {
            var pickupInput  = document.getElementById('br-pickup-address');
            var dropoffInput = document.getElementById('br-dropoff-address');
            var returnPickupInput  = document.getElementById('br-return-pickup-address');
            var returnDropoffInput = document.getElementById('br-return-dropoff');

            var options = { types: ['geocode', 'establishment'] };

            if (pickupInput)       new google.maps.places.Autocomplete(pickupInput,  options);
            if (dropoffInput)      new google.maps.places.Autocomplete(dropoffInput, options);
            if (returnPickupInput) new google.maps.places.Autocomplete(returnPickupInput, options);
            if (returnDropoffInput)new google.maps.places.Autocomplete(returnDropoffInput, options);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places&callback=initGoogleMapsAutocomplete" async defer></script>

</body>

</html>