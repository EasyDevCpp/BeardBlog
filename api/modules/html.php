<?php
/*
BeardBlog - Block based pagebuilding CMS
Copyright (C) 2019 Robin Krause

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

function HTML_GetCurrentLink() {
    return $_SERVER['REQUEST_URI'];
}

function HTML_ReplaceLinkPart($token) {
    $vPos = stripos(HTML_GetCurrentLink(), $token);
    if($vPos !== false) {
        return substr(HTML_GetCurrentLink(), 0, $vPos);
    } else {
        return HTML_GetCurrentLink();
    }
}

?>