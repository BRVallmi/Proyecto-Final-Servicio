<?php
require "../lib/ssh/remotescript.php";
session_start();
session_unset();
session_destroy();
setcookie('session', '', time() - 3600, '/');
startDocker($data['IPCurso'],$data['ipAlumno'],$user,$_SERVER["REMOTE_ADDR"],null);
header('Location: ../index.php');
exit();
?>
