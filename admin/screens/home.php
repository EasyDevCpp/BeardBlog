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

function HomeScreen() {
    global $sql;
    global $user;

    div('p-5');
        div('dash-box pt-2 pl-5 pb-2 pr-5 shadow');
            div_row();
                div_col('auto', 'pl-3');
                    draw_text('Version: '.BB_VER, 4);
                div_end();
                if($_GET['mode'] == 2) {
                    div_col();
                        draw_button('Update?', '', 'btn-big btn-orange shadow-sm');
                    div_end();
                }
                div_col();
                    draw_button('Open Page', '../index.php', 'btn-big btn-blue shadow-sm', true);
                div_end();
                div_col();
                    draw_text('Username: '.$user->username, 4);
                div_end();
                div_col();
                    if($user->type == 1) {
                        draw_text('Logged in as: Editor', 4);
                    } else {
                        draw_text('Logged in as: Admin', 4);
                    }
                div_end();
            div_end();
        div_end();
    div_end();
    div_row('pb-5 pl-5 pr-5');
        div_col('auto', 'pl-5');
            draw_text('Popular:', 1);

            $popular_type_menu = new Menu('popular-type-menu', 1);
            $popular_type_menu->add_entry('Pages');
            $popular_type_menu->add_entry('Posts');
            $popular_type_menu->draw();

            $page_ids = $sql->fetch_ids_ordered('bb_page', 'views', 'DESC');
            $post_ids = $sql->fetch_ids_ordered('bb_post', 'views', 'DESC');

            $popular_ids = '';
            if($popular_type_menu->get_entry() == 0) {
                $popular_ids = $page_ids;
            } else {
                $popular_ids = $post_ids;
            }

            $popular_list = new UList();

            for($i = 0; $i < 5; $i++) {
                if($i < count($popular_ids)) {
                    $popular_row = '';
                    if($popular_type_menu->get_entry() == 0) {
                        $popular_row = $sql->fetch_row('bb_page', $popular_ids[$i]);
                    } else {
                        $popular_row = $sql->fetch_row('bb_post', $popular_ids[$i]);
                    }
                    $popular_list->add_entry(($i + 1).'. '.$popular_row['title'].'<div class="dash-list-right">Views: '.$popular_row['views'].'</div>');
                } else {
                    break;
                }
            }

            $popular_list->draw();
        div_end();
        div_col(50, 'text-align-center');
            $views = 0;
            for($i = 0; $i < count($page_ids); $i++) {
                $row = $sql->fetch_row('bb_page', $page_ids[$i]);
                $views += $row['views'];
            }
            for($i = 0; $i < count($post_ids); $i++) {
                $row = $sql->fetch_row('bb_post', $post_ids[$i]);
                $views += $row['views'];
            }
            draw_text('Views: '.$views, 2);
        div_end();
    div_end();
}
?>