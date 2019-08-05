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

session_start();

include_once "api/bb-api.php";

function choose_button($text_1, $text_2, $name, $url) {
    if(!isset($_SESSION[$name.'-url'])) {
        $_SESSION[$name.'-url'] = HTML_GetCurrentLink();
    }
    if(!isset($_SESSION[$name.'-pick'])) {
        $_SESSION[$name.'-pick'] = -1;
    }
    if($_SESSION[$name.'-pick'] == -1) {
        echo '<a href="'.$url.'" class="designer-btn">'.$text_1.'</a>';
    } else {
        echo '<a href="'.$url.'" class="designer-btn designer-btn-active">'.$text_2.'</a>';
    }
}

function set_chosen_value($id, $value) {
    if(!isset($_SESSION[$id.'-pick'])) {
        if(!empty($value)) {
            $_SESSION[$id.'-pick'] = $value;
        } else {
            $_SESSION[$id.'-pick'] = -1;
        }
    } 
}

$sql = new SQL();
$sql->init();

$user = new User();

$options = $sql->fetch_row('bb_options', 1);

include_once 'themes/'.($sql->fetch_row('bb_themes', $options['theme_id'])['name']).'/theme.php';

if($user->is_logged_in && $user->type != 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>BeardBlog | Designer</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet">
    <script src="https://kit.fontawesome.com/565bcf65de.js"></script>
    <link type="text/css" rel="stylesheet" href="api/style/designer.css">
    <?php
    Theme_HTMLHead();
    ?>
</head>
<body>
    <?php
    Theme_Header();

    ?>
    <div class="designer designer-box">
        <h1>Add Block:</h1>
        <div class="designer-blocks">
            <?php
            $counter = 0;

            while(true) {
                if($counter % 3 == 0) {
                    echo '<div class="designer-row">';
                }
                if($counter == 0) {
                    if(isset($_GET['preview_block']) && $_GET['preview_block'] == 'call') {
                        echo '<a href="'.HTML_ReplaceLinkPart('&preview_block=').'&preview_block=call#add" class="designer-col-25 designer-box-mr designer-box-mr-active">Call</a>';
                    } else {
                        echo '<a href="'.HTML_ReplaceLinkPart('&preview_block=').'&preview_block=call#add" class="designer-col-25 designer-box-mr">Call</a>';
                    }
                } else {
                    if(function_exists('Block_'.$counter)) {
                        if(isset($_GET['preview_block']) && $_GET['preview_block'] == $counter) {
                            echo '<a href="'.HTML_ReplaceLinkPart('&preview_block=').'&preview_block='.$counter.'#add" class="designer-col-25 designer-box-mr designer-box-mr-active">Block '.$counter.'</a>';
                        } else {
                            echo '<a href="'.HTML_ReplaceLinkPart('&preview_block=').'&preview_block='.$counter.'#add" class="designer-col-25 designer-box-mr">Block '.$counter.'</a>';
                        }

                        if(($counter + 1) % 3 == 0) {
                            echo '</div>';
                        }
                    } else {
                        echo '</div>';
                        break;
                    }
                }
                $counter++;
            }
            ?>
        </div>
    </div>
    <?php
    if(isset($_GET['action'])) {
        if($_GET['action'] == 'add_call') {
            if(isset($_GET['plugin'])) {
                $ids = $sql->fetch_ids('bb_block');
                $sql->insert('bb_block', 'id, page_id, type, pos', "NULL, ".$_GET['page'].", 'call', ".(count($ids) + 1));
                $ids = $sql->fetch_ids('bb_block');
                $block_id = $ids[count($ids) - 1];
                $sql->insert('bb_call', 'id, block_id, plugin_id', "NULL, $block_id, ".$_GET['plugin']);
                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&preview_block=').'">';
            }
        } else if($_GET['action'] == 'add_block') {
            if(isset($_GET['preview_block'])) {
                $ids = $sql->fetch_ids('bb_block');
                $sql->insert('bb_block', 'id, page_id, type, pos', "NULL, ".$_GET['page'].", 'Block_".$_GET['preview_block']."', ".(count($ids) + 1));
                $ids = $sql->fetch_ids('bb_block');
                $block_id = $ids[count($ids) - 1];
                $block = call_user_func('Block_'.$_GET['preview_block'], '', false);
                for($i = 0; $i < count($block->attributes); $i++) {
                    $sql->insert('bb_attr', 'id, block_id, type, name', "NULL, $block_id, '".$block->attributes[$i]->type."', '".$block->attributes[$i]->name."'");
                }
                echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&preview_block=').'">';
            }
        }
    }
    if(isset($_GET['preview_block'])) {
        if($_GET['preview_block'] == 'call') {
            ?>
            <div class="designer designer-box" id="set">
                <h1>Plug-ins:</h1>
                <?php
                $plugin_ids = $sql->fetch_ids('bb_plugins');

                if(is_array($plugin_ids)) {
                ?>
                    <div class="designer-blocks" id="add">
                        <div class="designer-row">
                            <?php
                            for($i = 0; $i < count($plugin_ids); $i++) {
                                $row = $sql->fetch_row('bb_plugins', $plugin_ids[$i]);
                                if(isset($_GET['plugin']) && $_GET['plugin'] == $row['id']) {
                                    echo '<a href="'.HTML_ReplaceLinkPart('&plugin=').'&plugin='.$row['id'].'#add" class="designer-col-25 designer-box-mr-active">'.$row['name'].'</a>';
                                } else {
                                    echo '<a href="'.HTML_ReplaceLinkPart('&plugin=').'&plugin='.$row['id'].'#add" class="designer-col-25 designer-box-mr">'.$row['name'].'</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="designer-row">
                        <?php echo '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=add_call" class="designer-btn">Add Block</a>'; ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="designer-row">
                        <p class="designer-text">No plug-ins installed!</p>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
        } else {
            call_user_func('Block_'.$_GET['preview_block'], '', true);

            ?>
            <div class="designer designer-box" id="set">
                <div class="designer-row">
                    <?php echo '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=add_block" class="designer-btn">Add Block</a>'; ?>
                </div>
            </div>
            <?php
        }
    }

    //Preview the damn block
    $block_ids = $sql->fetch_ids_by_param_ordered('bb_block', 'page_id', $_GET['page'], 'pos');
    $preview_block = '';

    for($i = 0; $i < count($block_ids); $i++) {
        $preview_block = new Block();
        $preview_block->init($block_ids[$i]);
        $preview_block->show_block();
        
        if(!isset($_GET['action']) || (isset($_GET['action']) && isset($_GET['block']) && $_GET['block'] != $block_ids[$i])) {
            echo '<div class="designer designer-box" id="Block_'.$block_ids[$i].'">';
            ?>
                <div class="designer-row">
                    <?php
                    if($i != 0) echo '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=swap_up&block='.$block_ids[$i].'#Block_'.$block_ids[$i].'" class="designer-btn designer-ml">Up</a>';
                    if($i < count($block_ids) - 1) echo '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=swap_down&block='.$block_ids[$i].'#Block_'.$block_ids[$i].'" class="designer-btn designer-ml">Down</a>';
                    echo '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=edit&block='.$block_ids[$i].'#Block_'.$block_ids[$i].'" class="designer-btn designer-ml">Edit</a>'; 
                    echo '<a href="'.HTML_ReplaceLinkPart('&action=').'&action=delete&block='.$block_ids[$i].'#Block_'.$block_ids[$i].'" class="designer-btn designer-ml">Delete</a>'; 
                    ?>
                </div>
            </div>
        <?php
        } else if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['block']) && $_GET['block'] == $block_ids[$i]) {
            $row = $sql->fetch_row('bb_block', $_GET['block']);
            $sql->delete('bb_block', $_GET['block']);

            if($row['type'] == 'call') {
                $call_row = $sql->fetch_row_by_param('bb_call', 'block_id', $_GET['block']);
                $sql->delete('bb_call', $call_row['id']);
            } else {
                $attr_ids = $sql->fetch_ids_by_param('bb_attr', 'block_id', $_GET['block']);
                for($k = 0; $k < count($attr_ids); $k++) {
                    $sql->delete('bb_attr', $attr_ids[$k]);
                }
            }
            echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&action=').'">';
        } else if(isset($_GET['action']) && $_GET['action'] == 'swap_up' && isset($_GET['block']) && $_GET['block'] == $block_ids[$i]) {
            $row_1 = $sql->fetch_row('bb_block', $_GET['block']);
            $row_2 = $sql->fetch_row_by_param('bb_block', 'pos', $row_1['pos'] - 1);

            $sql->update('bb_block', $row_1['id'], 'pos', $row_2['pos']);
            $sql->update('bb_block', $row_2['id'], 'pos', $row_1['pos']);

            echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&action=').'">';
        } else if(isset($_GET['action']) && $_GET['action'] == 'swap_down' && isset($_GET['block']) && $_GET['block'] == $block_ids[$i]) {
            $row_1 = $sql->fetch_row('bb_block', $_GET['block']);
            $row_2 = $sql->fetch_row_by_param('bb_block', 'pos', $row_1['pos'] + 1);

            $sql->update('bb_block', $row_1['id'], 'pos', $row_2['pos']);
            $sql->update('bb_block', $row_2['id'], 'pos', $row_1['pos']);

            echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&action=').'">';
        } else if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['block']) && $_GET['block'] == $block_ids[$i]) {
            echo '<div class="designer designer-box" id="Block_'.$block_ids[$i].'">';
            
            if($preview_block->type == 'call') {
                if(isset($_GET['submit'])) {
                    $params = $_POST['params'];

                    $sql->update('bb_call', $_GET['block'], 'params', $params);

                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&submit=').'#Block_'.$_GET['block'].'">';
                }
            ?>
                <ul class="designer-ul">
                    <?php
                    echo '<li><a href="'.HTML_ReplaceLinkPart('&action=').'#Block_'.$block_ids[$i].'" class="designer-menu"><i class="fas fa-chevron-left"></i> Back</a></li>';
                    ?>
                </ul>
                <?php echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true#Block_'.$block_ids[$i].'" method="POST" id="data">'; ?>
                    <div class="designer-row">
                        <div class="designer-col-auto">
                            <?php echo '<p>Parameters: <input class="designer-input" type="text" name="params" id="params" value="'.htmlspecialchars($preview_block->call->params).'"/></p>'; ?>
                        </div>
                    </div>
                </form>
                <?php
                echo '<div class="designer-row designer-mt">';
                    echo '<a href="#Block_'.$block_ids[$i].'" onclick="document.getElementById(\'data\').submit();" class="designer-btn">Save Changes.</a>';
                echo '</div>';
            } else {
            ?>
                <ul class="designer-ul">
                    <?php
                    echo '<li><a href="'.HTML_ReplaceLinkPart('&action=').'#Block_'.$block_ids[$i].'" class="designer-menu"><i class="fas fa-chevron-left"></i> Back</a></li>';
                    if($preview_block->count_by_type('image') > 0) {
                        if(isset($_GET['set']) && $_GET['set'] == 'images') {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=images#Block_'.$block_ids[$i].'" class="designer-menu designer-menu-active">Images</a></li>';
                        } else {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=images#Block_'.$block_ids[$i].'" class="designer-menu">Images</a></li>';
                        }
                    }
                    if($preview_block->count_by_type('short-text') > 0) {
                        if(isset($_GET['set']) && $_GET['set'] == 'short-texts') {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=short-texts#Block_'.$block_ids[$i].'" class="designer-menu designer-menu-active">Short-Texts</a></li>';
                        } else {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=short-texts#Block_'.$block_ids[$i].'" class="designer-menu">Short-Texts</a></li>';
                        }
                    }
                    if($preview_block->count_by_type('text') > 0) {
                        if(isset($_GET['set']) && $_GET['set'] == 'texts') {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=texts#Block_'.$block_ids[$i].'" class="designer-menu designer-menu-active">Texts</a></li>';
                        } else {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=texts#Block_'.$block_ids[$i].'" class="designer-menu">Texts</a></li>';
                        }
                    }
                    if($preview_block->count_by_type('link') > 0) {
                        if(isset($_GET['set']) && $_GET['set'] == 'links') {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=links#Block_'.$block_ids[$i].'" class="designer-menu designer-menu-active">Links</a></li>';
                        } else {
                            echo '<li><a href="'.HTML_ReplaceLinkPart('&set=').'&set=links#Block_'.$block_ids[$i].'" class="designer-menu">Links</a></li>';
                        }
                    }
                    ?>
                </ul>
                <?php
                if(isset($_GET['set'])) {
                    if($_GET['set'] != 'texts') {
                        echo '<form action="'.HTML_ReplaceLinkPart('&submit=').'&submit=true#Block_'.$block_ids[$i].'" method="POST" id="data">';
                    }
                    ?>
                        <div class="designer-row">
                            <?php
                            if($_GET['set'] == 'images') {
                                $attributes = $preview_block->get_attributes_by_type('image');
                                for($j = 0; $j < $preview_block->count_by_type('image'); $j++) {
                                    if(isset($_GET['submit'])) {
                                        if(!empty($_POST['alt-'.$j]) && isset($_SESSION['designer-image'.$block_ids[$i].$j.'-pick'])) {
                                            $img_id = $_SESSION['designer-image'.$block_ids[$i].$j.'-pick'];
                                            $alt_text = $_POST['alt-'.$j];

                                            $attr_ids = $sql->fetch_ids_by_param('bb_attr', 'block_id', $_GET['block']);
                                            $id = 0;
                                            for($k = 0; $k < count($attr_ids); $k++) {
                                                $row = $sql->fetch_row('bb_attr', $attr_ids[$k]);
                                                if($attributes[$j]->name == $row['name']) {
                                                    $id = $attr_ids[$k];
                                                    break;
                                                }
                                            }

                                            $sql->update('bb_attr', $id, 'value', $img_id);
                                            $sql->update('bb_attr', $id, 'value2', $alt_text);

                                            unset($_SESSION['designer-image'.$block_ids[$i].$j.'-pick']);
                                            unset($_SESSION['designer-image'.$block_ids[$i].$j.'-url']);
                                        }
                                    }

                                    echo '<div class="designer-col-25">';
                                        set_chosen_value('designer-image'.$block_ids[$i].$j, $attributes[$j]->values[0]);
                                        choose_button('Choose '.$attributes[$j]->name, $attributes[$j]->name.' chosen.', 'designer-image'.$block_ids[$i].$j, HTML_ReplaceLinkPart('designer.php').'admin/dashboard.php?mode=2&menu=dash-menu&entry=4&action=pick&choose_id=designer-image'.$block_ids[$i].$j);
                                    echo '</div>';
                                    echo '<div class="designer-col-auto">';
                                        echo '<p>'.$attributes[$j]->name.'(Alt): <strong>Important for SEO!</strong><input class="designer-input" type="text" name="alt-'.$j.'" id="alt-'.$j.'" value="'.$attributes[$j]->values[1].'"/></p>';
                                    echo '</div>';
                                }
                                if(isset($_GET['submit'])) {
                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&submit=').'#Block_'.$_GET['block'].'">';
                                }
                            } else if($_GET['set'] == 'short-texts') {
                                $attributes = $preview_block->get_attributes_by_type('short-text');
                                for($j = 0; $j < $preview_block->count_by_type('short-text'); $j++) {
                                    if(isset($_GET['submit'])) {
                                        if(!empty($_POST['short-text-'.$j])) {
                                            $short_text = $_POST['short-text-'.$j];

                                            $attr_ids = $sql->fetch_ids_by_param('bb_attr', 'block_id', $_GET['block']);
                                            $id = 0;
                                            for($k = 0; $k < count($attr_ids); $k++) {
                                                $row = $sql->fetch_row('bb_attr', $attr_ids[$k]);
                                                if($attributes[$j]->name == $row['name']) {
                                                    $id = $attr_ids[$k];
                                                    break;
                                                }
                                            }

                                            $sql->update('bb_attr', $id, 'value', $short_text);
                                        }
                                    }

                                    echo '<div class="designer-col-50">';
                                        echo '<p>'.$attributes[$j]->name.': <input class="designer-input" type="text" name="short-text-'.$j.'" id="short-text-'.$j.'" value="'.$attributes[$j]->values[0].'"/></p>';
                                    echo '</div>';
                                }
                                if(isset($_GET['submit'])) {
                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&submit=').'#Block_'.$_GET['block'].'">';
                                }
                            } else if($_GET['set'] == 'texts') {
                                $attributes = $preview_block->get_attributes_by_type('text');
                                for($j = 0; $j < $preview_block->count_by_type('text'); $j++) {
                                    if(isset($_GET['submit']) && isset($_POST['text'.$j])) {
                                        $text = $_POST['text'.$j];

                                        $attr_ids = $sql->fetch_ids_by_param('bb_attr', 'block_id', $_GET['block']);
                                        $id = 0;
                                        for($k = 0; $k < count($attr_ids); $k++) {
                                            $row = $sql->fetch_row('bb_attr', $attr_ids[$k]);
                                            if($attributes[$j]->name == $row['name']) {
                                                $id = $attr_ids[$k];
                                                break;
                                            }
                                        }

                                        $sql->update('bb_attr', $id, 'value', addslashes($text));
                                    }
                                    echo '<div class="designer-col-50">';
                                        echo '<p>'.$attributes[$j]->name.':</p>';
                                        wysiwyg_editor($attributes[$j]->values[0], 'Save Changes.', 'text'.$j, '', '', true, 'Block_'.$block_ids[$i]);
                                    echo '</div>';
                                }
                            } else if($_GET['set'] == 'links') {
                                $attributes = $preview_block->get_attributes_by_type('link');
                                for($j = 0; $j < $preview_block->count_by_type('link'); $j++) {
                                    if(isset($_GET['submit'])) {
                                        if(!empty($_POST['link-'.$j.'-text']) && !empty($_POST['link-'.$j.'-url'])) {
                                            $text = $_POST['link-'.$j.'-text'];
                                            $url = $_POST['link-'.$j.'-url'];

                                            $attr_ids = $sql->fetch_ids_by_param('bb_attr', 'block_id', $_GET['block']);
                                            $id = 0;
                                            for($k = 0; $k < count($attr_ids); $k++) {
                                                $row = $sql->fetch_row('bb_attr', $attr_ids[$k]);
                                                if($attributes[$j]->name == $row['name']) {
                                                    $id = $attr_ids[$k];
                                                    break;
                                                }
                                            }

                                            $sql->update('bb_attr', $id, 'value', addslashes($text));
                                            $sql->update('bb_attr', $id, 'value2', $url);
                                        }
                                    }
                                    echo '<div class="designer-col-50">';
                                        echo '<p>'.$attributes[$j]->name.'(Text): <input class="designer-input" type="text" name="link-'.$j.'-text" id="link-'.$j.'-text" value="'.htmlspecialchars($attributes[$j]->values[0]).'"/></p>';
                                    echo '</div>';
                                    echo '<div class="designer-col-50">';
                                       echo '<p>'.$attributes[$j]->name.'(URL): <input class="designer-input" type="text" name="link-'.$j.'-url" id="link-'.$j.'-url" value="'.htmlspecialchars($attributes[$j]->values[1]).'"/></p>';
                                    echo '</div>';
                                }
                                if(isset($_GET['submit'])) {
                                    echo '<meta http-equiv="refresh" content="0; URL='.HTML_ReplaceLinkPart('&submit=').'#Block_'.$_GET['block'].'">';
                                }
                            }
                            ?>
                        </div>
                    <?php
                    if($_GET['set'] != 'texts') {
                        echo '</form>';

                        echo '<div class="designer-row designer-mt">';
                            echo '<a href="#Block_'.$block_ids[$i].'" onclick="document.getElementById(\'data\').submit();" class="designer-btn">Save Changes.</a>';
                        echo '</div>';
                    }
                }
            }
            ?>
            </div>
            <?php
        }
        $preview_block->reset();
    }

    Theme_Footer();
    ?>

    <script src="api/modules/wysiwyg.js"></script>
</body>
</hmtl>
<?php
} else {
    echo 'You ain\'t admin or editor | or you are maybe not even logged in';
}
?>