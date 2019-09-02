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

$sql = new SQL();
$sql->init();

$user = new User();

$options = $sql->fetch_row('bb_options', 1);

include_once 'themes/'.($sql->fetch_row('bb_themes', $options['theme_id'])['name']).'/theme.php';

$page_id = '';
if(isset($_GET['page'])) {
    $page_id = $_GET['page'];
} else {
    $page_id = 1;
}

$page = array();
if(is_numeric($page_id)) {
    if($page_id == 1) {
        $page['title'] = $options['description'];
    } else {
        $page = $sql->fetch_row('bb_page', $page_id);

        if(empty($page['title'])) {
            $page['title'] = PRE_TITLE_ERROR;
            $page_id = 404;
        }
    }
} else {
    if($page_id == 'blog') {
        $page['title'] = PRE_TITLE_BLOG;
    } else if($page_id == 'contact') {
        $page['title'] = PRE_TITLE_CONTACT;
    } else if($page_id == 'login') {
        if($options['login'] == 1) {
            $page['title'] = PRE_TITLE_LOGIN;
        } else {
            $page['title'] = PRE_TITLE_ERROR;
            $page_id = 404;
        }
    } else if($page_id == 'register') {
        if($options['register'] == 1) {
            $page['title'] = PRE_TITLE_REGISTER;
        } else {
            $page['title'] = PRE_TITLE_ERROR;
            $page_id = 404;
        }
    } else {
        $page['title'] = PRE_TITLE_ERROR;
        $page_id = 404;
    }
}

$seo = $sql->fetch_row_by_param('bb_seo', 'page_id', $page_id);
?>
<!DOCTYPE html>
<?php
echo '<html lang="'.$options['html_lang'].'">'
?>
<head>
    <?php
    echo '<meta charset="'.$options['html_charset'].'">';
    echo '<title>'.$options['title'].' | '.$page['title'].'</title>';
    echo '<meta name="description" content="'.$seo['description'].'">'."\n";
    echo '<meta name="keywords" content="'.$seo['keywords'].'">'."\n";
    echo '<meta name="author" content="'.$user->username.'">'."\n";
    echo '<meta name="og:description" content="'.$seo['description'].'">'."\n";
    echo '<meta name="og:keywords" content="'.$seo['keywords'].'">'."\n";
    echo '<meta name="og:author" content="'.$user->username.'">'."\n";
    Theme_HTMLHead();
    ?>
</head>
<body>
    <?php
    Theme_Header();

    if($page_id == 'blog') {
        if(!isset($_GET['post'])) {
            Theme_Blog();
        } else {
            $row = $sql->fetch_row('bb_post', $_GET['post']);
            $sql->update('bb_post', $_GET['post'], 'views', ($row['views'] + 1));
            Theme_Post($row);
        }
    } else if($page_id == 'contact') {
        Theme_Contact();
    } else if($page_id == 'login') {
        Theme_Login();
    } else if($page_id == 'register') {
        Theme_Register();
    } else if($page_id == 404) {
        Theme_Error();
    } else {
        $row = $sql->fetch_row('bb_page', $page_id);
        $sql->update('bb_page', $page_id, 'views', ($row['views'] + 1));
        $block_ids = $sql->fetch_ids_by_param_ordered('bb_block', 'page_id', $page_id, 'pos');
        $block = '';

        for($i = 0; $i < count($block_ids); $i++) {
            $block = new Block();
            $block->init($block_ids[$i]);
            $block->show_block();
        }
    }

    Theme_Footer();
    ?>
</body>
</html>

