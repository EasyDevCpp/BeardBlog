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

    function BBThemeError() {
    ?>
    <section class="fdb-block" style="background-image: url(./themes/default/imgs/alt_wide_2.svg);">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 text-left">
                    <h1>Error 404</h1>
                    <p class="text-h3">
                        Sorry we couldn't find what you are searching for...
                    </p>
                    <p class="mt-4">
                        <?php echo "<a class=\"btn btn-round\" href=\"?site=".$_GET["site"]."\"><i class=\"fa fa-home\"></i> Back to Home</a>"; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
?>