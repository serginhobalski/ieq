<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>{{ env('APP_NAME') }} | @yield('title') </title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon.png') }}">
    <link rel="manifest" href="{{ asset('') }}assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="{{ asset('') }}assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('') }}assets/js/config.js"></script>
    <script src="{{ asset('') }}vendors/simplebar/simplebar.min.js"></script>

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('') }}vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('') }}assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="{{ asset('') }}assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('') }}assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-5 py-3 position-relative"><img class="bg-auth-circle-shape"
                        src="" alt=""
                        width="250"><img class="bg-auth-circle-shape-2"
                        src="" alt=""
                        width="150">
                    <div class="card overflow-hidden z-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center bg-card-gradient">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                                        <div class="bg-holder bg-auth-card-shape"
                                            style="background-image:url({{ asset('favicon.png') }}">
                                        </div><!--/.bg-holder-->
                                        <div class="z-1 position-relative"><a
                                                class="link-light mb-4 font-sans-serif fs-5 d-inline-block fw-bolder"
                                                href="{{ url('/') }}">IEQ Taquara</a>
                                            <p class="opacity-75 text-white">
                                                Existimos para manifestar o reino de Deus e promover o
                                                seu crescimento na terra.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                                        
                                        @yield('link')
                                        
                                        <p class="mb-0 mt-4 mt-md-5 fs-10 fw-semi-bold text-white opacity-75">
                                            Leia nossos
                                            <a class="text-decoration-underline text-white" href="#!">termos</a>
                                            and
                                            <a class="text-decoration-underline text-white" href="#!">condições
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                @yield('form')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

    

    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    <script src="{{ asset('') }}vendors/popper/popper.min.js"></script>
    <script src="{{ asset('') }}vendors/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('') }}vendors/anchorjs/anchor.min.js"></script>
    <script src="{{ asset('') }}vendors/is/is.min.js"></script>
    <script src="{{ asset('') }}vendors/fontawesome/all.min.js"></script>
    <script src="{{ asset('') }}vendors/lodash/lodash.min.js"></script>
    <script src="{{ asset('') }}vendors/list.js/list.min.js"></script>
    <script src="{{ asset('') }}assets/js/theme.js"></script>
</body>

</html>
