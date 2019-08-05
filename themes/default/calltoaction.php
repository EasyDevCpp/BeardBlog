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

        
        Call To Action Blocks 1-24
        If you leave one empty make sure to return false!

        Included: 6 different calltoaction blocks

        Parameters should always be: String[imgs],String[texts],String[headings],String[links],Boolean[show=true]
    */

    function CallToAction1($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <?php echo "<section class=\"fdb-block\" style=\"background-image: url(".$imgs[0].")\">"; ?>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 text-left">
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>"; ?>
                        <p class="mt-4">
                            <?php echo "<a class=\"btn btn-round\" href=\"".$links[0]."\">".$texts[1]."</a>"; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>1,1=>2,2=>1,3=>1];
        return $params;
    }

    function CallToAction2($imgs,$texts,$headings,$links,$bShow=true) {
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
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>"; ?>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center pt-5">
                    <div class="col-8 col-sm-3">
                        <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">"; ?>
                    </div>
                    <div class="col-12 col-sm-6 m-auto pt-4 pt-sm-0">
                        <?php echo "<h2><strong>".$headings[1]."</strong></h2>";
                        echo "<p class=\"text-h3\">".$texts[1]."</p>"; ?>
                    </div>
                    <div class="col-12 col-sm-3 text-center pt-4 pt-sm-0">
                        <?php echo "<p><a class=\"btn btn-round btn-empty\" href=\"".$links[0]."\">".$texts[2]."</a></p>";
                        echo "<p><a class=\"btn btn-round\" href=\"".$links[1]."\">".$texts[3]."</a></p>";
                        echo "<p class=\"text-h5\"><em>".$texts[4]."</em></p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>1,1=>5,2=>2,3=>2];
        return $params;
    }

    function CallToAction3($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <?php echo "<section class=\"fdb-block bg-dark fdb-viewport\" style=\"background-image: url(".$imgs[0].");\">"; ?>
            <div class="container align-items-center justify-content-center d-flex">
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"mt-5\"><a href=\"".$links[0]."\" class=\"btn btn-round\">".$texts[0]."</a></p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        $params=[0=>1,1=>1,2=>1,3=>1];
        return $params;
    }

    function CallToAction4($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <?php echo "<section class=\"fdb-block fdb-viewport bg-dark\" style=\"background-image: url(".$imgs[0].")\">"; ?>
            <div class="container justify-content-center align-items-center d-flex">
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-md-8">
                        <?php echo "<img alt=\"image\" class=\"fdb-icon\" src=\"".$imgs[1]."\">";
                        echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>";
                        echo "<p class=\"mt-5\"><a href=\"".$links[0]."\" class=\"btn btn-round\">".$texts[1]."</a></p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>2,1=>2,2=>1,3=>1];
        return $params;
    }

    function CallToAction5($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <section class="fdb-block pb-0">
            <div class="container align-items-end justify-content-center d-flex">
                <div class="row align-items-top text-left">
                    <div class="col-12 col-md-6 col-lg-5">
                        <?php echo "<p class=\"mb-5 mt-5\"><img alt=\"image\" src=\"".$imgs[0]."\" height=\"40\"></p>";
                        echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>";
                        echo "<p class=\"mt-4\"><a href=\"".$links[0]."\" class=\"btn btn-round\">".$texts[1]."</a></p>"; ?>
                    </div>
                    <div class="col-12 col-sm-4 col-md-6 col-lg-4 m-auto pt-5">
                        <?php echo "<img alt=\"image\" class=\"img-fluid br-0\" src=\"".$imgs[1]."\">"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>2,1=>2,2=>1,3=>1];
        return $params;
    }

    function CallToAction6($imgs,$texts,$headings,$links,$bShow=true) {
        if($bShow) {
            $imgs=explode("|",$imgs);
            $texts=explode("|",$texts);
            $headings=explode("|",$headings);
            $links=explode("|",$links);
        ?>
        <?php echo "<section class=\"fdb-block fdb-viewport\" style=\"background-image: url(".$imgs[0].")\">"; ?>
            <div class="container align-items-center justify-content-center d-flex">
                <div class="row align-items-center text-left">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                        <?php echo "<h1>".$headings[0]."</h1>";
                        echo "<p class=\"text-h3\">".$texts[0]."</p>";
                        echo "<p class=\"mt-5\"><a href=\"".$links[0]."\" class=\"btn btn-round btn-shadow\">".$texts[1]."</a> <a href=\"".$links[1]."\" class=\"btn btn-round btn-white btn-shadow\">".$texts[2]."</a></p>"; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        } 
        $params=[0=>1,1=>3,2=>1,3=>2];
        return $params;
    }

    function CallToAction7($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction8($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction9($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction10($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction11($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction12($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction13($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction14($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction15($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction16($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction17($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction18($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction19($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction20($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction21($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction22($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction23($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }

    function CallToAction24($imgs,$texts,$headings,$links,$bShow=true) {
        return false;
    }
?>