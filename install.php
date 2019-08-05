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

if($sql->db_conn != false) {
    $row_inst = $sql->fetch_row('bb_installed', 1);
    if($row_inst['installed'] == true && !isset($_GET['mode'])) {
        echo '<meta http-equiv="refresh" content="0; URL=install.php?mode=update">';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    if(!isset($_GET['mode']) || $_GET['mode'] == 'install') {
        echo '<title>BeardBlog | Installation</title>';
    } else {
        echo '<title>BeardBlog | Update</title>';
    }
    ?>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet">
    <script src="https://kit.fontawesome.com/565bcf65de.js"></script>
    <link type="text/css" rel="stylesheet" href="./api/style/style.css">
</head>
<body class="bg-special">
    <div class="full-page">
        <div class="login-container">
            <div class="box-centered">
                <div class="text-align-center">
                    <?php
                    if(!isset($_GET['mode']) || $_GET['mode'] == 'install') {
                        echo '<h1><span class="text-orange">Beard</span>Blog | <span class="text-gray">Installation</span></h1>';
                    } else {
                        echo '<h1><span class="text-orange">Beard</span>Blog | <span class="text-gray">Update</span></h1>';
                    }
                    ?>
                    <p>Block based pagebuilding CMS with integrated Blog &amp; much more...</p>
                </div>
                <?php
                if((!isset($_GET['mode']) && !isset($_GET['step'])) || (isset($_GET['mode']) && $_GET['mode'] == 'install')) {
                    $step = 1;
                    if(isset($_GET['step'])) {
                        $step = $_GET['step'];
                    }

                    echo '<h1>'.$step.'/6 Steps</h1>';
                    echo '<hr/>';

                    if($step == 1) {
                        if(isset($_GET['submit'])) {
                            if(!empty($_POST['db_location']) && !empty($_POST['db_name']) && !empty($_POST['db_user'])) {
                                $db_location = $_POST['db_location'];
                                $db_name = $_POST['db_name'];
                                $db_user = $_POST['db_user'];
                                $db_password = $_POST['db_password'];

                                $config_file = fopen('./api/modules/config.php', 'w');
                                $config_content = '';

                                $config_content .= "<?php\n";
                                $config_content .= "\tdefine('BB_DB_LOCATION', '".$db_location."');\n";
                                $config_content .= "\tdefine('BB_DB_NAME', '".$db_name."');\n";
                                $config_content .= "\tdefine('BB_DB_USER', '".$db_user."');\n";
                                $config_content .= "\tdefine('BB_DB_PW', '".$db_password."');\n";
                                $config_content .= "?>";

                                if(!fwrite($config_file, $config_content)) {
                                    echo '<p class="text-warning"><strong>Unable to write config-file!</strong></p>';    
                                } else {
                                    SQL_CreateDatabase($db_location, $db_user, $db_password, $db_name);

                                    // ...And add all the tables...
                                    $sql = new SQL();
                                    $sql->init_ex($db_location, $db_user, $db_password, $db_name);
                                    $sql->create_table('bb_user', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'username VARCHAR(60) NOT NULL,'.
                                                                'password VARCHAR(255) DEFAULT NULL,'.
                                                                'email VARCHAR(255) DEFAULT NULL,'.
                                                                'type INT DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');
                                    
                                    $sql->create_table('bb_plugins', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'name VARCHAR(255) NOT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_themes', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'name VARCHAR(255) NOT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_menu', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'page_id VARCHAR(12) DEFAULT NULL,'.
                                                                'post_id INT DEFAULT NULL,'.
                                                                'name VARCHAR(60) DEFAULT NULL,'.
                                                                'link VARCHAR(255) DEFAULT NULL,'.
                                                                'show_always INT NOT NULL,'.
                                                                'pos INT NOT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_social', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'icon VARCHAR(255) NOT NULL,'.
                                                                'link VARCHAR(255) DEFAULT NULL,'.
                                                                'pos INT NOT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_post', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'title VARCHAR(80) NOT NULL,'.
                                                                'content TEXT DEFAULT NULL,'.
                                                                'date DATE DEFAULT NULL,'.
                                                                'media_id INT NOT NULL,'.
                                                                'user_id INT NOT NULL,'.
                                                                'views INT DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');
                                                                
                                    $sql->create_table('bb_media', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'path VARCHAR(255) DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_seo', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'page_id VARCHAR(12) NOT NULL,'.
                                                                'description TEXT DEFAULT NULL,'.
                                                                'keywords VARCHAR(255) DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_installed', 'id INT NOT NULL,'.
                                                                'installed INT DEFAULT NULL,'.
                                                                'version VARCHAR(10) DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');
                                    
                                    $sql->create_table('bb_linked', 'id INT NOT NULL,'.
                                                                'linked INT DEFAULT NULL,'.
                                                                'db_name VARCHAR(255) DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_page', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'title VARCHAR(255) DEFAULT NULL,'.
                                                                'views INT DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_block', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'page_id INT NOT NULL,'.
                                                                'type VARCHAR(25) DEFAULT NULL,'.
                                                                'pos INT NOT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_attr', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'block_id INT NOT NULL,'.
                                                                'type VARCHAR(12) NOT NULL,'.
                                                                'value TEXT DEFAULT NULL,'.
                                                                'value2 VARCHAR(255) DEFAULT NULL,'.
                                                                'name VARCHAR(50) NOT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_call', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'block_id INT NOT NULL,'.
                                                                'plugin_id INT NOT NULL,'.
                                                                'params TEXT DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_options', 'id INT NOT NULL,'.
                                                                'title VARCHAR(255) DEFAULT NULL,'.
                                                                'description VARCHAR(255) DEFAULT NULL,'.
                                                                'favicon VARCHAR(255) DEFAULT NULL,'.
                                                                'html_lang VARCHAR(5) DEFAULT NULL,'.
                                                                'html_charset VARCHAR(25) DEFAULT NULL,'.
                                                                'contact_mail VARCHAR(255) DEFAULT NULL,'.
                                                                'login INT DEFAULT NULL,'.
                                                                'register INT DEFAULT NULL,'.
                                                                'comments INT DEFAULT NULL,'.
                                                                'comments_by_nonusers INT DEFAULT NULL,'.
                                                                'theme_id INT DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->create_table('bb_comments', 'id INT NOT NULL AUTO_INCREMENT,'.
                                                                'post_id INT NOT NULL,'.
                                                                'comment_id INT NOT NULL,'.
                                                                'user_id INT NOT NULL,'.
                                                                'content TEXT DEFAULT NULL,'.
                                                                'date DATE DEFAULT NULL,'.
                                                                'PRIMARY KEY (id)');

                                    $sql->quit();

                                    echo '<meta http-equiv="refresh" content="0; URL=install.php?mode=install&step='.($step + 1).'">';
                                }
                                fclose($config_file);
                            } else {
                                echo '<p class="text-warning"><strong>Please fill out the entire form!</strong></p>';
                            }
                        }
                    ?>
                        <p><strong>Let's create our config.</strong></p>
                        <?php echo '<form action="?mode=install&step='.$step.'&submit=true" method="POST" id="data">'; ?>
                            <p>Db Location: <input type="text" name="db_location" value="localhost"></p>
                            <p>Db Name: <input type="text" name="db_name"></p>
                            <br/>
                            <p>Db User: <input type="text" name="db_user" value="root"></p>
                            <p>Db Password: <input type="password" name="db_password"></p>
                        </form>
                    <?php
                    } else if($step == 2) {
                        if(isset($_GET["submit"])) {
                            if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["db_name"])) {
                                $email = $_POST["email"];
                                $password = $_POST["password"];
                                $db_name = $_POST["db_name"];
                                
                                if($db_name != BB_DB_NAME) {
                                    $sql = new SQL();
                                    $sql->init_ex(BB_DB_LOCATION, BB_DB_USER, BB_DB_PW, $db_name);
                                    $row = $sql->fetch_row_by_param('bb_user', 'email', $email);

                                    if(sizeof($row) > 0) {
                                        if(password_verify($password, $row["password"]) && $row["type"] == 2) {
                                            $sql->init();
                                            $sql->insert('bb_linked', 'id, linked, db_name', "1, 1, '$db_name'");
                                            $sql->quit();

                                            echo '<meta http-equiv="refresh" content="0; URL=install.php?mode=install&step=4">';
                                        } else {
                                            echo '<p class="text-warning"><strong>Wrong E-Mail & Password combination!</strong></p>';
                                        }
                                    }
                                } else {
                                    echo '<p class="text-warning"><strong>You can\'t link to your page itself! Are you kidding me?!</strong></p>';
                                }
                            } else {
                                echo '<p class="text-warning"><strong>Please fill out the entire form!</strong></p>';
                            }
                        }
                    ?>
                        <p><strong>Do you want to link this page to a former installed page?</strong></p>
                        <p class="text-align-center">The Username and Password from any Admin-Account from the page you want to link to.</p>
                        <?php echo '<form action="?mode=install&step='.$step.'&submit=true" method="POST" id="data">'; ?>
                            <p>E-Mail: <input type="email" name="email" /></p>
                            <p>Password: <input type="password" name="password" /></p>
                            <br/>
                            <p>Database Name: <input type="text" name="db_name" /></p>
                        </form>

                        <div class="row p-5">
                            <div class="col-50 text-align-center">
                                <a href="#" onclick="document.getElementById('data').submit();" class="btn btn-orange shadow-sm"><i class="fas fa-link"></i> Link</a>
                            </div>
                            <div class="col-50 text-align-center">
                                <?php echo '<a href="?mode=install&step='.($step + 1).'" class="btn shadow-sm">Skip <i class="fas fa-chevron-right"></i></a>'; ?>
                            </div>
                        </div>

                        <p>(Used to share the same User-Database across BeardBlog generated websites)</p>
                    <?php
                    } else if($step == 3) {
                        if(isset($_GET["submit"])) {
                            if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
                                $username = $_POST["username"];
                                $email = $_POST["email"];
                                $password = $_POST["password"];

                                $user = new User();
                                if($user->add_user($username, $email, $password, 2) == 0) {
                                    echo '<meta http-equiv="refresh" content="0; URL=install.php?mode=install&step='.($step + 1).'">';
                                } else {
                                    echo '<p class="text-warning"><strong>User already registered!</strong></p>';
                                }
                                $user->quit();
                            } else {
                                echo '<p class="text-warning"><strong>Please fill out the entire form!</strong></p>';
                            }
                        }
                    ?>
                        <p><strong>Create your Admin-Account.</strong></p>
                        <p class="text-align-center">Choose a good password and write it down!</p>
                        <?php echo '<form action="?mode=install&step='.$step.'&submit=true" method="POST" id="data">'; ?>
                            <p class="pt-2">Username: <input type="text" name="username" /></p>
                            <p>E-Mail: <input type="email" name="email" /></p>
                            <p>Password: <input type="password" name="password" /></p>
                        </form>
                    <?php
                    } else if($step == 4) {
                        if(isset($_GET["submit"])) {
                            if(!empty($_POST["title"]) && !empty($_POST["description"])) {
                                $title = $_POST["title"];
                                $description = $_POST["description"];

                                $sql = new SQL();
                                $sql->init();
                                $sql->insert('bb_options', 'id, title, description, theme_id', "1, '$title', '$description', 1");
                                $sql->insert('bb_page', 'id, title, views', "NULL, 'Home', 0");
                                $sql->insert('bb_seo', 'id, page_id', "NULL, 1");
                                $sql->insert('bb_themes', 'id, name', "NULL, 'default'");
                                $sql->insert('bb_menu', 'id, page_id, show_always, pos', "NULL, '1', 1, 1");
                                $sql->quit();

                                echo '<meta http-equiv="refresh" content="0; URL=install.php?mode=install&step='.($step + 1).'">';
                            }
                        }
                    ?>
                        <p><strong>Create your Homepage.</strong></p>
                        <?php echo '<form action="?mode=install&step='.$step.'&submit=true" method="POST" id="data">'; ?>
                            <p class="pt-2">Title: <input type="text" name="title" /></p>
                            <p>Description: <input type="text" name="description" /></p>
                        </form>
                    <?php
                    } else if($step == 5) {
                        if(!isset($_SESSION['login']) && !isset($_SESSION['register']) && !isset($_SESSION['comments']) && !isset($_SESSION['comments_by_nonusers'])) {
                            $_SESSION['login'] = 1;
                            $_SESSION['register'] = 1;
                            $_SESSION['comments'] = 0;
                            $_SESSION['comments_by_nonusers'] = 0;
                        }
                        if(isset($_GET['set']) && isset($_GET['value'])) {
                            $_SESSION[$_GET['set']] = $_GET['value'];
                        }
                        if(isset($_GET["submit"])) {
                            $sql = new SQL();
                            $sql->init();
                            $sql->update('bb_options', 1, 'login', $_SESSION['login']);
                            $sql->update('bb_options', 1, 'register', $_SESSION['register']);
                            $sql->update('bb_options', 1, 'comments', $_SESSION['comments']);
                            $sql->update('bb_options', 1, 'comments_by_nonusers', $_SESSION['comments_by_nonusers']);
                            $sql->quit();

                            echo '<meta http-equiv="refresh" content="0; URL=install.php?mode=install&step='.($step + 1).'">';
                        }
                    ?>
                        <p><strong>Set some options for your Homepage.</strong></p>
                        <p class="text-align-center">You can always change those settings!</p>
                        <div class="row pt-3 pb-2">
                            <div class="col-50">
                                <p>Login:</p>
                                <p>Register:</p>
                                <p>Comments:</p>
                                <p>Comments by non-users:</p>
                            </div>
                            <div class="col-50 text-align-center">
                                <?php
                                if(isset($_SESSION['login']) && $_SESSION['login'] == 1) {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=login&value=1" class="btn btn-sm btn-active shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=login&value=0" class="btn btn-sm shadow-sm">disabled</i></a></p>';
                                } else {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=login&value=1" class="btn btn-sm shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=login&value=0" class="btn btn-sm btn-active shadow-sm">disabled</i></a></p>';
                                }

                                if(isset($_SESSION['register']) && $_SESSION['register'] == 1) {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=register&value=1" class="btn btn-sm btn-active shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=register&value=0" class="btn btn-sm shadow-sm">disabled</i></a></p>';
                                } else {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=register&value=1" class="btn btn-sm shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=register&value=0" class="btn btn-sm btn-active shadow-sm">disabled</i></a></p>';
                                }

                                if(isset($_SESSION['comments']) && $_SESSION['comments'] == 1) {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments&value=1" class="btn btn-sm btn-active shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments&value=0" class="btn btn-sm shadow-sm">disabled</i></a></p>';
                                } else {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments&value=1" class="btn btn-sm shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments&value=0" class="btn btn-sm btn-active shadow-sm">disabled</i></a></p>';
                                }

                                if(isset($_SESSION['comments_by_nonusers']) && $_SESSION['comments_by_nonusers'] == 1) {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments_by_nonusers&value=1" class="btn btn-sm btn-active shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments_by_nonusers&value=0" class="btn btn-sm shadow-sm">disabled</i></a></p>';
                                } else {
                                    echo '<p><a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments_by_nonusers&value=1" class="btn btn-sm shadow-sm">enabled</a> <a href="'.HTML_ReplaceLinkPart('&set=').'&set=comments_by_nonusers&value=0" class="btn btn-sm btn-active shadow-sm">disabled</i></a></p>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        echo '<p class="pt-5 pb-2"><a href="?mode=install&step='.$step.'&submit=true" class="btn shadow-sm">Next <i class="fas fa-chevron-right"></i></a></p>';
                        ?>
                    <?php
                    } else if($step == 6) {
                        $sql = new SQL();
                        $sql->init();
                        $sql->insert('bb_installed', 'id, installed, version', "1, 1, '".BB_VER."'");
                        $sql->quit();
                    ?>
                        <h1><span class="text-orange">BAMM!</span> You are now ready to grow a audience!</h1>
                        <h3 class="text-align-center">(and a beard)</h3>
    
                        <div class="row pt-3 pb-2">
                            <div class="col-50 text-align-center">
                                <?php 
                                echo '<p class="pt-5 pb-2"><a href="'.HTML_ReplaceLinkPart('install.php').'admin/login.php" class="btn btn-orange shadow-sm">Login <i class="fas fa-chevron-right"></i></a></p>'; 
                                ?>
                            </div>
                            <div class="col-50 text-align-center">
                                <p class="pt-5 pb-2"><a href="tutorial.php" class="btn shadow-sm"><i class="fas fa-info-circle"></i> Tutorial</a></p>
                            </div>
                        </div>
                    <?php 
                    }
                    ?>
                <?php
                    if($step != 2 && $step != 5 && $step != 6) {
                        echo '<p class="pt-5 pb-2"><a href="#" onclick="document.getElementById(\'data\').submit();" class="btn shadow-sm">Next <i class="fas fa-chevron-right"></i></a></p>';
                    }
                }
                ?>
                
                <div class="pt-3 text-align-center">
                    <p>Coded with <i class="fas fa-heart"></i> by Robin Krause.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
