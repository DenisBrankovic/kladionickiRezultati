<?php 

class Connection extends Database{
		
	//Database management
	
	public static function dateConverter($date){
		$d = explode("-", $date); 
		$newDate = $d[2].".".$d[1].".".$d[0]."."; 
		return $newDate; 
	}
	
	public static function getLastId(){
		$conn = self::connect();
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$res = $conn->query("select MAX(id) from results");
			$lastLine = $res->fetchAll(PDO::FETCH_ASSOC);
			$id = $lastLine[0]['MAX(id)'];
		
			return $id;
		}
	}
	
	public static function getLastEntry(){
		$conn = self::connect();
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$id = self::getLastId();
			$res = $conn->query("select * from results where id = {$id}"); 
			$latest = $res->fetchAll(PDO::FETCH_CLASS, 'Betting');
			
			$bet = new Betting();
			foreach($latest as $b){
				$bet->today = $b->date;
				$bet->wager = $b->wager;
				$bet->dailyResult = $b->dailyResult;
				$bet->overallResult = $b->overallResult;
			}
			return $bet; 
		}
	}
		
	public static function getCurrentResult(){
		$conn = self::connect(); 
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$id = self::getLastId();
			$res = $conn->query("select * from results where id = {$id}"); 
			$latest = $res->fetchAll(PDO::FETCH_CLASS, 'Betting');
			
			foreach($latest as $k){
				return $k->overallResult; 
			}
		}
	}
	
	
	
	//User input
	
	
	
	public static function insertNext($bet){
		$conn = self::connect();
		
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			if($bet != null){
				$insertedRow = $conn->exec("insert into results values(null, '{$bet->today}', {$bet->wager}, {$bet->dailyResult}, {$bet->overallResult})");
				return 1; 
			}else{
				return 0; 
			}
		}
	}
	
	public static function updateWager($bet){
		$conn = self::connect();	
				
		$id = self::getLastId();
		
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$updatedWager = $conn->exec("update results set wager = {$bet->wager}, dailyResult = {$bet->dailyResult}, overallResult = {$bet->overallResult} where id = {$id}"); 
			
			if($bet != null){
				if($updatedWager){
					return 1; 
				}else{
					return 0;
				}
			}
		}
	}
	
	public static function win($bet){
		$conn = self::connect();	
						
		$id = self::getLastId();
		
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$winnings = $conn->exec("update results set waget = {$bet->wager}, dailyResult = {$bet->dailyResult}, overallResult = {$bet->overallResult} where id = {$id}"); 
			if($winnings){
				return 1; 
			}else{
				return 0;
			}
		}
	}
	
	public static function deleteLast(){
		$conn = self::connect();
		
		$id = self::getLastId();
		
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$confirmation = $conn->exec("delete from results where id = {$id}"); 
			if($confirmation){
				return 1;
			}else{
				return 0;  
			}
		}
	}
		
	
	//Print out data
	
	
	
	public static function getAverage(){
		$conn = self::connect();
		 
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$count = $conn->query("select count(id) from results where wager > 0"); 
			$rowCountArray = $count->fetchAll(PDO::FETCH_COLUMN);
			$rowCount = $rowCountArray[0];
			$currentState = self::getCurrentResult();
					
			$d1 = date_create(date("Y-m-d"));
			$d2 = date_create("2021-01-10");
			$dateDifference = date_diff($d1, $d2);
			$daysOfPlay = $dateDifference->format("%a");	
			
			$dailyProfit = $currentState / $daysOfPlay;
			$hourlyProfit = $dailyProfit / 24; 
			$monthlyProfit = $dailyProfit * 30;
			$yearlyProfit = $dailyProfit * 365; 
			$profitPerPlay = $currentState / $rowCount; 	
			
			$stats = array($rowCount, $hourlyProfit, $dailyProfit, $monthlyProfit, $yearlyProfit, $profitPerPlay);
						
			return $stats; 
		}
	}
	
	public static function printWins(){
		$conn = self::connect();
		 
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$data = $conn->query("select * from results where dailyResult > 0 order by id desc"); 
			$rows = $data->fetchAll(PDO::FETCH_CLASS, "Betting");
			
			foreach($rows as $w){ 
				$datum = self::dateConverter($w->date);
				$win = "<div id='stats2' style='display:flex; justify-content:space-around; border:solid gold 1px; border-radius:10px; margin:2px;'>
				<div style='display:inline; width:25%; padding-left: 3px'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$datum}</p></div>
				<div style='display:inline; width:25%'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$w->wager}</p></div>
				<div style='display:inline; width:25%'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$w->dailyResult}</p></div>
				<div style='display:inline; width:25%'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$w->overallResult}</p></div>
				</div>";
				echo $win;
			}
		}
	}
	
	public static function printAll(){
		$conn = self::connect();
		
		if(!$conn){
			die("Veza sa serverom je trenutno u prekidu.");
		}else{
			$data = $conn->query("select * from results order by id desc"); 
			$rows = $data->fetchAll(PDO::FETCH_CLASS, "Betting");
			
			foreach($rows as $result){
				$datum = self::dateConverter($result->date);
				$dailyResult = "<div id='stats1' style='display:flex; justify-content:space-around; border:solid gold 1px; border-radius:10px; margin:2px;'>
				<div style='display:inline; width:25%; padding-left: 3px'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$datum}</p></div>
				<div style='display:inline; width:25%'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$result->wager}</p></div>
				<div style='display:inline; width:25%'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$result->dailyResult}</p></div>
				<div style='display:inline; width:25%'><p style='text-align:center; font-family: 'Montserrat', sans-serif; font-size: 110%'>{$result->overallResult}</p></div>
				</div>";
				echo $dailyResult;
			}
		}
	}
}
		
		