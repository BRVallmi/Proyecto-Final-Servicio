<?php
// Incluir la biblioteca phpseclib
use phpseclib3\Net\SSH2;
require 'vendor/autoload.php';
function startDocker($ipCurso,$ipAlumno,$user,$ipClient){
    // Configurar los datos de conexión SSH
    $host = $ipCurso;
    $port = 22; // Puerto SSH
    $username = 'admin';
    $password = 'konosuba';

    // Crear una nueva instancia de SSH2
    $ssh = new SSH2($host, $port);

    // Intentar la conexión SSH
    if (!$ssh->login($username, $password)) {
        exit('Error de autenticación');
    }
    
    // Ejecutar script Docker
    $ssh->write("sudo sh docker.sh $user $ipAlumno \n");
    $output = $ssh->read('/.*[pP]assword.*:/');
    $ssh->write("$password\n");
    $output .= $ssh->read();

    sleep(2);

    // Ejecutar Script Iptables
    $ssh->write("sudo sh iptables.sh true $user $ipAlumno $ipClient \n");
    $output = $ssh->read('/.*[pP]assword.*:/');
    $ssh->write("$password\n");
    $output .= $ssh->read();

    echo $output;
}
?>
