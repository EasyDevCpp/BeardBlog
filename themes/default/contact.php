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

    $MACROPAGES_TITLE["contact"]="Contact";
    $MACROPAGES_DESCRIPTION["contact"]="Contact page.";
    $MACROPAGES_KEYWORDS["contact"]="Contact";

    function BBThemeContact() {
        if(isset($_GET["submit"])) {
            if(isset($_POST["email"])&&isset($_POST["message"])) {
                $row=SQLGetUserRow(1);
                $subject="Support [";
                if(isset($_POST["subject"])) {
                    $subject.=$_POST["subject"];
                }
                mail($row["email"],$subject."]",nl2br($_POST["message"]));
            }
        }
    ?>
    <section class="fdb-block pb-0" style="background-image: url(./themes/default/imgs/bg_3.svg)">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-7">
                    <h1>Contact Us</h1>
                </div>
            </div>
            <div class="row-50"></div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-7">
                    <?php echo "<form action=\"?site=".$_GET["site"]."&page=contact&submit=true\" method=\"POST\">"; ?>
                        <div class="row">
                            <div class="col">
                                <label>Your Email Address</label>
                                <input class="form-control" name="email" type="email" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label>Subject (optional but helpful)</label>
                                <input class="form-control" name="subject" type="text">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label>How can we help?</label>
                                <textarea class="form-control" name="message" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-round"><i class="fa fa-send"></i> Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row-100"></div>
        </div>
    </section>
    <?php
    }
?>