<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/account/EditAccount.php';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles/account/edit.css">
</head>

<body>

<?php
$a_type = $_GET['a_type'];
if ($a_type == 'asset' || $a_type == 'credit' || $a_type == 'debit') {
    $edit_account->printEditForm($a_type);
} else {
    exit;
}
?>

</body>

</html>
