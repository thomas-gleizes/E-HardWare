<?php

require_once ("../model/ModelAjax.php");


class ControllerAjax {

    public static function add(){
        $id = $_GET['id'];
        $tab = ModelAjax::add($id);
        foreach ($tab as $value){
            foreach ($value as $val){
                echo $val."£";
            }
        }
    }


    public static function card(){
        $tab = ModelAjax::card();
        foreach ($tab as $value){
            foreach ($value as $val){
                echo $val."£";
            }
        }
    }

    public static function marque(){
        $tab = ModelAjax::marque();
        foreach ($tab as $value){
            foreach ($value as $val){
                echo $val."£";
            }
        }
    }

    public static function result(){
        $result = $_GET['result'];
        $tab = ModelAjax::result($result);
        foreach ($tab as $value){
            foreach ($value as $val){
                echo $val."£";
            }
        }
    }


}
