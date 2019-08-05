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

        
        Content Blocks 1-33
        If you leave one empty make sure to return false!

        Included: 4 different content blocks

        Parameters should always be: String[imgs],String[texts],String[headings],String[links],Boolean[show=true]
    */

    function Content1($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<h2>".$headings[1]."</h2>";
                        echo "<p class=\"text-h3\"><a href=\"".$links[0]."\">".$texts[0]."</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".$links[1]."\">".$texts[1]."</a></p>";
                        echo "<img alt=\"image\" class=\"img-fluid mt-5\" src=\"".$imgs[0]."\">"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>1,1=>2,2=>2,3=>2];
        return $params;
    }

    function Content2($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 mb-4 mb-md-0">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">"; ?>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5 ml-md-auto text-left">
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>";
                        echo "<p><a class=\"btn btn-round mt-4\" href=\"".$links[0]."\">".$texts[1]."</a></p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>1,1=>2,2=>1,3=>1];
        return $params;
    }

    function Content3($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <?php echo "<section class=\"fdb-block fdb-image-bg\" style=\"background: url(".$imgs[0].")\">"; ?>
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <?php echo "<h1>".$headings[0]."</h1>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        $params=[0=>1,1=>0,2=>1,3=>0];
        return $params;
    }

    function Content4($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12 col-lg-8 text-center">
                                <?php echo "<h1>".$headings[0]."</h1>"; ?>
                            </div>
                        </div>
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>1,1=>0,2=>1,3=>0];
        return $params;
    }

    function Content5($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content6($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content7($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content8($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content9($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content10($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content11($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content12($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content13($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content14($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content15($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content16($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content17($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content18($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content19($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content20($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content21($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content22($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content23($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content24($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content25($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content26($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content27($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content28($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content29($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content30($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content31($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content32($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Content33($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }
?>