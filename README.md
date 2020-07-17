MySQL Backup Class
==================
This project provides a useful tool (PHP Class) to backup any MySQL database automaticall with Amazon S3 Support.

```bash
composer require louis1021/mysql-php-backup-class dev-master
```

> THE AMAZON S3 IS NOT READY YET!

# Changelog

202007151522 - Now we have the current working environment.		
202007151454 - Revamped and fixed mysqldump, mysql system command.		
202007151300 - Added namespace.		
202007171257 - Rewritten the code and become a plugin.		
202007171242 - Yes, I forked.		

# Features
	- Backup the whole database (All Tables) in one single file
	- Backup each DB table in a seperate SQL Dump File
	- Exclude specific tables from your Backup
	- Backup data on Amazon S3 (Optional)
	- Allows custom dump options
	- Restore the whole database on the fly (Runs Once)

# Currently Working On:

	1. Add a Code Generation File   
	2. Validate user provided settings (DB Login and Amazon S3 Keys)   
	3. Validating user added dump options  (within the 'addDumpOption' Method)   
	4. Creating the automatic scheduling of the backup process (CronJobs Creator)
	5. Read Backup from Amazon S3 Storage if the local copy isn't available (in restore)

Code Examples
=============

#### Basic Backup Usage
```php
<?php
	use Louis1021\MysqlPhpBackupClass\DbBackup;
	$dbConfig = array('host' => 'localhost',
					  'login' => '{DBUsername}',
					  'password' => '{DBPassword}',
					  'database_name' => '{DBName}');
	
	$dbBackupObj = new DbBackup($dbConfig);
	$dbBackupObj->executeBackup();
?>
```

#### Extended Backup Usage (All Options, commented code)
```php
<?php
	use Louis1021\MysqlPhpBackupClass\DbBackup;
	
	//Database address, credentials and name
	$dbConfig = array('host' => 'localhost',
					  'login' => '{DBUsername}',
					  'password' => '{DBPassword}',
					  'database_name' => '{DBName}');
	
	
	//Amazon S3 Configurations Array (Optional)
	$amazonConfig = array('accessKey' => '{YOUR S3 ACCESS KEY}',
				 	  'secretKey' =>  '{Your S3 Secret Key}',
				  	  'bucketName' => '{Your Bucket}');
	
	
	$dbBackupObj = new DbBackup($dbConfig);
    
    $dbBackupDbj->setCurrentWorkingDirectory(getcwd());

	//Put backup files in the 'extendedExample' directory. NOTE: 'backups' DIR should be writable
	$dbBackupObj->setBackupDirectory('backups/extendedExample');
	
	//To disable the single table files dumping (1 Dump file for the whole database)
	$dbBackupObj->setDumpType(0); 
	
	//Exclude few tables from your backup execution
	$dbBackupObj->excludeTable('table1Name','tabel2Name','table3Name');
	
	//Add few custom options to your backup execution
	$dbBackupObj->addDumpOption('--xml','--force'); //Get XML output and Continue on error
	
	//Transfer your backup files to Amazon S3 Storage
	// $dbBackupObj->enableS3Support($amazonConfig);
	
	//Start the actual backup process using the user specified settings and options
	$dbBackupObj->executeBackup();
?>
```

#### Basic Restore Usage
```php
<?php
	use Louis1021\MysqlPhpBackupClass\DbBackup;
	$dbConfig = array('host' => 'localhost',
					  'login' => '{DBUsername}',
					  'password' => '{DBPassword}',
					  'database_name' => '{DBName}');
	
	$dbBackupObj = new DbBackup($dbConfig);
	$dbBackupObj->executeRestore();
?>
```
