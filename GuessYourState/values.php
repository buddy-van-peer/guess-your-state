<?php
// Get connection script
include "connect.php";

// Values to insert into database
$swimwearValue = "''";
$potatoValue = "''";
$drinkValue = "''";
$sausageValue = "''";
$danceValue = "''";
$shopValue = "''";
$playgroundValue = "''";

$westernAustralia = 0;
$northernTerritory = 0;
$southAustralia = 0;
$queensland = 0;
$newSouthWales = 0;
$victoria = 0;
$australianCapitalTerritory = 0;
$tasmania = 0;

$lastID = 0;

// Checks if all radio buttons are checked
function radiosChecked()
{
	if (isset($_POST['swimwear']) && isset($_POST['potato']) && isset($_POST['drink']) && isset($_POST['sausage']) 
		&& isset($_POST['dance']) && isset($_POST['shop']) && isset($_POST['playground']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

if (isset($_POST['submit']) && radiosChecked())
{		
	switch ($_POST['swimwear'])
	{
		case "bathers":				
			$swimwearValue = "'Bathers'";								
			break;
		case "swimmers":
			$swimwearValue = "'Swimmers'";
			break;
		case "togs":
			$swimwearValue = "'Togs'";
			break;
		case "cossie":
			$swimwearValue = "'Cossie'";
			break;
		case "other":
			break;			
	}
	
	switch ($_POST['potato'])
	{
		case "potato cake":
			$potatoValue = "'Potato Cake'";
			break;
		case "potato scallop":
			$potatoValue = "'Potato Scallop'";
			break;
		case "potato fritter":
			$potatoValue = "'Potato Fritter'";
			break;
		case "other":
			break;
	}

	switch ($_POST['drink'])
	{
		case "bubbler":
			$drinkValue = "'Bubbler'";
			break;
		case "drinking fountain":
			$drinkValue = "'Drinking Fountain'";
			break;
		case "water fountain":
			$drinkValue = "'Water Fountain'";
			break;
		case "other":
			break;
	}

	switch ($_POST['sausage'])
	{
		case "sausage in bread":				
			$sausageValue = "'Sausage in Bread'";								
			break;
		case "sausage sandwich":
			$sausageValue = "'Sausage Sandwich'";
			break;
		case "sausage sizzle":
			$sausageValue = "'Sausage Sizzle'";
			break;			
		case "other":
			break;
	}
	
	switch ($_POST['dance'])
	{
		case "pants":				
			$danceValue = "'Pants'";								
			break;
		case "aunts":
			$danceValue = "'Aunts'";
			break;			
		case "other":
			break;
	}
	
	switch ($_POST['shop'])
	{
		case "corner":				
			$shopValue = "'Corner Store'";								
			break;
		case "milk bar":
			$shopValue = "'Milk Bar'";
			break;
		case "deli":
			$shopValue = "'Deli'";
			break;			
		case "other":
			break;
	}
	
	switch ($_POST['playground'])
	{
		case "slide":				
			$playgroundValue = "'Slide'";								
			break;
		case "slippery":
			$playgroundValue = "'Slippery Dip'";
			break;			
		case "other":
			break;
	}
		
	$insertQuery = "INSERT INTO Results (Swimwear, Potato, Drink, Sausage, Dance, Shop, Playground)
	VALUES ($swimwearValue, $potatoValue, $drinkValue, $sausageValue, $danceValue, $shopValue, $playgroundValue);";
	
	// Enters user's input data into the database and grabs the UserID for that record
    if (mysqli_query($conn, $insertQuery))
	{
		$lastID = mysqli_insert_id($conn);		
	}
	
	$selectQuery = "SELECT * FROM Results WHERE UserID = $lastID";
	
	$result = mysqli_query($conn, $selectQuery);
	
	if (mysqli_num_rows($result) > 0)
	{
        // Assign variables
        while ($row = mysqli_fetch_assoc($result))
		{
            $swimwear = $row['Swimwear'];
            $potato = $row['Potato'];
            $drink = $row['Drink'];
            $sausage = $row['Sausage'];
            $dance = $row['Dance'];
            $shop = $row['Shop'];
            $playground = $row['Playground'];                            
        }

		switch ($swimwear)
		{
			case "Bathers":
				$westernAustralia++;
				$northernTerritory++;
				$victoria++;
				$tasmania++;
				$southAustralia++;
				break;
			case "Swimmers":
				$newSouthWales++;
				$australianCapitalTerritory++;
				break;
			case "Togs":
				$queensland = $queensland + 2;
				break;
			case "Cossie":
				$newSouthWales++;
				break;			
		}
		
		switch ($potato)
		{
			case "Potato Cake":
				$northernTerritory++;
				$victoria++;
				$tasmania++;
				break;
			case "Potato Scallop":
				$westernAustralia++;
				$queensland++;
				$newSouthWales++;
				$australianCapitalTerritory++;
				break;
			case "Potato Fritter":
				$southAustralia++;
				break;
		}
		
		switch ($drink)
		{
			case "Bubbler":
				$northernTerritory++;
				$queensland++;
				$newSouthWales++;
				$australianCapitalTerritory++;
				break;
			case "Drinking Fountain":
				$westernAustralia++;
				$victoria++;
				$tasmania++;
				$southAustralia++;
				break;
			case "Water Fountain":
				$westernAustralia++;
				$southAustralia++;
				break;			
		}
		
		switch ($sausage)
		{
			case "Sausage in Bread":
				$queensland++;
				$victoria++;
				$tasmania++;
				$southAustralia++;
				break;
			case "Sausage Sandwich":
				$northernTerritory++;
				$newSouthWales++;
				$australianCapitalTerritory++;
				break;
			case "Sausage Sizzle":
				$westernAustralia++;				
				break;			
		}		
		
		switch ($dance)
		{
			case "Aunts":				
				$southAustralia++;
				break;				
		}
		
		switch ($shop)
		{
			case "Corner Store":
				$northernTerritory++;
				$queensland++;
				$newSouthWales++;
				$australianCapitalTerritory++;
				$tasmania++;
				break;
			case "Milk Bar":
				$victoria++;
				break;
			case "Deli":
				$westernAustralia++;
				$southAustralia++;
				break;			
		}
		
		switch ($playground)
		{
			case "Slippery Dip":
				$northernTerritory++;
				$queensland++;
				$newSouthWales++;
				$australianCapitalTerritory++;
				$southAustralia++;
				break;
			case "Slide":
				$westernAustralia++;
				$australianCapitalTerritory++;
				$victoria++;
				$tasmania++;
				break;		
		}			
		
		// Put each variable value into an array with the variable name as the key
		$array = compact('newSouthWales','victoria', 'queensland', 'westernAustralia', 'southAustralia', 'tasmania', 'australianCapitalTerritory', 'northernTerritory');
		
		// Find's the highest value(s) from the array and gets the key(s)
		$highestKeys = array_keys($array, max($array));
						
		/* Grammaticises $highestKeys[] by capitalising the first letter of the word
		 * and adding a space before every capital letter afterwards
		 * eg: newSouthWales becomes New South Wales. */

		echo "<br><center>I guess:<br><b>";
		for ($i = 0; $i < count($highestKeys); $i++)
		{
			if ($i < (count($highestKeys) - 1))
			{
				$state = print_r(preg_replace('/(?<!\ )[A-Z]/', ' $0', ucfirst($highestKeys[$i])) . " </b>or<b><br>");
			}
			else
			{
				$state = print_r(preg_replace('/(?<!\ )[A-Z]/', ' $0', ucfirst($highestKeys[$i])));
			}			
		}
		echo "</b></center>";		
	}
}
else if (isset($_POST['submit']) && !radiosChecked())
{
	echo "<span>Please select an option from every question</span>";
}
?>