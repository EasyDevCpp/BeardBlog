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

    function BBThemeHeader($iID,$bShow=true) {
        $imgs=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,1)["blockid"])["imgs"]);
        $links=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,1)["blockid"])["links"]);
        if($bShow==true) {
    ?>
        <header class="bg-dark" id="navigator">
            <div class="container">
                <nav class="navbar navbar-expand-md no-gutters">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav10" aria-controls="navbarNav10" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="col-4 col-sm-2 text-center order-lg-6">
                        <?php
                        if($links[0]!="") {
                            echo "<a href=\"".$links[0]."\">";
                        } else {
                            echo "<a href=\"?site=".$iID."\">";
                        }
                        if($imgs[0]!="") {
                            echo "<img src=\"".$imgs[0]."\" alt=\"image\" height=\"30\">";
                        } else {
                            echo "<img src=\"\" alt=\"image\" height=\"30\">";
                        }
                        ?>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse col-12 col-md-5 order-lg-1" id="navbarNav10">
                        <ul class="navbar-nav col-5">
                            <?php
                            $counter=0;
                            while($aElem=HTMLGetMenuElement($iID,$counter)) {
                                echo "<li class=\"nav-item\">";
                                echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
                                echo "</li>";
                                $counter++;
                            }
                            ?>
                        </ul>
                    </div>
                    <ul class="navbar-nav justify-content-end col-sm-5 order-lg-12 d-none d-md-flex">
                        <?php
                        $counter=0;
                        while($aElem=HTMLGetSocialElement($iID,$counter)) {
                            echo "<li class=\"nav-item\">";
                            echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
                            echo "</li>";
                            $counter++;
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>
    <?php
        }
        $params=[
            0 => 1,
            1 => 0,
            2 => 0,
            3 => 1];
        return $params;
    } 
?>