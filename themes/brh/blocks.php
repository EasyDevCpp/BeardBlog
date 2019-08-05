<?php
/*

    BRH Theme
    Copyright (C) 2019 Robin Krause.

*/

function Block_Empty() {
    ?>
    <section class="full-page-cover" id="top">
      <div class="center-content-25-left z-2">
          <h1>Empty Block.</h1>
      </div>
      <div class="overlay z-1"></div>
    </section>
    <?php
}

function Block_1($block = '', $show = false) {
    $base = new Block();

    $base->add_attribute('image', array('', 'BRH Logo'), 'Logo');
    $base->add_attribute('short-text', array('| Hessen West'), 'Logo Text');
    $base->add_attribute('short-text', array('Hunde retten Menschen.'), 'Überschrift');
    $base->add_attribute('text', array('Irgendwelche Fakten über keine Ahnung was.'), 'Beschreibung');
    $base->add_attribute('link', array('Erzähl Mir Mehr <i class="fas fa-chevron-right"></i>', '#what-we-do'), 'Weiterlesen Link');

    if(!$show) {
        return $base;
    } else {
    ?>
        <section class="full-page-cover" id="top">
            <div class="full-page-video">
                <video autoplay muted loop class="full-page-video">
                    <source src="themes/brh/media/video.mov" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="center-content-25-left z-2">
                <?php
                echo '<p class="logo-addition"><img src="'.get_img(get_attribute($block, $base, 'Logo')->values[0]).'" alt="'.get_attribute($block, $base, 'Logo')->values[1].'" height="54" width="54" />'.get_attribute($block, $base, 'Logo Text')->values[0].'</p>';
                echo '<h1>'.get_attribute($block, $base, 'Überschrift')->values[0].'</h1>';
                echo '<p>'.stripslashes(get_attribute($block, $base, 'Beschreibung')->values[0]).'</p>';
                ?>
                <br/>
                <?php
                echo '<a href="'.get_attribute($block, $base, 'Weiterlesen Link')->values[1].'" class="btn btn-uppercase shadow">'.get_attribute($block, $base, 'Weiterlesen Link')->values[0].'</a>';
                ?>
            </div>
            <div class="overlay z-1"></div>
        </section>
    <?php
    }
}

function Block_2($block = '', $show = false) {
    $base = new Block();

    $base->add_attribute('link', array('<i class="fas fa-play-circle"></i> Sieh dir das ganze Video an.', 'https://youtube.de'), 'Video Link');

    if(!$show) {
        return $base;
    } else {
    ?>
        <section class="quarter-page bg-dark">
            <div class="center-content">
                <?php
                echo '<a href="'.get_attribute($block, $base, 'Video Link')->values[1].'" class="btn btn-big">'.get_attribute($block, $base, 'Video Link')->values[0].'</a>';
                ?>
            </div>
        </section>
    <?php
    }
}

function Block_3($block = '', $show = false) {
    $base = new Block();

    $base->add_attribute('short-text', array('Anruf oder Mail'), 'Überschrift');
    $base->add_attribute('text', array(''), 'Infos');

    if(!$show) {
        return $base;
    } else {
    ?>
        <section class="full-page" id="contact">
            <div class="black-outline"></div>
            <div class="content">
                <h1>Kontaktieren Sie uns.</h1>
                <div class="grid-2">
                    <div class="col-1">
                        <?php
                        echo '<h2>'.get_attribute($block, $base, 'Überschrift')->values[0].'</h2>';
                        echo ''.stripslashes(get_attribute($block, $base, 'Infos')->values[0]).'';
                        ?>
                    </div>
                    <div class="col-2 p-3 bg-dark shadow">
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
                                        <textarea class="form-control" name="message" rows="5" placeholder="Wie können wir helfen?"></textarea>
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
}

?>