<?php 

require_once('functions.php');

//Action GET handler 
if (isset($_GET['action'])) {

//DB object we're going to use for this	
$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);

	
	//Liftoff
	if ($_GET['action'] == 'lift') {
	
		//TODO: Validate if user canLift();
	
		$sql = "UPDATE ".TBL_PREFIX."user SET landed = 0 WHERE ID=$player->id";
		//echo $sql;
		//console($sql);	
		if ($db->query($sql)) {
			//header("Location: index.php");
			echo "Liftoff successul at ".date ('r');
		}
		else {
			//console("Liftoff failed");
		}
	}
	
	//Landing handler 
	
	if(($_GET['action'] == 'land') && (isset($_GET['destination'])) && ($player->landed == 0)) {
    	
    	//TODO: Validate destination
    		//canLift();
    	
    	$destination = $_GET['destination'];
		
		if ($db->get_var("SELECT parent FROM ".TBL_PREFIX."spob WHERE id=$destination AND parent=$player->location_syst") != $player->location_syst) {
			//header("Location: index.php");
			//console("Invalid landing coordinates");
			echo "Unable to land. Invalid landing coordinates";
		}
		
		elseif (transitCheck($player->eta)) {
			echo "Error: Superluminal velocities detected. Estimated time of arrival: ";
			transitTime(date('r', $player->eta));
		}
		
		else {
		
    		$sql = "UPDATE ".TBL_PREFIX."user SET landed = 1, location_spob=$destination WHERE ID=$player->id";
    				
    		if ($db->query($sql)) {
				//header("Location: index.php");
    			//console("Landed!");
    			echo "Landed!";
    		}
    		else {
    			echo "Unable to land";
    		}
    	}
    }
    
    //Jump handler
    
    if(($_GET['action'] == 'jump') && (isset($_GET['destination'])) && ($player->landed == 0)) {
    	    	
    	//Fail for fuel
    	if ($player->fuel < 1) {
    		echo "Unable to complete jump, not enough fuel: ".$player->fuel." jumps remaining";
	    	//console("Unable to complete jump, not enough fuel: ".$player->fuel." jumps remaining");
    	}
    			
    	//Fail for jumping
		elseif (transitCheck($player->eta)) {
			echo "Unable to correct course at superluminal velocities. Estimated arrival time: ";
			transitTime($player->eta);
		}
    	
    	//Fail for destination  	
    	elseif (!in_array(($_GET['destination']), load_connections($player->location_syst))) {
			echo "No safe route can be calculated. Please select another destination.";
			//print_r(load_connections($player->location_syst));
    	}    	
    	//Success!
    	else {
    		
	    	$neweta = time() + (1 * floor(rand(20,30)));
	    	//echo date('r', $neweta);
			
			//console($eta);
			
			$destination = $_GET['destination'];
			
    		$sql = "UPDATE ".TBL_PREFIX."user SET location_syst=$destination, fuel=fuel-1, eta=$neweta, jumping=1, attackable = 0 WHERE ID=$player->id";
    		
    		//console($sql);
    		
    		if ($db->query($sql)) {
    		    //header("Location: index.php");
    		    //console("Jumped!");
    		    echo ($neweta - time()) * 1000;
    		    ?>

<?php
    		 
    		}
    		else {
    		    echo "Unable to jump!";
    		}
    	}
    }
    
    //Refuel
    
    if ($_GET['action'] == 'refuel') {
		
		
		$cost = $fuelprice * ($ships[$player->ship - 1]-> fueltank - $player->fuel);
		if ($player->credits < $cost) {
			echo "Unable to refuel. Not enough credits.";
		}
		else {
			$sql = "UPDATE ".TBL_PREFIX."user SET fuel=".$ships[$player->ship - 1]-> fueltank.", credits=credits-$cost WHERE ID=$player->id";
			if ($db->query($sql)) {
	    	   	 //header("Location: index.php");
			   	 echo "Refueled! It cost you $cost credits!";
			   	}
			else {
				   echo "Failed to refuel!";
			}
		}
		//$max = $ship->fuelTank;
		//$cost = ($max - $player->fuel) * $spob->fuelCost;
		//$sql = "UPDATE ".TBL_PREFIX."user SET fuel=$max, credits=credits-$cost WHERE ID=$player->id";
		//$sql = "UPDATE ".TBL_PREFIX."user SET fuel=10, credits - $cost WHERE ID=$player->id";
		
		
    }
    
    //Self destruct
    if ($_GET['action'] == 'selfdestruct') {

		$sql = "UPDATE ".TBL_PREFIX."user SET fuel=". $ships['0']->fueltank .", location_syst=1, location_spob=1, landed=1, eta=NULL WHERE ID=$player->id";
		
		if ($db->query($sql)) {
    	    //header("Location: index.php");
    	    echo "You blew up. But welcome back!";
    	}
    }
    
    //Government joins
    
    if (($_GET['action'] == 'join') && (isset($_GET['gov']))) {
    	$gov = $_GET['gov'];
    	$sql = "UPDATE ".TBL_PREFIX."user SET government=$gov WHERE id=$player->id";
    	if ($db->query($sql)) {
    	    echo "Changed government";
    	}   
    }
    
    //Buy a ship  
    if (($_GET['action'] == 'buyShip') && ($player->landed == 1)) {
    
    	$credits = $player->credits;
    	$cost = $ships[$_GET['shipid'] - 1]->cost;
    	$ship = $ships[$_GET['shipid'] - 1]->id;
    	$fuel = $ships[$_GET['shipid'] - 1]->fueltank;
		//print_r($player);
	    if ($credits > $cost) {
		    
	    $sql = "UPDATE ".TBL_PREFIX."user SET credits=credits-$cost, ship=$ship, fuel=$fuel WHERE ID=".$player->id."";
			
			if ($player->ship == $ship) {
	    		echo "Unable to purchase a ship you already own!";
	    		
    		}
			
			elseif ($db->query($sql)) {
    		    //header("Location: index.php");
				echo "You've got yourself a new ship!";
			    echo "You've got ".($player->credits - $cost)." credits left.";
    		}
    		
    		else {
	    		echo "Unable to puchase ship!";
    		}
	    }
    }
      
    else {
	    //echo "Unknown action '".$_GET['action']."' specified";
    }
}
?>