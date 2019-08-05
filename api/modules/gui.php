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

/* Menu */
class Menu {
    private $names;
    private $links;
    private $style; // 0 = Dash Menu; 1 = Other Menu; 2 = Pages
    private $id;

    public $entry;

    public $DIFF_URL = false;

    function __construct($id = 0, $style = 0, $default_value = 0) {
        if($style == 0 || $style == 1 || $style == 2) {
            $this->style = $style; // Dash Menu
        } else {
            $this->style = 0;
        }
        $this->names = array();
        $this->links = array();
        $this->id = $id;

        if(!isset($_SESSION["menu_$id"])) {
            $_SESSION["menu_$id"] = $default_value;
            $this->entry = $default_value;
        } else {
            $this->entry = $_SESSION["menu_$id"];
        }
    }

    function add_entry($name, $link = "auto") {
        $this->names[] = $name;
        $this->links[] = $link;
    }

    function get_entry() {
        if(!$this->DIFF_URL) {
            if(isset($_GET['menu']) && $_GET['menu'] == $this->id) {
                if(isset($_GET['entry'])) {
                    $_SESSION['menu_'.$this->id] = $_GET['entry'];
                    $this->entry = $_GET['entry'];
                }
            }
        } else {
            if(isset($_GET['menu_'.$this->id])) {
                $_SESSION['menu_'.$this->id] = $_GET['menu_'.$this->id];
                $this->entry = $_GET['entry'];
            }
        }

        return $_SESSION['menu_'.$this->id];
    }

    function get_entry_name() {
        return $this->names[$this->get_entry()];
    }

    function set_entry($entry) {
        $_SESSION['menu_'.$this->id] = $entry;
        $this->entry = $entry;
    }

    function draw($additional = '') {
        $this->get_entry();

        echo '<ul class="dash-ul-'.$this->style.' '.$additional.'">';
        for($i = 0; $i < count($this->names); $i++) {
            if($this->links[$i] == "auto") {
                if(!$this->DIFF_URL) {
                    if($i == $_SESSION['menu_'.$this->id]) {
                        echo '<li><a href="'.HTML_ReplaceLinkPart('&menu=').'&menu='.$this->id.'&entry='.$i.'" class="dash-menu-'.$this->style.'-active">'.$this->names[$i].'</a></li>';
                    } else {
                        echo '<li><a href="'.HTML_ReplaceLinkPart('&menu=').'&menu='.$this->id.'&entry='.$i.'" class="dash-menu-'.$this->style.'">'.$this->names[$i].'</a></li>';
                    }
                } else {
                    if($i == $_SESSION['menu_'.$this->id]) {
                        echo '<li><a href="'.HTML_ReplaceLinkPart('&menu_'.$this->id.'=').'&menu_'.$this->id.'='.$i.'" class="dash-menu-'.$this->style.'-active">'.$this->names[$i].'</a></li>';
                    } else {
                        echo '<li><a href="'.HTML_ReplaceLinkPart('&menu_'.$this->id.'=').'&menu_'.$this->id.'='.$i.'" class="dash-menu-'.$this->style.'">'.$this->names[$i].'</a></li>';
                    }
                }
            } else {
                echo '<li><a href="'.$this->links[$i].'" class="dash-menu-'.$this->style.'">'.$this->names[$i].'</a></li>';
            }
        }
        echo '</ul>';
    }
}

/* List */
class UList {
    private $html_content;

    function __construct() {
        $this->html_content = array();
    }

    function add_entry($html_content) {
        $this->html_content[] = $html_content;
    }

    function draw($additional = '') {
        echo '<ul class="dash-list-ul shadow '.$additional.'">';
        for($i = 0; $i < count($this->html_content); $i++) {
            if($i + 1 < count($this->html_content)) {
                echo '<li class="dash-list-item dash-list-seperator">'.$this->html_content[$i].'</li>';
            } else {
                echo '<li class="dash-list-item">'.$this->html_content[$i].'</li>';
            }
        }
        echo '</ul>';
    }
}

/* ChooseButton */
class ChooseButton {
    private $id;
    private $pick_from;
    public $pick_id;

    function __construct($id = '', $pick_from = '') {
        if(!isset($_GET['choose_id'])) {
            $this->id = $id;
        } else {
            $this->id = $_GET['choose_id'];
        }
        $this->pick_from = HTML_ReplaceLinkPart('&menu=').$pick_from.'&action=pick&choose_id='.$id;

        if(isset($_SESSION[$this->id.'-pick'])) {
            $this->pick_id = $_SESSION[$this->id.'-pick'];
        } else {
            $this->pick_id = -1;
        }
    }
    
    function draw_choose_button($text_1, $text_2, $additional = '') {
        if(!isset($_SESSION[$this->id.'-url'])) {
            $_SESSION[$this->id.'-url'] = HTML_GetCurrentLink();
        }
        if($this->pick_id == -1) {
            echo '<a href="'.$this->pick_from.'" class="btn shadow '.$additional.'">'.$text_1.'</a>';
        } else {
            echo '<a href="'.$this->pick_from.'" class="btn btn-active shadow '.$additional.'">'.$text_2.'</a>';
        }
    }

    function draw_custom_choose_button($text, $css_classes = '') {
        if(!isset($_SESSION[$this->id.'-url'])) {
            $_SESSION[$this->id.'-url'] = HTML_GetCurrentLink();
        }
        echo '<a href="'.$this->pick_from.'" class="'.$css_classes.'">'.$text.'</a>';
    }

    function get_pick_button($id) {
        if(isset($_GET['picked'])) {
            $_SESSION[$this->id.'-pick'] = $_GET['picked'];
            echo '<meta http-equiv="refresh" content="0; URL='.$_SESSION[$this->id.'-url'].'">';
        }
        if($id == $this->pick_id) {
            return '<a href="'.HTML_ReplaceLinkPart('&picked=').'&picked='.$id.'" class="btn btn-active btn-sm">picked</a>';
        } else {
            return '<a href="'.HTML_ReplaceLinkPart('&picked=').'&picked='.$id.'" class="btn btn-sm">pick</a>';
        }
    }

    function reset() {
        unset($_SESSION[$this->id.'-pick']);
        unset($_SESSION[$this->id.'-url']);
    }

    function set_default_pick($id) {
        if(!isset($_SESSION[$this->id.'-pick'])) {
            $this->pick_id = $id;
            $_SESSION[$this->id.'-pick'] = $id;
        } 
    }
}

/* Text */
function draw_text($text, $size = 3, $additional = '') {
    echo '<p class="dash-text-h'.$size.' '.$additional.'">'.$text.'</p>';
}

/* Button */
function draw_button($text, $link, $additional = '', $new_tab = false) {
    if(!$new_tab) {
        echo '<a href="'.$link.'" class="btn '.$additional.'">'.$text.'</a>';
    } else {
        echo '<a href="'.$link.'" class="btn '.$additional.'" target="_blank">'.$text.'</a>';
    }
}

/* Div, Row, Cols */
function div($additional = '') {
    echo '<div class="'.$additional.'">';
}

function div_row($additional = '') {
    echo '<div class="row '.$additional.'">';
}

function div_col($size = 'auto', $additional = '') {
    echo '<div class="col-'.$size.' '.$additional.'">';
}

function div_end() {
    echo '</div>';
}

function get_img($img_id) {
    global $sql;
    return $sql->fetch_row('bb_media', $img_id)['path'];
}

/* WYSIWYG Editor */
/*
    * Those TODOs apply for the next version *
    TODO:   Insert image. Preferring media selection, instead of prompt. Prepare for a lot of code because the paths need to be matched(dashboard isn't placed in the root dir)
    TODO:   Horizontal ruler. Simple.
    TODO:   Blockquotes. Simple.
    TODO:   styleWithCss. Propably gonna use prompt so should be simple.
*/
function wysiwyg_editor($value, $btn_text, $post_name = '', $post_params = '', $additional = '', $designer = false, $link_id = '') {
    //$img_button = new ChooseButton('wysiwyg-image', '&menu=dash-menu&entry=4');
    ?>
    <!--
    <script>
        var img_path = <?php //echo get_img($img_button->pick_id); ?>;
    </script>
    -->
    <?php
    div($additional);
        div('pt-2 pb-5');
            div('pt-3 pl-5 pb-3 pr-5 dash-box shadow');
                echo '<button class="wysiwyg-button" data-attribute="formatBlock-p">p</button>';
                echo '<button class="wysiwyg-button" data-attribute="heading-1">h1</button>';
                echo '<button class="wysiwyg-button" data-attribute="heading-2">h2</button>';
                echo '<button class="wysiwyg-button" data-attribute="heading-3">h3</button>';
                echo '<button class="wysiwyg-button" data-attribute="bold"><i class="fas fa-bold"></i></button>';
                echo '<button class="wysiwyg-button" data-attribute="italic"><i class="fas fa-italic"></i></button>';
                echo '<button class="wysiwyg-button" data-attribute="underline"><i class="fas fa-underline"></i></button>';
                echo '<button class="wysiwyg-button" data-attribute="justifyleft"><i class="fas fa-align-left"></i></button>';
                echo '<button class="wysiwyg-button" data-attribute="justifycenter"><i class="fas fa-align-center"></i></button>';
                echo '<button class="wysiwyg-button" data-attribute="justifyfull"><i class="fas fa-align-justify"></i></button>';
                echo '<button class="wysiwyg-button" data-attribute="justifyright"><i class="fas fa-align-right"></i></button>';
                echo '<button class="wysiwyg-button" data-attribute="createLink"><i class="fas fa-link"></i></button>';
                /*$img_button->draw_custom_choose_button('pick', 'wysiwyg-button-nm');
                echo '<button class="wysiwyg-button" data-attribute="insertImage"><i class="fas fa-image"></i></button>';
                */
            div_end();
            echo '<div class="wysiwyg-canvas dash-box shadow mt-3" id="wysiwyg-canvas" contenteditable>';
                echo $value;
            echo '</div>';
        div_end();
    div_end();
    $params = '';
    if($post_params != '') {
        $params = '{'.$post_name.': \'\'+document.getElementById(\'wysiwyg-canvas\').innerHTML+\'\', '.$post_params.'}';
    } else {
        $params = '{'.$post_name.': \'\'+document.getElementById(\'wysiwyg-canvas\').innerHTML+\'\'}';
    }
    if(!$designer) {
        echo '<p class="pt-3 pb-2"><a href="#" onclick="wysiwyg_post(\''.HTML_ReplaceLinkPart('&submit=').'&submit=true\', '.$params.');" class="btn btn-big btn-blue shadow-sm">'.$btn_text.'</a></p>';
    } else {
        echo '<p class="pt-3 pb-2"><a href="#'.$link_id.'" onclick="wysiwyg_post(\''.HTML_ReplaceLinkPart('&submit=').'&submit=true#'.$link_id.'\', '.$params.');" class="designer-btn">'.$btn_text.'</a></p>';
    }
}

?>