<?php
session_start();

$melding = $_SESSION['melding'] ?? null;
$type    = $_SESSION['type'] ?? null;
$oud     = $_SESSION['oud'] ?? [];

unset($_SESSION['melding'], $_SESSION['type'], $_SESSION['oud']);

function oudeWaarde(array $oud, string $veld): string
{
    return htmlspecialchars($oud[$veld] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactformulier MBO Utrecht</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>Neem contact op</h1>
        <p class="intro">Vul het formulier in en wij nemen zo snel mogelijk contact met je op.</p>

        <?php if ($melding): ?>
            <div class="melding <?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($melding, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form action="verzend.php" method="post" class="contactform">
            <label for="naam">Naam</label>
            <input type="text" id="naam" name="naam" required value="<?= oudeWaarde($oud, 'naam') ?>">

            <label for="email">E-mailadres</label>
            <input type="email" id="email" name="email" required value="<?= oudeWaarde($oud, 'email') ?>">

            <label for="onderwerp">Onderwerp</label>
            <input type="text" id="onderwerp" name="onderwerp" required value="<?= oudeWaarde($oud, 'onderwerp') ?>">

            <label for="bericht">Bericht</label>
            <textarea id="bericht" name="bericht" rows="6" required><?= oudeWaarde($oud, 'bericht') ?></textarea>

            <button type="submit">Verstuur bericht</button>
        </form>
    </main>
</body>
</html>
