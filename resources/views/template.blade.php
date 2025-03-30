<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Examen Laravel</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png"
          sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32"
          type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16"
          type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg"
          color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }

        }

        main > .container {
            padding-top: 90px;
        }

        .test {
            background-color: rgb(0, 126, 182);

        }

        .class1 {
            background-color: rgb(0, 126, 182);
            color: white;
        }

        .dropdown {
            color: rgb(0, 126, 182);
        }

    </style>

    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top  test">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('Accueil') }}">ISI Présence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($accueil)  ? "active" : ""  ?>" aria-current="page"
                           href="{{ route('Accueil') }}">Accueil</a>
                    </li>
                    @if(session('user_role') == "Administrateur")
                        <li class="nav-item">
                            <a class="nav-link <?php echo !empty($users)  ? "active" : ""  ?>"
                               href="{{ route('Utilisateurs') }}">Utilisateurs</a>
                        </li>
                    @endif
                    @if(session('user_role') != "Employe")
                        <li class="nav-item">
                            <a class="nav-link @php echo !empty($emar)  ? "active" : "" @endphp"
                               href="{{ route('Emargements') }}">Emargements</a>
                        </li>
                    @elseif(session('user_role') == "Employe")
                        <li class="nav-item dropdown @php  echo !empty($emar)  ? "active" : ""  @endphp">
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Emargements
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item dropdown" href="{{ route('Emargements') }}">Historique</a></li>
                                <li><a class="dropdown-item dropdown" href="{{route('addEmargements')}}">Emargé</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(session('user_role') != "Employe")
                        <li class="nav-item">
                            <a class="nav-link <?php echo !empty($serv)  ? "active" : ""  ?>"
                               href="{{ route('Services') }}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo !empty($dep)  ? "active" : ""  ?>"
                               href="{{ route('Departements') }}">Départements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo !empty($rapport_statistique)  ? "active" : ""  ?>"
                               href="{{ route('RapportStatistique') }}">Rapports et statistiques</a>
                        </li>
                    @endif
                </ul>
                <button class="btn btn-outline-light mt-1" type="submit" data-bs-toggle="modal"
                        data-bs-target="#logoutmodal">Se déconnecter
                </button>
            </div>
        </div>
    </nav>
</header>

<main class="flex-shrink-0">
    <div class="container">
        <div class="modal" tabindex="-1" id="logoutmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avertissement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous vraiment vous déconnecter</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                        <a type="button" class="btn btn-primary" href="{{route('logout')}}">Oui</a>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-body-secondary">Copyright ISI Présence   {{date('Y')}} </span>
    </div>
</footer>
<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>
