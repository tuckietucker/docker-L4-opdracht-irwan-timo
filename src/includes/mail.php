<?php
// Eenvoudige SMTP-mailverzender.
// Geen externe libraries nodig: praat rechtstreeks met de Mailtrap SMTP-server
// via een socketverbinding. Voldoende voor een leeropdracht.

function verstuurMail(string $naam, string $email, string $onderwerp, string $bericht): bool
{
    $config = require __DIR__ . '/../config/mail.php';

    $socket = @fsockopen($config['host'], (int) $config['port'], $errno, $errstr, 10);
    if (!$socket) {
        error_log("SMTP verbinding mislukt: $errstr ($errno)");
        return false;
    }

    $lees = function () use ($socket) {
        return fgets($socket, 512);
    };
    $schrijf = function (string $cmd) use ($socket) {
        fwrite($socket, $cmd . "\r\n");
    };

    $lees(); // begroeting

    $schrijf('HELO contactformulier.local');
    $lees();

    $schrijf('MAIL FROM:<' . $config['from_email'] . '>');
    $lees();

    $schrijf('RCPT TO:<' . $config['to_email'] . '>');
    $lees();

    $schrijf('DATA');
    $lees();

    $headers  = 'From: ' . $config['from_name'] . ' <' . $config['from_email'] . ">\r\n";
    $headers .= 'Reply-To: ' . $naam . ' <' . $email . ">\r\n";
    $headers .= 'To: <' . $config['to_email'] . ">\r\n";
    $headers .= 'Subject: ' . $onderwerp . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $body  = "Nieuw bericht via het contactformulier:\r\n\r\n";
    $body .= "Naam: $naam\r\n";
    $body .= "E-mail: $email\r\n";
    $body .= "Onderwerp: $onderwerp\r\n\r\n";
    $body .= "Bericht:\r\n$bericht\r\n";

    $schrijf($headers . "\r\n" . $body . "\r\n.");
    $lees();

    $schrijf('QUIT');
    fclose($socket);

    return true;
}
