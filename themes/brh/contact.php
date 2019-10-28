<?php
/*
    BRH Theme
    Copyright (C) 2019 Robin Krause.

*/

function Theme_Contact() {
    global $sql;

    $contact_mail = '';
    if(isset($_GET['sendto'])) {
        $row = $sql->fetch_row_by_param('_team_head', 'human_id', $_GET['sendto']);
        $contact_mail = $row['email'];
    } else {
        $row = $sql->fetch_row('bb_options', 1);
        $contact_mail = $row['contact_mail'];
    }
    if(isset($_GET['submit'])) {
        if(!(empty($_POST['first_name']) && empty($_POST['last_name']) && empty($_POST['email']) && empty($_POST['phone']) && empty($_POST['message']) && empty($_POST['captcha']))) {
            $first_name = htmlspecialchars($_POST['first_name']);
            $last_name  = htmlspecialchars($_POST['last_name']);
            $email      = htmlspecialchars($_POST['email']);
            $phone      = htmlspecialchars($_POST['phone']);
            $message    = nl2br(htmlspecialchars($_POST['message']));
            $captcha    = $_POST['captcha'];
            $date       = date('d.m.Y');

            if(password_verify($captcha, $_SESSION['captcha'])) {
                $message_head = <<<EOF
                <html>
                    <body>
                        <h1>Support Request</h1>
                        <b>Name:</b> {$first_name} {$last_name}<br/>
                        <b>E-Mail:</b> {$email}<br/>
                        <b>Telefon:</b> {$phone}<br/>
                        <b>Datum:</b> {$date}<br/>
                        <p>-----------------------------------------------------------</p>
                        <p>{$message}</p>
                    </body>
                </html>
                EOF;

                $id = '#'.random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9);

                $header  = "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html; charset=utf-8\r\n";
                $header .= "From: $email\r\n";
                $header .= "Reply-To: $email\r\n";
                $header .= "X-Mailer: PHP ". phpversion();

                if(mail($contact_mail, '[SUPPORT ID]: '.$id, $message_head, $header) === true) {
                    echo '<p class="success shadow"><i class="fas fa-paper-plane"></i> E-Mail wurde erfolgreich versendet.</p>';        
                } else {
                    echo '<p class="error shadow">E-Mail konnte nicht versendet werden!</p>';       
                }
            } else {
                echo '<p class="error shadow">Captcha falsch ausgefüllt!</p>';    
            }
        } else {
            echo '<p class="error shadow">Bitte füllen sie das gesamte Formular aus!</p>';
        }
    }
    ?>
    <section class="full-page mt-5" id="contact">
        <div class="content text-align-center">
            <h1>Kontaktieren Sie uns.</h1>
            <div class="grid-2 mt-5 grid-column-gap">
                <div class="col-1">
                    <div class="color-tile tile-nr-gray">
                        <?php
                        if(isset($_GET['sendto'])) {
                            $row = $sql->fetch_row('_team_humans', $_GET['sendto']);
                            echo '<h2>Sie schreiben an:</h2>';
                            echo '<p class="text-large"><b>'.$row['name'].'</b></p>';
                            echo '<img src="'.get_img($row['media_id']).'" height="210" width="210" class="img-rounded shadow-lg" />';
                        }
                        ?>
                        <div class="contact-grid">
                            <?php echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">'; ?>
                                <p><strong>Vorname:</strong>
                                <input type="text" class="shadow-lg" name="first_name" placeholder=""></p>
                                <p><strong>Nachname:</strong>
                                <input type="text" class="shadow-lg" name="last_name" placeholder=""></p>
                                <p><strong>E-Mail:</strong>
                                <input type="email" class="shadow-lg" name="email" placeholder=""></p>
                                <p><strong>Telefon:</strong>
                                <input type="text" class="shadow-lg" name="phone" placeholder=""></p>
                                <textarea class="shadow-lg" name="message" rows="12" placeholder="Wie können wir helfen?"></textarea>
                                <?php
                                $rand_num1 = random_int(-12, 12);
                                $rand_num2 = random_int(-6, 36);
                                $_SESSION['captcha'] = password_hash(($rand_num1 + $rand_num2), PASSWORD_DEFAULT);
                                echo '<p><strong>'.$rand_num1.' + '.$rand_num2.' = ?</strong>';
                                ?>
                                <input type="text" class="shadow-lg" name="captcha" placeholder=""><a href="#" onclick="document.getElementById('data').submit();" class="btn btn-med mt-4"><i class="fas fa-paper-plane"></i> Abschicken</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <h1>Nicht das wonach sie gesucht haben?</h1>
                    <div class="mt-5">
                        <div class="color-tile color-tile-dark-gray">
                            <h1><i class="fas fa-hand-holding-usd"></i> Fördern</h1>
                            <h1><a href="" class="btn btn-red btn-med">Jetzt fördern <i class="fas fa-chevron-right"></i></a></h1>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="color-tile color-tile-blue">
                            <h1>Mitglied werden.</h1>
                            <h1><a href="" class="btn btn-med">Jetzt Bewerben <i class="fas fa-chevron-right"></i></a></h1>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

?>