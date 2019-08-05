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

include_once "config.php";

class SQL {
    public $db_conn;

    function init() {
        $this->db_conn = mysqli_connect(BB_DB_LOCATION, BB_DB_USER, BB_DB_PW, BB_DB_NAME);
    }
    function init_ex($sLocation, $sUser, $sPw, $sName) {
        $this->db_conn = mysqli_connect($sLocation, $sUser, $sPw, $sName);
    }
    function quit() {
        mysqli_close($this->db_conn);
    }

    function create_table($sTable, $sFields) {
	    $sQuery = "CREATE TABLE IF NOT EXISTS ".$sTable." (".$sFields.")";
        mysqli_query($this->db_conn, $sQuery);
        echo mysqli_error($this->db_conn);
    }

    function table_exists($sTable) {
        $sQuery = "SELECT 1 FROM ".$sTable." LIMIT 1";
        if(mysqli_query($this->db_conn, $sQuery) !== false) {
            return true;
        } else {
            return false;
        }
    }

    function fetch_row($sTable, $iID) {
	    $sQuery = "SELECT * FROM ".$sTable." WHERE id='".$iID."'";
	    $vQuery = mysqli_query($this->db_conn, $sQuery);
        $aRow = mysqli_fetch_assoc($vQuery);
        echo mysqli_error($this->db_conn);
	    return $aRow;
    }

    function fetch_ids($sTable) {
	    $sQuery = "SELECT id FROM ".$sTable;
	    $vQuery = mysqli_query($this->db_conn, $sQuery);
	    $tRow = array();
	    while($aRow = mysqli_fetch_assoc($vQuery)) {
		    $tRow[] = $aRow["id"];
        }
        echo mysqli_error($this->db_conn);
	    return $tRow;
    }

    function fetch_ids_ordered($sTable, $sOrder, $sMode = '') {
	    $sQuery = "SELECT id FROM ".$sTable." ORDER BY ".$sOrder." $sMode";
	    $vQuery = mysqli_query($this->db_conn, $sQuery);
	    $tRow = array();
	    while($aRow = mysqli_fetch_assoc($vQuery)) {
		    $tRow[] = $aRow["id"];
        }
        echo mysqli_error($this->db_conn);
	    return $tRow;
    }

    function fetch_row_by_param($sTable, $sField, $sValue) {
	    $sQuery = "SELECT * FROM ".$sTable." WHERE ".$sField."='".$sValue."'";
	    $vQuery = mysqli_query($this->db_conn, $sQuery);
        $aRow = mysqli_fetch_assoc($vQuery);
        echo mysqli_error($this->db_conn);
	    return $aRow;
    }

    function fetch_ids_by_param($sTable, $sField, $sValue) {
	    $sQuery = "SELECT id FROM ".$sTable." WHERE ".$sField."='".$sValue."'";
	    $vQuery = mysqli_query($this->db_conn, $sQuery);
	    $tRow = array();
	    while($aRow = mysqli_fetch_assoc($vQuery)) {
		    $tRow[] = $aRow["id"];
        }
        echo mysqli_error($this->db_conn);
	    return $tRow;
    }

    function fetch_ids_by_param_ordered($sTable, $sField, $sValue, $sOrder, $sMode = '') {
	    $sQuery = "SELECT id FROM ".$sTable." WHERE ".$sField."='".$sValue."' ORDER BY ".$sOrder." $sMode";
	    $vQuery = mysqli_query($this->db_conn, $sQuery);
        $tRow = array();
	    while($aRow = mysqli_fetch_assoc($vQuery)) {
		    $tRow[] = $aRow["id"];
        }
        echo mysqli_error($this->db_conn);
	    return $tRow;
    }

    function update($sTable, $iID, $sField, $vValue) {
	    $sQuery = "UPDATE ".$sTable." SET ".$sField.'="'.$vValue.'" WHERE id="'.$iID.'"';
        mysqli_query($this->db_conn, $sQuery);
        echo mysqli_error($this->db_conn);
    }

    function insert($sTable, $sFields, $sValues) {
	    $sQuery = "INSERT INTO ".$sTable." (".$sFields.") VALUES (".$sValues.")";
        mysqli_query($this->db_conn, $sQuery);
        echo mysqli_error($this->db_conn);
    }

    function row_count($sTable) {
	    $sQuery = "SELECT * FROM ".$sTable;
        $iRet = mysqli_num_rows(mysqli_query($this->db_conn, $sQuery));
        echo mysqli_error($this->db_conn);
	    return $iRet;
    }

    function exec_query($sQuery) {
        mysqli_query($this->db_conn, $sQuery);
        echo mysqli_error($this->db_conn);
    }

    function delete($sTable, $iID) {
	    $sQuery = "DELETE FROM ".$sTable." WHERE id=".$iID;
        $iRet = mysqli_query($this->db_conn, $sQuery);
        echo mysqli_error($this->db_conn);
	    return $iRet;
    }
}

function SQL_CreateDatabase($sLocation, $sUser, $sPw, $sName) {
	$conn = mysqli_connect($sLocation, $sUser, $sPw);
	$sQuery = "CREATE DATABASE IF NOT EXISTS ".$sName;
	mysqli_query($conn, $sQuery);
	mysqli_close($conn);
}