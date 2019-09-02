<?php
function Team_Config() {
    global $sql;

    if($sql->table_exists('_team_dogs')) {
        div('p-5');
            div_row('pt-2');
                div_col(50);
                    $user_types = new Menu('team-types', 1);
                    $user_types->DIFF_URL = true;
                    $user_types->add_entry('Mitglied');
                    $user_types->add_entry('Hunde');
                    $user_types->add_entry('Vorstand');
                    $user_types->draw();

                    if($user_types->get_entry() == 0) {
                        $choose_profile_image = new ChooseButton('profile-image', '&menu=dash-menu&entry=4');
                        $choose_profile_image2 = new ChooseButton('profile-image2', '&menu=dash-menu&entry=4');

                        if(isset($_GET['do']) && $_GET['do'] == 'edit' && isset($_GET['elem_id'])) {
                            if(isset($_GET['submit'])) {
                                if($choose_profile_image2->pick_id != -1 && !empty($_POST['name']) && !empty($_POST['exams']) && !empty($_POST['functions'])) {
                                    $sql->update('_team_humans', $_GET['elem_id'], 'name', $_POST['name']);
                                    $sql->update('_team_humans', $_GET['elem_id'], 'media_id', $choose_profile_image2->pick_id);
                                    $sql->update('_team_humans', $_GET['elem_id'], 'exams', $_POST['exams']);
                                    $sql->update('_team_humans', $_GET['elem_id'], 'functions', $_POST['functions']);
                                    $choose_profile_image2->reset();

                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&do=').'">';
                                    exit;
                                }
                            }

                            $row = $sql->fetch_row('_team_humans', $_GET['elem_id']);

                            draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&do='), 'btn-big btn-blue shadow-sm');
                            draw_text('Bearbeiten:', 3);
                            echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                            $choose_profile_image2->set_default_pick($row['media_id']);
                            $choose_profile_image2->draw_choose_button('Profilbild auswählen', 'Profilbild ausgewählt');
                            echo '<p class="pt-3">Vollständiger Name: <input type="text" name="name" value="'.$row['name'].'"/></p>';
                            echo '<p class="pt-3">Prüfungen: <input type="text" name="exams" value="'.$row['exams'].'"/></p>';
                            echo '<p class="pt-3">Funktionen (<strong>nicht Vorstands bezogen)</strong>: <input type="text" name="functions" value="'.$row['functions'].'"/></p>';
                            echo '</form>';
                            echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Bearbeiten</a></p>';
                        } else if(!isset($_GET['do']) || (isset($_GET['do']) && $_GET['do'] == 'delete')) {
                            if(isset($_GET['submit'])) {
                                if($choose_profile_image->pick_id != -1 && !empty($_POST['name']) && !empty($_POST['exams']) && !empty($_POST['functions'])) {
                                    $sql->insert('_team_humans', 'id, name, media_id, exams, functions', 'NULL, "'.$_POST['name'].'", '.$choose_profile_image->pick_id.', "'.$_POST['exams'].'", "'.$_POST['functions'].'"');
                                    $choose_profile_image->reset();

                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&submit=').'">';
                                }
                            }
                            if(isset($_GET['do']) && $_GET['do'] == 'delete' && isset($_GET['elem_id'])) {
                                $sql->delete('_team_humans', $_GET['elem_id']);
                                $ids = $sql->fetch_ids_by_param('_team_dogs', 'human_id', $_GET['elem_id']);

                                for($i = 0; $i < count($ids); $i++) {
                                    $sql->delete('_team_dogs', $ids[$i]);
                                }

                                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&do=').'">';
                            }

                            draw_text('Hinzufügen:', 3);
                            echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                            $choose_profile_image->draw_choose_button('Profilbild auswählen', 'Profilbild ausgewählt');
                            echo '<p class="pt-3">Vollständiger Name: <input type="text" name="name" /></p>';
                            echo '<p class="pt-3">Prüfungen: <input type="text" name="exams" /></p>';
                            echo '<p class="pt-3">Funktionen (<strong>nicht Vorstands bezogen)</strong>: <input type="text" name="functions" /></p>';
                            echo '</form>';
                            echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Hinzufügen</a></p>';
                            draw_text('Liste:', 3, 'pt-3');

                            $list = new UList();

                            $ids = $sql->fetch_ids('_team_humans');

                            $pages = new Menu('human-pages', 2);
                            $pages->DIFF_URL = true;

                            if($pages->get_entry() >= ceil(count($ids) / 15)) {
                                $pages->set_entry(0);
                            }

                            if(count($ids) > 0 && $ids[0] != "") {
                                for($i = ($pages->get_entry() * 15); $i < ($pages->get_entry() * 15) + 15; $i++) {
                                    if($i < count($ids)) {
                                        $row = $sql->fetch_row('_team_humans', $ids[$i]);
                                        $list->add_entry('<p>'.$row['name'].' <img src="../'.get_img($row['media_id']).'" width="10%"><span class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&do=').'&do=edit&elem_id='.$ids[$i].'" class="btn btn-sm">Edit</a> <a href="'.HTML_ReplaceLinkPart('&do=').'&do=delete&elem_id='.$ids[$i].'" class="btn btn-sm">Delete</a></span></p>');
                                    }
                                }
                            
                                for($i = 0; $i < ceil(count($ids) / 15); $i++) {
                                    $pages->add_entry($i + 1);
                                }
                            } else {
                                $list->add_entry('No matching element found!');
                            }
                        
                            $list->draw();
                            $pages->draw();
                        }
                    } else if($user_types->get_entry() == 1) {
                        $choose_profile_image = new ChooseButton('profile-image3', '&menu=dash-menu&entry=4');
                        $choose_profile_image2 = new ChooseButton('profile-image4', '&menu=dash-menu&entry=4');

                        if(isset($_GET['do']) && $_GET['do'] == 'edit' && isset($_GET['elem_id'])) {
                            if(isset($_GET['submit'])) {
                                if($choose_profile_image2->pick_id != -1 && !empty($_POST['dog_name']) && !empty($_POST['breed']) && !empty($_POST['birth'])) {
                                    $sql->update('_team_dogs', $_GET['elem_id'], 'name', $_POST['dog_name']);
                                    $sql->update('_team_dogs', $_GET['elem_id'], 'media_id', $choose_profile_image2->pick_id);
                                    $sql->update('_team_dogs', $_GET['elem_id'], 'breed', $_POST['breed']);
                                    $sql->update('_team_dogs', $_GET['elem_id'], 'year_of_birth', $_POST['birth']);
                                    $choose_profile_image2->reset();

                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&do=').'">';
                                    exit;
                                }
                            }
                            $row = $sql->fetch_row('_team_dogs', $_GET['elem_id']);

                            draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&do='), 'btn-big btn-blue shadow-sm');
                            draw_text('Bearbeiten:', 3);
                            echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                            $choose_profile_image2->set_default_pick($row['media_id']);
                            $choose_profile_image2->draw_choose_button('Profilbild auswählen', 'Profilbild ausgewählt');
                            echo '<p class="pt-3">Name des Hundes: <input type="text" name="dog_name" value="'.$row['name'].'"/></p>';
                            echo '<p class="pt-3">Hunderasse: <input type="text" name="breed" value="'.$row['breed'].'"/></p>';
                            echo '<p class="pt-3">Jahr der Geburt: <input type="number" name="birth" value="'.$row['year_of_birth'].'"/></p>';
                            echo '</form>';
                            echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Bearbeiten</a></p>';
                        } else if(!isset($_GET['do']) || (isset($_GET['do']) && $_GET['do'] == 'delete')) {
                            if(isset($_GET['submit'])) {
                                if($choose_profile_image->pick_id != -1 && !empty($_POST['name']) && !empty($_POST['dog_name']) && !empty($_POST['breed']) && !empty($_POST['birth'])) {
                                    $row = $sql->fetch_row_by_param('_team_humans', 'name', $_POST['name']);
                                    $sql->insert('_team_dogs', 'id, name, media_id, breed, year_of_birth, human_id', 'NULL, "'.$_POST['dog_name'].'", '.$choose_profile_image->pick_id.', "'.$_POST['breed'].'", '.$_POST['birth'].', '.$row['id']);
                                    $choose_profile_image->reset();

                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&submit=').'">';
                                }
                            }
                            if(isset($_GET['do']) && $_GET['do'] == 'delete' && isset($_GET['elem_id'])) {
                                $sql->delete('_team_dogs', $_GET['elem_id']);
                                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&do=').'">';
                            }
                            draw_text('Hinzufügen:', 3);
                            echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                            $choose_profile_image->draw_choose_button('Profilbild auswählen', 'Profilbild ausgewählt');
                            echo '<p class="pt-3">Vollständiger Name des Besitzers: <input type="text" name="name" /></p>';
                            echo '<p class="pt-3">Name des Hundes: <input type="text" name="dog_name" /></p>';
                            echo '<p class="pt-3">Hunderasse: <input type="text" name="breed" /></p>';
                            echo '<p class="pt-3">Jahr der Geburt: <input type="number" name="birth" /></p>';
                            echo '</form>';
                            echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Hinzufügen</a></p>';
                            draw_text('Liste:', 3, 'pt-3');
                            
                            $list = new UList();

                            $ids = $sql->fetch_ids('_team_dogs');

                            $pages = new Menu('dog-pages', 2);
                            $pages->DIFF_URL = true;

                            if($pages->get_entry() >= ceil(count($ids) / 15)) {
                                $pages->set_entry(0);
                            }

                            if(count($ids) > 0 && $ids[0] != "") {
                                for($i = ($pages->get_entry() * 15); $i < ($pages->get_entry() * 15) + 15; $i++) {
                                    if($i < count($ids)) {
                                        $row = $sql->fetch_row('_team_dogs', $ids[$i]);
                                        $row2 = $sql->fetch_row('_team_humans', $row['human_id']);
                                        $list->add_entry('<p>'.$row['name'].'('.$row2['name'].') <img src="../'.get_img($row['media_id']).'" width="10%"><span class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&do=').'&do=edit&elem_id='.$ids[$i].'" class="btn btn-sm">Edit</a> <a href="'.HTML_ReplaceLinkPart('&do=').'&do=delete&elem_id='.$ids[$i].'" class="btn btn-sm">Delete</a></span></p>');
                                    }
                                }
                            
                                for($i = 0; $i < ceil(count($ids) / 15); $i++) {
                                    $pages->add_entry($i + 1);
                                }
                            } else {
                                $list->add_entry('No matching element found!');
                            }
                        
                            $list->draw();
                            $pages->draw();
                        }
                    } else {
                        if(isset($_GET['do']) && $_GET['do'] == 'edit' && isset($_GET['elem_id'])) {
                            if(isset($_GET['submit'])) {
                                $sql->update('_team_head', $_GET['elem_id'], 'email', $_POST['email']);
                                $sql->update('_team_head', $_GET['elem_id'], 'phone', $_POST['phone']);
                                $sql->update('_team_head', $_GET['elem_id'], 'function', $_POST['function']);

                                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&do=').'">';
                            }
                            $row = $sql->fetch_row('_team_head', $_GET['elem_id']);

                            draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&do='), 'btn-big btn-blue shadow-sm');
                            draw_text('Bearbeiten:', 3);
                            echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                            echo '<p class="pt-3">E-Mail: <input type="email" name="email" value="'.$row['email'].'"/></p>';
                            echo '<p class="pt-3">Telefon: <input type="text" name="phone" value="'.$row['phone'].'"/></p>';
                            echo '<p class="pt-3">Funktion: <input type="text" name="function" value="'.$row['function'].'"/></p>';
                            echo '</form>';
                            echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Bearbeiten</a></p>';
                        } else if(!isset($_GET['do']) || (isset($_GET['do']) && $_GET['do'] == 'delete')) {
                            if(isset($_GET['submit'])) {
                                if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['function'])) {
                                    $row = $sql->fetch_row_by_param('_team_humans', 'name', $_POST['name']);
                                    $sql->insert('_team_head', 'id, human_id, email, phone, function', 'NULL, '.$row['id'].', "'.$_POST['email'].'", "'.$_POST['phone'].'", "'.$_POST['function'].'"');

                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&submit=').'">';
                                }
                            }
                            if(isset($_GET['do']) && $_GET['do'] == 'delete' && isset($_GET['elem_id'])) {
                                $sql->delete('_team_head', $_GET['elem_id']);
                                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&do=').'">';
                            }
                            draw_text('Hinzufügen:', 3);
                            echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                            echo '<p class="pt-3">Vollständiger Name des Mitglieds: <input type="text" name="name" /></p>';
                            echo '<p class="pt-3">E-Mail: <input type="email" name="email" /></p>';
                            echo '<p class="pt-3">Telefon: <input type="text" name="phone" /></p>';
                            echo '<p class="pt-3">Funktion: <input type="text" name="function" /></p>';
                            echo '</form>';
                            echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Hinzufügen</a></p>';
                            draw_text('Liste:', 3, 'pt-3');
                            
                            $list = new UList();

                            $ids = $sql->fetch_ids('_team_head');

                            $pages = new Menu('head-pages', 2);
                            $pages->DIFF_URL = true;

                            if($pages->get_entry() >= ceil(count($ids) / 15)) {
                                $pages->set_entry(0);
                            }

                            if(count($ids) > 0 && $ids[0] != "") {
                                for($i = ($pages->get_entry() * 15); $i < ($pages->get_entry() * 15) + 15; $i++) {
                                    if($i < count($ids)) {
                                        $row = $sql->fetch_row('_team_head', $ids[$i]);
                                        $row2 = $sql->fetch_row('_team_humans', $row['human_id']);
                                        $list->add_entry('<p>'.$row2['name'].'<span class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&do=').'&do=edit&elem_id='.$ids[$i].'" class="btn btn-sm">Edit</a> <a href="'.HTML_ReplaceLinkPart('&do=').'&do=delete&elem_id='.$ids[$i].'" class="btn btn-sm">Delete</a></span></p>');
                                    }
                                }
                            
                                for($i = 0; $i < ceil(count($ids) / 15); $i++) {
                                    $pages->add_entry($i + 1);
                                }
                            } else {
                                $list->add_entry('No matching element found!');
                            }
                        
                            $list->draw();
                            $pages->draw();
                        }
                    }
                div_end();
            div_end();
        div_end();
    } else {
        div();
            div_row();
                draw_text('Installation...', 2);

                /*
                    * _team_humans      id | name | media_id | exams | functions
                    * _team_dogs        id | name | media_id | breed | year_of_birth | human_id
                    * _team_head        id | human_id | email | phone | function
                */
                $sql->create_table('_team_humans',  'id INT NOT NULL AUTO_INCREMENT,'.
                                                    'name VARCHAR(60) NOT NULL,'.
                                                    'media_id INT DEFAULT NULL,'.
                                                    'exams TEXT NOT NULL,'.
                                                    'functions TEXT DEFAULT NULL,'.
                                                    'PRIMARY KEY (id)');

                $sql->create_table('_team_dogs',    'id INT NOT NULL AUTO_INCREMENT,'.
                                                    'name VARCHAR(60) NOT NULL,'.
                                                    'media_id INT DEFAULT NULL,'.
                                                    'breed VARCHAR(60) NOT NULL,'.
                                                    'year_of_birth INT NOT NULL,'.
                                                    'human_id INT NOT NULL,'.
                                                    'PRIMARY KEY (id)');

                $sql->create_table('_team_head',    'id INT NOT NULL AUTO_INCREMENT,'.
                                                    'human_id INT NOT NULL,'.
                                                    'email VARCHAR(30) NOT NULL,'.
                                                    'phone VARCHAR(20) DEFAULT NULL,'.
                                                    'function TEXT NOT NULL,'.
                                                    'PRIMARY KEY (id)');

                draw_text('Done.', 2);
            div_end();
            div_row();
                draw_button('<i class="fas fa-sync"></i> Refresh', HTML_GetCurrentLink());
            div_end();
        div_end();
    }
}
?>