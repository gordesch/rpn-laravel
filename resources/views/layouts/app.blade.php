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
