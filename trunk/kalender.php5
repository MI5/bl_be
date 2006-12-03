<?php

// Test ob die Variable m per Get übergeben wurde.
// m steht für den Monats-offset. Das heißt, wenn m negativ und z.B. -4 ist, dann sind
// wir 4 Monate in der Vegangenheit. Ist m  positiv und z.B. 5 dann sind wir 5 Monate
// in der Zukunft. Beispiel: Der echte aktuelle Monat gerade ist Dezember 2006 und
// m ist gleich 2, dann wird der Monat Februar 2007 dargestellt (Weil wir 2 Monate in
// der Zukunft sind).
if (isset($_GET['m']))
{
    // Für das leichtere arbeiten mit der Variable benutzen wir nur noch $m
    // $m würde auch ohne diese Zuweisung im Normalfall den korrekten Wert
    // enthalten; durch die Zuweisung wird aber sichergestellt, dass $m als
    // get-Variable übergeben wurde und nicht aus einer anderen "gehackten"
    // Quelle stammt, z.B. POST oder COOKIE.
	$m = $_GET['m'];

    // per mktime() ermitteln wir den richtigen Monat. Die ersten 3 Parameter
    // geben Std, Min und Sek an. Hierfür übernehmen wir die aktuelle echte Zeit.
    // Der 4. Parameter ist der Monat. Wir nehmen den aktuellen und addieren den
    // offset drauf. So wird der richtige Monat ermittelt.
    // Der letzte Parameter ist der Tag des Monats. Hier nehmen wir immer den 1. Tag
    // des Monats, denn wenn ich den tatsächlichen heutigen Tag nehmen würde, und es
    // wäre heute z.B. der 31. Tag im Monat und ich würde in der Kalenderansicht zu
    // einem Februar wechseln, dann käme es zu einem Fehler. (Logisch!) 
	$kalZeit = mktime(date("G"),date("i"),date("s"),date("n")+$m,1);

    // $m wird um eines erhöht, damit man im Kalender einen weiteren Monat
    // vorblättern kann.
	$m++;
}
else
{
    // Wenn $m nicht gesetzt ist, dann ermitteln wir den aktuellen echten Monat mit
    // time().
	$kalZeit = time();

    // $m wird gesetzt damit in den Vor- und Zurück-Links in der Kalender-Ansicht
    // korrekt zum nächsten Monat gewechselt werden kann.
    $m = 1;
}
if (isset($_GET['day']))
{
	$day = $_GET['day'];
}
else
{
    $day = 0;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="de">
  <head>
    <title>Kalender</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>

    <table>

        <caption>
          <a href="<?=$PHP_SELF?>?m=<?=$m-2?>">
            <img src="bilder/rueck.gif" alt="" width="10" height="10" border="0" />
          </a>
          <b>
            <?php
            // In der Caption geben wir Den Monatsnamen und die Jahreszahl aus. 
            echo date("M Y", $kalZeit);
            ?>
          </b> 
          <a href="<?=$PHP_SELF?>?m=<?=$m?>">
            <img src="bilder/vor.gif" alt="" width="10" height="10" border="0" />
          </a>        
        </caption>

        <tr>
          <th>Mo</th><th>Di</th><th>Mi</th><th>Do</th><th>Fr</th><th>Sa</th><th>So</th>
        </tr>

        <tr>
        <?php
        // Wir müssen in der Tabelle so viele leere Zellen ausgehen, wie wir entfernt
        // von Montag sind.
        // Ist der 1. ein Montag, dann natürlich keine. Ist der 1. ein Mittwoch, dann
        // sind es 2.
        // Das switch ist bewusst ohne break! So dass man durch den Code "durchfällt"
        // und so automatisch die korrekte Anzahl an leeren Zellen ermittelt wird.
        switch (date("D", $kalZeit))
        {
        	case "Sun": echo "<td class=\"aux\" />\n";
        	case "Sat": echo "<td class=\"aux\" />\n";
        	case "Fri": echo "<td class=\"aux\" />\n";
        	case "Thu": echo "<td class=\"aux\" />\n";
        	case "Wed": echo "<td class=\"aux\" />\n";
        	case "Tue": echo "<td class=\"aux\" />\n";
        	case "Mon": ;
        }

        // Ich muss einen offset ermitteln, damit ich immer an einem Sonntag einen
        // Tabellenumbruch einfügen kann. Diesen Offset kann ich NICHT in das obere
        // Switch mit aufnehmen, da ich dort ja "durchfalle", ich beim setzen des
        // offsets dies aber nicht darf.
        switch (date("D", $kalZeit))
        {
        	case "Sun": $offset = 6; break;
        	case "Sat": $offset = 5; break;
        	case "Fri": $offset = 4; break;
        	case "Thu": $offset = 3; break;
        	case "Wed": $offset = 2; break;
        	case "Tue": $offset = 1; break;
        	case "Mon": $offset = 0; break;
        }

        //$i soll auch nach der Schleife noch bekannt sein. KA ob das bei php nötig ist
        $i = 0;

        // Ich gehe i durch von 1 bis zur Anzahl der Tage, die der Monat hat.
        // date("t") sagt mir die Anzahl der Tage die der Monat hat. 
        for ($i=1;$i<=date("t", $kalZeit);$i++)
        {
            // Ich gebe den Tag als Zelle aus
            if ($i == date("j", $kalZeit)) {
        	    echo "<td class=\"heute\"><a href=\"$PHP_SELF?m=".($m-1)."&day=$i\">$i</a></td>\n";
            }
            else {
        	    echo "<td><a href=\"$PHP_SELF?m=".($m-1)."&day=$i\">$i</a></td>\n";
            }

        	// An jedem Sonntag ( % 7) füge ich einen Tabellen-umbruch ein.
        	// Aber nicht dann wenn es sich um den letzten Tag des Monats handelt.
        	// z.B. 31., weil dann folgt ja keine weitere Zeile
        	if (($i+$offset) % 7 == 0 && $i != date("t", $kalZeit))
        	  echo "</tr><tr>\n";
        }

        // Jetzt muss ich noch so viele leere Zellen einfügen, wie Tage bis zum
        // Sonntag fehlen, damit die Tabellenlogik stimmt. Am besten versteht man
        // was hiermit gemeint ist, wenn man sich den Kalender anschaut.
        while (($i+$offset-1) % 7 != 0)
        {
            $i++;
            // Fügt eine leere Zelle ein.
            echo "<td class=\"aux\" />\n";
        }
        ?>
        </tr>
    </table>




    <div class="buttonpos">
		<a href="test1.php" class="button">Login</a>
    	<a href="test2.php" class="button">Logout</a>
		<a href="test2.php" class="button">Einstellungen</a> 
	   	<br /><br />
	  	<a href="test.php" class="button">Neuer Termin</a>
	  	<a href="test.php" class="button">Neuer Geburtstag</a>
	  	<a href="test.php" class="button">Neues ToDo</a>
    </div>
	 
	<div class="terminpos">
	    <span class="termin">
			<?php
			    if ($day != 0) {
			        echo "Termine für den ".$day.". ".date("M Y", $kalZeit);
			    }
			?> 
		</span>
    </div>
	</body>	
</html>