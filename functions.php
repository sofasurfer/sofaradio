<?php

class SimpleStream{

    public function is_stream_running($icecast_host, $icecast_port) {
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


    public function get_stream_info($icecast_host, $icecast_port) {
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

    public function get_stream_log($icecast_logfile) {
        $tracklist = array();
        $handle = @fopen($icecast_logfile, "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $data = explode('|',$buffer);
                $time = strtotime($data[0]);
                $tracklist[] =  array(
                    'date' => date('D h:i',$time),
                    'title' => $data[3]
                ); 
            }
            if (!feof($handle)) {
                $tracklist[] = "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        return $tracklist;
    }

}