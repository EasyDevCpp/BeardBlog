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

function UsersScreen() {
    global $sql;
    global $user;

    if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'edit') {
        if(isset($_GET['submit'])) {
            if(!empty($_POST['username']) && !empty($_POST['email'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $type = $_SESSION['menu_user-types'];

                $user->set_user($_GET['id'], $username, $email, $password, $type);
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        $row = $sql->fetch_row('bb_user', $_GET['id']);

                        unset($_SESSION['menu_user-types']);
                        $user_types = new Menu('user-types', 1, $row['type']);
                        $user_types->DIFF_URL = true;
                        $user_types->add_entry('User');
                        $user_types->add_entry('Editor');
                        $user_types->add_entry('Admin');
                        $user_types->draw();

                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        echo '<p class="pt-3">Username: <input type="text" name="username" value="'.$row['username'].'" /></p>';
                        echo '<p class="pt-3">E-Mail: <input type="email" name="email" value="'.$row['email'].'" /></p>';
                        echo '<p class="pt-3">Password: <input type="password" name="password" /></p>';
                        echo '</form>';
                        
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Save Changes.</a></p>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else if(isset($_GET['action']) && $_GET['action'] == 'add') {
        if(isset($_GET['submit'])) {
            if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $type = $_SESSION['menu_user-types'];

                $user->add_user($username, $email, $password, $type);
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        $user_types = new Menu('user-types', 1);
                        $user_types->DIFF_URL = true;
                        $user_types->add_entry('User');
                        $user_types->add_entry('Editor');
                        $user_types->add_entry('Admin');
                        $user_types->draw();

                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        echo '<p class="pt-3">Username: <input type="text" name="username" /></p>';
                        echo '<p class="pt-3">E-Mail: <input type="email" name="email" /></p>';
                        echo '<p class="pt-3">Password: <input type="password" name="password" /></p>';
                        echo '</form>';
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Add User</a></p>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else {
        if(isset($_GET['action']) && $_GET['action'] == 'delete') {
            if(isset($_GET['id'])) {
                $sql->delete('bb_user', $_GET['id']);
            }
        }
        div('pb-5 pl-5 pr-5');
            $user_type_menu = new Menu('user-type-menu', 1);
            $user_type_menu->add_entry('All');
            $user_type_menu->add_entry('Editors');
            $user_type_menu->add_entry('Admins');
            $user_type_menu->add_entry('Add User', HTML_ReplaceLinkPart('&action=').'&action=add');

            $user_type_menu->draw();

            $user_list = new UList();
            if($user_type_menu->entry != 0) {
                $user_ids = $sql->fetch_ids_by_param('bb_user', 'type', $user_type_menu->entry);
            } else {
                $user_ids = $sql->fetch_ids('bb_user');
            }

            $user_pages = new Menu('user-pages', 2);

            if($user_pages->get_entry() >= ceil(count($user_ids) / 15)) {
                $user_pages->set_entry(0);
            }

            if(count($user_ids) > 0 && $user_ids[0] != "") {
                for($i = ($user_pages->get_entry() * 15); $i < ($user_pages->get_entry() * 15) + 15; $i++) {
                    if($i < count($user_ids)) {
                        $row = $sql->fetch_row('bb_user', $user_ids[$i]);
                        if($user->username != $row['username']) {
                            $user_list->add_entry($row['username'].' &#8226; '.$row["email"].' <div class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit&id='.$user_ids[$i].'" class="btn btn-sm">Edit</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=delete&id='.$user_ids[$i].'" class="btn btn-sm">Delete</a></div>');
                        } else {
                            $user_list->add_entry('You <div class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit&id='.$user_ids[$i].'" class="btn btn-sm">Edit</a></div>');
                        }
                    }
                }

                for($i = 0; $i < ceil(count($user_ids) / 15); $i++) {
                    $user_pages->add_entry($i + 1);
                }
            } else {
                $user_list->add_entry('No matching element found!');
            }

            $user_list->draw();
            $user_pages->draw();
        div_end();
    }
}
?>