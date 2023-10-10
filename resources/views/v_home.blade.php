<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    Document Title
    =============================================
    -->
    <title>Bot Telegram CAMABA SNBT 2023</title>
    <!--
    Favicons
    =============================================
    -->
    {{-- <link rel="apple-touch-icon" sizes="57x57" href="dashboard/assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="dashboard/assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="dashboard/assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="dashboard/assets/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="dashboard/assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="dashboard/assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="dashboard/assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="dashboard/assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="dashboard/assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="dashboard/assets/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="dashboard/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="dashboard/assets/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="dashboard/assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="dashboard/assets/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff"> --}}
    <!--
    Stylesheets
    =============================================
-->

    <link rel="shortcut icon" href="{{ asset('/img') }}/logounm.png" type="image/x-icon">
    <!-- Default stylesheets-->
    <link href="dashboard/assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="dashboard/assets/lib/animate.css/animate.css" rel="stylesheet">
    <link href="dashboard/assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    {{-- <link href="assetsdashboard/assets/css/style.css" rel="stylesheet"> --}}
    <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet">
    <link id="color-scheme" href="dashboard/assets/css/colors/default.css" rel="stylesheet">
    <style>
        .head-question {
            width: max-content;
            padding-inline: 1rem;
            border-bottom: 1px solid black;
        }


        .list-question {
            list-style: none;
            font-size: 24px;
            width: max-content;
            margin-bottom: 1rem;
        }

        .list-question::before {
            content: "";
        }

        @media screen and (max-width: 576px) {
            .head-question {
                font-size: 20px;
            }

            .list-question {
                font-size: 16px;
                margin-bottom: 1rem;
                padding-left: 0;
            }
        }
    </style>
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
        <nav class="navbar navbar-custom navbar-transparent navbar-fixed-top one-page" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <img src="img/logounm.png" alt="" style="display: block;width:28px">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="custom-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#totop">Beranda</a></li>
                        <li><a class="section-scroll" href="#services">Layanan</a></li>
                        <li><a class="section-scroll" href="#alt-features">Fitur</a></li>
                        @if (!auth()->check())
                            <li class="btn-auth">
                                <a id="btn-login" class="section-scroll btn btn-primary text-light p-1"
                                    aria-current="page" href="/login">Login</a>
                            </li>
                        @else
                            <li>
                                <a id="btn-login" class="section-scroll btn text-light p-1"
                                    style="background: #333;color:white" aria-current="page"
                                    href="{{ route('bot.dashboard') }}">Dashboard Admin</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="main">
            <section id="home">
            </section>
            <section class="module" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="module-title font-alt">Layanan Kami</h2>
                            <div class="module-subtitle font-serif">Kami berkomitmen untuk menyediakan layanan yang
                                unggul dan responsif kepada pengguna kami. Berikut adalah layanan utama yang kami
                                tawarkan
                            </div>
                        </div>
                    </div>
                    <div class="row multi-columns-row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="features-item">
                                <div class="features-icon"><span class="icon-lightbulb"></span></div>
                                <h3 class="features-title font-alt">Pertanyaan-Pertanyaan Serupa</h3>
                                <p>Kami telah mengumpulkan daftar pertanyaan yang sering diajukan oleh pengguna kami.
                                    Anda dapat menjelajahi pertanyaan-pertanyaan ini untuk menemukan jawaban yang
                                    mungkin sudah ada.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="features-item">
                                <div class="features-icon"><span class="icon-bike"></span></div>
                                <h3 class="features-title font-alt">Pencarian Cepat</h3>
                                <p>Gunakan fitur pencarian kami untuk mencari jawaban atas pertanyaan Anda. Cukup ketik
                                    kata kunci atau topik yang relevan, dan bot kami akan mencarikan jawaban terkait.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="features-item">
                                <div class="features-icon"><span class="icon-tools"></span></div>
                                <h3 class="features-title font-alt">Pertanyaan Khusus</h3>
                                <p>Jika pertanyaan Anda tidak ada dalam daftar pertanyaan yang sering diajukan, Anda
                                    dapat mengajukannya langsung kepada kami. Bot kami akan berusaha memberikan respons
                                    yang sesuai.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="features-item">
                                <div class="features-icon"><span class="icon-gears"></span></div>
                                <h3 class="features-title font-alt">24/7 Dukungan</h3>
                                <p>Bot Telegram kami aktif 24 jam sehari, 7 hari seminggu. Tidak perlu menunggu jam
                                    kerja atau hari kerja untuk mendapatkan bantuan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="module-small bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-8 col-lg-6 col-lg-offset-2">
                            <div class="callout-text font-alt">
                                <h3 class="callout-title">Ingin melihat lebih banyak hasil karya?</h3>
                                <p>Kami selalu terbuka untuk proyek-proyek menarik.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-2">
                            <div class="callout-btn-box"><a class="btn btn-w btn-round" href="">Lets view</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="module" id="alt-features">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="module-title font-alt">Fitur-Fitur</h2>
                            <div class="module-subtitle font-serif"> Aplikasi Helpdesk Bot Telegram kami dirancang
                                dengan berbagai fitur yang bertujuan untuk membuat pengalaman pengguna semakin mudah,
                                cepat, dan efisien.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="alt-features-item">
                                <div class="alt-features-icon"><span class="icon-strategy"></span></div>
                                <h3 class="alt-features-title font-alt">Kategori yang Terstruktur</h3>Temukan
                                pertanyaan-pertanyaan berdasarkan kategori tertentu. Kami telah mengelompokkan
                                pertanyaan menjadi berbagai kategori untuk memudahkan pencarian.
                            </div>
                            <div class="alt-features-item">
                                <div class="alt-features-icon"><span class="icon-tools-2"></span></div>
                                <h3 class="alt-features-title font-alt">Obrolan Interaktif</h3>Gunakan antarmuka
                                obrolan yang ramah pengguna untuk berkomunikasi dengan bot kami. Ini membuat proses
                                mendapatkan jawaban menjadi lebih interaktif.
                            </div>
                            <div class="alt-features-item">
                                <div class="alt-features-icon"><span class="icon-target"></span></div>
                                <h3 class="alt-features-title font-alt">Privasi Terjamin</h3>Kami menjaga privasi Anda
                                dengan sangat serius. Obrolan dengan bot kami bersifat pribadi dan aman.
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 hidden-xs hidden-sm">
                            <div class="alt-services-image align-center"><img src="img/mockup.jpg"
                                    alt="Feature Image"></div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="alt-features-item">
                                <div class="alt-features-icon"><span class="icon-mobile"></span></div>
                                <h3 class="alt-features-title font-alt">Pembaruan Real-Time</h3>Kami selalu berusaha
                                untuk memberikan informasi terbaru. Bot kami memungkinkan pembaruan real-time, sehingga
                                Anda selalu mendapatkan data yang relevan.
                            </div>
                            <div class="alt-features-item">
                                <div class="alt-features-icon"><span class="icon-linegraph"></span></div>
                                <h3 class="alt-features-title font-alt">Panduan Interaktif</h3>Bot kami dapat
                                memberikan panduan interaktif untuk membantu Anda menemukan informasi dengan lebih baik.
                                Kami adalah mitra dalam perjalanan pencarian Anda.
                            </div>
                            <div class="alt-features-item">
                                <div class="alt-features-icon"><span class="icon-basket"></span></div>
                                <h3 class="alt-features-title font-alt">Kemudahan Akses</h3>Aplikasi kami dapat diakses
                                dari berbagai perangkat, termasuk smartphone Anda. Ini memberikan kemudahan akses tanpa
                                batasan.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <hr class="divider-w">
            @if (!empty($lists[0]))
                <section id="pertanyaan_terbanyak">
                    <center>
                        <h1 class="head-question" style="color: black;">Paling Sering Ditanyakan</h1>
                        <ol>
                            @foreach ($lists as $list)
                                <li class="list-question" style="color:black;">{{ $list->pertanyaan }}</li>
                            @endforeach
                        </ol>
                    </center>
                </section>
                <hr class="divider-w">
            @endif
            <section class="module" id="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="module-title font-alt">Tidak menemukan pertanyaan yang sesuai?lampirkan
                                pertanyaan anda disini</h2>
                            <div class="module-subtitle font-serif"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <form role="form" method="post" action="/userQuestion">
                                <div class="form-group">
                                    <label class="sr-only" for="name">Nama</label>
                                    <input class="form-control" type="text" name="name"
                                        placeholder="Masukkan nama anda*" required="required"
                                        data-validation-required-message="Masukkan nama anda." />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="7" name="message" placeholder="Pertanyaan anda." required="required"
                                        data-validation-required-message="Please enter your message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-block btn-round btn-d" type="submit">Submit</button>
                                </div>
                            </form>
                            <div class="ajax-response font-alt" id="contactFormResponse"></div>
                        </div>
                    </div>
                </div>
            </section>
            <hr class="divider-d">
            <footer class="footer bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="copyright font-alt">&copy; 2023&nbsp;<a href="/">Bot Helpdesk</a>, All
                                Rights
                                Reserved</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="scroll-up"><a href="#totop" style="background: yellow"><i
                    class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!--
JavaScripts
=============================================
-->
    <script src="dashboard/assets/lib/jquery/dist/jquery.js"></script>
    <script src="dashboard/assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
