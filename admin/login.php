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

$user = new User();

?>
<!DOCTYPE html>
<html>
<head>
    <title>BeardBlog | Log In</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet">
    <script src="https://kit.fontawesome.com/565bcf65de.js"></script>
    <link type="text/css" rel="stylesheet" href="../api/style/style.css">
</head>
<body class="bg-special">
    <div class="full-page">
        <div class="login-container">
            <div class="box-centered">
                <div class="text-align-center">
                    <h1><span class="text-orange">Beard</span>Blog</h1>
                    <p>Block based pagebuilding CMS with integrated Blog &amp; much more...</p>
                </div>
                <br/>
                <?php
                if(isset($_GET['submit'])) {
                    if(!empty($_POST['email']) && !empty($_POST['password'])) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $ret = $user->log_in($email, $password);
                        if($ret == 0) {
                            if($user->type != 0) {
                                echo '<meta http-equiv="refresh" content="0; URL=dashboard.php?mode='.$user->type.'">';
                            } else {
                                echo '<p class="text-warning"><strong>Access denied!</strong></p>';    
                            }
                        } else if($ret == -1) {
                            echo '<p class="text-warning"><strong>You are already logged in!</strong></p>';
                        } else if($ret == -2) {
                            echo '<p class="text-warning"><strong>Wrong E-Mail!</strong></p>';
                        } else if($ret == -3) {
                            echo '<p class="text-warning"><strong>Wrong E-Mail and Password combination!</strong></p>';
                        }
                    } else {
                        echo '<p class="text-warning"><strong>Please fill out the entire form!</strong></p>';
                    }
                }
                ?>
                <form action="?submit=true" method="POST" id="data">
                    <p>E-Mail: <input type="email" name="email" /></p>
                    <p>Password: <input type="password" name="password" /></p>
                </form>
                <div class="text-align-center">
                    <p class="pt-5 pb-2"><a href="#" onclick="document.getElementById('data').submit();" class="btn shadow-sm">Login <i class="fas fa-chevron-right"></i></a></p>
                </div>
                <div class="pt-3 text-align-center">
                    <p>Coded with <i class="fas fa-heart"></i> by Robin Krause.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>