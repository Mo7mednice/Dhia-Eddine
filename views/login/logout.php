<?php
session_start();
unset($_SESSION["admin_id"] , $_SESSION["adhérent_id"]);
session_destroy();
header("Location: Login.php");
exit();