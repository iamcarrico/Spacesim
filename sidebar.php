<?php

require_once('functions.php');

?>

<div class="headbar">

<?php echo "You are logged in as ".$player->name.". ";
	
		if ($player->landed == 0) {
			echo "You are in the ".$systems[$player->location_syst - 1]->name." system. ";
		}
		elseif ($player->landed == 1) {
			echo "You are ".landverb($spobs[$player->location_spob - 1]->type, "past")." ".spobTitle($spobs[$player->location_spob - 1]->type)." ".$spobs[$player->location_spob - 1]->name." in the ".$systems[$player->location_syst - 1]->name." system. ";
		}
		//print_r($spobs);
	
		echo "You have ".$player->credits." credits. ";
		
		echo "You have ".floor($player->fuel)." jumps remaining. ";
		
		if (($player->fuel < $maxFuel) && ($player->landed == 1)) {
			echo "<a href='#' onClick='reFuel()'>Refuel</a> ";
		}
		
		echo "<a style='color: white; background: red;' href='#' onClick='selfDestruct()' title='Hello darkness my old friend...'>Self destruct</a><br>";
		
		//echo "You literally just <span class='msg'></span>";
	
		echo "You are piloting a ".$ships[$player->ship - 1]-> name.", the <em>".$governments[$player->government - 1]->isoname." ".$player->vessel."</em>";
		
		if ($player->landed == 1) {
			echo "<a href='#' onclick='shipyard()'> Shipyard</a>";
		}
?>

</div>


<?

if (!isLanded() && (!transitCheck())) { 
	
?>

<h1>Systems</h1>
		<table class="table table-condensed table-bordered">
		<?php 
		
			foreach ($systems as $system) {
			
			if (in_array(($system->id), $jumps)) {
				if ($player->location_syst == $system->id) {
					echo "<tr class='hilight' style='background-color: ".$governments[$system->government - 1]->color."'>";
				}
				else {
					echo "<tr style='background-color: ".$governments[$system->government - 1]->color.";'>";
				}
				echo "<td>System ".$system->name;
				
					if (($player->landed == 0) && ($player->location_syst != $system->id)) {
							echo " <a href='#' onclick='jumpLink(".$system->id.")'>Jump</a>";
						}
				
				echo "<br>Controlled by ".$governments[$system->government - 1]->name."</td></tr>";
				
				}
			}

		?>
		</table>
		
		<table class="table table-condensed table-bordered">
		<?php 
		if((empty($pilots)) || ($pilots[$player->id - 1]->name == $player->name)) {
			echo "No other pilots detected in this system.";
		}
		else {
			echo "<span style='color: red'>Alert!</span> Other pilots detected in system!<br>";
			
			//print_r($governments);
			foreach ($pilots as $pilot) {
				if (($player->name != $pilot->name) && ($pilot->landed == 0)) {
					echo "<li style='color: ".$governments[$pilot->government - 1]->color."' title='Affiliated with ".$governments[$pilot->government - 1]->name."'>".$pilot->name.",
					piloting a ".$ships[$pilot->ship - 1]->name.", the <em>".$governments[$pilot->government - 1]->isoname." ".$pilot->vessel."</em></li>";
				}
			}

		}
		
		?>
		</table>
		
		<?php }
		
		else {
		}
		
		 if (!transitCheck()) {?>
		
		<h1>Attractions
			<small><?php
			
			if ($player->landed > 0) {
				echo "<a href='#' onClick='liftOff()'>Liftoff</a>";
				//console('Player is landed');
			}
			
			else {
				echo "Land on a planet, dock with a station or jump to another system.";
				//console('Player is in space');
			}
			?></small>
		</h1>
		<table class="table table-condensed table-bordered">
		
		<?php
			if (empty($spobs)) {
				echo "<tr><td><strong>Stellar Error 404</strong> No planets or stations found. Please reset the galaxy and try again.</td></tr>";
				if ($player->fuel <= 0) {
					echo "Uh oh. You're out of fuel in an uninhabited system. <em>Hello darkness my old friend...</em><br><h1><a style='color: red' href='#' onClick='selfDestruct()'>Self destruct</a></h1>";
				}
			}
			
			else {
			
			foreach($spobs as $spob) {
				if ($spob->parent == $player->location_syst) {
					echo "<tr><td>";
				
					echo "<strong>".spobTitle($spob->type), $spob->name;
					
					if ($player->landed == 0) {
					    //echo " <a href='?action=land&destination=".$spob->id."'>".landVerb($spob->type)."</a>";
					    echo " <a href='#' onClick='landLink(".$spob->id.")'>".landVerb($spob->type)."</a>";
					}
					
					echo "</strong>";
					if (($player->landed == 1) && ($spob->id == $player->location_spob)) {
					    echo "<span style='color: red'>You are here</span>";
					}
					
					echo "<p>".$spob->desc."</p>";
					
					if (($player->fuel < $maxFuel) && ($player->landed == 1) && ($player->location_spob == $spob->id)) {
					    echo "<a href='#' onClick='reFuel()'>Refuel</a>";
					}
				}
				echo "</td></tr>";
			}
		
		}
	}
	else {
			echo "In transit. Unable to access navigation computer. Arrival at: ";
			transitTime($player->eta);
			echo "<br /><a href='#' onClick='reSidebar()'>Refresh</a>";
			//echo '<div class="jumpeta"></div>';
			
		}
	
	?>
	</table>
	<?php if (isLoggedIn()){ ?>
<a href='#' class="reset" onClick="reSidebar()">Reload sidebar</a>
<?php } ?>
