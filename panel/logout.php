<?php
require "../lib/ssh/remotescript.php";
session_start();
startDocker($data['IPCurso'],$data['ipAlumno'],$user,$_SERVER["REMOTE_ADDR"],null);
session_unset();
session_destroy();
setcookie('session', '', time() - 3600, '/');
header('Location: ../index.php');
exit();
?>
