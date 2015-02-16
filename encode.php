<?php
function fromLongtoShorten($key){

	$result=base_convert($key, 10, 36);
	return $result;
}
?>