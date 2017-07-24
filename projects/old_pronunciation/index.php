<?php
$title = 'OLD';
$nav_type = 'old';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="container">

<?php
$q = htmlspecialchars($_GET['q']);
$page = file_get_contents("http://www.oxfordlearnersdictionaries.com/definition/english/$q");

preg_match_all('/word/', $page, $isName);

print_r($isName);

    echo '</div><!-- .container -->';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
