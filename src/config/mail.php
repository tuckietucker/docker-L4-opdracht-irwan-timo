<?php
// Mail configuratie (Mailtrap)
// Mailtrap vangt uitgaande mail af zodat er tijdens het ontwikkelen
// geen echte mail naar support@mboutrecht.nl wordt verstuurd.

return [
    'host'       => getenv('MAIL_HOST') ?: 'mailtrap',
    'port'       => getenv('MAIL_PORT') ?: 1025,
    'from_email' => getenv('MAIL_FROM') ?: 'noreply@contactformulier.local',
    'from_name'  => 'Contactformulier MBO Utrecht',
    'to_email'   => 'support@mboutrecht.nl',
];
