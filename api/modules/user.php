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

class User {
    private $sql;

    public $id;
    public $username;
    public $password;
    public $email;
    public $type;
    public $is_logged_in = false;

    function __construct() {
        $this->sql = new SQL();
        $this->sql->init();

        //If user is already logged in
        if(isset($_SESSION['u_data_1']) && isset($_SESSION['u_data_6'])) { 
            $this->email = $_SESSION['u_data_1'];
            $this->password = $_SESSION['u_data_6'];

            $row = $this->sql->fetch_row_by_param('bb_user', 'email', $this->email);

            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->type = $row['type'];
            $this->is_logged_in = true;
        }
    }
    function quit() {
        $this->sql->quit();
    }

    function add_user($username, $email, $password, $type) {
        $row_user = $this->sql->fetch_row_by_param('bb_user', 'username', $username);
        $row_email = $this->sql->fetch_row_by_param('bb_user', 'email', $email);

        if(!is_array($row_user) && !is_array($row_email)) {
            $this->sql->insert('bb_user', 'id, username, password, email, type', "NULL, '$username', '".password_hash($password, PASSWORD_DEFAULT)."', '$email', $type");
            return 0;
        }
        return -1; //User already exists
    }

    function set_user($id, $username, $email, $password, $type) {
        $this->sql->update('bb_user', $id, 'username', $username);
        $this->sql->update('bb_user', $id, 'email', $email);
        $this->sql->update('bb_user', $id, 'type', $type);
        if($password != "") {
            $this->sql->update('bb_user', $id, 'password', password_hash($password, PASSWORD_DEFAULT));
        }
        if($username == $this->username || $email == $this->email) {
            $this->username = $username;
            $this->email = $email;
            $this->type = $type;
            if($password != "") {
                $this->password = password_hash($password, PASSWORD_DEFAULT);
            }
            $_SESSION['u_data_1'] = $this->email;
            $_SESSION['u_data_6'] = $this->password;
        }
    }

    function log_in($email, $password) {
        if(!$this->is_logged_in) {
            $row = $this->sql->fetch_row_by_param('bb_user', 'email', $email);

            if(is_array($row)) { //Email exists
                if(password_verify($password, $row['password'])) { //Correct password
                    $this->email = $email;
                    $this->password = $password;
                    $this->username = $row['username'];
                    $this->type = $row['type'];
                    $this->is_logged_in = true;

                    $_SESSION['u_data_1'] = $email;
                    $_SESSION['u_data_6'] = $password;

                    return 0;
                } else {
                    return -3; //Wrong password
                }
            } else {
                return -2; //Unknown Email
            }
        }
        return -1; //Already logged in
    }

    function log_out() {
        $this->email = '';
        $this->password = '';
        $this->username = '';
        $this->type = '';
        $this->is_logged_in = false;

        unset($_SESSION['u_data_1']);
        unset($_SESSION['u_data_6']);
        session_destroy();
    }
}

?>