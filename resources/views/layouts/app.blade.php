<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') - Interface d'administration</title>

    <link rel="stylesheet" type="text/css" href="/admin/css/admin-1.2.10.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css" integrity="sha256-CCsHNqNAiVDlD9ZaCQkhAD/oPYnsbjCEVJoB1d+p6FQ=" crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/underscore@1.9.2/underscore-min.js"></script>

    <script src="/admin/js/admin-1.2.0.js"></script>
    <script src="/admin/js/tablesorter.js"></script>
</head>

<body style="padding-top: 70px;">
<div id="app">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Afficher le menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Administration</a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="{{ route('admin.shows.index') }}">Fiches-film</a>
                        {{--<a href="{{ route('admin.shows.index') }}" class="dropdown-toggle" data-toggle="dropdown">Fiches-film <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="creation-fiche-film.php"><i class="fa fa-fw fa-plus-circle"></i> Création</a></li>
                            <li><a href="modification-fiche-film-choix.php"><i class="fa fa-fw fa-pencil-square-o"></i> Modification</a></li>
                            <li><a href="chargement-affiche.php"><i class="fa fa-fw fa-picture-o"></i> Affiche</a></li>
                            <li><a href="bande-annonce.php"><i class="fa fa-fw fa-play-circle-o"></i> Bande-annonce</a></li>
                            <li><a href="fiche-film.php"><i class="fa fa-fw fa-search"></i> Recherche</a></li>
                            <li><a href="dernieres-fiches-film.php"><i class="fa fa-fw fa-sort-numeric-desc"></i> Dernières fiches-film</a></li>
                        </ul>--}}
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('admin.showings.import.index') }}" class="dropdown-toggle" data-toggle="dropdown">Programmation <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.showings.import.create') }}"><i class="fa fa-fw fa-upload"></i> Importation</a></li>
                            <li><a href="programmation-semaine.php"><i class="fa fa-fw fa-cog"></i> Réglages</a></li>
                            <li><a href="correction-seances.php"><i class="fa fa-fw fa-pencil-square-o"></i> Correction</a></li>
                            <li><a href="etat-fiches-film.php"><i class="fa fa-fw fa-tasks"></i> État des fiches-film</a></li>
                            <li><a href="export-programmation.php"><i class="fa fa-fw fa-download"></i> Exportation</a></li>
                            <li><a href="ressources-newsletter.php"><i class="fa fa-fw fa-send"></i> Ressources Newsletter</a></li>
                            <li><a href="liste-seances.php"><i class="fa fa-fw fa-list-ol"></i> Liste et ID des séances</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="importation-cartes.php" class="dropdown-toggle" data-toggle="dropdown">Divers <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="services.php"><i class="fa fa-fw fa-external-link"></i> Services externes</a></li>
                            <li><a href="opcache.php"><i class="fa fa-fw fa-refresh"></i> OPCache</a></li>
                            <li><a href="ezservermonitor2-5/"><i class="fa fa-fw fa-tasks"></i> Monitoring du serveur</a></li>
                            <li><a href="errors.php"><i class="fa fa-fw fa-stethoscope"></i> Logs d'erreurs</a></li>
                            <li><a href="importation-cartes.php"><i class="fa fa-fw fa-credit-card"></i> Cartes</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="//www.royalpalacenogent.fr">Retour au site public</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <strong>
                                USERNAME
                            </strong>
                            (<em>USERTYPE</em>)
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">
                                    Utilisateurs
                                </a>
                            </li>
                            <li role="presentation" class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-times"></i>
                                    <em>Déconnexion</em>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <div class="container">

        @include('flash::message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </div> <!-- /site -->

    <footer id="footer">
        <p class="text-muted container" style="padding:20px 15px;margin:0 auto;">
            Cinéma Royal Palace –
            Interface d'administration
            ·
            <a href="{{ config('app.url') }}">Retour au site public</a>
            <span style="float:right">
                <a href="#">Revenir en haut &uarr;</a>
            </span>
        </p>
    </footer>

</div>
@yield('scripts')
</body>

</html>
