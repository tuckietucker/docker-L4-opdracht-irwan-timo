# Contactformulier (PHP + MySQL + Docker)

Leeropdracht 1e jaar. Een PHP-contactformulier dat berichten opslaat in een
MySQL-database en per e-mail verstuurt naar `support@mboutrecht.nl` (afgevangen
door een lokale mailcatcher).

Zie **OPDRACHT.md** voor de volledige opdrachtbeschrijving.

## Structuur

```
contactformulier/
├── OPDRACHT.md              # De opdracht voor de student
├── README.md                # Dit bestand
├── docker-compose.yml       # LEEG - in te vullen door student
├── docker/
│   └── php/
│       └── Dockerfile       # LEEG - in te vullen door student
├── db/
│   └── init.sql             # Maakt database + tabel 'berichten'
└── src/                     # Complete PHP-applicatie (al af)
    ├── index.php
    ├── verzend.php
    ├── style.css
    ├── config/
    │   ├── database.php
    │   └── mail.php
    └── includes/
        ├── db.php
        └── mail.php
```
