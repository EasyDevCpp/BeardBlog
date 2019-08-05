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

function PostsScreen() {
    global $sql;
    global $user;

    $choose_button = new ChooseButton('post-image', '&menu=dash-menu&entry=4');
    $pick_button = new ChooseButton();

    if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'edit') {
        if(isset($_GET['submit'])) {
            if(!empty($_POST['content']) && !empty($_POST['title'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $media_id = $choose_button->pick_id;
                
                $sql->update('bb_post', $_GET['id'], 'title', $title);
                $sql->update('bb_post', $_GET['id'], 'content', addslashes($content));
                $sql->update('bb_post', $_GET['id'], 'media_id', $media_id);
                $choose_button->reset();
                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&action=').'">';
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        $row = $sql->fetch_row('bb_post', $_GET['id']);

                        echo '<p class="pt-3">Title:</p>';
                        div_row();
                            div_col();
                                echo '<input type="text" name="title" id="title" value="'.$row['title'].'" />';
                            div_end();
                            div_col('button');
                                $choose_button->set_default_pick($row['media_id']);
                                $choose_button->draw_choose_button('Choose Image.', 'Image Chosen.');
                            div_end();
                        div_end();
                        wysiwyg_editor(stripslashes($row['content']), 'Save Changes.', 'content', 'title: \'\'+document.getElementById(\'title\').value+\'\'', 'pt-3');
                    div_end();
                div_end();
            div_end();
        div_end();
    } else if(isset($_GET['action']) && $_GET['action'] == 'add') {
        if(isset($_GET['submit'])) {
            if(!empty($_POST['content']) && !empty($_POST['title'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $media_id = $choose_button->pick_id;
                
                $sql->insert('bb_post', 'id, title, content, date, media_id, user_id, views', 'NULL, "'.$title.'", "'.addslashes($content).'", "'.date('Y-m-d').'", '.$media_id.', '.$user->id.', 0');
                $choose_button->reset();
                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&action=').'">';
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        echo '<p class="pt-3">Title:</p>';
                        div_row();
                            div_col();
                                echo '<input type="text" name="title" id="title" />';
                            div_end();
                            div_col('button');
                                $choose_button->draw_choose_button('Choose Image.', 'Image Chosen.');
                            div_end();
                        div_end();
                        wysiwyg_editor('', 'Add Post', 'content', 'title: \'\'+document.getElementById(\'title\').value+\'\'', 'pt-3');
                    div_end();
                div_end();
            div_end();
        div_end();
    } else {
        if(isset($_GET['action']) && $_GET['action'] == 'delete') {
            if(isset($_GET['id'])) {
                $sql->delete('bb_post', $_GET['id']);
            }
        }
        div('p-5');
            div('pt-2 pl-5 pb-5 pr-5');
                draw_button('Add Post', HTML_ReplaceLinkPart('&action=').'&action=add','btn-big shadow-sm');
            div_end();
            div('pt-3');
                $post_list = new UList();

                $post_ids = $sql->fetch_ids('bb_post');

                $post_pages = new Menu('post-pages', 2);

                if($post_pages->get_entry() >= ceil(count($post_ids) / 15)) {
                    $post_pages->set_entry(0);
                }

                if(count($post_ids) > 0 && $post_ids[0] != "") {
                    for($i = ($post_pages->get_entry() * 15); $i < ($post_pages->get_entry() * 15) + 15; $i++) {
                        if($i < count($post_ids)) {
                            $row = $sql->fetch_row('bb_post', $post_ids[$i]);
                            if(isset($_GET['action']) && $_GET['action'] == 'pick') {
                                $post_list->add_entry($row['title'].' <div class="dash-list-right">'.$pick_button->get_pick_button($post_ids[$i]).'</div>');
                            } else {
                                $post_list->add_entry($row['title'].' <div class="dash-list-right"><a href="../index.php?page=blog&post='.$post_ids[$i].'" class="btn btn-blue btn-sm" target="_blank">View</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit&id='.$post_ids[$i].'" class="btn btn-sm">Edit</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=delete&id='.$post_ids[$i].'" class="btn btn-sm">Delete</a></div>');
                            }
                        }
                    }

                    for($i = 0; $i < ceil(count($post_ids) / 15); $i++) {
                        $post_pages->add_entry($i + 1);
                    }
                } else {
                    $post_list->add_entry('No matching element found!');
                }

                $post_list->draw();
                $post_pages->draw();
            div_end();
        div_end();
    }
}
?>