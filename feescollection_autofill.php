<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('feescollection');
	if(!$table_perms[0]){ die('// Access denied!'); }

	$mfk=$_GET['mfk'];
	$id=makeSafe($_GET['id']);
	$rnd1=intval($_GET['rnd1']); if(!$rnd1) $rnd1='';

	if(!$mfk){
		die('// No js code available!');
	}

	switch($mfk){

		case 'Student':
			if(!$id){
				?>
				$('Class<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				$('Balance<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				<?php
				break;
			}
			$res = sql("SELECT `students`.`id` as 'id', `students`.`FullName` as 'FullName', `students`.`Gender` as 'Gender', if(`students`.`DOB`,date_format(`students`.`DOB`,'%m/%d/%Y'),'') as 'DOB', `students`.`Photo` as 'Photo', `students`.`RegNo` as 'RegNo', IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') as 'Class', IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') as 'Stream', IF(    CHAR_LENGTH(`hostels1`.`Name`), CONCAT_WS('',   `hostels1`.`Name`), '') as 'Hostel', if(`students`.`DOJ`,date_format(`students`.`DOJ`,'%m/%d/%Y'),'') as 'DOJ', IF(    CHAR_LENGTH(`studentcategories1`.`Name`), CONCAT_WS('',   `studentcategories1`.`Name`), '') as 'Category', IF(    CHAR_LENGTH(`sessions1`.`Year`) || CHAR_LENGTH(`sessions1`.`Term`), CONCAT_WS('',   `sessions1`.`Year`, ' :Term ', `sessions1`.`Term`), '') as 'AcademicYear', IF(    CHAR_LENGTH(`schoolmoney1`.`Total`), CONCAT_WS('',   `schoolmoney1`.`Total`), '') as 'TotalFees', `students`.`AdvanceFees` as 'AdvanceFees', `students`.`Balance` as 'Balance', IF(    CHAR_LENGTH(`parents1`.`Name`) || CHAR_LENGTH(`parents1`.`Phone`), CONCAT_WS('',   `parents1`.`Name`, ' :Phone: ', `parents1`.`Phone`), '') as 'Parent' FROM `students` LEFT JOIN `classes` as classes1 ON `classes1`.`id`=`students`.`Class` LEFT JOIN `streams` as streams1 ON `streams1`.`id`=`students`.`Stream` LEFT JOIN `hostels` as hostels1 ON `hostels1`.`id`=`students`.`Hostel` LEFT JOIN `studentcategories` as studentcategories1 ON `studentcategories1`.`id`=`students`.`Category` LEFT JOIN `sessions` as sessions1 ON `sessions1`.`id`=`students`.`AcademicYear` LEFT JOIN `schoolmoney` as schoolmoney1 ON `schoolmoney1`.`id`=`students`.`TotalFees` LEFT JOIN `parents` as parents1 ON `parents1`.`id`=`students`.`Parent`  WHERE `students`.`id`='$id' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#Class<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Class'].' :Stream '.$row['Stream']))); ?>&nbsp;');
			$j('#Balance<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Balance']))); ?>&nbsp;');
			<?php
			break;


	}

?>