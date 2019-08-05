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

function PagesScreen() {
    global $sql;
    global $user;

    $pick_button = new ChooseButton();

    if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'edit') {
        if(isset($_GET['submit'])) {
            if(!empty($_POST['title'])) {
                $title = $_POST['title'];
                $keywords = $_POST['keywords'];
                $description = $_POST['description'];

                $sql->update('bb_page', $_GET['id'], 'title', $title);
                $row_seo = $sql->fetch_row_by_param('bb_seo', 'page_id', $_GET['id']);
                $sql->update('bb_seo', $row_seo['id'], 'description', $description);
                $sql->update('bb_seo', $row_seo['id'], 'keywords', $keywords);
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        $row = $sql->fetch_row('bb_page', $_GET['id']);
                        $row_seo = $sql->fetch_row_by_param('bb_seo', 'page_id', $_GET['id']);

                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        echo '<p class="pt-3">Title: <input type="text" name="title" value="'.$row['title'].'" /></p>';
                        echo '<p class="pt-5">Keywords: <input type="text" name="keywords" value="'.$row_seo['keywords'].'" /></p>';
                        echo '<p class="pt-2">Description: </p>';
                        echo '<textarea name="description" rows="4">'.$row_seo['description'].'</textarea>';
                        echo '</form>';
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Save Changes.</a></p>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'edit_pre') {
        if(isset($_GET['submit'])) {
            $keywords = $_POST['keywords'];
            $description = $_POST['description'];

            $row = $sql->fetch_row_by_param('bb_seo', 'page_id', $_GET['id']);
            if(is_array($row)) {
                $sql->update('bb_seo', $row['id'], 'description', $description);
                $sql->update('bb_seo', $row['id'], 'keywords', $keywords);
            } else {
                $sql->insert('bb_seo', 'id, page_id, description, keywords', "NULL, '".$_GET['id']."', '$description', '$keywords'");
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        $row = $sql->fetch_row_by_param('bb_seo', 'page_id', $_GET['id']);

                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        echo '<p class="pt-3">Keywords: <input type="text" name="keywords" value="'.$row['keywords'].'" /></p>';
                        echo '<p class="pt-2">Description: </p>';
                        echo '<textarea name="description" rows="4">'.$row['description'].'</textarea>';
                        echo '</form>';
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Save Changes.</a></p>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else if(isset($_GET['action']) && $_GET['action'] == 'add') {
        if(isset($_GET['submit'])) {
            if(!empty($_POST['title'])) {
                $title = $_POST['title'];
                $keywords = $_POST['keywords'];
                $description = $_POST['description'];

                $sql->insert('bb_page', 'id, title, views', "NULL, '$title', 0");
                $ids = $sql->fetch_ids('bb_page');
                $sql->insert('bb_seo', 'id, page_id, description, keywords', "NULL, ".$ids[count($ids) - 1].", '$description', '$keywords'");
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-2');
                    div_col(50);
                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" id="data">';
                        echo '<p class="pt-3">Title: <input type="text" name="title" /></p>';
                        echo '<p class="pt-5">Keywords: <input type="text" name="keywords" /></p>';
                        echo '<p class="pt-2">Description: </p>';
                        echo '<textarea name="description" rows="4"></textarea>';
                        echo '</form>';
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn btn-big btn-blue shadow-sm">Add Page</a></p>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else {
        if(isset($_GET['action']) && $_GET['action'] == 'delete') {
            if(isset($_GET['id'])) {
                $sql->delete('bb_page', $_GET['id']);
            }
        }
        div('p-5');
            div('pt-2 pl-5 pb-5 pr-5');
                draw_button('Add Page', HTML_ReplaceLinkPart('&action=').'&action=add','btn-big shadow-sm');
            div_end();
            div('pt-3');
                $page_list = new UList();

                $page_ids = $sql->fetch_ids('bb_page');

                $page_pages = new Menu('page-pages', 2);

                if($page_pages->get_entry() >= ceil(count($page_ids) / 15)) {
                    $page_pages->set_entry(0);
                }

                if(count($page_ids) > 0 && $page_ids[0] != "") {
                    for($i = ($page_pages->get_entry() * 15); $i < ($page_pages->get_entry() * 15) + 15; $i++) {
                        if(isset($_GET['action']) && $_GET['action'] == 'pick') {
                            if($i == 0) {
                                $page_list->add_entry('[Blog] <div class="dash-list-right">'.$pick_button->get_pick_button('blog').'</div>');
                                $page_list->add_entry('[Contact] <div class="dash-list-right">'.$pick_button->get_pick_button('contact').'</div>');
                                $page_list->add_entry('[Login] <div class="dash-list-right">'.$pick_button->get_pick_button('login').'</div>');
                                $page_list->add_entry('[Register] <div class="dash-list-right">'.$pick_button->get_pick_button('register').'</div>');
                            }
                            if($i < count($page_ids)) {
                                $row = $sql->fetch_row('bb_page', $page_ids[$i]);
                                if($page_ids[$i] == 1) {
                                    $page_list->add_entry($row['title'].'<div class="dash-list-right">'.$pick_button->get_pick_button($page_ids[$i]).'</div>');
                                } else {
                                    $page_list->add_entry($row['title'].'<div class="dash-list-right">'.$pick_button->get_pick_button($page_ids[$i]).'</div>');
                                }
                            }
                        } else {
                            if($i == 0) {
                                $page_list->add_entry('[Blog] <div class="dash-list-right"><a href="../index.php?page=blog" class="btn btn-blue btn-sm" target="_blank">View</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit_pre&id=blog" class="btn btn-sm">Edit</a></div>');
                                $page_list->add_entry('[Contact] <div class="dash-list-right"><a href="../index.php?page=contact" class="btn btn-blue btn-sm" target="_blank">View</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit_pre&id=contact" class="btn btn-sm">Edit</a></div>');
                                $page_list->add_entry('[Login] <div class="dash-list-right"><a href="../index.php?page=login" class="btn btn-blue btn-sm" target="_blank">View</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit_pre&id=login" class="btn btn-sm">Edit</a></div>');
                                $page_list->add_entry('[Register] <div class="dash-list-right"><a href="../index.php?page=register" class="btn btn-blue btn-sm" target="_blank">View</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit_pre&id=register" class="btn btn-sm">Edit</a></div>');
                            }
                            if($i < count($page_ids)) {
                                $row = $sql->fetch_row('bb_page', $page_ids[$i]);
                                if($page_ids[$i] == 1) {
                                    $page_list->add_entry($row['title'].' <a href="../designer.php?page='.$page_ids[$i].'" class="btn btn-sm" target="_blank">Designer.</a><div class="dash-list-right"><a href="../index.php?page='.$page_ids[$i].'" class="btn btn-blue btn-sm" target="_blank">View</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit&id='.$page_ids[$i].'" class="btn btn-sm">Edit</a></div>');
                                } else {
                                    $page_list->add_entry($row['title'].' <a href="../designer.php?page='.$page_ids[$i].'" class="btn btn-sm" target="_blank">Designer.</a><div class="dash-list-right"><a href="../index.php?page='.$page_ids[$i].'" class="btn btn-blue btn-sm" target="_blank">View</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit&id='.$page_ids[$i].'" class="btn btn-sm">Edit</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=delete&id='.$page_ids[$i].'" class="btn btn-sm">Delete</a></div>');
                                }
                            }
                        }
                    }

                    for($i = 0; $i < ceil(count($page_ids) / 15); $i++) {
                        $page_pages->add_entry($i + 1);
                    }
                } else {
                    $page_list->add_entry('No matching element found!');
                }

                $page_list->draw();
                draw_text('[...] = Pre-Allocated pages. Design is handled by the installed theme!', 4);
                $page_pages->draw();
            div_end();
        div_end();
    }
}
?>