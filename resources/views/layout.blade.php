<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield("title", "Childhood Development Organization (CDO)")</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{asset('lib/animate/animate.min.css')}}" />
    <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
</head>

<body>

<!-- Spinner Start -->
<div id="spinner"
     class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid topbar px-0 px-lg-4 bg-success py-2 d-none d-lg-block">
    <div class="container">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <div class="border-end border-light pe-3">
                        <a href="#" class="text-light small"><i
                                class="fas fa-map-marker-alt text-light me-2"></i>Mzumbe,Morogoro</a>
                    </div>
                    <div class="ps-3">
                        <a href="mailto:example@gmail.com" class="text-light small"><i
                                class="fas fa-envelope text-light me-2"></i>2000cdo@gmail.com</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-flex justify-content-end">
                    <div class="d-flex border-end border-light pe-3">
                        <a class="btn p-0 text-light me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn p-0 text-light me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn p-0 text-light me-3" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="btn p-0 text-light me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="dropdown ms-3">
                        <a class="text-light">@cdo_mzumbe</a>
                        <!--<a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i
                                    class="fas fa-globe-europe text-primary me-2"></i> English</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item">English</a>
                            <a href="#" class="dropdown-item">Bangla</a>
                            <a href="#" class="dropdown-item">French</a>
                            <a href="#" class="dropdown-item">Spanish</a>
                            <a href="#" class="dropdown-item">Arabic</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="#" class="navbar-brand p-0">
                <h4 class="text-light mb-0"><img src="img/logos/logo.png" alt="Logo"></h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-0 mx-lg-auto">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">About Us</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="feature.html" class="dropdown-item">About</a>
                            <a href="team.html" class="dropdown-item">Publications</a>
                            <a href="testimonial.html" class="dropdown-item">Reach Us</a>
                            <a href="FAQ.html" class="dropdown-item">FAQs</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">Updates</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="feature.html" class="dropdown-item">Recent News</a>
                            <a href="team.html" class="dropdown-item">Fundraising</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">Our Projects</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="feature.html" class="dropdown-item">Changarawe Project</a>
                            <a href="team.html" class="dropdown-item">Afya Yangu Maisha Yangu</a>
                            <a href="testimonial.html" class="dropdown-item">Watoto Wetu Tunu Yetu</a>
                            <a href="FAQ.html" class="dropdown-item">Mtoto Kwanza Project</a>
                            <a href="404.html" class="dropdown-item">Inclusive Education</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">Staff</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="feature.html" class="dropdown-item">Our Features</a>
                            <a href="team.html" class="dropdown-item">Our team</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="FAQ.html" class="dropdown-item">FAQs</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <div class="nav-btn px-3">
                        <a href="#" class="btn btn-success rounded-pill py-2 px-4 ms-3 flex-shrink-0">Donate Now</a>
                    </div>
                </div>
            </div>
            <div class="d-none d-xl-flex flex-shrink-0 ps-4">
                <a href="#" class="btn btn-light btn-lg-square rounded-circle position-relative wow tada"
                   data-wow-delay=".9s">
                    <i class="fa fa-phone-alt fa-2x"></i>
                    <div class="position-absolute" style="top: 7px; right: 12px;">
                        <span><i class="fa fa-comment-dots text-secondary"></i></span>
                    </div>
                </a>
                <div class="d-flex flex-column ms-3">
                    <span>Contact Us Via</span>
                    <a href="+255 657 773 147"><span class="text-dark">Call: +255 657 773 147</span></a>
                </div>
            </div>
        </nav>
    </div>
</div>

@yield("main_content")



<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-9">
                <div class="mb-5">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-6 col-xl-5">
                            <div class="footer-item">
                                <a href="index.html" class="p-0">
                                    <!-- <h3 class="text-white"><i class="fab fa-slack me-3"></i> LifeSure</h3>-->
                                  <img src="img/logos/logo.png" alt="Logo" style="height: 3em; margin-bottom: 9px">


                                </a>
                                <p class="text-white mb-4">Childhood Development Organization (CDO) is a nonprofit making local NGO operating in all districts of Morogoro Region...</p>
                                <div class="footer-btn d-flex">
                                    <a class="btn btn-md-square rounded-circle me-3" href="#"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-3" href="#"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-3" href="#"><i
                                            class="fab fa-instagram"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-0" href="#"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="footer-item">
                                <h4 class="text-white mb-4">Useful Links</h4>
                                <a href="#"><i class="fas fa-angle-right me-2"></i> About Us</a>
                                <a href="#"><i class="fas fa-angle-right me-2"></i> Recent News</a>
                                <a href="#"><i class="fas fa-angle-right me-2"></i> Fundraising</a>
                                <a href="#"><i class="fas fa-angle-right me-2"></i> FAQ's</a>
                                <a href="#"><i class="fas fa-angle-right me-2"></i> Publication</a>
                                <a href="#"><i class="fas fa-angle-right me-2"></i> Contact</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="footer-item">
                                <h4 class="mb-4 text-white">Instagram</h4>
                                <div class="row g-3">
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-1.jpg" class="img-fluid w-100" alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-1.jpg"
                                                   data-lightbox="footerInstagram-1" class="my-auto"><i
                                                        class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-2.jpg" class="img-fluid w-100" alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-2.jpg"
                                                   data-lightbox="footerInstagram-2" class="my-auto"><i
                                                        class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-3.jpg" class="img-fluid w-100" alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-3.jpg"
                                                   data-lightbox="footerInstagram-3" class="my-auto"><i
                                                        class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-4.jpg" class="img-fluid w-100" alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-4.jpg"
                                                   data-lightbox="footerInstagram-4" class="my-auto"><i
                                                        class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-5.jpg" class="img-fluid w-100" alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-5.jpg"
                                                   data-lightbox="footerInstagram-5" class="my-auto"><i
                                                        class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-6.jpg" class="img-fluid w-100" alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-6.jpg"
                                                   data-lightbox="footerInstagram-6" class="my-auto"><i
                                                        class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-5" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="row g-4">
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fas fa-map-marker-alt fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Address</h4>
                                            <p class="mb-0">Tanzania, Morogoro, Mvomero Mzumbe</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fas fa-envelope fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Mail Us</h4>
                                            <p class="mb-0">2000cdo@gmail.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fa fa-phone-alt fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Telephone</h4>
                                            <p class="mb-0">+255 657 773 147</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Newsletter</h4>
                    <p class="text-white mb-3">Please Subscribe by providing your email to receive our Newsletter</p>
                    <div class="position-relative rounded-pill mb-4">
                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                               placeholder="Enter your email">
                        <button type="button"
                                class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                    </div>
                    <div class="d-flex flex-shrink-0">
                        <div class="footer-btn">
                            <a href="#" class="btn btn-lg-square rounded-circle position-relative wow tada"
                               data-wow-delay=".9s">
                                <i class="fa fa-phone-alt fa-2x"></i>
                                <div class="position-absolute" style="top: 2px; right: 12px;">
                                    <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column ms-3 flex-shrink-0">
                            <span>Contact Us</span>
                            <a href="tel:+255 657 773 147"><span class="text-white">Call: +255 657 773 147</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-end mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white"><i
                                class="fas fa-copyright text-light me-2"></i>Childhood Development Organization (CDO)</a>, All right
                        reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-start text-body">
                Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">Diaz Mwinuka</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('lib/wow/wow.min.js')}}"></script>
<script src="{{asset('lib/easing/easing.min.js')}}"></script>
<script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('lib/counterup/counterup.min.js')}}"></script>
<script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>
<script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>


<!-- Template Javascript -->
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>

