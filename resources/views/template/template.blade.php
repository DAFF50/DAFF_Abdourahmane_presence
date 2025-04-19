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

        .profil {
            color: #FFFFFF;
            margin-right: 30px;
            font-size: 13px;
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
            <a class="navbar-brand" href="{{ route('Accueil') }}" style="font-weight: bold">ISI Présence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link " style="{{!empty($accueil)  ? 'color: white; font-weight: bold;' : '' }}"
                           aria-current="page"
                           href="{{ route('Accueil') }}">Accueil</a>
                    </li>
                    @if(session('user_role') == "Administrateur")
                        <li class="nav-item">
                            <a class="nav-link " style="{{!empty($users) ? 'color: white; font-weight: bold;' : '' }}"
                               href="{{ route('Utilisateurs') }}">Utilisateurs</a>
                        </li>
                    @endif
                    @if(session('user_role') != "Employe")
                        <li class="nav-item">
                            <a class="nav-link " style="{{!empty($emar)  ? 'color: white; font-weight: bold;' : '' }}"
                               href="{{ route('Emargements') }}">Emargements</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false"
                               style="{{!empty($emar)  ? 'color: white; font-weight: bold;' : '' }}">
                                Emargements
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item dropdown" href="{{ route('Emargements') }}">Historique</a>
                                </li>
                                <li><a class="dropdown-item dropdown" href="{{route('addEmargements')}}">Emargé</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(session('user_role') != "Employe")
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false"
                               style="{{!empty($serv)  ? 'color: white; font-weight: bold;' : '' }}">
                                Services
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item dropdown" href="{{ route('Services') }}">Gestion des
                                        services</a></li>
                                <li><a class="dropdown-item dropdown" href="{{route('gestionEmploye')}}">Attribution des
                                        services</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " style="{{!empty($dep)  ? 'color: white; font-weight: bold;' : '' }}"
                               href="{{ route('Departements') }}">Départements</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false"
                               style="{{!empty($rap)  ? 'color: white; font-weight: bold;' : '' }}">
                                Rapports et statistiques
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item dropdown" href="{{ route('presenceParEmploye') }}">présences
                                        par employé</a></li>
                                <li><a class="dropdown-item dropdown" href="{{route('evolutionPresences')}}">Évolution
                                        des présences </a></li>
                                <li><a class="dropdown-item dropdown" href="{{route('tauxPresenceParService')}}">Taux de
                                        présence par service</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <a href="{{route('Settings')}}" class="nav-link " style="color: white; font-weight: bold;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-gear-fill me-2" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg>
                </a>

                <div class="profil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                         class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd"
                              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                    <span style="font-weight: bold">
                        {{ session('user_role') }}
                    </span>
                </div>
                <button class="btn btn-outline-light mt-1" type="submit" data-bs-toggle="modal"
                        data-bs-target="#logoutmodal" style="font-weight: bold">Se déconnecter
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
