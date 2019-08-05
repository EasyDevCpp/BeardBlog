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

function MediaScreen() {
    global $sql;
    global $user;

    $pick_button = new ChooseButton();

    if(isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
        if(isset($_GET['submit'])) {
            $target_dir = 'media/';
            $target_file = $target_dir.basename($_FILES['file']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo('../'.$target_file, PATHINFO_EXTENSION));
            
            $check = getimagesize($_FILES['file']['tmp_name']);
            if($check !== false) $uploadOk = 1;
            else $uploadOk = 0;

            if(file_exists('../'.$target_file)) $uploadOk = 0;
            
            if($_FILES['file']['size'] > 500000) $uploadOk = 0;
            
            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
                $uploadOk = 0;
            }
            
            if($uploadOk == 0) {
                echo '<p class="text-warning"><strong>The Upload failed!</strong></p>';
            } else {
                if(move_uploaded_file($_FILES['file']['tmp_name'], '../'.$target_file)) {
                    if(isset($_GET['id']) && $_GET['action'] == 'edit') {
                        $row = $sql->fetch_row('bb_media', $_GET['id']);
                        unlink('../'.$row['path']);
                        $sql->update('bb_media', $_GET['id'], 'path', $target_file);
                    } else {
                        $sql->insert('bb_media', 'id, path', 'NULL, "'.$target_file.'"');
                    }
                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&action=').'">';
                } else {
                    echo '<p class="text-warning"><strong>Seems like an premission error!</strong></p>';
                }
            }
        }
        div('p-5');
            div('dash-box p-5 shadow');
                draw_button('<i class="fas fa-chevron-left"></i> Back', HTML_ReplaceLinkPart('&action='),'btn-big btn-blue shadow-sm');
                div_row('pt-4 pb-5');
                    div_col(50);
                        if(isset($_GET['id']) && $_GET['action'] == 'edit') {
                            $row = $sql->fetch_row('bb_media', $_GET['id']);
                            div('p-5 text-align-center');
                                echo '<img src="../'.$row['path'].'" width="30%">';          
                            div_end();
                        }
                        echo '<form class="text-align-center" action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true" method="POST" enctype="multipart/form-data" id="data">';
                        echo '<input type="file" name="file" id="file" />';
                        echo '<label for="file" class="btn btn-big shadow-sm">Choose a file...</label>';
                        echo '<a href="#" onclick="document.getElementById(\'data\').submit();" class="ml-4 btn btn-big btn-blue shadow-sm">Upload</a>';
                        echo '</form>';
                    div_end();
                div_end();
            div_end();
        div_end();
    } else {
        if(isset($_GET['action']) && $_GET['action'] == 'delete') {
            if(isset($_GET['id'])) {
                $row = $sql->fetch_row('bb_media', $_GET['id']);
                unlink('../'.$row['path']);
                $sql->delete('bb_media', $_GET['id']);
            }
        }
        div('p-5');
            div('pt-2 pl-5 pb-5 pr-5');
                draw_button('Upload Image', HTML_ReplaceLinkPart('&action=').'&action=add','btn-big shadow-sm');
            div_end();
            div('pt-3');
                $media_list = new UList();

                $media_ids = $sql->fetch_ids('bb_media');

                $media_pages = new Menu('media-pages', 2);

                if($media_pages->get_entry() >= ceil(count($media_ids) / 15)) {
                    $media_pages->set_entry(0);
                }

                if(count($media_ids) > 0 && $media_ids[0] != "") {
                    for($i = ($media_pages->get_entry() * 15); $i < ($media_pages->get_entry() * 15) + 15; $i++) {
                        if($i < count($media_ids)) {
                            $row = $sql->fetch_row('bb_media', $media_ids[$i]);
                            if(isset($_GET['action']) && $_GET['action'] == 'pick') {
                                $media_list->add_entry('<p><img src="../'.$row['path'].'" width="10%"> '.substr($row['path'], 6).'<span class="dash-list-right">'.$pick_button->get_pick_button($media_ids[$i]).'</span></p>');
                            } else {
                                $media_list->add_entry('<p><img src="../'.$row['path'].'" width="10%"> '.substr($row['path'], 6).'<span class="dash-list-right"><a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit&id='.$media_ids[$i].'" class="btn btn-sm">Edit</a> <a href="'.HTML_ReplaceLinkPart('&action=').'&action=delete&id='.$media_ids[$i].'" class="btn btn-sm">Delete</a></span></p>');
                            }
                        }
                    }

                    for($i = 0; $i < ceil(count($media_ids) / 15); $i++) {
                        $media_pages->add_entry($i + 1);
                    }
                } else {
                    $media_list->add_entry('No matching element found!');
                }

                $media_list->draw();
                $media_pages->draw();
            div_end();
        div_end();
    }
}
?>