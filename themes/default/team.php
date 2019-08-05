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

        
        Team Blocks 1-8
        If you leave one empty make sure to return false!

        Included: 1 Team block

        Parameters should always be: String[imgs],String[texts],String[headings],String[links],Boolean[show=true]
    */

    function Team1($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block team-2">
            <div class="container">
                <div class="row text-center justify-content-center">
                    <div class="col-8">
                        <?php echo "<h1>".$headings[0]."</h1>"; ?>
                    </div>
                </div>
                <div class="row-50"></div>
                <div class="row text-center justify-content-center">
                    <div class="col-sm-3 m-sm-auto">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">";
                        echo "<h2>".$headings[1]."</h2>";
                        echo "<p>".$texts[0]."</p>"; ?>
                    </div>
                    <div class="col-sm-3 m-sm-auto">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[1]."\">";
                        echo "<h2>".$headings[2]."</h2>";
                        echo "<p>".$texts[1]."</p>"; ?>
                    </div>
                    <div class="col-sm-3 m-sm-auto">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[2]."\">";
                        echo "<h2>".$headings[3]."</h2>";
                        echo "<p>".$texts[2]."</p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>3,1=>3,2=>4,3=>0];
        return $params;
    }

    function Team2($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Team3($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Team4($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Team5($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Team6($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Team7($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Team8($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }
?>