<?php
function BlogCats_Config() {
    global $sql;

    if($sql->table_exists('_blogcats')) {
        div('p-5');
            div_row('pt-2');
                div_col(50);
                    $user_types = new Menu('blogcat-types', 1);
                    $user_types->DIFF_URL = true;
                    $user_types->add_entry('Categories');
                    $user_types->add_entry('Posts');
                    $user_types->draw();
                div_end();
            div_end();
        div_end();
    } else {
        div();
            div_row();
                draw_text('Installation...', 2);
                /*
                    * _blogcats         id | name | post_id
                */
                $sql->create_table('_blogcats',     'id INT NOT NULL AUTO_INCREMENT,'.
                                                    'name VARCHAR(60) NOT NULL,'.
                                                    'post_id INT NOT NULL,'.
                                                    'PRIMARY KEY (id)');
                
                draw_text('Done.', 2);
            div_end();
            div_row();
                draw_button('<i class="fas fa-sync"></i> Refresh', HTML_GetCurrentLink());
            div_end();
        div_end();
    }
}