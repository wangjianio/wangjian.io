<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php'; ?>
<!DOCTYPE html>
<html lang="zh-CN">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/styles/footer.css">
        <?php echo $extra_css; ?>
        <script src="/node_modules/jquery/dist/jquery.min.js"></script>
        <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <?php echo $extra_js; ?>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!--<style>
            .dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
            }
        </style>-->
        <style>
            .navbar {
                margin-bottom: 0;
            }

            .container {
                max-width: 970px;
            }

        </style>
    </head>

    <body>

<?php require_once 'nav.php'; ?>
