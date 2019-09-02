<?php
function ContentSlides_Config() {
    draw_text('Configuration closed for the moment!');
}

function ContentSlides() {
    ?>
    <script>
        var ow_opacity = 1.0;
        var ow_fade_state = 0;
        var ow_fade_done = false;

        function our_work(page) {
            if(ow_fade_state == 0) {
                if(ow_opacity >= 0) {
                    ow_opacity -= .1;
                    setTimeout(function() { our_work(page) }, 38);
                } else {
                    ow_fade_state = 1;
                    ow_fade_done  = true;
                    our_work(page);
                }
            } else if(ow_fade_state == 1) {
                if(ow_opacity < 1) {
                    ow_opacity += .1;
                    setTimeout(function() { our_work(page) }, 38);
                } else {
                    ow_fade_state = 0;
                }
            }
            document.getElementById('ow-heading').style.opacity = ow_opacity;
            if(ow_fade_done) {
                var html_content = "";

                if(page == 1) {
                    document.getElementById("ow-heading").innerText = "Unsere Arbeit.";
                } else if(page == 2) {
                    document.getElementById("ow-heading").innerText = "Unser Versprechen.";
                }

                ow_fade_done = false;
            }
        }
    </script>
    <section class="full-page mt-5" id="what-we-do">
        <!-- <div class="black-outline"></div> -->
        <div class="content text-align-center">
            <h1 id="ow-heading">Unsere Arbeit.</h1>
            <ul class="content-nav">
                <li class="float-left"><a class="btn btn-med btn-dark btn-longtext shadow-sm" onclick="our_work(1)">Fläche- und Trümmersuche</a></li>
                <li class="ml-5 float-left"><a class="btn btn-med btn-dark btn-longtext shadow-sm" onclick="our_work(2)">Mantrailing</a></li>
                <!-- <li class="ml-5 float-left"><a class="content-nav-elements" onclick="our_work(3)">Vorstand</a></li> -->
            </ul>
            <div class="mt-5 inner-page-np">
                <div class="our-work-heading-gray">
                    <h2>Die Voraussetzung der erfolgreichen Rettungshundearbeit ist das gänzliche Vertrauen zwischen Hundeführer und Hund.</h2>
                </div>
                <div class="our-work-text-grid our-work-text-grid-blue">
                    <p>
                        Es gibt hinsichtlich Rasse und Geschlecht keinerlei Einschränkungen, um ein erfolgreiches Rettungsteam zu werden, sofern der Vierbeiner Spaß an der Nasenarbeit hat.
                        Auch ein ausgeprägter Such- und Stöbertrieb, sowie ein gewisser Kampf- und Beutetrieb können von Vorteil sein. Um die Synergie zwischen den Partnern zu steigern, 
                        gibt es einige Prüfungen, für die wir gemeinsam trainieren. Beginnend mit der Begleithunde-Prüfung, die der Vierbeiner ab dem 15. Monat absolvieren kann. Sofern das
                        Team diese besteht kann es die Vorprüfung ablegen, die jeweils die Grundlage für die Flächen- und Trümmerprüfung bildet.
                    </p>
                    <div class="our-work-image">
                        <img src="media/Fläche.JPG" width="100%" />
                    </div>
                </div>
                <div class="our-work-text-grid our-work-text-grid-green">
                    <h2>Was möchte ich mit meinem Hund machen?</h2>
                    <h2>Unter welchen Umständen fühlen wir uns wohl bei der Arbeit?</h2>
                    <p>
                        Hierbei ist zu beachten, dass wir immer auf die Wünsche des Hundes eingehen. Es macht keinen Sinn, einen Hund in den Wald zu schicken, der sich aber in den Trümmern
                        viel wohler fühlt. <strong>Nur ein Hund, der sich bei der Arbeit wohl fühlt, macht seinen Job gut und sicher, wie bei uns Menschen auch.</strong>
                    </p>
                </div>
                <div class="our-work-text-grid our-work-text-grid-gray">
                    <h2>Was ist Flächen- und Trümmersuche?</h2>
                    <p>
                        Die Flächensuche findet im Wald statt, wobei der Hund völlig autark (ohne Leine) agieren kann. Seine Aufgabe ist es hilfsbedürftige Menschen aufzuspüren und diese 
                        anzuzeigen (z.B. durch Bellen), sodass wir zur Hilfe eilen können.
                    </p>
                    <div class="our-work-image">
                        <img src="media/Fläche_2.jpg" width="100%" />
                    </div>
                    <p>
                        Die Trümmersuche ähnelt der Flächensuche stark, unterscheidet sich jedoch im jeweiligen Einsatzgebiet. So findet sie z.B. Anwendung in eingestürzten Häusern, 
                        Erdbebengebieten, verlassenen Lagerhallen etc. Sie erfordert mehr Aufmerksamkeit bei Hund und Hundeführer.
                    </p>
                    <div class="our-work-image">
                        <img src="media/Trümmer.jpg" width="100%" />
                    </div>
                    <p>
                        Nicht nur Hund, sondern auch der Hundeführer durchlaufen eine Ausbildung. Grundvoraussetzung bildet hierbei der Suchtrupphelfer, welcher folgende Gebiete umfasst: 
                        <strong>Umgang mit Karte/Kompass, Funken, Umgang mit GPS, Erste-Hilfe am Hund und am Menschen</strong>. Optionale Weiterbildungen stellen die Ausbilder*innen Karriere, der 
                        Gruppenführer*innen oder sogar der Einsatzleiter*innen-Werdegang dar.
                    </p>
                    <div class="our-work-image">
                        <img src="media/Suchtrupp.jpeg" width="100%" />
                    </div>
                </div>
                <div class="our-work-text-grid our-work-text-grid-purple">
                    <h2>Ist die Rettungshundearbeit das Richtige für uns?</h2>
                    <p>
                        Es sei zu beachten das die Rettungshundearbeit nichts für Einzelkämpfer ist. Wir sind alle ein Team, wir werden alle geschlossen als Staffel in den Einsatz 
                        gerufen und beenden diesen auch geschlossen! 
                    </p>
                    <div class="our-work-image">
                        <img src="media/Teamwork.jpg" width="100%" />
                    </div>
                    <p>
                        Die Rettungshundearbeit geht mit einer gewissen Verantwortung und vor allem einem Versprechen einher. Sie nimmt viel Zeit in Anspruch und ist daher nicht 
                        mit einem Hundesportverein vergleichbar.

                        Das Training findet meistens am Wochenende statt, deshalb sollte man sich folgende Fragen stellen:
                        Wie geht es der Familie damit?

                        Wie sieht es mit dem/der Arbeitgeber*in aus? Würde er/sie mich freistellen, um bei einem Einsatz während der Arbeitszeit zu helfen? Wie sieht es mit 
                        Auslandseinsätzen aus?
                    </p>
                </div>
                <div class="our-work-text-grid our-work-text-grid-light-blue">
                    <h2>Wenn du diese Fragen alle beantwortet hast, dann steht der spannenden und abwechslungsreichen Rettungshundearbeit nichts mehr im Wege!</h2>
                    <p>
                        <a href="#what-we-do" class="btn btn-dark btn-longtext shadow-sm" onclick="our_work(1)">Fläche- und Trümmersuche</a>
                        <a href="#what-we-do" class="btn btn-dark btn-longtext shadow-sm" onclick="our_work(2)">Mantrailing</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>