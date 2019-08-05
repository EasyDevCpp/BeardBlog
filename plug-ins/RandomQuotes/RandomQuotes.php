<?php
function RandomQuotes_Config() {
    draw_text('RandomQuotes is not configurable!');
}

function RandomQuotes($iID = '') {
    $aQuotes=array(
        "Mycroft Holmes: All lives end; all hearts are broken. Caring is not an advantage, Sherlock.&mdash;<em>Sherlock</em>",
        "SH: Yes, obviously.&mdash;<em>Sherlock</em>",
        "SH: Taking your own life. Interesting expression. Taking it from who? Once it's over, it's not you who'll miss it. Your own death is something that happens to everybody else. Your life is not your own. Keep your hands off it.&mdash;<em>Sherlock</em>",
        "Eleven: Friends don't lie!&mdash;<em>Stranger Things</em>",
        "Mike Wheeler: I never gave up on you. I called you every night. Every night for...<br/><br/>
         Eleven: 353 days. I heard.&mdash;<em>Stranger Things</em>",
        "Tony Stark: What's the stat, Rogers?<br/>
        </br>
        Steve Rogers: [looks at the Helicarrier tech] It seems to be powered by some sort of electricity!<br/>
        </br>
        Tony Stark: ...well, you're not wrong.&mdash;<em>The Avengers</em>",
        "Steve Rogers: Doctor Banner, now might be a good time for you to get angry.<br/>
        <br/>
        Bruce Banner: That's my secret, Captain: I'm always angry.<br/>
        <br/>
        [Banner hulks out and punches the Leviathan]&mdash;<em>The Avengers</em>",
        "Sam: [Both are overcome by exhaustion] Do you remember the Shire, Mr. Frodo? It'll be spring soon. And the orchards will be in blossom. And the birds will be nesting in the hazel thicket. And they'll be sowing the summer barley in the lower fields... and eating the first of the strawberries with cream. Do you remember the taste of strawberries?<br/>
        <br/>
        Frodo: No, Sam. I can't recall the taste of food... nor the sound of water... nor the touch of grass. I'm... naked in the dark, with nothing, no veil... between me... and the wheel of fire! I can see him... with my waking eyes!<br/>
        <br/>
        Sam: Then let us be rid of it... once and for all! Come on, Mr. Frodo. I can't carry it for you... but I can carry you!&mdash;<em>The Lord of the Rings: The Return of the King</em>",
        "Gandalf: I will not say \"Do not weep\", for not all tears are an evil.&mdash;<em>The Lord of the Rings: The Return of the King</em>",
        "Gandalf: Fool of a Took!&mdash;<em>The Lord of the Rings: The Return of the King</em>",
        "Aragorn: For Frodo.<br/>
        <br/>
        [He charges out towards the remaining army of Morder alone. Merry and Pippin raise their swords and yell then charge. The rest of the soldiers do the same and soon overtake Merry and Pippin]&mdash;<em>The Lord of the Rings: The Return of the King</em>"
    );
    ?>
    <div class="container">
		<div class="fdb-box">
            <?php 
            if($iID == '') {
                echo "<p>".$aQuotes[rand(0,count($aQuotes)-1)]."</p>";
            } else {
                echo "<p>".$aQuotes[$iID]."</p>";
            }
            ?>
		</div>
    </div>
<?php
}
?>
