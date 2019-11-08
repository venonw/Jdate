<?php

if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

/*
**********************************************
	Venon Web developers. VENON.ir
**********************************************
*/

function venon_jdate_config() {
    $configarray = array(
    "name" => "Venon Jalali Date",
    "description" => "Convert Gerogian To Jalali Date in Client area, Admin area, Email templates and other modules",
    "version" => "2.3",
    "author" => "Venon Web Developers. Venon.ir",
    "language" => "farsi",
    "fields" => array(
        // "License" => array ("FriendlyName" => "License", "Type" => "text", "Size" => "25", "Description" => "Enter your venon_jdate License number", "Default" => "venon-", ),
    ));
    return $configarray;
}

function venon_jdate_activate() {

    # Create Custom DB Table
    $query = "CREATE TABLE `mod_venon_jdate` (`setting` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  `dual` text NOT NULL,  `format` text CHARACTER SET utf8 COLLATE utf8_bin,   `timezone` int(11) DEFAULT NULL, `status` TEXT NOT NULL, `localkey` TEXT NULL, `num` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL);";
	$result = mysql_query($query);

    # Insert deafualt options
	$query = "INSERT INTO `mod_venon_jdate` (`setting`, `dual`, `format`, `timezone`, `status`, `localkey`, `num`) VALUES ('options', 'false', 'Y/m/d', 1, 'Active', '', 'fa');";
	$result = mysql_query($query);

    # Return Result
    return array('status'=>'success','description'=>'Venon Jalali Date addon successfully installed');
    return array('status'=>'error','description'=>'Error: For further assistance, please contact us at venon.ir');
    return array('status'=>'info','description'=>'Select your options below');

}

function venon_jdate_deactivate() {

    # Remove Custom DB Table
    $query = "DROP TABLE `mod_venon_jdate`";
	$result = mysql_query($query);

    # Return Result
    return array('status'=>'success','description'=>'Venon Jalali Date addon successfully uninstalled');
    return array('status'=>'error','description'=>'Error: For further assistance, please contact us at venon.ir');
    return array('status'=>'info','description'=>'');

}

function venon_jdate_upgrade($vars) {

    $version = $vars['version'];

    # Run SQL Updates for V1.0 to V1.1
}



function venon_jdate_output($vars) {
	global $results;

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $LANG = $vars['_lang'];

	// Sql query
	$table = "mod_venon_jdate";

	//form submit
	if(!empty($_POST['format'])){
		$update = array("dual"=>$_POST['dual'], "format"=>$_POST['format'], "num"=>$_POST['num']);
		$where = array("setting"=>'options');
		update_query($table,$update,$where);
	}

	$result = mysql_query('SELECT * FROM `mod_venon_jdate` WHERE setting =  "options"');
	$data = mysql_fetch_array($result);
	$format = $data['format'];
	$timezone = $data['timezone'];
	$num = $data['num'];
	$dual = $data['dual'];
	$venonlocalkey = $data['localkey'];

	// addons admin html
    echo '<div class="contexthelp"><a href="http://www.venon.ir" target="_blank"><img src="images/icons/help.png" border="0" align="absmiddle">'.$LANG['venonhelp'].'</a></div>';
	echo '<p>'.$LANG['intro'].'</p>';
	echo '<p>'.$LANG['desc'].'</p>';

    # Allow Script to Run
	//options
	echo '<h4>'.$LANG['formtitle'].'</h4><form method="POST" action="">
	<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3"><tbody>
		<tr><td class="fieldlabel" width="20%">'.$LANG['formattitle'].'</td>
			<td class="fieldarea">'.$LANG['formatdesc'].'<br/>
				<label><input name="format" type="radio" defualt="true" value="Y/m/d"'; if($format == "Y/m/d"){echo 'checked="checked"';}; echo'/>'.$LANG['formatop1'].'</label><br/>
				<label><input name="format" type="radio" defualt="true" value="J F V"'; if($format == "J F V"){echo 'checked="checked"';}; echo'/>'.$LANG['formatop2'].'</label><br/>
				<label><input name="format" type="radio" defualt="true" value="l J F v"'; if($format == "l J F v"){echo 'checked="checked"';}; echo'/>'.$LANG['formatop3'].'</label><br/>
				<label><input name="format" type="radio" defualt="true" value="j F Y"'; if($format == "j F Y"){echo 'checked="checked"';}; echo'/>'.$LANG['formatop4'].'</label><br/>
				<label><input name="format" type="radio" defualt="true" value="l j F Y"'; if($format == "l j F Y"){echo 'checked="checked"';}; echo'/>'.$LANG['formatop5'].'</label><br/><br/>
			</td></tr>
		<tr><td class="fieldlabel" width="20%">'.$LANG['dualdatetitle'].'</td>
			<td class="fieldarea">'.$LANG['dualdatedesc'].'<br/>
				<label><input name="dual" type="radio" defualt="true" value="true"'; if($dual == "true"){echo 'checked="checked"';}; echo'/>'.$LANG['yes'].'</label>
				<label><input name="dual" type="radio" defualt="true" value="false"'; if($dual == "false"){echo 'checked="checked"';}; echo'/>'.$LANG['no'].'</label><br/><br/>
			</td></tr>
		<tr><td class="fieldlabel" width="20%">'.$LANG['numtitle'].'</td>
			<td class="fieldarea">'.$LANG['numdesc'].'<br/>
				<label><input name="num" type="radio" defualt="true" value="fa"'; if($num == "fa"){echo 'checked="checked"';}; echo'/>'.$LANG['numfarsi'].'</label>
				<label><input name="num" type="radio" defualt="true" value="en"'; if($num == "en"){echo 'checked="checked"';}; echo'/>'.$LANG['numenglish'].'</label><br/><br/>
			</td></tr>

	</tbody></table><br/>
	<input class="btn btn-primary" type="submit" value="'.$LANG['submit'].'"/>
	</form>';

}

function venon_jdate_sidebar($vars) {

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $LANG = $vars['_lang'];

    $sidebar = '<span class="header"><img src="images/icons/addonmodules.png" class="absmiddle" width="16" height="16" /> Venon Jdate</span>
<ul class="menu">
        <li><a href="addonmodules.php?module=venon_jdate">Venon Jdate settings</a></li>
        <li><a href="#">Version: '.$version.'</a></li>
    </ul>';
    return $sidebar;
}
?>
