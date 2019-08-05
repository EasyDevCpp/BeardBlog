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

    //Add your custom include here

    function BBThemeCustom($CustomParam) {
        if($CustomParam=="test") {
			echo "<section class=\"fdb-block\">";
			echo "<div class=\"container\">";
			echo "<div class=\"row align-items-center\">";
			echo "<h1>It's a Trap!</h1>";
			echo "</div>";
			echo "</div>";
			echo "</section>";
        }
    }
?>