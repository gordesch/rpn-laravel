<!DOCTYPE html>
<html dir="ltr" lang="fr-FR" class="no-js">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }} - Cinéma Royal Palace</title>
  <link rel="stylesheet" media="all" href="{{ mix('/css/public.css') }}">
  @yield('head')
</head>
<body data-target="#spytarget" data-spy="scroll" data-offset="400" class="container">
<!--[if lte IE 8]>
<p>Notre site ne supporte pas les versions d'Internet Explorer inférieures à 8, sorties il y a plus de 7 ans et ne respectant pas les standards du web.<br/>
    Pour pouvoir le consulter, merci d'utiliser un navigateur qui se met à jour automatiquement&nbsp;:
    <a href="https://www.mozilla.org/fr/firefox/new/">Mozilla Firefox</a>,
    <a href="https://www.google.fr/chrome/browser/desktop/">Google Chrome</a>,
    <a href="http://www.opera.com/fr">Opera</a>...</p>
<![endif]-->
<a href="#contenu-principal" id="go-contenu">Aller au contenu principal</a>
<header id="first-header" itemscope itemtype="http://schema.org/MovieTheater">
  <div id="first-header-logo" style="margin-bottom: 5px;">
    <a href="/" title="Retour à l'accueil">
      <img
        itemprop="image"
        src="/css/images/logo-texte.png"
        srcset="/css/images/logo-texte@2x.png 2x, css/images/logo-texte.svg 3x"
        width="83" height="75" alt="Cinéma Royal Palace"
      /><p itemprop="description" class="lead">Cinéma Art et Essai<br />6 salles numériques – 3D</p>
    </a>
  </div>
  <div id="first-header-contact" >
    <p>
      <strong itemprop="name">Cinéma Royal Palace</strong><br />
      <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress">165, grande rue Charles-de-Gaulle</span><br />
                <span itemprop="postalCode">94130</span> <span itemprop="addressLocality">Nogent-sur-Marne</span><span class="sr-only" itemprop="addressCountry"> France</span></span><br />
      <a href="acces.php"><i class="fa fa-map-marker fa-fw"></i><em>Accès &amp; Parkings</em></a>
      <a href="mailto:contact@royalpalacenogent.fr"><i class="fa fa-envelope fa-fw"></i><em>Nous contacter</em></a>
    </p>
  </div>
  <div class="clearfix"></div>
  <div class="toptips navbar-default navbar-text">
    <hr>
    <a class="navbar-link" href="#" id="#newsletter" data-toggle="modal" data-target="#newsletter-modal">
      ➤ Recevez la programmation par mail tous les lundis
    </a>&nbsp;&nbsp;//&nbsp;&nbsp;
    <a href="https://www.facebook.com/CineRoyalPalace" target="_blank" class="navbar-link">
      ➤ Rejoignez notre page Facebook
    </a>
  </div>
</header>
<div id="contenant">
  <header id="site-header">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Afficher le menu</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Accueil</a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        Topmenu
      </div>
    </nav>
  </header>
  <section id="site" role="main">
    @if (!empty($section) && ($section !== 'index'))
      <div class="row">
        <div class="col-md-3">
          <nav class="sidebar hidden-print hidden-xs hidden-sm" role="complementary" data-spy="affix" data-offset-top="200">
            Sidemenu
          </nav>
        </div>
        <article class="col-md-9">
          @endif


          {{ $slot }}


          @if ($section !== "index") : ?>
        </article>
      </div><!-- /.row -->
    @endif
  </section> <!-- /site -->
</div>

<footer id="last-footer">
  <div id="mentions">
    <a href="accessibilite.php">Accessibilité</a>
    <a href="plan-du-site.php">Plan du site</a>
    <a href="contact.php">Contactez-nous</a>
    <a href="mentions-legales.php">Cookies &amp; Mentions légales</a>
  </div>
</footer>

<!-- Newsletter Modal -->
<div class="modal fade" id="newsletter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
