<?php 
// Function to get the client ip address
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}


// Function to get the client ip address
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

// Get the client ip address
$ipaddress = $_SERVER['REMOTE_ADDR'];

echo 'Your IP address (using $_SERVER[\'REMOTE_ADDR\']) is ' . $ipaddress . '<br />';
echo 'Your IP address (using get_client_ip_env function) is ' . get_client_ip_env() . '<br />';
echo 'Your IP address (using get_client_ip_server function) is ' . get_client_ip_server() . '<br />';

//EMAIL DONDE RECIBIRÁ LOS DATOS
$para = 'lacasona@directoslp.com';

$nombre = $_POST["nombre"]; 
 
$mailheader = "From: ".$_POST["email"]."\r\n"; 
$mailheader .= "Reply-To: ".$_POST["email"]."\r\n"; 
$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$MESSAGE_BODY = "Nombre: ".$_POST["nombre"]."<br>";
$MESSAGE_BODY .= "Telefono: ".$_POST["telefono"]."<br>";  
$MESSAGE_BODY .= "Email: ".$_POST["email"]."<br>";
$MESSAGE_BODY .= "Mensaje: ".$_POST["mensaje"]."<br>"."<br>";
/*$MESSAGE_BODY .= "Direccion: ".$_POST["direccion"]."<br>"."<br>";
$MESSAGE_BODY .= "Llegada: ".$_POST["llegada"]."<br>"; //Envia tamaño
$MESSAGE_BODY .= "Salida: ".$_POST["salida"]."<br>";
$MESSAGE_BODY .= "Adultos: ".$_POST["adultos"]."<br>";
$MESSAGE_BODY .= "Niños: ".$_POST["niños"]."<br>";
$MESSAGE_BODY .= "CheckBox-1: ".$_POST["checkbox1"]."<br>";
$MESSAGE_BODY .= "CheckBox-2: ".$_POST["checkbox2"]."<br>"."<br>";*/
$MESSAGE_BODY .= "Usuario IP : ".$_SERVER["REMOTE_ADDR"]."<br>"."\r\n"; //Envia la IP
$MESSAGE_BODY .= "De : ".$_SERVER["HTTP_REFERER"]."<br><br>"; //Pais
$MESSAGE_BODY .= "Navegador : ".$_SERVER["HTTP_USER_AGENT"]."\r\n"; //Navegador

mail($para, $nombre, $MESSAGE_BODY, $mailheader, $ipaddress) or die ("Error al enviar el Formulario !"); 

//REDIRECCION EN SERVIDOR

header('Status: 301 Moved Permanently', false, 301);
header('Location: /');


?>