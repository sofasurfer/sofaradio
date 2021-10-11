<?php


function is_stream_running($icecast_host, $icecast_port) {
  $status_url = "http://{$icecast_host}:{$icecast_port}/status-json.xsl";
  $status_dat = @file_get_contents($status_url);

  if ($status_dat === FALSE) {
    return FALSE;
  }
  $status_arr = json_decode($status_dat, true);

  if ($status_arr === NULL || !isset($status_arr["icestats"])) {
    return FALSE;
  }
  return ($status_arr["icestats"]["source"]) ? true : false;
}


function get_stream($icecast_host, $icecast_port) {
  $status_url = "http://{$icecast_host}:{$icecast_port}/status-json.xsl";
  $status_dat = @file_get_contents($status_url);

  if ($status_dat === FALSE) {
    return FALSE;
  }
  $status_arr = json_decode($status_dat, true);

  if ($status_arr === NULL || !isset($status_arr["icestats"])) {
    return FALSE;
  }
  return $status_arr["icestats"]["source"];
}