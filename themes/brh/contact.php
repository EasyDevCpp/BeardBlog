<?php
/*
    BRH Theme
    Copyright (C) 2019 Robin Krause.

*/

function Theme_Contact() {
    ?>
    <section class="full-page" id="contact">
            <!-- <div class="black-outline"></div> -->
            <div class="content border-top text-align-center">
                <h1>Kontaktieren Sie uns.</h1>
                <div class="grid-2">
                    <div class="col-1 p-3 color-tile-ts color-tile-light-gray">
                        
                    </div>
                    <div class="ml-4 col-2 p-3 color-tile-ts color-tile-dark-gray">
                        <h2>Schreiben Sie uns.</h2>
                        <form>
                            <div class="grid-2-auto">
                                <div class="col-1">
                                    <p><strong>Vorname:</strong></p>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col-1">
                                    <p><strong>Nachname:</strong></p>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col-1">
                                    <p><strong>E-Mail:</strong></p>
                                </div>
                                <div class="col-2">
                                    <input type="email" class="form-control" placeholder="">
                                </div>
                                <div class="col-1">
                                    <p><strong>Telefon:</strong></p>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="">
                                    <div class="mt-5">
                                        <textarea class="form-control" name="message" rows="8" placeholder="Wie können wir helfen?"></textarea>
                                    </div>
                                    <div class="mt-10">
                                        <a href="" class="btn btn-med"><i class="fas fa-paper-plane"></i> Abschicken</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
}

?>