<?php
function Team_Config() {
    global $sql;
    
    $choose_profile_image = new ChooseButton('profile-image', '&menu=dash-menu&entry=4');

    if($sql->table_exists('_team_dogs')) {
        div('p-5');
            div_row('pt-2');
                div_col(50);
                    $user_types = new Menu('team-types', 1);
                    $user_types->DIFF_URL = true;
                    $user_types->add_entry('Hundeführer');
                    $user_types->add_entry('Hunde');
                    $user_types->draw();

                    if($user_types->get_entry() == 0) {
                        draw_text('Hinzufügen:', 3);
                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        $choose_profile_image->draw_choose_button('Profilbild auswählen', 'Profilbild ausgewählt');
                        echo '<p class="pt-3">Vollständiger Name: <input type="text" name="username" /></p>';
                        echo '</form>';
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Hinzufügen</a></p>';
                        draw_text('Liste:', 3, 'pt-3');

                    } else {
                        draw_text('Hinzufügen:', 3);
                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        $choose_profile_image->draw_choose_button('Profilbild auswählen', 'Profilbild ausgewählt');
                        echo '<p class="pt-3">Name des Hundes: <input type="text" name="username" /></p>';
                        echo '<p class="pt-3">Vollständiger Name des Besitzers: <input type="text" name="username" /></p>';
                        echo '</form>';
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Hinzufügen</a></p>';
                        draw_text('Liste:', 3, 'pt-3');
                        
                    }
                div_end();
            div_end();
        div_end();
    } else {
        div();
            div_row();
                draw_text('Installation...', 2);

                /*
                    * _team_humans    id | name       | media_id
                    * _team_dogs      id | name       | human_id  | media_id
                    * _team_head      id | human_id   | email     | phone
                */
                $sql->create_table('_team_humans',  'id INT NOT NULL AUTO_INCREMENT,'.
                                                    'name VARCHAR(60) NOT NULL,'.
                                                    'media_id INT DEFAULT NULL,'.
                                                    'PRIMARY KEY (id)');

                $sql->create_table('_team_dogs',    'id INT NOT NULL AUTO_INCREMENT,'.
                                                    'name VARCHAR(60) NOT NULL,'.
                                                    'human_id INT NOT NULL,'.
                                                    'media_id INT DEFAULT NULL,'.
                                                    'PRIMARY KEY (id)');

                $sql->create_table('_team_head',    'id INT NOT NULL AUTO_INCREMENT,'.
                                                    'human_id INT NOT NULL,'.
                                                    'email VARCHAR(30) NOT NULL,'.
                                                    'phone VARCHAR(20) DEFAULT NULL,'.
                                                    'PRIMARY KEY (id)');

                draw_text('Done.', 2);
            div_end();
            div_row();
                draw_button('<i class="fas fa-sync"></i> Refresh', HTML_GetCurrentLink());
            div_end();
        div_end();
    }
}

function Team() {
    
}
?>
