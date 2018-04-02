<? 
require('kernel/before.php'); 
if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

require('kernel/after.php');