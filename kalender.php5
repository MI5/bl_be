<?php

if (isset($_GET['m']))
{
	$m = $_GET['m'];

	$kalZeit = mktime(date("G"),date("i"),date("s"),date("n")+$m);

	$m++;
}
else
{
	$m = 1;
	$kalZeit = time();
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
            <?php echo date("M Y", $kalZeit);  ?>
          </b>
          <a href="<?=$PHP_SELF?>?m=<?=$m?>">
            <img src="bilder/vor.gif" alt="" width="10" height="10" border="0" />
          </a>        
        </caption>

        <tr>
          <th>Mo</th><th>Di</th><th>Mi</th><th>Do</th><th>Fr</th><th>Sa</th><th>So</th>
        </tr>
        
        /**
         * Geht von 1-31 die Tage durch. Setzt ein Offset.
         * Alle 7 ein Umbruch. .... 
         */
        <tr>
          <td class="aux" />
          <td class="aux" />
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>5</td>
        </tr>
        <tr>
          <td>6</td>
          <td>7</td>
          <td>8</td>
          <td>9</td>
          <td>10</td>
          <td>11</td>
          <td>12</td>
        </tr>
        <tr>
          <td>13</td>
          <td>14</td>
          <td>15</td>
          <td>16</td>
          <td>17</td>
          <td>18</td>
          <td>19</td>
        </tr>
        <tr>
          <td>20</td>
          <td>21</td>
          <td>22</td>
          <td>23</td>
          <td>24</td>
          <td>25</td>
          <td>26</td>
        </tr>
        <tr>
          <td>27</td>
          <td>28</td>
          <td>29</td>
          <td>30</td>
          <td>31</td>
          <td class="aux" />
          <td class="aux" />
        </tr>
        <tr>
          <td class="aux" />
          <td class="aux" />
          <td class="aux" />
          <td class="aux" />
          <td class="aux" />
          <td class="aux" />
          <td class="aux" />
        </tr>
    </table>

 
  
  	<div class="buttonpos">
			<span class="button">
		  		<a href="test1.php">Button 1</a>
	  	</span>	
			<span class="button">
		  		<a href="test2.php">Button 2</a>
	  	</span>	
	 		<span class="button">
		  		<a href="test.php">Button 3</a> 
	   	</span>	
	   	<br /><br />
	 		<span class="button">
		  		<a href="test.php">Button 4</a>
	  	</span>	
	  		 		<span class="button">
		  		<a href="test.php">Button 5</a>
	  	</span>	
	  		 		<span class="button">
		  		<a href="test.php">Button 6</a>
	  	</span>	
	  </div>
  



	</body>	
</html>