<?php
	//function inspect($var) { d($var); }
	if(!defined('m_debug')) {define('m_debug', 1);}

	/*
	function var_name (&$iVar, &$aDefinedVars)
	{
	    foreach ($aDefinedVars as $k=>$v)
	        $aDefinedVars_0[$k] = $v;

	    $iVarSave = $iVar;
	    $iVar     =!$iVar;

	    $aDiffKeys = array_keys (array_diff_assoc ($aDefinedVars_0, $aDefinedVars));
	    $iVar      = $iVarSave;

	    return $aDiffKeys[0];
	}
	*/

	function d($var) {
		if (m_debug) {
			
			$bt = debug_backtrace();
			$src = file($bt[0]["file"]);
			$line = $src[ $bt[0]['line'] - 1 ];

			//striping the inspect() from the sting
			$strip = explode('d(', $line);
			$matches = preg_match('#\(#', $strip[0]);
			$strip = explode(')', $strip[1]);
			for ($i=0;$i<count($matches-1);$i++) {
				array_pop($strip);
			}
			$label = implode(')', $strip);
                          
               d_format($var, $label);
		}

	}
	

	function timeTracer($times, $name=''){
        $phase = count($times);
        $faseAtual = (string)$phase;
        $faseAnterior = (string)($phase-1);
        $times['fase'.$faseAtual] = microtime(true);
        d($times['fase'.$faseAtual]);
        $tempoDestaFase = $times['fase'.$faseAtual] - $times['fase'.$faseAnterior];
        d($name.": " .$tempoDestaFase);
        $tempoTotal = $times['fase'.$faseAtual] - $times['fase0'];
        d("Tempo total: ". $tempoTotal);
        //d($times);
        d('////');
        return $times;
    }
	
	// log function to 
	
	function l() {
		global $super_dump_log;
		
		if (func_num_args() > 0) {
			$array = func_get_args();
			array_merge($super_dump_log, $array);
		} else {
			foreach($super_dump_log as $log){
				//
			}
		}
	}
	
	function d_format($var, $label) {
		
		$colorVar = 'Blue';
		$type = get_type($var);
		$colorType = get_type_color($type);
		
		echo "<div class='m_inspect' style='background-color:#FFF; overflow:visible;'><pre><span style='color:$colorVar'>";
		echo $label;
		echo "</span> = <span class='subDump' style='color:$colorType'>";
		if ($type == 'string') {
			print_r(htmlspecialchars($var));
		} else {
			print_r($var);
		}
		echo "</span></pre></div>";
	}
	
	function get_type($var) {
		
		if (is_bool($var)) {
			$type = 'bool';
		} elseif (is_string($var)) {
			$type = 'string';
		} elseif (is_array($var)) {	
			$type = 'array';		
		} elseif (is_object($var)) {	
			$type = 'object';		
		} elseif (is_numeric($var)) {
			$type = 'numeric';
		} else {
			$type = 'unknown';
		}
		
		return $type;
	}

	
	function get_type_color($type) {

		if ('bool' == $type) {
			$colorType = 'Green';
		} elseif ('string' == $type) {
			$colorType = 'DimGrey';
		} elseif ('array' == $type) {
			$colorType = 'DarkOrchid';
		} elseif ('object' == $type) {
			$colorType = 'BlueViolet';
		} elseif ('numeric' == $type) {
			$colorType = 'Red';	
		} else {	
			$colorType = 'Tomato';	
		}
		
		return $colorType;
	}