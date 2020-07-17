<?php
// Remove namespace first for testing purpose
require_once('src/DbBackup.php');
?>
<h1>Example of a DB Backup File</h1>
<?php
//Database Configurations Array
$dbConfig = array('host' => 'localhost',
					  'login' => 'user',
					  'password' => 'user',
					  'database_name' => 'oauth_db');
	
//Amazon S3 Configurations Array (Optional)
$amazonConfig = array('accessKey' => '{YOUR S3 ACCESS KEY}',
				 	  'secretKey' =>  '{Your S3 Secret Key}',
				  	  'bucketName' => '{Your Bucket}');
					  
/*
 * Example 1: Very Basic Backup Example
 */

$dbBackupObj = new DbBackup($dbConfig);
$dbBackupObj->executeBackup();

/*
 * Example 2: Extended Backup
 */	
try{
  $dbBackupObj = new DbBackup($dbConfig);
  $dbBackupDbj->setCurrentWorkingDirectory(getcwd());
	$dbBackupObj->setBackupDirectory('backups/extendedExample'); //CustomFolderName
	$dbBackupObj->setDumpType(0); //To disable the single table files dumping (1 Dump file for the whole database)
	$dbBackupObj->excludeTable('table1Name','tabel2Name','table3Name');	//Exclude few tables from your backup execution
	$dbBackupObj->addDumpOption('--xml','--force');//Add few custom options to your backup execution
	$dbBackupObj->enableS3Support($amazonConfig);//Transfer your backup files to Amazon S3 Storage
	$dbBackupObj->executeBackup();//Start the actual backup process using the user specified settings and options
}catch(Exception $e){
		echo $e->getMessage();
}

/*
 * Example 3: Very Basic Restore Database Example
 */
 try{
	$dbBackupObj = new DbBackup($dbConfig);
	$dbBackupObj->executeRestore();
}catch(Exception $e){
	echo $e->getMessage();
}