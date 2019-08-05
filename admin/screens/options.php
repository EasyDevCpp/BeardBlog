<?php
/*
BeardBlog - Block based pagebuilding CMS
Copyright (C) 2019 Robin Krause

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function OptionsScreen() {
    global $sql;
    global $user;

    if(isset($_GET['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $favicon = $_POST['favicon'];
        $lang = $_POST['lang'];
        $charset = $_POST['charset'];
        $contact_mail = $_POST['contact_mail'];
        $login = $_SESSION['menu_config-login'];
        $register = $_SESSION['menu_config-register'];
        $comments = $_SESSION['menu_config-comments'];
        $comments_by_nonusers = $_SESSION['menu_config-comments_by_nonusers'];

        $sql->update('bb_options', 1, 'title', $title);
        $sql->update('bb_options', 1, 'description', $description);
        $sql->update('bb_options', 1, 'favicon', $favicon);
        $sql->update('bb_options', 1, 'html_lang', $lang);
        $sql->update('bb_options', 1, 'html_charset', $charset);
        $sql->update('bb_options', 1, 'contact_mail', $contact_mail);
        $sql->update('bb_options', 1, 'login', $login);
        $sql->update('bb_options', 1, 'register', $register);
        $sql->update('bb_options', 1, 'comments', $comments);
        $sql->update('bb_options', 1, 'comments_by_nonusers', $comments_by_nonusers);

        unset($_SESSION['menu_config-login']);
        unset($_SESSION['menu_config-register']);
        unset($_SESSION['menu_config-comments']);
        unset($_SESSION['menu_config-comments_by_nonusers']);
    }

    div('p-5');
        div('pt-2 pl-5 pb-5 pr-5');
            echo '<a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Save Changes.</a>';
        div_end();
        div('pt-3');
            $row = $sql->fetch_row('bb_options', 1);

            $options_list = new UList();
            $options_list->add_entry('Title: <input class="mt-2" type="text" name="title" value="'.$row['title'].'" />');
            $options_list->add_entry('Description: <input class="mt-2" type="text" name="description" value="'.$row['description'].'" />');
            $options_list->add_entry('Favicon: <input class="mt-2" type="text" name="favicon" value="'.$row['favicon'].'" />');
            $options_list->add_entry('HTML Lang: <input class="mt-2" type="text" name="lang" placeholder="en" value="'.$row['html_lang'].'" />');
            $options_list->add_entry('HTML Charset: <input class="mt-2" type="text" name="charset" placeholder="UTF-8" value="'.$row['html_charset'].'" />');
            $options_list->add_entry('Contact Mail: <input class="mt-2" type="email" name="contact_mail" value="'.$row['contact_mail'].'" />');

            echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
            $options_list->draw();
            echo '</form>';

            div('pt-4');
                draw_text('Allow Login:', 3);

                $config_login = new Menu('config-login', 1, $row['login']);
                $config_login->add_entry('Disable');
                $config_login->add_entry('Enable');
                //$config_login->set_entry($row['login']);
                $config_login->draw();

                draw_text('Allow Register:', 3);
                
                $config_register = new Menu('config-register', 1, $row['register']);
                $config_register->add_entry('Disable');
                $config_register->add_entry('Enable');
                //$config_register->set_entry($row['register']);
                $config_register->draw();

                draw_text('Allow Comments:', 3);
                
                $config_comments = new Menu('config-comments', 1, $row['comments']);
                $config_comments->add_entry('Disable');
                $config_comments->add_entry('Enable');
                //$config_comments->set_entry($row['comments']);
                $config_comments->draw();

                draw_text('Allow Comments by Non-Users:', 3);
                
                $config_comments_by_nonusers = new Menu('config-comments_by_nonusers', 1, $row['comments_by_nonusers']);
                $config_comments_by_nonusers->add_entry('Disable');
                $config_comments_by_nonusers->add_entry('Enable');
                //$config_comments_by_nonusers->set_entry($row['comments_by_nonusers']);
                $config_comments_by_nonusers->draw();
            div_end();
        div_end();
    div_end();
}
?>