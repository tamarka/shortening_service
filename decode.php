<?php
function fromShortToLong($id){

	$result=base_convert($id, 36, 10);
	return $result;
}
?>