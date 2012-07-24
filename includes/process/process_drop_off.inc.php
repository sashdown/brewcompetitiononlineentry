<?php 
/*
 * Module:      process_drop_off.inc.php
 * Description: This module does all the heavy lifting for adding/editing info in the "drop_off" table
 */

$dropLocationWebsite = check_http($_POST['dropLocationWebsite']);

if ($action == "add") {
	$insertSQL = sprintf("INSERT INTO $drop_off_db_table (dropLocationName, dropLocation, dropLocationPhone, dropLocationWebsite, dropLocationNotes) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString(capitalize($_POST['dropLocationName']), "text"),
                       GetSQLValueString($_POST['dropLocation'], "text"),
                       GetSQLValueString($_POST['dropLocationPhone'], "text"),
					   GetSQLValueString($dropLocationWebsite, "text"),
					   GetSQLValueString($_POST['dropLocationNotes'], "text")
					   );

	mysql_select_db($database, $brewing);
  	$Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());
	if ($section == "step6") $insertGoTo = "../setup.php?section=$section&msg=11"; else $insertGoTo = $insertGoTo;
	header(sprintf("Location: %s", $insertGoTo));				   
	
}

if ($action == "edit") {
	$updateSQL = sprintf("UPDATE $drop_off_db_table SET dropLocationName=%s, dropLocation=%s, dropLocationPhone=%s, dropLocationWebsite=%s, dropLocationNotes=%s WHERE id=%s",
                       GetSQLValueString(capitalize($_POST['dropLocationName']), "text"),
                       GetSQLValueString($_POST['dropLocation'], "text"),
                       GetSQLValueString($_POST['dropLocationPhone'], "text"),
					   GetSQLValueString($_POST['dropLocationWebsite'], "text"),
					   GetSQLValueString($dropLocationWebsite, "text"),
					   GetSQLValueString($id, "int"));   
					   
	mysql_select_db($database, $brewing);
  	$Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());
	header(sprintf("Location: %s", $updateGoTo));			
}

?>