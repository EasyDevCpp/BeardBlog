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


        Pricing Blocks 1-10
        If you leave one empty make sure to return false!

        Included: 2 different pricing blocks

        Parameters should always be: String[imgs],String[texts],String[headings],String[links],Boolean[show=true]
    */

    function Pricing1($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block bg-dark" style="background-image: url(./themes/default/imgs/bg_1.svg);">
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                        <?php echo "<h1>".$headings[0]."</h1>"; ?>
                    </div>
                </div>
                <div class="row mt-5 align-items-center no-gutters">
                    <div class="col-12 col-sm-10 col-md-8 m-auto col-lg-4 text-center">
                        <div class="bg-gray pb-5 pt-5 pl-4 pr-4">
                            <?php echo "<h2 class=\"font-weight-light\">".$headings[1]."</h2>";
                            echo "<p class=\"text-h1 mt-5 mb-5\"><strong>".$texts[0]."</strong> <span class=\"text-h4\">".$texts[1]."</span></p>";
                            echo "<ul class=\"text-left\">";
                            echo "<li>".$texts[2]."</li>";
                            echo "<li>".$texts[3]."</li>";
                            echo "<li>".$texts[4]."</li>";
                            echo "</ul>";
                            echo "<p class=\"text-center pt-4\"><a href=\"".$links[0]."\" class=\"btn btn-round btn-white btn-shadow\">".$texts[5]."</a></p>"; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-8 ml-auto mr-auto col-lg-4 text-center mt-4 mt-lg-0 sl-1 pt-0 pt-lg-3 pb-0 pb-lg-3 bg-gray fdb-touch">
                        <div class="pb-5 pt-5 pl-4 pr-4">
                            <?php echo "<h2 class=\"font-weight-light\">".$headings[2]."</h2>";
                            echo "<p class=\"text-h1 mt-5 mb-5\"><strong>".$texts[6]."</strong> <span class=\"text-h4\">".$texts[7]."</span></p>";
                            echo "<ul class=\"text-left\">";
                            echo "<li>".$texts[8]."</li>";
                            echo "<li>".$texts[9]."</li>";
                            echo "<li>".$texts[10]."</li>";
                            echo "</ul>";
                            echo "<p class=\"text-center pt-4\"><a href=\"".$links[1]."\" class=\"btn btn-round btn-shadow\">".$texts[11]."</a></p>"; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-8 ml-auto mr-auto col-lg-4 text-center mt-4 mt-lg-0">
                        <div class="bg-gray pb-5 pt-5 pl-4 pr-4">
                            <?php echo "<h2 class=\"font-weight-light\">".$headings[3]."</h2>";
                            echo "<p class=\"text-h1 mt-5 mb-5\"><strong>".$texts[12]."</strong> <span class=\"text-h4\">".$texts[13]."</span></p>";
                            echo "<ul class=\"text-left\">";
                            echo "<li>".$texts[14]."</li>";
                            echo "<li>".$texts[15]."</li>";
                            echo "<li>".$texts[16]."</li>";
                            echo "</ul>";
                            echo "<p class=\"text-center pt-4\"><a href=\"".$links[2]."\" class=\"btn btn-round btn-white btn-shadow\">".$texts[17]."</a></p>"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        $params=[0=>0,1=>18,2=>4,3=>3];
        return $params;
    }

    function Pricing2($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block">
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                        <?php echo "<h1>".$headings[0]."</h1>"; ?>
                    </div>
                </div>
                <div class="row mt-5 align-items-top">
                    <div class="col-12 col-sm-10 col-md-6 col-lg-5 m-auto col-xl-3 text-left">
                        <div class="bg-gray p-3 text-center br sl-1">
                            <?php echo "<h2 class=\"font-weight-light\">".$headings[1]."</h2>";
                            echo "<p class=\"text-h2\">".$texts[0]."</p>";
                            echo "<p class=\"text-center\"><a href=\"".$links[0]."\" class=\"btn btn-round btn-empty\">".$texts[1]."</a></p>"; ?>
                            <hr class="mt-5 mb-5">
                            <?php echo "<p>".$texts[2]."</p>";
                            echo "<p>".$texts[3]."</p>";
                            echo "<p>".$texts[4]."</p>"; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-6 col-lg-5 m-auto col-xl-3 text-left pt-5 pt-md-0">
                        <div class="bg-gray p-3 text-center br sl-1">
                            <?php echo "<h2 class=\"font-weight-light\">".$headings[2]."</h2>";
                            echo "<p class=\"text-h2\">".$texts[5]."</p>";
                            echo "<p class=\"text-center\"><a href=\"".$links[1]."\" class=\"btn btn-round btn-empty\">".$texts[6]."</a></p>"; ?>
                            <hr class="mt-5 mb-5">
                            <?php echo "<p>".$texts[7]."</p>";
                            echo "<p>".$texts[8]."</p>";
                            echo "<p>".$texts[9]."</p>"; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-6 col-lg-5 m-auto col-xl-3 text-left pt-5 pt-xl-0">
                        <div class="bg-gray p-3 text-center br sl-1">
                            <?php echo "<h2 class=\"font-weight-light\">".$headings[3]."</h2>";
                            echo "<p class=\"text-h2\">".$texts[10]."</p>";
                            echo "<p class=\"text-center\"><a href=\"".$links[2]."\" class=\"btn btn-round btn-empty\">".$texts[11]."</a></p>"; ?>
                            <hr class="mt-5 mb-5">
                            <?php echo "<p>".$texts[12]."</p>";
                            echo "<p>".$texts[13]."</p>";
                            echo "<p>".$texts[14]."</p>"; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-6 col-lg-5 m-auto col-xl-3 text-left pt-5 pt-xl-0">
                        <div class="bg-gray p-3 text-center br sl-1">
                            <?php echo "<h2 class=\"font-weight-light\">".$headings[4]."</h2>";
                            echo "<p class=\"text-h2\">".$texts[15]."</p>";
                            echo "<p class=\"text-center\"><a href=\"".$links[3]."\" class=\"btn btn-round btn-empty\">".$texts[16]."</a></p>"; ?>
                            <hr class="mt-5 mb-5">
                            <?php echo "<p>".$texts[17]."</p>";
                            echo "<p>".$texts[18]."</p>";
                            echo "<p>".$texts[19]."</p>"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        $params=[0=>0,1=>20,2=>5,3=>4];
        return $params;
    }

    function Pricing3($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing4($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing5($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing6($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing7($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing8($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing9($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing10($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing11($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing12($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing13($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing14($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing15($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing16($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing17($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing18($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing19($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing20($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing21($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing22($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing23($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing24($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing25($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing26($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing27($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing28($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing29($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing30($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing31($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function Pricing32($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }
?>
