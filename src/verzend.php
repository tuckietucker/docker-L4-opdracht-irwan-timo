<?php
session_start();

require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/mail.php';

// Alleen POST toestaan
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Invoer ophalen en opschonen
$naam      = trim($_POST['naam'] ?? '');
$email     = trim($_POST['email'] ?? '');
$onderwerp = trim($_POST['onderwerp'] ?? '');
$bericht   = trim($_POST['bericht'] ?? '');

// Validatie
$fouten = [];
if ($naam === '')                                       $fouten[] = 'Naam is verplicht.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))         $fouten[] = 'Geen geldig e-mailadres.';
if ($onderwerp === '')                                  $fouten[] = 'Onderwerp is verplicht.';
if ($bericht === '')                                    $fouten[] = 'Bericht is verplicht.';

if ($fouten) {
    $_SESSION['melding'] = implode(' ', $fouten);
    $_SESSION['type']    = 'fout';
    $_SESSION['oud']     = compact('naam', 'email', 'onderwerp', 'bericht');
    header('Location: index.php');
    exit;
}

try {
    // 1. Opslaan in de database
    $pdo = maakVerbinding();
    $stmt = $pdo->prepare(
        'INSERT INTO berichten (naam, email, onderwerp, bericht)
         VALUES (:naam, :email, :onderwerp, :bericht)'
    );
    $stmt->execute([
        ':naam'      => $naam,
        ':email'     => $email,
        ':onderwerp' => $onderwerp,
        ':bericht'   => $bericht,
    ]);

    // 2. Mail versturen (wordt afgevangen door Mailtrap)
    verstuurMail($naam, $email, $onderwerp, $bericht);

    $_SESSION['melding'] = 'Bedankt! Je bericht is verzonden.';
    $_SESSION['type']    = 'succes';
} catch (Throwable $e) {
    error_log($e->getMessage());
    $_SESSION['melding'] = 'Er ging iets mis bij het verzenden. Probeer het later opnieuw.';
    $_SESSION['type']    = 'fout';
    $_SESSION['oud']     = compact('naam', 'email', 'onderwerp', 'bericht');
}

header('Location: index.php');
exit;
