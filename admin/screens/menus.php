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

function MenuScreen() {
    global $sql;
    global $user;

    $page_button = new ChooseButton('menu-page', '&menu=dash-menu&entry=2');
    $post_button = new ChooseButton('menu-post', '&menu=dash-menu&entry=3');

    if(isset($_GET['action']) && $_GET['action'] == 'menu_add') {
        if(isset($_GET['submit'])) {
            $show_always = $_SESSION['menu_show-always'];
            $pos = count($sql->fetch_ids('bb_menu')) + 1;
            if($page_button->pick_id == -1 && $post_button->pick_id == -1) {
                if(!empty($_POST['name']) && !empty($_POST['link'])) {
                    $link_name = $_POST['name'];
                    $link_url = $_POST['link'];
                    $sql->insert('bb_menu', 'id, name, link, show_always, pos', "NULL, '$link_name', '$link_url', $show_always, $pos");
                }
            } else if($page_button->pick_id != -1) {
                $sql->insert('bb_menu', 'id, page_id, show_always, pos', "NULL, '$page_button->pick_id', $show_always, $pos");
            } else if($post_button->pick_id != -1) {
                $sql->insert('bb_menu', 'id, post_id, show_always, pos', "NULL, $post_button->pick_id, $show_always, $pos");
            }
            $page_button->reset();
            $post_button->reset();
            unset($_SESSION['menu_show-always']);
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        div_row('text-align-center pt-3');
                            div_col();
                                $page_button->draw_choose_button('Choose Page', 'Page Chosen.');
                            div_end();
                            div_col();
                                draw_text('or', 3);
                            div_end();
                            div_col('button');
                                $post_button->draw_choose_button('Choose Post', 'Post Chosen.');
                            div_end();
                        div_end();
                        draw_text('Or the old-school way:', 3, 'text-align-center');
                        div_row('text-align-center');
                            div_col();
                                echo '<input type="text" name="name" placeholder="Link Name" />';
                            div_end();
                            div_col('button');
                                echo '<input type="text" name="link" placeholder="Link URL" />';
                            div_end();
                        div_end();
                        echo '</from>';

                        draw_text('Show even to users that are logged out?', 3, 'pt-5 mt-5');

                        $show_always = new Menu('show-always', 1, 1);
                        $show_always->DIFF_URL = true;
                        $show_always->add_entry('No');
                        $show_always->add_entry('Yes');
                        $show_always->draw();

                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Add Entry</a></p>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else if(isset($_GET['action']) && $_GET['action'] == 'social_add') {
        if(isset($_GET['submit'])) {
            if(!empty($_POST['icon']) && !empty($_POST['link']))  {
                $link_icon = $_POST['icon'];
                $link_url = $_POST['link'];

                $ids = $sql->fetch_ids('bb_social');
                $sql->insert('bb_social', 'id, icon, link, pos', "NULL, '$link_icon', '$link_url', ".(count($ids) + 1));
                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&action=').'">';
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        div_row('text-align-center');
                            div_col();
                                echo '<input type="text" name="icon" placeholder="Social Icon" />';
                            div_end();
                            div_col('button');
                                echo '<input type="text" name="link" placeholder="Social URL" />';
                            div_end();
                        div_end();
                        echo '</from>';

                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Add Entry</a></p>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else {
        if(isset($_GET['action']) && isset($_GET['id'])) {
            if($_GET['action'] == 'menu_delete') {
                $sql->delete('bb_menu', $_GET['id']);
            } else if($_GET['action'] == 'menu_swap_down') {
                $row_1 = $sql->fetch_row('bb_menu', $_GET['id']);
                $row_2 = $sql->fetch_row_by_param('bb_menu', 'pos', $row_1['pos'] + 1);

                $sql->exec_query("UPDATE bb_menu a INNER JOIN bb_menu b ON a.id <> b.id SET a.page_id = b.page_id,
                                                                                            a.post_id = b.post_id,
                                                                                            a.name = b.name,
                                                                                            a.link = b.link,
                                                                                            a.show_always = b.show_always
                                                                                        WHERE a.id IN (".$row_1['id'].", ".$row_2['id'].") AND b.id IN (".$row_1['id'].", ".$row_2['id'].")");
            } else if($_GET['action'] == 'menu_swap_up') {
                $row_1 = $sql->fetch_row('bb_menu', $_GET['id']);
                $row_2 = $sql->fetch_row_by_param('bb_menu', 'pos', $row_1['pos'] - 1);

                $sql->exec_query("UPDATE bb_menu a INNER JOIN bb_menu b ON a.id <> b.id SET a.page_id = b.page_id,
                                                                                            a.post_id = b.post_id,
                                                                                            a.name = b.name,
                                                                                            a.link = b.link,
                                                                                            a.show_always = b.show_always
                                                                                        WHERE a.id IN (".$row_1['id'].", ".$row_2['id'].") AND b.id IN (".$row_1['id'].", ".$row_2['id'].")");
            } else if($_GET['action'] == 'social_delete') {
                $sql->delete('bb_social', $_GET['id']);
            } else if($_GET['action'] == 'social_swap_down') {
                $row_1 = $sql->fetch_row('bb_social', $_GET['id']);
                $row_2 = $sql->fetch_row_by_param('bb_social', 'pos', $row_1['pos'] + 1);

                $sql->exec_query("UPDATE bb_social a INNER JOIN bb_social b ON a.id <> b.id SET a.icon = b.icon,
                                                                                            a.link = b.link
                                                                                        WHERE a.id IN (".$row_1['id'].", ".$row_2['id'].") AND b.id IN (".$row_1['id'].", ".$row_2['id'].")");
            } else if($_GET['action'] == 'social_swap_up') {
                $row_1 = $sql->fetch_row('bb_social', $_GET['id']);
                $row_2 = $sql->fetch_row_by_param('bb_social', 'pos', $row_1['pos'] - 1);

                $sql->exec_query("UPDATE bb_social a INNER JOIN bb_social b ON a.id <> b.id SET a.icon = b.icon,
                                                                                            a.link = b.link
                                                                                        WHERE a.id IN (".$row_1['id'].", ".$row_2['id'].") AND b.id IN (".$row_1['id'].", ".$row_2['id'].")");
            }
        }
        div('p-5');
            div('pt-2 pl-5 pb-5 pr-5');
                draw_button('Add Menu Entry', HTML_ReplaceLinkPart('&action=').'&action=menu_add','btn-big shadow-sm');
            div_end();
            div('pt-3');
                $menu_list = new UList();
                $menu_ids = $sql->fetch_ids('bb_menu');

                if(count($menu_ids) > 0 && $menu_ids[0] != "") {
                    for($i = 0; $i < count($menu_ids); $i++) {
                        $row = $sql->fetch_row('bb_menu', $menu_ids[$i]);
                        $link = '';
                        $swap = '';

                        if($row['page_id'] != '') {
                            if($row['page_id'] == 'blog') {
                                $link = '<a href="../index.php?page='.$row['page_id'].'" class="ml-5 link" target="_blank">Blog</a>';
                            } else if($row['page_id'] == 'contact') {
                                $link = '<a href="../index.php?page='.$row['page_id'].'" class="ml-5 link" target="_blank">Contact</a>';
                            } else if($row['page_id'] == 'login') {
                                $link = '<a href="../index.php?page='.$row['page_id'].'" class="ml-5 link" target="_blank">Log In</a>';
                            } else if($row['page_id'] == 'register') {
                                $link = '<a href="../index.php?page='.$row['page_id'].'" class="ml-5 link" target="_blank">Register</a>';
                            } else {
                                $row_page = $sql->fetch_row('bb_page', $row['page_id']);
                                $link = '<a href="../index.php?page='.$row['page_id'].'" class="ml-5 link" target="_blank">'.$row_page['title'].'</a>';
                            }
                        } else {
                            $link = '<a href="'.$row['link'].'" class="ml-5 link" target="_blank">'.$row['name'].'</a>';
                        }

                        if(count($menu_ids) > 1) {
                            if($i == 0) {
                                $swap = '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=menu_swap_down&id='.$menu_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-down"></i></a> ';
                            } else if($i + 1 == count($menu_ids)) {
                                $swap = '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=menu_swap_up&id='.$menu_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-up"></i></a> ';
                            } else {
                                $swap = '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=menu_swap_up&id='.$menu_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-up"></i></a> ';
                                $swap .= '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=menu_swap_down&id='.$menu_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-down"></i></a> ';
                            }
                        }

                        $menu_list->add_entry($swap.$link.'<span class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&action=').'&action=menu_delete&id='.$menu_ids[$i].'" class="btn btn-sm">Delete</a></span>');
                    }
                } else {
                    $menu_list->add_entry('No matching element found!');
                }
                $menu_list->draw();
            div_end();
        div_end();
        div('p-5');
            div('pt-2 pl-5 pb-5 pr-5');
                draw_button('Add Social Entry', HTML_ReplaceLinkPart('&action=').'&action=social_add','btn-big shadow-sm');
            div_end();
            div('pt-3');
                $social_list = new UList();
                $social_ids = $sql->fetch_ids('bb_social');

                if(count($social_ids) > 0 && $social_ids[0] != "") {
                    for($i = 0; $i < count($social_ids); $i++) {
                        $row = $sql->fetch_row('bb_social', $social_ids[$i]);
                        $link = '';
                        $swap = '';

                        $link = '<a href="'.$row['link'].'" class="ml-5 link" target="_blank">'.$row['icon'].'</a>';

                        if(count($social_ids) > 1) {
                            if($i == 0) {
                                $swap = '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=social_swap_down&id='.$social_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-down"></i></a> ';
                            } else if($i + 1 == count($social_ids)) {
                                $swap = '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=social_swap_up&id='.$social_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-up"></i></a> ';
                            } else {
                                $swap = '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=social_swap_up&id='.$social_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-up"></i></a> ';
                                $swap .= '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=social_swap_down&id='.$social_ids[$i].'" class="btn btn-sm"><i class="fas fa-chevron-down"></i></a> ';
                            }
                        }

                        $social_list->add_entry($swap.$link.'<span class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&action=').'&action=social_delete&id='.$social_ids[$i].'" class="btn btn-sm">Delete</a></span>');
                    }
                } else {
                    $social_list->add_entry('No matching element found!');
                }
                $social_list->draw();
            div_end();
        div_end();
    }
}
?>  