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

include_once __DIR__."/../api/bb-api.php";

$sql = new SQL();
$sql->init();

$user = new User();

include_once "screens/home.php";
include_once "screens/users.php";
include_once "screens/pages.php";
include_once "screens/posts.php";
include_once "screens/media.php";
include_once "screens/menus.php";
include_once "screens/plugins.php";
include_once "screens/themes.php";
include_once "screens/options.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>BeardBlog | Dashboard</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet">
    <script src="https://kit.fontawesome.com/565bcf65de.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script> -->
    <link type="text/css" rel="stylesheet" href="../api/style/style.css">
</head>
<body>
    <?php
    if(isset($_GET['mode'])) {
        if(isset($_GET['log_out'])) {
            $user->log_out();
        }
        if($user->is_logged_in && $user->type == $_GET['mode']) {
            /* TOP MENU */
            $dash_menu = new Menu('dash-menu');
            $dash_menu->add_entry('<span class="text-orange">Beard</span>Blog');
            if($_GET['mode'] == 2) $dash_menu->add_entry('Users');
            $dash_menu->add_entry('Pages');
            $dash_menu->add_entry('Posts');
            $dash_menu->add_entry('Media');
            $dash_menu->add_entry('Menus');
            if($_GET['mode'] == 2) $dash_menu->add_entry('Plugins');
            if($_GET['mode'] == 2) $dash_menu->add_entry('Themes');
            if($_GET['mode'] == 2) $dash_menu->add_entry('Options');
            //$dash_menu->add_entry('Help', 'https://rkr-software.com'); Once rkr-software.com is finished
            $dash_menu->add_entry('Log Out', HTML_ReplaceLinkPart('&log_out=').'&log_out=true');

            /* DRAW */
            $dash_menu->draw('shadow');

            /* ENTRIES */
            if($dash_menu->get_entry() == 0) { //Home
                HomeScreen();
            } else if($dash_menu->get_entry_name() == 'Users') {
                UsersScreen();
            } else if($dash_menu->get_entry_name() == 'Pages') {
                PagesScreen();
            } else if($dash_menu->get_entry_name() == 'Posts') {
                PostsScreen();
            } else if($dash_menu->get_entry_name() == 'Media') {
                MediaScreen();
            } else if($dash_menu->get_entry_name() == 'Menus') {
                MenuScreen();
            } else if($dash_menu->get_entry_name() == 'Plugins') {
                PluginsScreen();
            } else if($dash_menu->get_entry_name() == 'Themes') {
                ThemesScreen();
            } else if($dash_menu->get_entry_name() == 'Options') {
                OptionsScreen();
            } else {
                //Unknown
            }
        } else {
            echo '<meta http-equiv="refresh" content="0; URL=login.php">';
        }
        $sql->quit();
    }
    if(!$user->is_logged_in) {
        echo '<meta http-equiv="refresh" content="0; URL=login.php">';
    }
    ?>
    <footer>
        <div class="p-5 text-align-center">
            <h3>Coded with <i class="fas fa-heart"></i> by Robin Krause.</h3>
        </div>
    </footer>

    <script src="../api/modules/wysiwyg.js"></script>
</body>
</html>