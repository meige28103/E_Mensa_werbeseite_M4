<?php
$link=mysqli_connect("localhost",
    "root",
    "",
    "emensawerbeseite"
);
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
/**
 * Praktikum DBWT . Autoren:
 * Yisen Fang, 3575875
 * Gelun Zheng, 3308763
 */
echo "Test";
const POST_PARAM_VORNAME="vorname";
const POST_PARAM_EMAIL="email";
const POST_PARAM_SPRACHE="sprache";
const GET_PARAM_SORTIERUNG="sortierung";
function validate($vorname,$email,$sprache):string
{
    if(!ctype_alpha($vorname)){
        return "Name darf keine Sonderzeichen enthalten!";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "Ungültige E-Mail-Adresse!";
    }
    else if(str_contains($email, "wegwerfmail")===true|| str_contains($email, "trashmail")===true){
        return "Ungültige E-Mail-Adresse!";
    }
    $newsletter=fopen("Newsletter.txt", "a");
    $kunden="";
    $kunden.=$vorname;
    $kunden .= ",";
    $kunden.=$email;
    $kunden .= ",";
    $kunden.=$sprache;
    $kunden.="<br>";
    fwrite($newsletter, $kunden);
    fclose($newsletter);
    return "Anmeldung erfolgt!";
}
?>
    <!DOCTYPE html>
    <!--
    -Praktikum DBWT. Autoren:
    -Fang, Yisen, 3575875
    -Zheng, Gelun, 3308763
    -->
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>index</title>
        <style>
            *{
                font-family: "Comic Sans MS", sans-serif;
            }
            nav{
                height: 70px;
                border-bottom: 1px solid gray;
            }
            .navi_logo{
                position:absolute;
                left:0;
                top:0;
                width:15%;
            }
            .navi_logo img{
                text-align: center;
                width:auto;
                max-height: 50px;
            }
            .navi_link{
                display: inline;
                position:absolute;
                left:15%;
                width: 70%;
                margin:auto;
                height:50px;
                border: 1px solid black;
            }
            .links{
                position: absolute;
                line-height: 50px;
            }
            .links a{
                color: darkcyan;
                padding-inline: 10px;
            }
            main{
                width: 70%;
                margin-left: 15%;
                margin-right: 15%;
            }
            .front img{
                width: 100%;
                height: auto;
            }
            .text_with_border{
                border: 1px solid black;
            }
            .tableprice
            {
                margin: auto;
                border: 1px solid black;
                border-collapse: collapse;
                width:100%;
            }
            .tableprice thead td{
                border:1px solid gray;
                border-collapse: collapse;
            }
            .tableprice tbody td{
                border:1px solid gray;
                border-collapse: collapse;
            }
            .summary li{
                display: inline-block;
                width: 15%;
            }
            .counts{
                text-align: right;
            }
            .newsletter{
                display:inline-grid;
                grid-template-rows: auto auto;
            }
            .klick{
                position: absolute;
                right:17%;
            }

            .slogan ul{
                margin-left:25%;
                margin-right: 25%;
            }
            h1{
                text-align: center;
            }
            footer{
                border-top: 1px solid gray;
            }
            .end{
                text-align: center;
            }
            .end li{
                font-size: small;
                display: inline;
                text-decoration: none;
            }
            span{
                padding-right: 5px;
                border-right: 1px solid darkcyan;
            }
            .anmeldungnewsletter{
                position: relative;
                top: 10px;
            }
            #nachrichten{
                border: black 1px solid;
                background-color: darkcyan;
                text-align: center;
            }
        </style>

    </head>
    <body>
    <nav>
        <div class="navi_logo">
            <img src="img/logo-FH.png"  alt="logo">
        </div>
        <div class="navi_link">
            <div class="links">
                <a href="www.mcdonalds.de/ankuendigung">Ankündigung</a>
                <a href="www.mcdonalds.de/speisen">Speisen</a>
                <a href="www.mcdonalds.de/zahlen">Zahlen</a>
                <a href="www.mcdonalds.de/kontakt">Kontakt</a>
                <a href="www.mcdonalds.de/wichtig_fuer_uns">Wichtig für uns</a>
            </div>
        </div>
    </nav>
    <br>
    <main>
        <div class="front">
            <img src="img/front.jpg" alt="frontpage">
        </div>
        <h2>Bald gibt es Essen auch online ;)</h2>
        <div class="text_with_border">
            <p>In neun Mensen, sieben Cafeterien und vier Kaffeebars bieten wir unseren Gästen aus Aachen und Jülich eine große Auswahl an gesunder und abwechslungsreicher Verpflegung, die nicht nur gut schmeckt, sondern darüber hinaus besonders günstig ist. Bei uns erhalten Sie viele Gerichte der internationalen Küche, leckeres aus dem WOK oder vom Grill sowie Pizza und Pasta. </p>
            <p>Wir legen Wert auf gesunde, ökologisch wertvolle und nachhaltig produzierte Zutaten. Vegetarische und vegane Gerichte gehören deswegen zum festen Bestandteil des Mensa-Speiseplans. In unseren Cafeterien bekommen unsere Gäste schon morgens früh frischen Kaffee, belegte Brötchen, süßes Gebäck und andere Snacks. Zum Entspannen laden unsere Kaffeebars ein: Dort gibt es in geselliger Lounge-Atmosphäre ausgewählte Kaffeespezialitäten, viele verschiedene Teesorten und leckere Snacks.</p>
            <p>Wir wollen, dass es an der Kasse schnell geht und unsere Gäste zügig an den Tisch gelangen. Deswegen kann man in vielen unserer Einrichtungen bequem und unkompliziert mit der BlueCard, FH Karte, Studierendengastkarte oder der Gastkarte zahlen.</p>
            <p>Wir wünschen einen guten Appetit!</p>
        </div>
        <h2>Köstlichenkeiten, die Sie erwarten</h2>
        <form method="get">
            <input type="submit" id="sortierung" name="sortierung" value='auf'>
            <input type="submit" id="sortierung" name="sortierung" value='ab'>
        </form>
        <table class="tableprice" id="menu">
            <thead>
            <tr>
                <td>Gerichtsname</td>
                <td>Preis intern</td>
                <td>Preis extern</td>
                <td>Allergene</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $default_sortierung='auf';
            if(isset($_GET[GET_PARAM_SORTIERUNG])){
                $default_sortierung=$_GET[GET_PARAM_SORTIERUNG];
                if($default_sortierung=='auf'){$sql="SELECT name, preisintern, preisextern, group_concat(code) AS gcode FROM gericht
INNER JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id  
GROUP BY name
ORDER BY name 
LIMIT 5
";
                }
                elseif ($default_sortierung=='ab'){
                    $sql="SELECT name, preisintern, preisextern, group_concat(code) AS gcode FROM gericht
INNER JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id  
GROUP BY name
ORDER BY name DESC
LIMIT 5";
                }}
            else{
                $sql="SELECT name, preisintern, preisextern, group_concat(code) AS gcode FROM gericht
INNER JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id  
GROUP BY name
ORDER BY name
LIMIT 5
";
            }


            $result=mysqli_query($link, $sql);
            $allergen_array=[];
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td style='text-align: left;'>" . $row["name"] . "</td>";
                echo "<td>" . $row["preisintern"] . "€</td>";
                echo "<td>" . $row["preisextern"] . "€</td>";
                echo "<td>" . $row["gcode"] . "</td>";
                $allergen_array[] = $row["gcode"];
                echo "</tr>";
            }
            $allergen_string=implode(",", $allergen_array);
            $allergen_array=explode(",", $allergen_string);
            $allergen_string=implode("','", $allergen_array);
            $allergen_string="'".$allergen_string."'";
            ?>
            </tbody>
        </table>
        <h3>Allergen:</h3>
        <ul>
            <?php
            $sql_allergen="SELECT name, code FROM allergen WHERE code IN ($allergen_string)";
            $result_allergen=mysqli_query($link, $sql_allergen);
            mysqli_query($link, $sql_allergen);
            while ($row = mysqli_fetch_assoc($result_allergen)) {
                echo "<li>" . $row["code"].": ".$row["name"] . "</li>";
            }
            ?>
        </ul>
        <h2>E-Mensa in Zahlen</h2>
        <ul class="summary">
            <li class="counts"><?php
                mysqli_query($link, "UPDATE anzahl_der_besucher SET anz_besucher = anz_besucher + 1;");
                $anzahl_visitor = mysqli_fetch_assoc(mysqli_query($link, "SELECT anz_besucher FROM anzahl_der_besucher;"));//
                echo $anzahl_visitor["anz_besucher"];

                ?></li>
            <li>Besuche</li>
            <li class="counts">
                <?php
                $anz_newsletter = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(vorname) AS anzahl FROM newsletter;"))['anzahl'];
                echo $anz_newsletter;
                ?>
            </li>
            <li class="anmeldungnewsletter">Anmeldungen zum Newsletter</li>
            <li class="counts"> <?php
                $anz_gerichte = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(id) AS anzahl FROM gericht;"))['anzahl'];//用表格里的gericht.id来统计有多少个菜品
                echo $anz_gerichte;
                ?>
            </li>
            <li>Speisen</li>
        </ul>
        <h2>Interesse geweckt? Wir informieren Sie!</h2>
        <form method="post" action="">
            <div class="newsletter">
                <label for="vorname">Ihr Name:</label>
                <input class="vorname" name ="vorname" id ="vorname" placeholder="vorname" required>
            </div>
            <div class="newsletter">
                <label for="email">Ihr E-Mail:</label>
                <input id ="email" name="email" required>
            </div >
            <div class="newsletter">
                <label for="sprache">Newsletter bitte in:</label>
                <select id="sprache" name="sprache">
                    <option value="DE" selected>Deutsch</option>
                    <option value="EN">Englisch</option>
                    <option value="CN">Chinesich</option>
                </select>
            </div >
            <br>
            <br>
            <label for="kreuz"></label>
            <input id="kreuz" type="checkbox" required>
            <label> Die Datenschutzbestimmung stimme ich zu</label>
            <input class="klick" type="submit" value="Zum Newsletter anmelden" >
        </form>
        <div id="nachrichten">
            <?php     if(!empty($_POST[POST_PARAM_VORNAME])&&!empty($_POST[POST_PARAM_EMAIL])){
                $vorname = $_POST[POST_PARAM_VORNAME];
                $email = $_POST[POST_PARAM_EMAIL];
                $sprache = $_POST[POST_PARAM_SPRACHE];
                echo validate($vorname, $email,$sprache);
            } ?>
        </div>
        <h2>Das ist uns wichtig</h2>
        <div class="slogan">
            <ul>
                <li>Beste frische saisonale Zutaten</li>
                <li>Ausgewagene abwechsekungsreiche Gericht</li>
                <li>Sauberkeit</li>
            </ul>
        </div>
        <h1 >Wir freuen uns auf Ihren Besuch!</h1>
    </main>
    <footer>
        <ul class="end">
            <li class><span>(c)E-Mensa GmbH</span></li>
            <li class><span>Fang und Zheng</span></li>
            <li class> <a href="www.mcdonalds.de/speisen">Impression</a></li>
        </ul>
    </footer>
    </body>
    </html>
<?php
mysqli_free_result($result);
mysqli_close($link);
?>