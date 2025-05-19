<?php

class DB {

    public static function connect() {
        $dbh = new PDO('mysql:host=localhost;dbname=inventario-slim', 'root', '');
        return $dbh;
    }
}
?>