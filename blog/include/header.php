<?php
if (!$is_root) {
    $dir = '../';
}

$css_href = $dir.'styles/main.css';

$icon_href = array(
    'about' => $dir.'about',
    'lopedever' => $dir.'index',
);

$icon_src = array(
    'about' => $dir.'../icons/About.svg',
    'github' => $dir.'../icons/github.svg',
    'lopedever' => $dir.'../icons/lopedever.svg',
    'twitter' => $dir.'../icons/twitter.svg',
);
?>
<html>

<head>
  <title><?php echo $title;?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="<?php echo $css_href;?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <header>
    <div class="wrapper">
      <a class="site-index" href="<?php echo $icon_href['lopedever'];?>"><?php include $icon_src['lopedever'];?></a>
      <a class="site-about" href="<?php echo $icon_href['about'];?>"><?php include $icon_src['about'];?></a>
    </div>
  </header>

  <div class="content">
