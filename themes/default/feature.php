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

        
        Feature Blocks 1-32
        If you leave one empty make sure to return false!

        Included: 4 different feature blocks

        Parameters should always be: String[imgs],String[texts],String[headings],String[links],Boolean[show=true]
    */

    function Feature1($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12 col-sm-6 col-md-3">
                        <?php echo "<img alt=\"image\" class=\"fdb-icon\" src=\"".$imgs[0]."\">";
                        echo "<h3><strong>".$headings[0]."</strong></h3>";
                        echo "<p class=\"mt-3\"><a class=\"btn btn-round\" href=\"".$links[0]."\">".$texts[0]."</a></p>"; ?>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 pt-5 pt-sm-0">
                        <?php echo "<img alt=\"image\" class=\"fdb-icon\" src=\"".$imgs[1]."\">";
                        echo "<h3><strong>".$headings[1]."</strong></h3>";
                        echo "<p class=\"mt-3\"><a class=\"btn btn-round\" href=\"".$links[1]."\">".$texts[1]."</a></p>"; ?>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 pt-5 pt-md-0">
                        <?php echo "<img alt=\"image\" class=\"fdb-icon\" src=\"".$imgs[2]."\">";
                        echo "<h3><strong>".$headings[2]."</strong></h3>";
                        echo "<p class=\"mt-3\"><a class=\"btn btn-round\" href=\"".$links[2]."\">".$texts[2]."</a></p>"; ?>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 pt-5 pt-md-0">
                        <?php echo "<img alt=\"image\" class=\"fdb-icon\" src=\"".$imgs[3]."\">";
                        echo "<h3><strong>".$headings[3]."</strong></h3>";
                        echo "<p class=\"mt-3\"><a class=\"btn btn-round\" href=\"".$links[3]."\">".$texts[3]."</a></p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>4,1=>4,2=>4,3=>4];
        return $params;
    }

    function Feature2($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3\"><a href=\"".$links[0]."\">".$texts[0]."</a></p>"; ?>
                    </div>
                </div>
                <div class="row text-center justify-content-center mt-5">
                    <div class="col-10 col-sm-3">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">";
                        echo "<h3><strong>".$headings[1]."</strong></h3>"; ?>
                    </div>
                    <div class="col-10 col-sm-3 pt-5 pt-sm-0">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[1]."\">";
                        echo "<h3><strong>".$headings[2]."</strong></h3>"; ?>
                    </div>
                    <div class="col-10 col-sm-3 pt-5 pt-sm-0">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[2]."\">";
                        echo "<h3><strong>".$headings[3]."</strong></h3>"; ?>
                    </div>
                    <div class="col-10 col-sm-3 pt-5 pt-sm-0">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[3]."\">";
                        echo "<h3><strong>".$headings[4]."</strong></h3>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>4,1=>1,2=>5,3=>1];
        return $params;
    }

    function Feature3($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row justify-content-center pb-5">
                    <div class="col-12 text-center">
                        <?php echo "<h1>".$headings[0]."</h1>"; ?>
                    </div>
                </div>
                <div class="row text-left align-items-center pt-5 pb-md-5">
                    <div class="col-4 col-md-5">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">"; ?>
                    </div>
                    <div class="col-12 col-md-5 m-md-auto">
                        <?php echo "<h2><strong>".$headings[1]."</strong></h2>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>";
                        echo "<p><a href=\"".$links[0]."\">".$texts[1]."</a></p>"; ?>
                    </div>
                </div>
                <div class="row text-left align-items-center pt-5 pb-md-5">
                    <div class="col-4 col-md-5 m-md-auto order-md-5">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[1]."\">"; ?>
                    </div>
                    <div class="col-12 col-md-5">
                        <?php echo "<h2><strong>".$headings[2]."</strong></h2>";
                        echo "<p class=\"text-h3\">".$texts[2]."</p>";
                        echo "<p><a href=\"".$links[1]."\">".$texts[3]."</a></p>"; ?>
                    </div>
                </div>
                <div class="row text-left align-items-center pt-5">
                    <div class="col-4 col-md-5">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[2]."\">"; ?>
                    </div>
                    <div class="col-12 col-md-5 m-md-auto">
                        <?php echo "<h2><strong>".$headings[3]."</strong></h2>";
                        echo "<p class=\"text-h3\">".$texts[4]."</p>";
                        echo "<p><a href=\"".$links[2]."\">".$texts[5]."</a></p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        $params=[0=>3,1=>6,2=>4,3=>3];
        return $params;
    }

    function Feature4($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block pb-0">
            <div class="container">
                <div class="row text-right align-items-center">
                    <div class="col-12 col-lg-6 col-xl-5 m-lg-auto text-left">
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3 pb-xl-4\">".$texts[0]."</p>"; ?>
                        <div class="row pt-5">
                            <div class="col-3">
                                <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">"; ?>
                            </div>
                            <div class="col-9">
                                <?php echo "<p>".$texts[1]."</p>"; ?>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-9 text-right">
                                <?php echo "<p>".$texts[2]."</p>"; ?>
                            </div>
                            <div class="col-3">
                                <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[1]."\">"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 col-sm-4 m-auto pt-5 pt-md-0">
                        <?php echo "<img alt=\"image\" class=\"img-fluid br-b-0\" src=\"".$imgs[2]."\">"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>3,1=>3,2=>1,3=>0];
        return $params;
    }

    function Feature5($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature6($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature7($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature8($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature9($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature10($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature11($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature12($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature13($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature14($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature15($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature16($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature17($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature18($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature19($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature20($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature21($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature22($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature23($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature24($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature25($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature26($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature27($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature28($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature29($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature30($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature31($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Feature32($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }
?>