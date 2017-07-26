<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/NavSelector.php'; ?>

    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
            aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index">Wang Jian IO</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">

<?php $nav_selector->printRightNav($nav_type); ?>

<?php $nav_selector->printLeftNav($nav_type, $subnav_type); ?>

        </div>
      </div>
    </nav>
