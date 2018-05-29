<?php
class PG {
	var $offset_first;
	var $offset_prev;
	var $offset_next;
	var $offset_last;
	var $perpagecount;
	var $totalcount;
	var $offset_current;
	var $currentpage;
	var $totalpages;
	var $link;
	var $startindex;
	var $endindex;
	var $numbersbetweentwodots=5;
	
	function PG($offset_current, $perpagecount, $totalcount, $link){
		$this->offset_current=$offset_current;
		$this->perpagecount=$perpagecount;
		$this->totalcount=$totalcount;
		$this->link=$link;
	
		// Total Pages
		$this->totalpages=$totalcount/$perpagecount;
		if($this->totalpages!=floor($this->totalpages)){
			$this->totalpages=floor($this->totalpages) + 1;
		}

		// Current Page
		$this->currentpage=(($offset_current + $perpagecount) / $perpagecount);

		// Start Index
		$this->startindex=$this->currentpage - 2;
		if($this->startindex < 1){
			$this->startindex=1;
		}

		// End Index
		$this->endindex=$this->startindex + ($this->numbersbetweentwodots - 1);
		if($this->endindex>$this->totalpages){
			$this->startindex=$this->startindex-($this->endindex-$this->totalpages);
			if($this->startindex < 1){
				$this->startindex=1;
			}
			$this->endindex=$this->totalpages;
		}

		// Offset for First Page
		if($offset_current==0)
			$this->offset_first=-1;
		else
			$this->offset_first=0;

		// Offset for Prev Page
		if($offset_current==0)
			$this->offset_prev=-1;
		else
			$this->offset_prev=$offset_current - $perpagecount;

		// Offset for Next Page
		if($this->totalpages>0 and $offset_current + $perpagecount < $totalcount)
			$this->offset_next=$offset_current + $perpagecount;
		else
			$this->offset_next=-1;

		// Offset for Last Page
		if($this->totalpages>0 and $offset_current + $perpagecount < $totalcount)
        	$this->offset_last=($this->totalpages - 1) * $perpagecount;
		else
			$this->offset_last=-1;
	}

	function show(){
		$html = '';
		if($this->startindex>1){
			$start=0;
            $html .= '<li><a href="javascript:' . $this->link . '(' . $start . ')">1</a></li>';
		}
	
		if(($this->startindex - 1)>1){
            $html .= '<li><a class="paggin_dot">&nbsp;...&nbsp;</a></li>';
		}
	
		for($i=$this->startindex;$i<=$this->endindex;$i++){
			$start=($i-1) * $this->perpagecount;
			
			if($i == $this->currentpage){
                $html .= '<li class="active"><a>'.$i.'</a></li>';
			}
			else {
                $html .= '<li><a href="javascript:' . $this->link . '(' . $start . ')">' . $i . '</a></li>';
			}
		}

		if($this->endindex<$this->totalpages){
			$start=($this->totalpages-1) * $this->perpagecount;
			if(($this->totalpages - $this->endindex)>1){
                $html .= '<li><a class="paggin_dot">&nbsp;...&nbsp;</a></li>';
			}
            $html .= '<li><a href="javascript:' . $this->link . '(' . $start . ')">'.$this->totalpages.'</a></li>';

		}

		return $html;
	}
	
	function showFirst(){
		if($this->totalpages>0 and $this->offset_first==0) {
            $html = '<li><a href="javascript: ' . $this->link . '(' . $this->offset_first . ')">First</a></li>';
		}
		else{
            $html = '<li class="disabled"><a>First</a></li>';
		}
		
		return $html;
	}
	
	function showLast(){
		if($this->totalpages>0 and $this->offset_last>0) {
            $html = '<li><a href="javascript: ' . $this->link . '(' . $this->offset_last . ')">Last</a></li>';
		}
		else{
            $html = '<li class="disabled"><a>Last</a></li>';
		}
		
		return $html;
	}
	
	function showPrevious(){
		if($this->offset_current) {
            $html = '<li><a href="javascript: ' . $this->link . '(' . $this->offset_prev . ')">Prev</a></li>';
		}
		else{
            $html = '<li class="disabled"><a>Prev</a></li>';
		}
		
		return $html;
	}

	function showNext(){
		if($this->totalpages>0 and $this->offset_current+$this->perpagecount<$this->totalcount) {
            $html = '<li><a href="javascript: ' . $this->link . '(' . $this->offset_next . ')">Next</a></li>';
		}
		else{
            $html = '<li class="disabled"><a>Next</a></li>';
		}
		
		return $html;
	}
	
	function showMenuPrevious(){
		$html = "";
		if($this->offset_current) {
			$html = '<span><a href="javascript: ' . $this->link . '(' . $this->offset_prev . ')"><div class="pgprevious"></div></a></span>';
		}
		
		return $html;
	}

	function showMenuNext(){
		$html = "";
		if($this->totalpages>0 and $this->offset_current+$this->perpagecount<$this->totalcount) {
			$html = '<span><a href="javascript: ' . $this->link . '(' . $this->offset_next . ')"><img src="images/process-menu-next.png" border="0" /></a></span>';
		}
		
		return $html;
	}
	
	function showLabel() {
		$html = "";
		$html = '<span class="paging_label" style="padding-right:10px;">Page</span>';
		
		return $html;
	}
}
?>