<?php
include_once 'config.php';

function Team() {
    global $sql;

    $human_ids = $sql->fetch_ids('_team_humans');
    $dog_ids = $sql->fetch_ids('_team_dogs');
    $head_ids = $sql->fetch_ids('_team_head');
    ?>
    <section class="full-page">
        <div class="content text-align-center">
            <h1>Unser Team.</h1>
            <div class="mt-5 inner-page-np">
                <div class="team-table">
                    <?php
                        $colors = array('light-gray', 'gray', 'dark-gray', 'bluish-gray', 'blue', 'light-blue', 'green', 'purple');
                        $invert = array(true, false, false, true, false, false, false, false);
                        $out = array();
                        $color_index = array();
                        $temp = '';
                        $col = 1;

                        for($i = 0; $i < count($dog_ids); $i++) {

                            $color_index[$i] = rand(0, 7);
                            $row = $sql->fetch_row('_team_dogs', $dog_ids[$i]);
                            $row_human = $sql->fetch_row('_team_humans', $row['human_id']);
                            $row_head = $sql->fetch_row_by_param('_team_head', 'human_id', $row['human_id']);

                            $temp .= '<img src="'.get_img($row['media_id']).'" height="240" width="240" class="img-rounded shadow-lg" />';
                            $temp .= '<div class="text-align-start">';
                            $temp .= '<p><strong>Name:</strong> '.$row['name'].'<br/>';
                            $temp .= '<strong>Geburtsjahr:</strong> * '.$row['year_of_birth'].'<br/>';
                            $temp .= '<strong>Hunderasse:</strong> '.$row['breed'].'<br/>';
                            if($invert[$color_index[$i]]) {
                                $temp .= '<a href="" class="btn btn-dark">Parte werden</a></p>';
                            } else {
                                $temp .= '<a href="" class="btn">Parte werden</a></p>';
                            }
                            $temp .= '</div>';
                            $temp .= '<div class="text-align-center">';
                            if($invert[$color_index[$i]]) {
                                $temp .= '<p><a class="mt-5 btn btn-dark" onclick="ot_'.$i.'_call(2)">Hundeführer Anzeigen</a></p>';
                            } else {
                                $temp .= '<p><a class="mt-5 btn" onclick="ot_'.$i.'_call(2)">Hundeführer Anzeigen</a></p>';
                            }
                            $temp .= '</div>';

                            $out[0] = $temp;
                            $temp = '';

                            $temp .= '<img src="'.get_img($row_human['media_id']).'" height="240" width="240" class="img-rounded shadow-lg" />';
                            $temp .= '<div class="text-align-start">';
                            $temp .= '<p><strong>Name:</strong> '.$row_human['name'].'<br/>';
                            $temp .= '<strong>Prüfungen:</strong> '.$row_human['exams'].'<br/>';
                            if(!empty($row_head['function'])) {
                                $temp .= '<strong>Funktionen:</strong> '.$row_head['function'].'<br/><i>'.$row_human['functions'].'</i>';
                                if($invert[$color_index[$i]]) {
                                    $temp .= '<p><a href="" class="btn btn-dark">Schreib Mir</a></p>';
                                } else {
                                    $temp .= '<p><a href="" class="btn">Schreib Mir</a></p>';
                                }
                            } else {
                                $temp .= '<strong>Funktionen:</strong> <i>'.$row_human['functions'].'</i>';
                            }
                            $temp .= '</p>';
                            $temp .= '</div>';
                            $temp .= '<div class="text-align-center">';
                            if($invert[$color_index[$i]]) {
                                $temp .= '<p><a class="mt-5 btn btn-dark" onclick="ot_'.$i.'_call(1)">Hund Anzeigen</a></p>';
                            } else {
                                $temp .= '<p><a class="mt-5 btn" onclick="ot_'.$i.'_call(1)">Hund Anzeigen</a></p>';
                            }
                            $temp .= '</div>';

                            $out[1] = $temp;
                            $temp = '';

                            echo '<script>'."\n";
                            echo 'var ot_'.$i.'_opacity = 1.0;'."\n";
                            echo 'var ot_'.$i.'_fade_state = 0;'."\n";
                            echo 'var ot_'.$i.'_fade_done = false;'."\n";

                            echo 'function ot_'.$i.'_call(index) {'."\n";
                                echo 'if(ot_'.$i.'_fade_state == 0) {'."\n";
                                    echo 'if(ot_'.$i.'_opacity >= 0) {'."\n";
                                        echo 'ot_'.$i.'_opacity -= .1;'."\n";
                                        echo 'setTimeout(function() { ot_'.$i.'_call(index) }, 38);'."\n";
                                    echo '} else {'."\n";
                                        echo 'ot_'.$i.'_fade_state = 1;'."\n";
                                        echo 'ot_'.$i.'_fade_done  = true;'."\n";
                                        echo 'ot_'.$i.'_call(index);'."\n";
                                    echo '}'."\n";
                                echo '} else if(ot_'.$i.'_fade_state == 1) {'."\n";
                                    echo 'if(ot_'.$i.'_opacity < 1) {'."\n";
                                        echo 'ot_'.$i.'_opacity += .1;'."\n";
                                        echo 'setTimeout(function() { ot_'.$i.'_call(index) }, 38);'."\n";
                                    echo '} else {'."\n";
                                        echo 'ot_'.$i.'_fade_state = 0;'."\n";
                                    echo '}'."\n";
                                echo '}'."\n";

                                echo 'document.getElementById(\'ot_'.$i.'\').style.opacity = ot_'.$i.'_opacity;'."\n";

                                echo 'if(ot_'.$i.'_fade_done) {'."\n";
                                    echo 'var html_content = "";'."\n";
                                    
                                    echo 'if(index == 1) {'."\n";
                                        echo 'document.getElementById("ot_'.$i.'").innerHTML = "";'."\n";
                                        echo 'html_content = \''.$out[0].'\''."\n";
                                        echo 'document.getElementById("ot_'.$i.'").insertAdjacentHTML(\'beforeend\', html_content);'."\n";
                                    echo '} else if(index == 2) {'."\n";
                                        echo 'document.getElementById("ot_'.$i.'").innerHTML = "";'."\n";
                                        echo 'html_content = \''.$out[1].'\''."\n";
                                        echo 'document.getElementById("ot_'.$i.'").insertAdjacentHTML(\'beforeend\', html_content);'."\n";
                                    echo '}'."\n";
                                    
                                    echo 'ot_'.$i.'_fade_done = false;'."\n";
                                echo '}'."\n";
                            echo '}'."\n";
                            echo '</script>'."\n";

                            echo '<div class="team-col-'.$col.' color-tile tile-'.$colors[$color_index[$i]].'" id="ot_'.$i.'">';
                            echo $out[0];
                            echo '</div>';

                            $col += 1;
                            if($col > 3) {
                                $col = 1;
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="mt-5">
                <div class="grid-2">
                    <div class="col-1">
                        <div class="color-tile color-tile-blue">
                            <h1>Mitglied werden.</h1>
                            <a href="" class="btn btn-med">Jetzt Bewerben <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="col-2 pl-4">
                        <div class="color-tile color-tile-dark-gray">
                            <h1><i class="fas fa-hand-holding-usd"></i> Fördern</h1>
                            <a href="" class="btn btn-red btn-med">Jetzt fördern <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
            </div>
        </div>
    </section>
<?php
}
?>
