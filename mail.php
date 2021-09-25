<?php
$name = trim($_POST['contact-name']);
$phone = trim($_POST['contact-phone']);
$email = trim($_POST['contact-email']);
$message = trim($_POST['contact-message']);
if ($name == "") {
    $msg['err'] = "\n Ingresa tu nombre completo";
    $msg['field'] = "contact-name";
    $msg['code'] = FALSE;
} else if ($phone == "") {
    $msg['err'] = "\n Ingresa tu teléfono";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if (!preg_match("/^[0-9 \\-\\+]{4,17}$/i", trim($phone))) {
    $msg['err'] = "\n Ingresa un teléfono válido";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if ($email == "") {
    $msg['err'] = "\n Ingresa tu email";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $msg['err'] = "\n Ingresa un email válido";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if ($message == "") {
    $msg['err'] = "\n Ingresa tu consulta";
    $msg['field'] = "contact-message";
    $msg['code'] = FALSE;
} else {
    $to = 'contacto@consultoriojuridico.com.ar';
    $subject = '[WEB] Nueva Consulta';
    $_message = '<html><head></head><body>';
    $_message .= '<p>Nombre: ' . $name . '</p>';
    $_message .= '<p>Teléfono: ' . $phone . '</p>';
    $_message .= '<p>Email: ' . $email . '</p>';
    $_message .= '<p>Consulta: ' . $message . '</p>';
    $_message .= '</body></html>';

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:  Consultorio Juridico <contacto@consultoriojuridico.com.ar>' . "\r\n";
    $headers .= 'cc: contacto@consultoriojuridico.com.ar' . "\r\n";
    $headers .= 'bcc: contacto@consultoriojuridico.com.ar' . "\r\n";
    mail($to, $subject, $_message, $headers, '-f contacto@consultoriojuridico.com.ar');

    $msg['success'] = "\n ¡Muchas gracias por tu mensaje!.";
    $msg['code'] = TRUE;
}
echo json_encode($msg);