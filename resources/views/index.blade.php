<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>TIS KZ</title>
    <meta content="Данная интеграция позволяет передавать данные о реализации в ТИС Prosklad" name="description">
    <meta content="Мой склад ТИС TIS" name="keywords">
    <!-- Favicons -->
    <link href="{{ assert('assets/img/favicon.png')  }}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css')  }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')  }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css')  }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')  }}" rel="stylesheet">
</head>
<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="{{asset('assets/img/logo.png')}}" alt="">
            <span>TIS KZ</span>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Главная</a></li>
                {{--                <li><a class="nav-link scrollto" href="#about">О нас</a></li>--}}
                <li><a class="nav-link scrollto" href="#contact">Контакты</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Данная интеграция позволяет передавать данные о реализации в ТИС Prosklad</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">Увеличьте пороги по доходу и НДС, оставаясь на
                    упрощенке</h2>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <a href="https://online.moysklad.ru/app/#apps?id=7b9b82f5-4f27-4e25-bc55-6f8717ff66c7"
                           class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Начать</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{asset('assets/img/hero-img.png')}}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section><!-- End Hero -->
<main id="main">
    <section id="contact" class="contact">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <header class="section-header"><h2>Контакты</h2>
                <p>Свяжитесь с нами</p></header>
            <div class="row gy-4">
                {{--                    <div class="col-lg-6">--}}
                {{--                        <div class="row gy-4">--}}
                {{--                            <div class="col-md-6">--}}
                {{--                                <div class="info-box"><i class="bi bi-geo-alt"></i>--}}
                {{--                                    <h3>Address</h3>--}}
                {{--                                    <p>A108 Adam Street,<br>New York, NY 535022</p></div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-md-6">--}}
                {{--                                <div class="info-box"><i class="bi bi-telephone"></i>--}}
                {{--                                    <h3>Call Us</h3>--}}
                {{--                                    <p>+1 5589 55488 55<br>+1 6678 254445 41</p></div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-md-6">--}}
                {{--                                <div class="info-box"><i class="bi bi-envelope"></i>--}}
                {{--                                    <h3>Email Us</h3>--}}
                {{--                                    <p>info@example.com<br>contact@example.com</p></div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-md-6">--}}
                {{--                                <div class="info-box"><i class="bi bi-clock"></i>--}}
                {{--                                    <h3>Open Hours</h3>--}}
                {{--                                    <p>Monday - Friday<br>9:00AM - 05:00PM</p></div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <div class="col-lg-12">
                    <form action="{{route('form.contact')}}" method="post" class="php-email-form">
                        <div class="row gy-4">
                            @csrf
                            <div class="col-md-6"><input type="text" name="name" class="form-control"
                                                         placeholder="Ваше имя" required=""></div>
                            <div class="col-md-6 "><input type="email" class="form-control" name="email"
                                                          placeholder="Почта" required=""></div>
                            <div class="col-md-12"><input type="tel" id="phone"
                                                          placeholder="+7(777)777-77-77"
                                                          class="form-control" name="phone"
                                                          placeholder="Телефон" required=""></div>
                            <div class="col-md-12"><textarea class="form-control" name="message" rows="6"
                                                             placeholder="Сообщение" required=""></textarea></div>
                            <div class="col-md-12 text-center">
                                <div class="loading">Загрузка</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Ваше сообщение отправлено, спасибо!</div>
                                <button type="submit">Отправить сообщение</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info"><a href="index.html" class="logo d-flex align-items-center">
                        <img src="assets/img/logo.png" alt=""> <span>TIS KZ</span> </a>
                    <p>Приобретая ТИС, вы получаете повышенные доходы за полугодие и увеличенный порог по НДС. Вы
                        сможете увеличить чистую прибыль в 5 раз, и не терять деньги на налогах.</p>
                </div>
                <div class="col-lg-3 col-6 footer-links"><h4>Полезные ссылки</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Главная</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">О нас</a></li>
                    </ul>
                </div>
                {{--                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start"><h4>Contact Us</h4>--}}
                {{--                    <p> A108 Adam Street <br> New York, NY 535022<br> United States <br><br> <strong>Phone:</strong> +1--}}
                {{--                        5589 55488 55<br> <strong>Email:</strong> info@example.com<br></p>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright"> © Copyright <strong><span>Tis KZ</span></strong>. All Rights Reserved</div>
    </div>
</footer>
<script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="https://unpkg.com/imask"></script>
<script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
