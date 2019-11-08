<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.venon_jdate.php
 * Type:     modifier
 * Name:     Venon WHMCS jalali date
 * Purpose:  Convert gerorgian to jalali date
 * -------------------------------------------------------------
 */
  function smarty_modifier_venon_jdate($whmcs_date)  {
	// $folder_level = "";
	// while (!file_exists($folder_level . "init.php")) {
  //         $folder_level .= "../";
  //   }
  //   include_once($folder_level . "modules/addons/venon_jdate/includes/jdate.php");
	//   require($folder_level . "modules/addons/venon_jdate/includes/venon_jdf_function.php");

  if(!function_exists('jdate')) {
    include_once(__DIR__ . "/../../../../../modules/addons/venon_jdate/includes/jdate.php");
  }
  require(__DIR__ . "/../../../../../modules/addons/venon_jdate/includes/venon_jdf_function.php");

	if(strpos($whmcs_date,':')) {$venon_jdf_formate .= ' (H:i)';}
  $whmcs_date = str_replace(array("(", ")"), "", $whmcs_date);


    $shmasi = jdate($venon_jdf_formate,strtotime($whmcs_date),'',$venon_jdf_time_zone,$venon_jdf_num);
		if ($venon_jdf_dual_date === 'true'){
			echo '(' .$whmcs_date .') ';
		}
    return $shmasi;

  }
?>
