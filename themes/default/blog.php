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

    $MACROPAGES_TITLE["blog"]="Blog";
    $MACROPAGES_DESCRIPTION["blog"]="All the latest News collected at one place!";
    $MACROPAGES_KEYWORDS["blog"]="Blog";

    function BBThemeBlog() {
        if(!isset($_GET["post"])) {
    ?>
    <section class="fdb-block">
        <div class="container">
            <div class="row align-items-center">
                <?php
                $ids=SQLGetPostIDs();
                $count=SQLGetPostRowCount();
                if($count>0) {
                    if(!isset($_GET["list"])) {
                        $iFrom=1;
                    } else {
                        $iFrom=(4*($_GET["list"]-1))+1;
                    }
                    $iTo=$iFrom+3;
                    if($count<$iTo) {
                        $iTo=$count;
                    }
                    for($i=$iFrom;$i<=$iTo;$i++) {
                        $row=SQLGetPostRow($ids[$i-1]);
                        echo "<div class=\"col-12 col-md-6 col-lg-5\">";
                        echo "<h1>".$row["title"]."</h1>";
                        echo "<p class=\"text-h3\">".htmlspecialchars(substr($row["content"],0,150))."...</p>";
                        echo "<a href=\"?site=".$_GET["site"]."&page=blog&post=".$ids[$i-1]."\" class=\"btn btn-round btn-empty\">Read More</a>";
                        echo "</div>";
                        echo "<div class=\"col-12 col-md-6 ml-md-auto mt-4 mt-md-0\">";
                        echo "<a href=\"?site=".$_GET["site"]."&page=blog&post=".$ids[$i-1]."\">";
                        echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$row["img"]."\">";
                        echo "</a>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
        <br/>
                    <?php HTMLPageSwitcher($count,4);
                } else {
                    echo "<h1>:( Nothing to Show...</h1>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
    </section>
    <?php
        } else {
            $row=SQLGetPostRow($_GET["post"]);
    ?>
    <?php echo "<section class=\"fdb-block fdb-viewport bg-dark\" style=\"background-image: url(".$row["img"].")\">"; ?>
        <div class="container align-items-center justify-content-center d-flex">
            <div class="row align-items-center text-left">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <?php
                    echo "<h1>".$row["title"]."</h1>";
                ?>
                </div>
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <?php
                    echo "<br/>";
                    echo "<p class=\"text-h3\">Published by ".SQLGetUserRow($row["author_id"])["username"]." at ".date("d.m.Y",strtotime($row["date"]))."</p>";
                ?>
                </div>
                <div class="col col-12 text-center">
                    <br/>
                    <br/>
                    <?php echo "<p class=\"text-h3\"><a href=\"?site=".$_GET["site"]."&page=blog\" class=\"btn btn-round btn-empty\"><i class=\"fa fa-arrow-left\"></i> Back</a></p>"; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="fdb-block" style="background-image: url(./themes/default/imgs/bg_c_1.svg);">
        <div class="container">
            <div class="row text-left">
                <div class="col-12 col-sm-10 m-auto m-md-0 col-md-8 col-lg-12">
                    <div class="fdb-box">
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-10 text-justify">
                                <?php echo "<h1>".$row["title"]."</h1>"; ?>
                                <?php echo "<p>".nl2br($row["content"])."</p>"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    }
?>
