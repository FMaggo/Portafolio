<?php
session_start();
session_unset();
session_destroy();
header("../html/user/index.php");
exit();
?>
