<?php
if (! defined('sugarEntry') || ! sugarEntry)
    die('Not A Valid Entry Point');


function pre_install() {
	require_once('include/utils/array_utils.php');
	require_once('include/utils/file_utils.php');
	require_once('include/utils/sugar_file_utils.php');
	
	
	$modules_array = array('Accounts','Contacts','Leads');
	
	/** add following:
	$entry_point_registry['formLetter'] = array('file' => 'modules/AOS_PDF_Templates/formLetterPdf.php', 'auth' => true);
	$entry_point_registry['generatePdf'] = array('file' => 'modules/AOS_PDF_Templates/generatePdf.php', 'auth' => true);
	*/

    $add_entry_point = false;
    $new_contents = "";
    $entry_point_registry = null;

}
?>
