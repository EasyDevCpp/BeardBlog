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

    function BBThemeFooter($iID,$bShow=true) {
        $texts=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,2)["blockid"])["texts"]);
        if($bShow==true) {
    ?>
        <footer class="fdb-block footer-small bg-dark">
            <div class="container">
                <div class="row text-center align-items-center">
                    <div class="col">
                        <ul class="nav justify-content-center">
                            <?php
                            $counter=0;
                            while($aElem=HTMLGetMenuElement($iID,$counter)) {
                                echo "<li class=\"nav-item\">";
                                echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
                                echo "</li>";
                                $counter++;
                            }
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"\"> | </a></li>";
                            $counter=0;
                            while($aElem=HTMLGetSocialElement($iID,$counter)) {
                                echo "<li class=\"nav-item\">";
                                echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
                                echo "</li>";
                                $counter++;
                            }
                            ?>
                        </ul>
                        <?php 
                        if($texts[0]!="") {
                            echo "<p class=\"text-h5 mt-5\">$texts[0]</p>";
                        } else {
                            echo "<p class=\"text-h4 mt-5\">Proudly powered by BeardBlock.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </footer>
    <?php
        }
        $params=[
            0 => 0,
            1 => 1,
            2 => 0,
            3 => 0];
        return $params;
    } 
?>