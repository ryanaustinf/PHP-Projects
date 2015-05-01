<?php
	setCookie( 'left',$_POST['left'],time() + 2**31 - 1,"/");
	setCookie('right',$_POST['right'],time() + 2**31 - 1,"/");
?>