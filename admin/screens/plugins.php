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

function PluginsScreen() {
    global $sql;
    global $user;

    if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'run') {
        $row = $sql->fetch_row('bb_plugins', $_GET['id']);

        include_once __DIR__.'/../../plug-ins/'.$row['name'].'/'.$row['name'].'.php';

        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                call_user_func($row['name'].'_Config');
            div_end();
        div_end();
    } else {
        if(isset($_GET['action'])) {
            if($_GET['action'] == 'delete') {
                if(isset($_GET['id'])) {
                    $sql->delete('bb_plugins', $_GET['id']);
                }
            } else if($_GET['action'] == 'sync') {
                /* TODO: Delete plugins that are no longer available */
                $plugins = array();
                if($handle = opendir('../plug-ins/')) {
                    while(false !== ($entry = readdir($handle))) {
                        if($entry != "." && $entry != "..") {
                            $plugins[] = $entry;
                        }
                    }
                    closedir($handle);
                }
                for($i = 0; $i < count($plugins); $i++) {
                    $row = $sql->fetch_row_by_param('bb_plugins', 'name', $plugins[$i]);
                    if(!is_array($row)) {
                        $sql->insert('bb_plugins', 'id, name', 'NULL, "'.$plugins[$i].'"');
                    }
                }
            }
        } 
        div('p-5');
            div('pt-2 pl-5 pb-5 pr-5');
                draw_button('Sync Folder.', HTML_ReplaceLinkPart('&action=').'&action=sync','btn-big btn-blue shadow-sm');
            div_end();
            div('pt-3');
                $plugin_list = new UList();
                $plugin_ids = $sql->fetch_ids('bb_plugins');
                $plugin_pages = new Menu('plugin-pages', 2);
                if($plugin_pages->get_entry() >= ceil(count($plugin_ids) / 15)) {
                    $plugin_pages->set_entry(0);
                }
                if(count($plugin_ids) > 0 && $plugin_ids[0] != "") {
                    for($i = 0; $i < count($plugin_ids); $i++) {
                        $row = $sql->fetch_row('bb_plugins', $plugin_ids[$i]);

                        $plugin_list->add_entry($row['name'].' <div class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&action=').'&action=run&id='.$plugin_ids[$i].'" class="btn btn-blue btn-sm">Execute</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=delete&id='.$plugin_ids[$i].'" class="btn btn-sm">Delete</a></div>');
                    }
                } else {
                    /* That should never happen! */
                    $plugin_list->add_entry('No matching element found!');
                }
                $plugin_list->draw();
                $plugin_pages->draw();
            div_end();
        div_end();
    }
}
?>