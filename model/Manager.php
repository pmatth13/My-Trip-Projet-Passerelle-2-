<?php
// Fichier qui permet de se connecter à la BDD -> Pour se faire je vais créer une class en POO 
    class Manager {

        protected function dbConnect(){
            $db = new PDO('mysql:host=localhost;dbname=my_trip;charset=utf8', 'root', '');
            return $db;
        }
    }