<?php


$link = mysqli_connect(
    "localhost",                // Host der Datenbank
    "root",                     // Benutzername zur Anmeldung
    "",                   // Passwort
    "emensawerbeseite"       // Auswahl der Datenbanken (bzw. des Schemas)
);


function notTrashmail($email):bool
{
    $blockedDomains = array('rcpt.at', 'damnthespam.at', 'wegwerfmail.de');//Trashmail示例
    $parts = explode("@", $email);//parts是用户名 以@相隔 前面的内容是用户名
    $middlepart=explode(".", $parts[1]);//middlepart是域名 用点号将域名区分开
    if (in_array($parts[1], $blockedDomains)||$middlepart[0]=='trashmail') {
        return false;
    }
return true;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Wunschergericht Eintragen</title>
    <style>
        *{
            font-family: "Comic Sans MS", sans-serif;
        }
        header ul li{
            list-style: none;
            display: inline;
            padding-right: 20px;

        }
        header{
            border-bottom: solid 5px lightseagreen;
            display: grid;
            grid-template-columns: 10em 35em auto;
        }
        header ul{
            padding: 20px;
        }
        header img{
            max-width: 10em;
        }
        footer ul li{
            list-style: none;
            display: inline;
            padding: 10px;
        }
        body footer{
            display: grid;
            border-top: solid 5px lightseagreen;
            padding-left: 10em;
            text-align: center;
            grid-template-columns: 35em auto;
            grid-template-rows: 4em;

        }
        .align_left{
            text-align:center;
        }

    </style>

</head>
<body>
<header>
    <img src="img/front.jpg" alt="logo-FH.jpg">
    <ul>
        <li><a href="#kontakt">Kontakt</a></li>
        <li><a href="index2.php">Homepage</a> </li>
    </ul>

</header>
<main>
    <h2>Wunschgericht</h2>
<form method="post" action="">
    <table>
        <tr>
            <td class="align_left"><label for="name">Name:</label> </td>
            <td> <input type="text" name="name" id="name"</td>
        </tr>
        <tr>
            <td class="align_left"><label for="email">E-Mail<sup>*</sup>:</td>
            <td><input type="email" name="email" id="email" </td>
        </tr>
        <tr>
            <td class="align_left"><label for="gericht_name">Gerichtsname<sup>*</sup>:</label> </td>
            <td><input type="text" name="gericht_name" id="gericht_name"></td>
        </tr>
        <tr>
            <td class="align_left"><label for="beschreibung">Beschreibung</label> </td>
            <td><textarea name="beschreibung" id="beschreibung" rows="4" cols="50"></textarea>
        </tr>
    </table>
    <input type="submit" value="Abschicken">
</form>
    <p><sup>*</sup>Pflicht</p>
    <?php
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $gericht_name = mysqli_real_escape_string($link, $_POST['gericht_name']);
        $beschreibung = mysqli_real_escape_string($link, $_POST['beschreibung']);
        if(notTrashmail(strtolower($email))){
            $problemlose_Emails=mysqli_fetch_assoc(mysqli_query($link, "SELECT count(email) FROM Ersteller WHERE email= '".$email ." ';"))['count(email)'];
            if($problemlose_Emails<1){
                mysqli_query($link, "INSERT INTO Ersteller(name, email) values( '".$name."', '".$email ."' );");
            }
            $Ersteller_ID=mysqli_fetch_assoc(mysqli_query($link,"SELECT Ersteller_ID FROM Ersteller WHERE email= '".$email ."';"))['Ersteller_ID'];
            mysqli_query($link,
                "INSERT INTO wunschgericht(NAME, Beschreibung, Erstellungsdatum, Ersteller_ID) 
                        VALUES ('". $gericht_name ."',
                                '". $beschreibung ."',
                                '". date("Y-m-d") ."',
                                '". $Ersteller_ID ."');");

        }
        else{
            echo "<p style='color:red'>E-Mail ist ungültig!</p>";
        }
    }



    ?>
</main>
<footer id="kontakt">
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li class="lborder">Yisen Fang, Gelun Zheng</li>
        <li class="lborder"><a href="">Impressum</a></li>
    </ul>
</footer>
</body>
</html>
