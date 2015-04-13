<?php
class hoge
{
    public function hogehoge(){

        $test = 'aaa'; 

        if(is_numeric($test)){
            echo $test;
        }else{
            echo 'do not numeric';
        }
    }
}

$obj = new hoge;
echo $obj->hogehoge();
