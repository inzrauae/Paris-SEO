<?php
// Values carried over from the homepage's quick-booking form (via URL query string)
$pickup = isset($_GET['pickup']) ? htmlspecialchars($_GET['pickup']) : '';
$dropoff = isset($_GET['dropoff']) ? htmlspecialchars($_GET['dropoff']) : '';
$passengers = isset($_GET['passengers']) ? htmlspecialchars($_GET['passengers']) : '';
$pickupType = isset($_GET['pickuptype']) ? htmlspecialchars($_GET['pickuptype']) : '';
$price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '';
?>
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
            .location-dropdown {
                max-height: 250px;
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


                            <form action="https://dashboard.parisfasttransfer.com/assets/php/mail.php" method="POST">

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
                                        <div class="form-group">
                                            <label>Pickup Location : Address with City</label>
                                            <input type="text" name="pickupaddr" class="form-control"
                                                id="br-pickup-address" placeholder="Address with City" required>
                                            <i class="far fa-location-dot"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="display: none;">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input require type="text" name="price" class="form-control non-editable"
                                                id="br-price" placeholder="Type price" value="<?php echo $price ?? ''; ?>">
                                            <i class="far fa-location-dot"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Drop Off Location : Address with City</label>
                                            <input type="text" name="dropoffaddr" class="form-control"
                                                id="br-dropoff-address" placeholder="Address with City" required>
                                            <i class="far fa-location-dot"></i>
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
                                                value="<?php echo $pickupType ?? ''; ?>"
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
                timeFormat: "hh:mm p",
                interval: 15,
                minTime: "12:00am",
                maxTime: "11:45pm",
                defaultTime: "",
                startTime: "12:00am",
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });

            // AM/PM quick-select buttons next to each time field
            $(".time-picker").each(function () {
                var $input = $(this);

                var $wrap = $('<span class="ampm-toggle"></span>').css({
                    display: "inline-flex",
                    gap: "6px",
                    marginLeft: "10px",
                    verticalAlign: "middle"
                });

                var btnStyle = {
                    padding: "6px 14px",
                    border: "1px solid #8ccfff",
                    borderRadius: "6px",
                    background: "#fff",
                    color: "#0b2542",
                    fontWeight: "600",
                    cursor: "pointer"
                };

                var $am = $('<button type="button">AM</button>').css(btnStyle);
                var $pm = $('<button type="button">PM</button>').css(btnStyle);

                $wrap.append($am).append($pm);
                $input.parent().append($wrap);

                function applyPeriod(period) {
                    var val = $input.val().trim();
                    var match = val.match(/(\d{1,2}):(\d{2})/);
                    var hh = match ? parseInt(match[1], 10) : 12;
                    var mm = match ? parseInt(match[2], 10) : 0;

                    // normalize to 24-hour, then apply requested period
                    if (hh === 12) hh = 0;
                    if (period === "PM") hh += 12;

                    var d = new Date();
                    d.setHours(hh, mm, 0, 0);

                    $input.timepicker("setTime", d);
                    $input.trigger("change");

                    $am.css("background", period === "AM" ? "#ffc107" : "#fff");
                    $pm.css("background", period === "PM" ? "#ffc107" : "#fff");
                }

                $am.on("click", function (e) { e.preventDefault(); applyPeriod("AM"); });
                $pm.on("click", function (e) { e.preventDefault(); applyPeriod("PM"); });
            });
        });

        function normalize(text) {
            return text.trim().toLowerCase();
        }

        // ✅ Shared rates data (fetched once from assets/data/rates.json — the SAME file
        // used by taxi-rate.html — so both pages always show/charge identical prices)
        let RATES_DATA = null;
        const RATES_READY = fetch('https://dashboard.parisfasttransfer.com/assets/php/get-rates.php')
            .then(res => res.json())
            .then(data => { RATES_DATA = data; return data; })
            .catch(err => {
                console.error('Failed to load rates.json', err);
                return null;
            });

        // Match a free-typed address (e.g. "Paris Charles de Gaulle Airport, France")
        // to a canonical location key (e.g. "CDG") using the keyword list in rates.json
        function matchLocationKey(addressText) {
            const text = normalize(addressText || "");
            if (!RATES_DATA) return null;
            for (const key in RATES_DATA.locations) {
                const loc = RATES_DATA.locations[key];
                if (loc.keywords.some(kw => text.includes(kw))) {
                    return key;
                }
            }
            return null;
        }

        // Find the route price for two canonical location keys + passenger count.
        // Routes are stored one-directional in rates.json since prices are symmetric.
        function findRoutePrice(fromKey, toKey, passengerCount) {
            if (!RATES_DATA || !fromKey || !toKey) return null;

            const route = RATES_DATA.routes.find(r =>
                (r.from === fromKey && r.to === toKey) ||
                (r.from === toKey && r.to === fromKey)
            );
            if (!route) return null;

            // Rates are defined for 3-21 PAX; use the 3 PAX rate for 1-2 passengers,
            // and the 21 PAX rate as a cap beyond that (contact-us case is handled by caller).
            const paxColumns = RATES_DATA.paxColumns;
            const minPax = paxColumns[0];
            const maxPax = paxColumns[paxColumns.length - 1];
            const clampedPax = Math.min(Math.max(passengerCount, minPax), maxPax);

            const price = route.prices[String(clampedPax)];
            return price !== undefined ? price : null;
        }

        // Kept for backward compatibility with any old inline callers; now delegates
        // to the shared rates.json data instead of a hardcoded list.
        function calculatePrice(from, to, passengerCount) {
            const fromKey = matchLocationKey(from);
            const toKey = matchLocationKey(to);
            const price = findRoutePrice(fromKey, toKey, passengerCount);
            return price !== null ? `${price}` : "Admin will contact you for price";
        }


        // Price is calculated only after rates.json has loaded, so the figure shown
        // always matches the live data on the Our Rates page.
        function renderBookingPrice() {
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

            let pickupTypeEl = document.getElementById('pickupType');
            let pickupType = pickupTypeEl ? pickupTypeEl.value : "";
            var price = calculatePrice(from, to, passengers);
            var basePrice = price.replace('€', '').trim();
            if (basePrice === "Admin will contact you for price") {
                if (brPrice) brPrice.value = basePrice;
                priceEl.innerText = basePrice;
                return;
            }
            var finalPrice = (pickupType == "Return" ? basePrice * 2 : basePrice);
            if (brPrice) brPrice.value = finalPrice;
            priceEl.innerText = '€ ' + finalPrice;
        }

        RATES_READY.then(renderBookingPrice);

        // Recalculate if the user switches between One Way / Return
        (function () {
            var pickupTypeEl = document.getElementById('pickupType');
            if (pickupTypeEl) {
                pickupTypeEl.addEventListener('change', function () {
                    if (RATES_DATA) renderBookingPrice();
                });
            }
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
                    <button type="button" class="location-btn" data-location="Paris, France">📍 Paris</button>
                    <button type="button" class="location-btn" data-location="Disneyland Paris, France">🎢 Disneyland</button>
                    <button type="button" class="location-btn" data-location="Paris Charles de Gaulle Airport, France">✈️ CDG</button>
                    <button type="button" class="location-btn" data-location="Paris Orly Airport, France">✈️ Orly</button>
                    <button type="button" class="location-btn" data-location="Beauvais Airport, France">✈️ Beauvais</button>
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

</body>

</html>