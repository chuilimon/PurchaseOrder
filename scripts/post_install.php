<?php
function post_install() {

	if (strtolower($_POST['mode']) == 'install') {
	
	?><br/>
	<h3>Advanced OpenSales by <a href="http://www.salesagility.com">SalesAgility</a></h3>
	<br/>
	Jesus Limon
	<br/><?php
		$modules = array('AOS_SI','AOS_ProductsPO','AOS_Products_PO','AOS_PO');
		
		$actions = array('clearAll','rebuildAuditTables','rebuildExtensions','repairDatabase');

		require_once('modules/Administration/QuickRepairAndRebuild.php');
		$randc = new RepairAndClear();
		$randc->repairAndClearAll($actions, $modules, true,false);
		
		$_REQUEST['upgradeWizard'] = true;
		require_once('modules/ACL/install_actions.php');
		unset($_REQUEST['upgradeWizard']);

	}
		
}
?>
