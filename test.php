<?php

$validates = array( 
	'name' => array( 'presence', array( 'max_length' => array( 'min' => 20, 'max' => 15 ) ) ),
	'username' => array( array( 'max_length' => array( 'max' => 15, 'min' => 10 ) ), 'presence' )
);

foreach($validates as $property=>$method) {
	foreach($method as $meth) {
		if(is_array($meth)) {
			foreach($meth as $m=>$v) {
				echo 'validates'.'_'.$m." ".$v['max']."<br>";
			}
		} else {
		 echo 'validates'.'_'.$meth."<br>";
		}
	}
}