<?php
include_once 'config.php';

function Team() {
    global $sql;

    $human_ids = $sql->fetch_ids('_team_humans');
    $dog_ids = $sql->fetch_ids('_team_dogs');
    $head_ids = $sql->fetch_ids('_team_head');

    $out = array();
    $temp = '';
    $col = 1;

    for($i = 0; $i < count($human_ids); $i++) {
        $row = $sql->fetch_row('_team_humans', $human_ids[$i]);

        $temp .= '<div class="team-col-'.$col.'">';
        $temp .= '<div class="name-table">';
        $temp .= '<div class="name-col-1">';
        $temp .= '<img src="'.get_img($row['media_id']).'" height="180" width="180" class="img-rounded shadow-sm" />';
        $temp .= '</div>';
        $temp .= '<div class="name-col-2">';
        $temp .= '<p><strong>'.$row['name'].'</strong></p>';
        $temp .= '</div>';
        $temp .= '<div class="name-col-3">';
        
        $dogs = $sql->fetch_ids_by_param('_team_dogs', 'human_id', $row['id']);
        for($j = 0; $j < count($dogs); $j++) {
            $temp .= '<p>'.$sql->fetch_row('_team_dogs', $dogs[$j])['name'].'</p>';
        }

        $temp .= '</div>';
        $temp .= '</div>';
        $temp .= '</div>';

        $col += 1;
        if($col > 3) {
            $col = 1;
        }
    }

    $out[] = $temp;
    $temp = '';
    $col = 1;

    for($i = 0; $i < count($dog_ids); $i++) {
        $row = $sql->fetch_row('_team_dogs', $dog_ids[$i]);

        $temp .= '<div class="team-col-'.$col.'">';
        $temp .= '<div class="name-table">';
        $temp .= '<div class="name-col-1">';
        $temp .= '<img src="'.get_img($row['media_id']).'" height="180" width="180" class="img-rounded shadow-sm" />';
        $temp .= '</div>';
        $temp .= '<div class="name-col-2">';
        $temp .= '<p><strong>'.$row['name'].'</strong></p>';
        $temp .= '</div>';
        $temp .= '<div class="name-col-3">';
        $temp .= '<p>'.$sql->fetch_row('_team_humans', $row['human_id'])['name'].'</p>';
        $temp .= '</div>';
        $temp .= '</div>';
        $temp .= '</div>';

        $col += 1;
        if($col > 3) {
            $col = 1;
        }
    }

    $out[] = $temp;
    $temp = '';
    $col = 1;

    for($i = 0; $i < count($head_ids); $i++) {
        $row = $sql->fetch_row('_team_head', $head_ids[$i]);
        $human = $sql->fetch_row('_team_humans', $row['human_id']);

        $temp .= '<div class="team-col-'.$col.'">';
        $temp .= '<div class="name-table">';
        $temp .= '<div class="name-col-1">';
        $temp .= '<img src="'.get_img($human['media_id']).'" height="280" width="280" class="shadow-sm" />';
        $temp .= '</div>';
        $temp .= '<div class="name-col-2">';
        $temp .= '<p><strong>'.$human['name'].'</strong></p>';
        if(!empty($row['phone'])) $temp .= '<p>Telefon: '.$row['phone'].'</p>';
        if(!empty($row['email'])) $temp .= '<p>E-Mail: <a href="mailto:'.$row['email'].'">'.$row['email'].'</a></p>';
        $temp .= '</div>';
        $temp .= '</div>';
        $temp .= '</div>';

        $col += 1;
        if($col > 3) {
            $col = 1;
        }
    }

    $out[] = $temp;
    ?>
    <script>
        var ot_opacity = 1.0;
        var ot_fade_state = 0;
        var ot_fade_done = false;

        function our_team(page) {
            if(ot_fade_state == 0) {
                if(ot_opacity >= 0) {
                    ot_opacity -= .1;
                    setTimeout(function() { our_team(page) }, 38);
                } else {
                    ot_fade_state = 1;
                    ot_fade_done  = true;
                    our_team(page);
                }
            } else if(ot_fade_state == 1) {
                if(ot_opacity < 1) {
                    ot_opacity += .1;
                    setTimeout(function() { our_team(page) }, 38);
                } else {
                    ot_fade_state = 0;
                }
            }
            document.getElementById('our-team-text').style.opacity = ot_opacity;
            if(ot_fade_done) {
                var html_content = "";

                if(page == 1) {
                    document.getElementById("our-team-text").innerHTML = "";
                    html_content = <?php echo "'".$out[1]."'" ?>;
                    document.getElementById("our-team-text").insertAdjacentHTML('beforeend', html_content);
                } else if(page == 2) {
                    document.getElementById("our-team-text").innerHTML = "";
                    html_content = <?php echo "'".$out[0]."'" ?>;
                    document.getElementById("our-team-text").insertAdjacentHTML('beforeend', html_content);
                } else if(page == 3) {
                    document.getElementById("our-team-text").innerHTML = "";
                    html_content = <?php echo "'".$out[2]."'" ?>;
                    document.getElementById("our-team-text").insertAdjacentHTML('beforeend', html_content);
                }

                ot_fade_done = false;
            }
        }
    </script>
    <section class="full-page" id="our-team">
        <div class="black-outline"></div>
        <div class="content">
            <h1>Unser Team.</h1>
            <ul class="content-nav">
                <li class="float-left"><a class="content-nav-elements" onclick="our_team(1)">Hunde</a></li>
                <li class="ml-5 float-left"><a class="content-nav-elements" onclick="our_team(2)">Mitglieder</a></li>
                <li class="ml-5 float-left"><a class="content-nav-elements" onclick="our_team(3)">Vorstand</a></li>
            </ul>
            <div class="mt-5 inner-page">
                <div class="team-table" id="our-team-text">
                    <?php echo $out[1]; ?>
                </div>
            </div>
            <div class="mt-10">
                <a href="" class="btn btn-red btn-med"><i class="fas fa-long-arrow-alt-right"></i> Mitglied werden</a>
                <a href="" class="ml-4 btn btn-dark btn-med"><i class="fas fa-hand-holding-usd"></i> Fördern</a>
            </div>
        </div>
    </section>
<?php
}
?>
