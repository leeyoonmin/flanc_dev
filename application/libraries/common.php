<?php
  class common {
    public function makeIndexkey($MAPID,$SCREEN){
      $browser = get_browser(null, true);

  		// OS구분
  		$operating_system = "";
  		if(substr($browser['platform'],0,3) == "Win"){
  			$operating_system = "01";
  		}else if($browser['platform'] == "Linux"){
  			$operating_system = "02";
  		}else if($browser['platform'] == "Unix"){
  			$operating_system = "03";
  		}else if($browser['platform'] == "MacOSX"){
  			$operating_system = "04";
  		}else if($browser['platform'] == "ChormeOS"){
  			$operating_system = "05";
  		}else if($browser['platform'] == "Android"){
  			$operating_system = "06";
  		}else if($browser['platform'] == "iOS"){
  			$operating_system = "07";
  		}else{
  			$operating_system = "99";
  		}

  		//매체구분
  		$device = "";
  		if($browser['device_type'] == "Desktop"){
  			$device = "01";
  		}else if($browser['device_type'] == "Mobile"){
  			$device = "02";
  		}else{
  			$device = "99";
  		}

  		$indexkey = $MAPID.$SCREEN.$device.$operating_system.date("YmdHis",time()).sprintf('%04d',mt_rand(0000,9999));

      return $indexkey;
    }
  }
?>
