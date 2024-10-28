@extends("layout")
@section("title", "Dashboard Page")
@section("main_content")
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item" style="background: linear-gradient(to right,
        rgba(3, 116, 49, 0.2),
        rgba(2, 145, 73, 0.1),
        rgba(2, 77, 30, 0.2)),
         url('{{asset("img/slide1.jpeg")}}');
         background-size: cover;
         background-repeat: no-repeat;
         background-blend-mode: overlay;">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7 animated fadeInLeft">
                            <div class="text-sm-center text-md-start">
                                <h5 class="text-white" style="font-size: 28px; font-weight: bold">Life Insurance Makes You Happy Insurance Makes You HappyInsurance Makes You Happy</h5>
                                <p class="mb-5 fs-8">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy...
                                </p>
                                <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i
                                            class="fas fa-play-circle me-2"></i> Watch Video</a>
                                    <a class="btn btn-dark rounded-pill py-3 px-4 px-md-5 ms-2" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 animated fadeInRight">
                            <div class="calrousel-img" style="object-fit: cover;">
                                <img src="img/slide1.jpeg" class="img-fluid w-100" alt="" style="border-radius: 1em">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="header-carousel-item" style="background: linear-gradient(to right,
        rgba(3, 116, 49, 0.3),
        rgba(2, 145, 73, 0.1),
        rgba(2, 77, 30, 0.3)),
         url('{{asset("img/slide.jpeg")}}');
         background-size: cover;
         background-repeat: no-repeat;
         background-blend-mode: overlay;">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-5 animated fadeInRight">
                            <div class="calrousel-img" style="object-fit: cover;">
                                <img src="img/slide.jpeg" class="img-fluid w-100" alt="" style=" border-radius: 1em">
                            </div>
                        </div>
                        <div class="col-lg-7 animated fadeInLeft">
                            <div class="text-sm-center text-md-start">
                                <h5 class="text-white" style="font-size: 28px; font-weight: bold">Life Insurance Makes You Happy Insurance Makes You
                                    You Happy Insurance Makes You You Happy Insurance Makes You HappyInsurance Makes You Happy</h5>
                                <p class="mb-5 fs-8">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy...
                                </p>
                                <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i
                                            class="fas fa-play-circle me-2"></i> Watch Video</a>
                                    <a class="btn btn-dark rounded-pill py-3 px-4 px-md-5 ms-2" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- FAQs Start -->
    <div class="container-fluid faq-section py-5" style="background: linear-gradient(rgba(250,247,247,0.8), rgba(237,236,236,0.8)),
         url('{{asset("img/content/about-bg.jpg")}}');
         background-size: cover;
         background-repeat: no-repeat;
         background-blend-mode: overlay;">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.4s">
                    <img src="img/content/about1.jpeg" class="img-fluid w-100" alt="" style="border-radius: 7px">
                </div>
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s" style="background: rgba(3,178,121,0.1); border-radius: 12px">
                    <div class="h-100">

                        <div class="accordion-body text-dark" id="accordionExample">
                            <h1 class="text-dark mb-2" style="font-family: Roboto; font-size: 37px"><b>Brief About Childhood Development Organization (CDO)</b></h1>
                            <p style="text-align: justify">
                            Childhood Development Organization (CDO) is a non profit making local NGO operating in Morogoro Region.Currently CDO operates in all districts of Morogoro Region.
                            The Organization is determined to support communities to improve their livelihoods.The establishment of CDO was based on the fact that there was a realization of
                            existing disadvantages faced by less privileged children from low income households in the communities which needed to be addressed.<br>
                            </p>
                            <a class="btn btn-primary rounded mt-4 py-2 px-4" href="#">Learn More</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- FAQs End -->







    <!-- Blog Start -->
    <div class="container-fluid blog py-5" style="background: linear-gradient(rgba(250,247,247,0.8), rgba(237,236,236,0.8)),
         url('{{asset("img/content/news-bg.jpg")}}'); background-size: cover; background-repeat: no-repeat; background-blend-mode: overlay;">
        <div class="container py-5">
            <div class="mx-auto wow fadeInUp mb-5" data-wow-delay="0.2s">
                <div class="row">
                    <div class="col-md-4">
                        <blockquote class="blockquote blockquote-custom" style="border-left: 8px solid #134cec; padding-left: 15px; margin-bottom: 0; font-size: 17px">
                            <h4 class="text-dark"><b>RECENT EVENTS</b> <img src="{{asset('img/content/news.gif')}}" style="height: 3em"></h4>
                        </blockquote>
                    </div>
                    <div class="col-md-6 border-start">
                        <p class="mb-0">You can view all our posts by clicking the 'Read More' button, or by following us on our social media accounts '@cdo_mzumbe'
                        </p>

                    </div>
                    <div class="col-md-2 text-start">
                        <a class="btn btn-primary py-2 px-4" href="#">Learn More >></a>

                    </div>

                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{asset('img/posts/post.jpeg')}}" class="img-fluid rounded-top w-100" alt="">
                            <div class="blog-categiry py-2 px-4">
                                <span>Business</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <div class="blog-comment d-flex justify-content-between mb-3">
                                <div class="small"><span class="fa fa-user text-primary"></span> Martin.C</div>
                                <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                            </div>
                            <a href="#" class="h4 d-inline-block mb-3">Which allows you to pay down insurance bills</a>
                            <p class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius libero soluta
                                impedit eligendi? Quibusdam, laudantium.</p>
                            <a href="#" class="btn p-0">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{asset('img/posts/post.jpeg')}}" class="img-fluid rounded-top w-100" alt="">
                            <div class="blog-categiry py-2 px-4">
                                <span>Business</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <div class="blog-comment d-flex justify-content-between mb-3">
                                <div class="small"><span class="fa fa-user text-primary"></span> Martin.C</div>
                                <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                            </div>
                            <a href="#" class="h4 d-inline-block mb-3">Leverage agile frameworks to provide</a>
                            <p class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius libero soluta
                                impedit eligendi? Quibusdam, laudantium.</p>
                            <a href="#" class="btn p-0">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{asset('img/posts/post.jpeg')}}" class="img-fluid rounded-top w-100" alt="">
                            <div class="blog-categiry py-2 px-4">
                                <span>Business</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <div class="blog-comment d-flex justify-content-between mb-3">
                                <div class="small"><span class="fa fa-user text-primary"></span> Martin.C</div>
                                <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                            </div>
                            <a href="#" class="h4 d-inline-block mb-3">Leverage agile frameworks to provide</a>
                            <p class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius libero soluta
                                impedit eligendi? Quibusdam, laudantium.</p>
                            <a href="#" class="btn p-0">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-start mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">


                <div class="row">
                    <div class="col-md-5">
                        <blockquote class="blockquote blockquote-custom" style="border-left: 8px solid #134cec; padding-left: 15px; margin-bottom: 0;">
                        <h4 class="text-primary">COMPAIGNS</h4>
                        <h1 class="display-6 ">Ongoing Campaigns</h1>
                        </blockquote>
                    </div>
                    <div class="col-md-7">
                        <blockquote class="blockquote blockquote-custom" style="border-left: 1px solid #434345; padding-left: 15px; margin-bottom: 0; font-size: 17px">
                        <p class="mb-0">You can view all our posts by clicking the 'Read More' button, or by following us on our social media accounts '@cdo_mzumbe'
                        </p>
                        </blockquote>

                    </div>

                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/content/about1.jpeg" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-users fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">Sanitary Pads for Adolescent Girls</a>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis,
                                    eum!</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/content/about1.jpeg" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-hospital fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">Nutrition for Most-Sick Children</a>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis,
                                    eum!</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/content/about1.jpeg" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-car fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">Health Insurance For Elders</a>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis,
                                    eum!</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="img/content/about1.jpeg" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-home fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">Education For Orphans Students</a>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis,
                                    eum!</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->




    <!-- About Start -->
    <div class="container-fluid about pb-5" style="background: linear-gradient(rgba(250,247,247,0.8), rgba(237,236,236,0.8)),
         url('{{asset("img/content/news-bg.jpg")}}'); background-size: cover; background-repeat: no-repeat; background-blend-mode: overlay;">
        <div class="container pb-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content rounded p-5 h-100" style="background: rgba(3,178,121,0.1)">
                        <h4 class="text-primary">SUCCESS STORIES</h4>
                        <h1 class="display-4 mb-4">Success Stories From Our Beneficiaries</h1>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt debitis sint tempora. Corporis consequatur illo blanditiis voluptates aperiam quos aliquam totam aliquid rem explicabo,
                        </p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae praesentium recusandae eligendi modi hic
                        </p>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>We can save your money.</p>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>Production or trading of good</p>
                        <p class="text-dark mb-4"><i class="fa fa-check text-primary me-3"></i>Our life insurance is flexible</p>
                        <a class="btn btn-success rounded py-3 px-5" href="#">Read Our Publication</a>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="rounded p-5 h-100" style="background: rgba(3,178,121,0.1)">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12">
                                <div class="rounded bg-light">
                                    <img src="img/content/about1.jpeg" class="img-fluid rounded w-100" alt="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item rounded p-3 bg-light h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">129</span>
                                        <span class="h1 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Insurance Policies</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">99</span>
                                        <span class="h1 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Awards WON</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">556</span>
                                        <span class="h1 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Skilled Agents</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">967</span>
                                        <span class="h1 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Team Members</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-5" style="background: linear-gradient(rgba(250,247,247,0.8), rgba(237,236,236,0.8)),
         url('{{asset("img/content/news-bg.jpg")}}'); background-size: cover; background-repeat: no-repeat; background-blend-mode: overlay;">
        <div class="container pb-5">
            <div class="text-start mx-auto wow fadeInUp" data-wow-delay="0.2s">
                    <div class="row">
                        <div class="col-md-4">
                            <blockquote class="blockquote blockquote-custom mt-5" style="border-left: 8px solid #134cec; padding-left: 15px; margin-bottom: 0; font-size: 17px">
                                <h4 class="text-primary">Our Blog Posts</h4>
                                <h1 class="display-6 "><b>RECENT Blogs</b></h1>
                            </blockquote>
                        </div>
                        <div class="col-md-6 border-start mt-5">
                            <p class="mb-0">You can view all our posts by clicking the 'Read More' button, or by following us on our social media accounts '@cdo_mzumbe'
                            </p>
                        </div>
                        <div class="col-md-2 text-start mt-5">
                            <a class="btn btn-primary py-2 px-4" href="#">Learn More >></a>
                        </div>
                    </div>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-6  col-lg-6 col-xl-6">
                            <div class="h-100">
                                <img src="img/content/about1.jpeg" class="img-fluid h-100 rounded"
                                     style="object-fit: cover;" alt="">
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-0">Client Name</h4>
                                <p class="mb-3">Profession</p>
                                <div class="d-flex text-primary mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim error
                                    molestiae aut modi corrupti fugit eaque rem nulla incidunt temporibus quisquam,
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->





    <!-- Team Start -->
    <div class="container-fluid team pb-5">
        <div class="container pb-5">
            <div class="text-start mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="text-start mx-auto wow fadeInUp" data-wow-delay="0.2s">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <blockquote class="blockquote blockquote-custom" style="border-left: 8px solid #134cec; padding-left: 15px; margin-bottom: 0; font-size: 17px">
                                <h4 class="text-primary">OUR TEAM</h4>
                                <h1 class="display-6 "><b>Meet Our Expert Team Members</b></h1>
                            </blockquote>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="img/team-1.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="team-title p-4">
                            <h4 class="mb-0">David James</h4>
                            <p class="mb-0">Profession</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="img/team-2.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="team-title p-4">
                            <h4 class="mb-0">David James</h4>
                            <p class="mb-0">Profession</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="img/team-3.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="team-title p-4">
                            <h4 class="mb-0">David James</h4>
                            <p class="mb-0">Profession</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="img/team-4.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="team-icon">
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="team-title p-4">
                            <h4 class="mb-0">David James</h4>
                            <p class="mb-0">Profession</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-5" style="background: linear-gradient(rgba(250,247,247,0.8), rgba(237,236,236,0.8)),
         url('{{asset("img/content/news-bg.jpg")}}'); background-size: cover; background-repeat: no-repeat; background-blend-mode: overlay;">
        <div class="container pb-5">
            <div class="text-start mx-auto wow fadeInUp" data-wow-delay="0.2s">
                <div class="row">
                    <div class="col-md-4">
                        <blockquote class="blockquote blockquote-custom mt-5" style="border-left: 8px solid #134cec; padding-left: 15px; margin-bottom: 0; font-size: 17px">
                            <h4 class="text-primary">WORKING WITH EXCELLENT</h4>
                            <h1 class="display-6 "><b>Partners</b></h1>
                        </blockquote>
                    </div>
                    <div class="col-md-6 border-start mt-5">
                        <p class="mb-0">We believe long-term, impactful partnerships are central to achieving our mission.

                        </p>
                    </div>
                    <div class="col-md-2 text-start mt-5">
                        <a class="btn btn-primary py-2 px-4" href="#">Publications ></a>
                    </div>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-6  col-lg-6 col-xl-6">
                            <div class="h-100">
                                <img src="img/logos/viiv.png" class="img-fluid h-100 rounded"
                                     style="height: 0.3px" alt="">
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-0">Changarawe Project</h4>
                                <p class="mb-3">We Thank You</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-6  col-lg-6 col-xl-6">
                            <div class="h-100">
                                <img src="img/logos/viiv.png" class="img-fluid h-100 rounded"
                                     style="height: 0.3px" alt="">
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-0">Changarawe Project</h4>
                                <p class="mb-3">We Thank You</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded">
                    <div class="row g-0">
                        <div class="col-6  col-lg-6 col-xl-6">
                            <div class="h-100">
                                <img src="img/logos/viiv.png" class="img-fluid h-100 rounded"
                                     style="height: 0.3px" alt="">
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <div class="d-flex flex-column my-auto text-start p-4">
                                <h4 class="text-dark mb-0">Changarawe Project</h4>
                                <p class="mb-3">We Thank You</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection


