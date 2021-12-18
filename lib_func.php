<?php 
    function koneksi_db() { 
        $host = "localhost"; 
        $database = "db_cobaregionmaps"; 
        $user = "root"; // isikan sesuai yang diisi sewaktu membuka PhpMyadmin
        $password = "";  // isikan sesuai yang diisi sewaktu membuka PhpMyadmin
        $link=mysqli_connect($host,$user,$password,$database); 
        // mysql_select_db($database,$link);
        // if(!$link) 
        //    echo "Error : ".mysql_error(); 
        return $link; 
    }

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }
 ?>