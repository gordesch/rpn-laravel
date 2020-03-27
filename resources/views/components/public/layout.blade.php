<!DOCTYPE html>
<html dir="ltr" lang="fr-FR" class="no-js">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }} - Cinéma Royal Palace</title>
  <link rel="stylesheet" media="all" href="{{ mix('/css/public.css') }}">
  <style>
    .rpn-shadow {
      box-shadow: 0 2px 12px 0 rgba(0,0,0,.6);
    }
    .scrollbar::-webkit-scrollbar {
      height: 0px;
    }
    .scrollbar::-webkit-scrollbar-thumb {
      border-radius: 8px;
      border: 5px solid #161e2e; /* should match background, can't be transparent */
      background-color: #4b5563;
    }
    .scrollbar:hover::-webkit-scrollbar-thumb {
      background-color: #6b7280;
    }
  </style>
</head>

<body class="bg-gray-100">

<div class="flex">
  <a class="flex text-xs opacity-0 focus:opacity-100 leading-3" href="#contenu-principal" >Aller au contenu principal</a>
</div>

<header class="container mx-auto px-4 sm:px-6 lg:px-8">
  <div class="flex justify-between">
    <a class="flex items-center" href="/" title="Retour à l'accueil">
      <img
        src="https://royalpalacenogent.fr/css/images/logo-texte.png"
        srcset="https://royalpalacenogent.fr/css/images/logo-texte@2x.png 2x, css/images/logo-texte.svg 3x"
        width="83" height="75" alt="Cinéma Royal Palace"
      >
      <p class="ml-2 uppercase font-light leading-4 text-center">
        Cinéma Art et Essai<br>
        6 salles numériques – 3D
      </p>
    </a>
    <p class="text-xs text-right">
      <strong>Cinéma Royal Palace</strong><br>
      165, grande rue Charles-de-Gaulle<br>
      94130 Nogent-sur-Marne<br>
      <a href="acces.php">
        <i class="fa fa-map-marker fa-fw"></i>
        <span class="italic">Accès &amp; Parkings</span>
      </a>
      <a href="mailto:contact@royalpalacenogent.fr">
        <i class="fa fa-envelope fa-fw"></i>
        <span class="italic">Nous contacter</span>
      </a>
    </p>
  </div>
  <div class="mt-2 py-3 border-t text-sm text-center text-gray-500 focus:underline">
    <a class="" href="#" id="#newsletter" data-toggle="modal" data-target="#newsletter-modal">
      ➤ Recevez la programmation par mail tous les lundis
    </a>&nbsp;&nbsp;//&nbsp;&nbsp;
    <a class="" href="https://www.facebook.com/CineRoyalPalace" target="_blank">
      ➤ Rejoignez notre page Facebook
    </a>
  </div>
</header>

<nav class="container mx-auto sm:px-6 lg:px-8">
  <div class="flex items-center {{--h-16--}} rpn-shadow sm:rounded-md bg-gray-900">
    <div class="flex flex-shrink-0 px-4">
      <a
        class="px-3 py-2 rounded-md font-bold leading-5 text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out"
        href="/"
      >
        Accueil
      </a>
    </div>

    <div class="flex items-center h-full overflow-y-hidden overflow-x-scroll scrolling-touch scrollbar">
      <div class="flex items-center z-10" style="position:relative;top:7px;">
        @foreach (range(1,12) as $item)
          <a
            class="@if(!$loop->first) ml-4 @endif px-3 whitespace-no-wrap z-10 py-2 rounded-md font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out"
            href="#"
          >
            À l'affiche
          </a>
        @endforeach
      </div>
    </div>
  </div>
</nav>

<nav class="container mx-auto flex justify-center mt-3 px-4 sm:px-6 lg:px-8">
  <a href="#" class="px-3 py-2 font-medium text-sm leading-5 rounded-md text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 focus:bg-gray-200">
    Maintenant
  </a>
  <a href="#" class="ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 focus:bg-gray-200">
    Ce soir
  </a>
  <a href="#" class="ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md text-gray-800 bg-gray-200 focus:outline-none focus:bg-gray-300">
    Cette semaine
  </a>
  <a href="#" class="ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 focus:bg-gray-200">
    La semaine prochaine
  </a>
</nav>

<main class="container mx-auto sm:px-6 lg:px-8 py-6">
  @if (!empty($category) && ($category !== 'index')) @endif
  {{ $slot }}
  @if ($category !== "index")@endif
</main>

<footer class="container mx-auto sm:px-6 lg:px-8 flex justify-center my-10 text-sm text-gray-900 uppercase">
  <a class="mx-10 hover:underline" href="accessibilite.php">Accessibilité</a>
  <a class="mx-10 hover:underline" href="plan-du-site.php">Plan du site</a>
  <a class="mx-10 hover:underline" href="contact.php">Contactez-nous</a>
  <a class="mx-10 hover:underline" href="mentions-legales.php">Cookies &amp; Mentions légales</a>
</footer>

<!-- Newsletter Modal -->
<div class="modal hidden fade" id="newsletter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form class="modal-dialog" id="newsletter-form">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Inscription à la newsletter hebdomadaire</h4>
      </div>
      <div class="modal-body">
        <p>Recevez tous les lundis notre programmation, directement dans votre boîte mail</p>
        <div class="form" role="form">
          <div class="form-group">
            <label for="newsletter-email">Adresse e-mail</label>
            <input class="form-control" name="m" id="newsletter-email" type="email" placeholder="Entrez votre adresse e-mail" required />
            <span style="opacity:0;" id="newsletter-suggestion" class="help-block">
                                Voulez-vous dire
                                <a href="#"><i><span id="nws-adress"></span>@<strong id="nws-domain"></strong></i></a>
                                ?
                            </span>
          </div>
        </div>
        <div class="panel panel-default" style="margin-bottom:0;">
          <div class="panel-heading" style="padding:0;">
            <button class="btn btn-link" data-target="#mentions-newsletter" data-toggle="collapse" type="button" style="color:#000;width:100%;padding:10px 15px;text-align:left">
              <small><i class="fa fa-lock fa-fw fa-lg"></i>Politique de confidentialité</small>
            </button>
          </div>
          <div id="mentions-newsletter" class="panel-collapse collapse">
            <div class="panel-body" style="font-size:.85em;">
              <p>
                Ce formulaire vous permet de vous inscrire à notre newsletter hebdomadaire.
                Votre adresse mail est automatiquement ajoutée à une base de donnée hébergée chez notre prestataire Mailjet.
                Le fichier informatique contenant ces informations a été déclaré auprès de la CNIL sous le numéro 1723053.
                Nous nous engageons à ce que ces données ne fassent l'objet d'aucune autre utilisation.
              </p>
              <p>
                Conformément à la loi « informatique et libertés » du 6 janvier 1978, modifiée en 2004,
                vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent.
                Pour vous désabonner, le plus simple est d'utiliser le lien situé tout en bas du mail que vous avez reçu.
                Si vous souhaitez être totalement supprimé de la base de données,
                vous pouvez en faire la demande par simple mail, depuis l'adresse concernée,
                à <a href="mailto:contact@royalpalacenogent.fr">contact@royalpalacenogent.fr</a>.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="newsletter-reset" type="button" class="btn btn-link" style="vertical-align:middle;">Réinitialiser</button>
        <button class="btn btn-link" type="button" data-dismiss="modal" style="margin-left:40px;vertical-align:middle;">Fermer</button>
        <button id="newsletter-submit" type="submit" class="btn btn-primary">S'abonner à la newsletter</button>
      </div>
    </div><!-- /.modal-content -->
  </form><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>

</html>
