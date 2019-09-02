<?php
/*

    BRH Theme
    Copyright (C) 2019 Robin Krause.

*/

function Theme_Header() {
    if(isset($_GET['page']) && $_GET['page'] != 1) {
        ?>
        <header>
            <img src="themes/brh/media/logo.png" alt="BRH Rettungshundestaffel Hessen West" width="120px">
            <p>
                <a href="?page=1" class="btn btn-dark btn-longtext"><i class="fas fa-chevron-left"></i> Zurüch zur Startseite</a>
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