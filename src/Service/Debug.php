<?php
namespace App\Service;

class Debug {
    public function debug($obj)
    {
        if ($_SERVER['LOG_LEVEL'] >=2) {
            echo "<span style='color:DodgerBlue'><b>DEBUG: </span></b><span style='color:" . $_SERVER['LOG_COLOR'] . "'>" . $obj . "</span><br />\n";
        }
        
    }
    public function info($obj)
    {
        if ($_SERVER['LOG_LEVEL'] >= 1) {
            echo "<span style='color:LawnGreen;'><b>INFO: </span></b>" . $obj . "<br />\n";
        }
    }
    public function warning($obj)
    {
        echo "<span style='color:Red;'><b>WARNING: </span></b>" . $obj . "<br />\n";
    }
}

?>