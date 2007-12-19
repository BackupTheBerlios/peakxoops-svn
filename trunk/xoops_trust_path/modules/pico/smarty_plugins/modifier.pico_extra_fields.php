<?php

function smarty_modifier_pico_extra_fields( $extra_fields_serialized , $key = '' )
{
	$extra_fields = @unserialize( $extra_fields_serialized ) ;
	return empty( $key ) ? $extra_fields : @$extra_fields[ $key ] ;
}

?>