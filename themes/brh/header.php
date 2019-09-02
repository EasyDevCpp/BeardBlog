<?php
/*

    BRH Theme
    Copyright (C) 2019 Robin Krause.

    TODO:   Implement a beardblog api part that is used to create menu entries(html wise) and activate them
            based on the current link. (!Custom css options)
*/

function Theme_Header() {
    if(isset($_GET['page']) && $_GET['page'] != 1) {
        ?>
        <header>
            <img src="themes/brh/media/logo.png" alt="BRH Rettungshundestaffel Hessen West" width="120px">
            <p>
                <a href="?page=1" class="btn btn-dark btn-longtext"><i class="fas fa-chevron-left"></i> Zurück</a>
                <a href="?page=blog" class="btn btn-dark btn-longtext">Aktuelles</a>
                <a href="?page=2" class="btn btn-dark btn-longtext">Team</a>
                <a href="?page=contact" class="btn btn-dark btn-longtext">Kontakt</a>
            </p>
        </header>
        <?php
    } else {
        ?>
        <nav></nav>
        <?php
    }
}
?>