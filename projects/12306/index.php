<?php
$title = '12306';
$nav_type = 'tl12306';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<div class="container">
<form method="get" action="get_station_telecode.php">
    <input name="station_name" type="text">
    <input type="submit">
</form>
</div>
</body>
</html>
