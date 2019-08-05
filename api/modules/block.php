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

class Attribute {
    public $type;
    public $values;
    public $name;

    function __construct($type, $values, $name) {
        $this->type = $type;
        $this->values = $values;
        $this->name = $name;
    }
}

class Call {
    public $name;
    public $params;
    public $path;

    function __construct($name, $params) {
        $this->name = $name;
        $this->params = $params;
        $this->path = 'plug-ins/'.$name.'/'.$name.'.php';
    }
}

class Block {
    private $sql;

    public $type;
    public $attributes;
    public $call;

    function __construct() {
        $this->sql = new SQL();
        $this->sql->init();

        $this->attributes = array();
    }

    function add_attribute($type, $values, $name) {
        $this->attributes[] = new Attribute($type, $values, $name);
    }

    function count_by_type($type) {
        $counter = 0;

        for($i = 0; $i < count($this->attributes); $i++) {
            if($this->attributes[$i]->type == $type) {
                $counter++;
            }
        }

        return $counter;
    }

    function init($block_id) {
        $block_row = $this->sql->fetch_row('bb_block', $block_id);
        $this->type = $block_row['type'];

        if($this->type != 'call') {
            $attr_ids = $this->sql->fetch_ids_by_param('bb_attr', 'block_id', $block_id);
            for($i = 0; $i < count($attr_ids); $i++) {
                $attr_row = $this->sql->fetch_row('bb_attr', $attr_ids[$i]);

                $this->add_attribute($attr_row['type'], array($attr_row['value'], $attr_row['value2']), $attr_row['name']);
            }
        } else {
            $call_row = $this->sql->fetch_row_by_param('bb_call', 'block_id', $block_id);
            $this->call = new Call($this->sql->fetch_row('bb_plugins', $call_row['plugin_id'])['name'], $call_row['params']);
        }
    }

    function reset() {
        unset($this->type);
        unset($this->attributes);
        unset($this->call);
    }

    function get_attributes_by_type($type) {
        $attrs = array();
        for($i = 0; $i < count($this->attributes); $i++) {
            if($this->attributes[$i]->type == $type) {  
                $attrs[] = $this->attributes[$i];
            }
        }
        return $attrs;
    }

    function show_block() {
        if($this->type != 'call') {
            call_user_func($this->type, $this, true);
        } else {
            include_once $this->call->path;
            call_user_func($this->call->name, $this->call->params);
        }
    }
}

function get_attribute($block_1, $block_2, $attr_name) {
    if(is_object($block_1)) {
        for($i = 0; $i < count($block_1->attributes); $i++) {
            if($block_1->attributes[$i]->name == $attr_name) {
                return $block_1->attributes[$i];
            }
        }
    }
    for($i = 0; $i < count($block_2->attributes); $i++) {
        if($block_2->attributes[$i]->name == $attr_name) {
            return $block_2->attributes[$i];
        }
    }
    return false;
}

?>