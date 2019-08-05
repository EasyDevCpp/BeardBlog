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

function ThemesScreen() {
    global $sql;
    global $user;

    if(isset($_GET['action'])) {
        if($_GET['action'] == 'delete') {
            if(isset($_GET['id'])) {
                $sql->delete('bb_themes', $_GET['id']);
            }
        } else if($_GET['action'] == 'sync') {
            /* TODO: Delete themes that are no longer available */
            $themes = array();
            if($handle = opendir('../themes/')) {
                while(false !== ($entry = readdir($handle))) {
                    if($entry != "." && $entry != "..") {
                        $themes[] = $entry;
                    }
                }
                closedir($handle);
            }
            for($i = 0; $i < count($themes); $i++) {
                $row = $sql->fetch_row_by_param('bb_themes', 'name', $themes[$i]);
                if(!is_array($row)) {
                    $sql->insert('bb_themes', 'id, name', 'NULL, "'.$themes[$i].'"');
                }
            }
        } else if($_GET['action'] == 'activate') {
            if(isset($_GET['id'])) {
                $sql->update('bb_options', 1, 'theme_id', $_GET['id']);
            }
        }
    }
    div('p-5');
        div('pt-2 pl-5 pb-5 pr-5');
            draw_button('Sync Folder.', HTML_ReplaceLinkPart('&action=').'&action=sync','btn-big btn-blue shadow-sm');
        div_end();
        div('pt-3');
            $theme_list = new UList();
            $theme_ids = $sql->fetch_ids('bb_themes');
            $theme_pages = new Menu('theme-pages', 2);
            if($theme_pages->get_entry() >= ceil(count($theme_ids) / 15)) {
                $theme_pages->set_entry(0);
            }
            if(count($theme_ids) > 0 && $theme_ids[0] != "") {
                for($i = 0; $i < count($theme_ids); $i++) {
                    $row = $sql->fetch_row('bb_themes', $theme_ids[$i]);
                    $row_options = $sql->fetch_row('bb_options', 1);

                    if($theme_ids[$i] == $row_options['theme_id']) {
                        $theme_list->add_entry($row['name']. '<div class="dash-list-right"><a href="#" class="btn btn-active btn-sm">Active</a></div>');
                    } else {
                        $theme_list->add_entry($row['name'].' <div class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&action=').'&action=activate&id='.$theme_ids[$i].'" class="btn btn-sm">Activate</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=delete&id='.$theme_ids[$i].'" class="btn btn-sm">Delete</a></div>');
                    }   
                }
            } else {
                /* That should never happen! */
                $theme_list->add_entry('No matching element found!');
            }
            $theme_list->draw();
            $theme_pages->draw();
        div_end();
    div_end();
}
?>