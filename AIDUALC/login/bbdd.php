<?php
    $conn = new mysqli("localhost","Claudia","rZ1ZLIp(4yMk[TsV","tfg_aidualc");
    if(mysqli_connect_errno()){
        echo "Conexion fallida %s\n",mysqli_connect_errno();
        exit();
    }