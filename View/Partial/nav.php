<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="?" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $controller->getPageName(); ?></span></a>
    </div>

    <div class="clearfix"></div>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="?">Accueil</a></li>
              <li><a href="index2.html">Dashboard2</a></li>
              <li><a href="index3.html">Dashboard3</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="?/users">Utilisateurs</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-key"></i> Clés <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="?/BorrowKeychainForm">Emprunter une clé</a></li>
              <li><a href="?/keys">Les clés</a></li>

            </ul>
          </li>
          <li><a><i class="fa flaticon-construction"></i> Salles <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="?/rooms">Salles</a></li>
            </ul>
          </li>
          <li><a><i class="fa flaticon-education"></i> Portes <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="?/doors">Liste des portes</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
