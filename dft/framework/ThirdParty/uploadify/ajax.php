<?php

switch ($_REQUEST['ajaxmode']) {
    case "uploadify_removefile":
	   $fileToDelete = $_SERVER['DOCUMENT_ROOT'] .$_REQUEST['path']. $_REQUEST['file'];
       while(is_file($fileToDelete) == TRUE)
        {
            chmod($fileToDelete, 0666);
            unlink($fileToDelete);
        }
    break;
}
?>