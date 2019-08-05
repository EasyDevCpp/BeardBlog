<?php
    /*
		Bambou - Block based pagebuilding CMS
	    Copyright (C) 2018  Robin Krause
	
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

    $MACROPAGES_TITLE["register"]="Registration";
    $MACROPAGES_DESCRIPTION["register"]="Registration page.";
    $MACROPAGES_KEYWORDS["register"]="Registration";

    function BBThemeRegister() {
    ?>
    <section class="fdb-block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Register</h1>
                            <p class="text-h3">Fill out the form to register yourself!</p>
                        </div>
                    </div>
                    <?php echo "<form action=\"?site=".$_GET["site"]."&page=register&submit=true\" method=\"POST\">"; ?>
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <label>Username:</label>
                                <input class="form-control" name="username" placeholder="Username" type="text" required>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <label>E-Mail:</label>
                                <input class="form-control" name="email" placeholder="E-Mail" type="email" required>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <label>Password:</label>
                                <input class="form-control" name="password" placeholder="Password" type="password" required>
                            </div>
                            <div class="col">
                                <label>Confirm Password:</label>
                                <input class="form-control" name="confirm_password" placeholder="Confirm Password" type="password" required>
                            </div>
                        </div>
                        <div class="row justify-content-start mt-4">
                            <div class="col">
                                <button class="btn btn-round mt-4" type="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
?>