<?php
/*

    BRH Theme
    Copyright (C) 2019 Robin Krause.

*/

//  Defines
define('PRE_TITLE_BLOG', 'Aktuelle Nachrichten');
define('PRE_TITLE_CONTACT', 'Kontaktiern Sie Uns');
define('PRE_TITLE_LOGIN', 'Anmeldung');
define('PRE_TITLE_REGISTER', 'Registrierung');
define('PRE_TITLE_ERROR', 'Wir haben Sie verloren.');

//  Include the other theme parts
include_once 'header.php';
include_once 'footer.php';
include_once 'blog.php';
include_once 'contact.php';
include_once 'login.php';
include_once 'register.php';
include_once 'error.php';
include_once 'blocks.php';

function Theme_HTMLHead() {
?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="themes/brh/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/565bcf65de.js"></script>
    <script src="themes/brh/js/jquery.js"></script>
    <script src="themes/brh/js/scroll.js"></script>
<?php
}

?>