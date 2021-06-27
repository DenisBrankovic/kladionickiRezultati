<?php
	spl_autoload_register(function($class){
		require_once($class.".php"); 
	}); 
	
	function newEntry(){
		$bet = new Betting();
		$bet->wager = 1; 
		$bet->dailyResult = -1; 
				
		$lastBet = Connection::getLastEntry();
		$lastBetDate = date_create($lastBet->today); 
		$today = date_create(date("Y-m-d")); 
		
		while($lastBetDate < $today){
			$lastBetDate->modify("+ 1 day");
			$bet->today = $lastBetDate->format("Y-m-d"); 
			$bet->overallResult = Connection::getCurrentResult() - $bet->wager;
			Connection::insertNext($bet);
		}
	}
	
	function additionalDailyBet($wager){
		$bet = new Betting();
		$bet->today = date("Y-m-d");
		$bet->wager = $wager;
		$bet->dailyResult = - $wager;
		$bet->overallResult = Connection::getCurrentResult() - $wager;
		$result = Connection::insertNext($bet); 
		
		return $result;
	}
			
	function wagerChange($wager){
		$bet = Connection::getLastEntry();
		
		$newOverallResult = $bet->overallResult + $bet->wager - $wager;
		
		$bet->wager = $wager; 
		$bet->overallResult = $newOverallResult;
		
		$result = $bet->dailyResult; 
		$bet->dailyResult = ($result < 0) ? (0 - $bet->wager) : $result; 
				
		$result = Connection::updateWager($bet); 
		
		return $result;
	}
	
	function resultModification($result){
		$bet = Connection::getLastEntry();
		if($result){
			$result -= $bet->wager;
			deleteLastEntry();
			
			$previousBet = Connection::getLastEntry();
			$previousBet->overallResult += $result;
			
			$bet->dailyResult = $result += $bet->wager; 
			$bet->overallResult = $previousBet->overallResult; 
			
			$result = Connection::insertNext($bet);
			
			return $result;
		}		
	}
	
	function getCurrentState(){
		$currentState = Connection::getCurrentResult();
		return $currentState; 
	}
	
	function deleteLastEntry(){
		$result = Connection::deleteLast();
		return $result; 
	}
	
	function getStats(){
		return Connection::getAverage(); 
	}

	function getWins(){
		Connection::printWins(); 
	}
	
	function getEverything(){
		Connection::printAll();
	}
		
	newEntry(); 
		 
	
			
	
	