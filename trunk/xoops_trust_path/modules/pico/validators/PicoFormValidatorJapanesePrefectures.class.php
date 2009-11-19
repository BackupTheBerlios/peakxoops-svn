<?php

require_once dirname(__FILE__).'/PicoFormValidatorAbstract.class.php' ;

// a sample validator
class PicoFormValidatorJapanesePrefectures extends PicoFormValidatorAbstract
{
	var $prefectures = array(1=>'�̳�ƻ',2=>'�Ŀ���',3=>'��긩',4=>'�ܾ븩',5=>'���ĸ�',6=>'������',7=>'ʡ�縩',8=>'��븩',9=>'���ڸ�',10=>'���ϸ�',11=>'��̸�',12=>'���ո�',13=>'�����',14=>'�����',15=>'���㸩',16=>'�ٻ���',17=>'���',18=>'ʡ�温',19=>'������',20=>'Ĺ�',21=>'���츩',22=>'�Ų���',23=>'���θ�',24=>'���Ÿ�',25=>'���츩',26=>'������',27=>'�����',28=>'ʼ�˸�',29=>'���ɸ�',30=>'�²λ���',31=>'Ļ�踩',32=>'�纬��',33=>'������',34=>'���縩',35=>'������',36=>'���縩',37=>'���',38=>'��ɲ��',39=>'���θ�',40=>'ʡ����',41=>'���츩',42=>'Ĺ�긩',43=>'���ܸ�',44=>'��ʬ��',45=>'�ܺ긩',46=>'�����縩',47=>'���츩' ) ;

	function validate( $value , $field_name )
	{
		$value4check = mb_convert_encoding( @$value , 'EUC-JP' , _CHARSET ) ;
		if( ! empty( $value ) && ! in_array( $value4check , $this->prefectures ) ) {
			$this->errors[] = 'invalid general' ;
			$this->processor->fields[ $field_name ]['errors'][] = 'invalid general' ;
		}
		return $value ;
	}

}

?>