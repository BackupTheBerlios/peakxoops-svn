<?php

require_once "exForm/Filter.php";

class CategorySearchFilter extends exAbstractFilterForm
{
	var $cid_=0;
	var $status_=0;
	var $sort_=array("cid","input_date","priority","status","size");

	var $action_;	// for mojaLE.

	function fetch()
	{
		$this->cid_ = isset($_GET['cid']) ? intval ( $_GET['cid'] ) : 0;
		$this->status_ = isset($_GET['status']) ? intval ( $_GET['status'] ) : 0;

		if($this->status_>0 &&$this->status<=2)
			$this->status_=0;
	}

	function &getCriteria($start=0,$limit=0,$sort=0)
	{
		$criteria=&$this->getSortCriteria($start,$limit,$sort);
		
		// cid Criterion
		if ( $this->cid_ )
			$criteria->add(new Criteria('cid',$this->cid_));

		// status Criterion
		if ( $this->status_ )
			$criteria->add(new Criteria('status',$this->status_));
		else {
			$criteria->add(new Criteria('status',1,'>='));
			$criteria->add(new Criteria('status',2,'<='));
		}

		return $criteria;
	}

	function &getDefaultCriteria($start,$limit)
	{
		// --- INSERT DEFAULT SORT CONDITION ----
		// このメソッドがフィルタがデフォルトで持っているソート条件などを返すようにします

		$criteria =& parent::getDefaultCriteria($start,$limit);
		$criteria->setSort('input_date');
		$criteria->setOrder('DESC');

		return $criteria;
	}
	
	function &getExtra()
	{
		// set array
		// ここに GET リクエストでフィルタ条件が引き継げるよう連想配列をセットします
		$ret=array();
		if($this->cid_)
			$ret['cid'] = $this->cid_;

		if($this->status_)
			$ret['status'] = $this->status_;

		return $ret;
	}

}


?>