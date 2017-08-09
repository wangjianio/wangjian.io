<?php
$title = '当前的 IP 地址是';
$nav_type = 'ip';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="container">
        <div class="page-header">
            <h1>
                <?php echo $title; ?>
            </h1>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="panel panel-default" style="margin-top: 20px">
                    <div class="panel-body">
                        <?php echo $_SERVER['REMOTE_ADDR']; ?>
                    </div>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
