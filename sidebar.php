<?php

require_once('functions.php');

?>

<?php echo "You are logged in as ".$player->name.". ";
	
		if ($player->landed == 0) {
			echo "You are in the ".$systems[$player->location_syst - 1]->name." system. ";
		}
		elseif ($player->landed == 1) {
			echo "You are ".landverb($spobs[$player->location_spob - 1]->type, "past")." ".spobTitle($spobs[$player->location_spob - 1]->type)." ".$spobs[$player->location_spob - 1]->name." in the ".$systems[$player->location_syst - 1]->name." system. ";
		}
		//print_r($spobs);
	
		echo "You have ".$player->credits." credits. ";
		
		echo "You have ".floor($player->fuel)." units of  fuel (out of ".$ships[$player->ship - 1]-> fueltank." total) remaining. ";
		
		
		
		echo "<a style='color: white; background: red;' href='#' onClick='selfDestruct()' title='Hello darkness my old friend...'>Self destruct</a><br>";
		
		//echo "You literally just <span class='msg'></span>";
	
		echo "You are piloting a ".$ships[$player->ship - 1]-> name.", the <em>".$governments[$player->government - 1]->isoname." ".$player->vessel."</em><br>";
		
		echo " <a href='#' onclick='loadContent(\"navigation\")'>Navigation Console</a>";
		
		if (($player->fuel < $ships[$player->ship - 1]-> fueltank) && ($player->landed == 1)) {
			echo " <a href='#' onClick='reFuel()'>Refuel</a> ";
		}
		
		if ($player->landed == 1) {
			echo " <a href='#' onclick='loadContent(\"shipyard\")'>Shipyard</a>";
		}
		
		if (($player->landed == 1)) {
		    echo " <a href='#' onclick='loadContent(\"bar\")'>Visit the spaceport bar</a>";
		}
		
		echo "<br>";
		echo "<span style='color: white; background: black; font-family: Monospace'> This is ".GAME_NAME." version ".VERSION."</span>";
?>

