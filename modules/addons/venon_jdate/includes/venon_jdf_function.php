<?php
  //sql query
  $result = mysql_query('SELECT * FROM mod_venon_jdate WHERE setting =  "options"');
  $data = mysql_fetch_array($result);
  $format = $data['format'];
  $timezone = $data['timezone'];
  $num = $data['num'];
  $dual = $data['dual'];

    # Allow Script to Run
	$venon_jdf_formate = $format;
	$venon_jdf_time_zone = $timezone;
	$venon_jdf_num = $num;
	$venon_jdf_dual_date = $dual;

?>
