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

include_once "calltoaction.php";
include_once "content.php";
include_once "feature.php";
include_once "pricing.php";
include_once "team.php";
include_once "testimonial.php";
include_once "custom.php";

function BBThemePage($iPageID) {
  $row=SQLGetPageRow($iPageID);
  if($row["type"]==0) {
    if($row["blockids"]!="") {
      $blockids=explode("|",$row["blockids"]);
      for($i=0;$i<count($blockids);$i++) {
        $block=SQLGetBlockRow($blockids[$i]);
        call_user_func($block["type"],$block["imgs"],$block["texts"],$block["headings"],$block["links"]);
      }
    } else {
      echo "<section class=\"fdb-block\">";
      echo "<div class=\"container\">";
      echo "<div class=\"row align-items-center\">";
      echo "<h1>Nothing to Show :(</h1>";
      echo "</div>";
      echo "</div>";
      echo "</section>";
    }
  } else {
    $plugin_ids = SQLGetPluginsIDs();
    $already_available = False;
    for($i = 0; $i < SQLGetPluginsRowCount(); $i++) {
      if(SQLGetPluginsRow($plugin_ids[$i])["name"] == $row["custom_php"] && SQLGetPluginsRow($plugin_ids[$i])["active"] == 1) {
        $already_available = True;
        break;
      }
    }
    if($already_available) {
      include_once 'plug-ins/'.$row["custom_php"].'/'.$row["custom_php"].'.php';
      call_user_func($row["custom_php"]);
    } else {
      BBThemeCustom($row["custom_php"]);
    }
  }
}
?>
