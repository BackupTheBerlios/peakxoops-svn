<?php

$this->holidays = array(
'2005-3-25'=>'Good Friday',
'2005-3-28'=>'Easter Monday',
'2005-5-23'=>'Victoria Day',
'2005-8-1'=>'Civic Holiday',
'2005-9-5'=>'Labour Day',
'2005-10-10'=>'Thanksgiving',

'2006-4-14'=>'Good Friday',
'2006-4-17'=>'Easter Monday',
'2006-5-22'=>'Victoria Day',
'2006-8-7'=>'Civic Holiday',
'2006-9-4'=>'Labour Day',
'2006-10-9'=>'Thanksgiving',

'2007-4-6'=>'Good Friday',
'2007-4-9'=>'Easter Monday',
'2007-5-21'=>'Victoria Day',
'2007-8-6'=>'Civic Holiday',
'2007-9-3'=>'Labour Day',
'2007-10-8'=>'Thanksgiving',

);

for( $y = 2001 ; $y < 2020 ; $y ++ ) {
$this->holidays[ "$y-1-1" ] = 'New Years Day' ;
$this->holidays[ "$y-12-25" ] = 'Christmas Day' ;
$this->holidays[ "$y-12-26" ] = 'Boxing Day' ;
$this->holidays[ "$y-7-1" ] = 'Canada Day' ;
$this->holidays[ "$y-11-11" ] = 'Rememberance Day' ;
}

?>