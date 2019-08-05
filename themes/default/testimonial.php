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

        
        Testmonial Blocks 1-10
        If you leave one empty make sure to return false!

        Included: 1 Testimonial block

        Parameters should always be: String[imgs],String[texts],String[headings],String[links],Boolean[show=true]
    */

    function Testimonial1($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row text-center justify-content-center">
                    <div class="col-lg-8">
                        <?php echo "<h2>".$headings[0]."</h2>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>"; ?>
                        <div class="mt-5 justify-content-center">
                            <?php echo "<img alt=\"image\" class=\"ml-3 mr-3 mb-2 mt-2\" src=\"".$imgs[0]."\" height=\"30\">";
                            echo "<img alt=\"image\" class=\"ml-3 mr-3 mb-2 mt-2\" src=\"".$imgs[1]."\" height=\"30\">";
                            echo "<img alt=\"image\" class=\"ml-3 mr-3 mb-2 mt-2\" src=\"".$imgs[2]."\" height=\"30\">";
                            echo "<img alt=\"image\" class=\"ml-3 mr-3 mb-2 mt-2\" src=\"".$imgs[3]."\" height=\"30\">";
                            echo "<img alt=\"image\" class=\"ml-3 mr-3 mb-2 mt-2\" src=\"".$imgs[4]."\" height=\"30\">";
                            echo "<img alt=\"image\" class=\"ml-3 mr-3 mb-2 mt-2\" src=\"".$imgs[5]."\" height=\"30\">"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>6,1=>1,2=>1,3=>0];
        return $params;
    }

    function Testimonial2($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial3($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial4($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial5($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial6($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial7($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial8($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial9($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Testimonial10($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }
?>