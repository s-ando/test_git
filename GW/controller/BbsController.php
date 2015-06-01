<?php
namespace GW\controller;

use GW\model\Bbs;

require_once '../model/Bbs.php';

class BbsController
{
    public function index(){
        $db = new Bbs();
        $ret = $db->select();
        include('../view/bbs.php');
    }

    public function insert(){
        $params = $_POST;
        if(isset($params['title']) && isset($params['comment'])){
            $db = new Bbs();
            $ret = $db->insert($params);
            header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
            exit();
        }
        include('../view/insert.php');
    }

    public function logicDelete(){
        $params = $_GET;
        if(isset($params['logicDelete'])){
            $db = new Bbs();
            $db->logicDelete($params['logicDelete']);
        }
        header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
        exit();
    }

    public function delete(){
        $params = $_GET;
        if(isset($params['delete'])){
            $db = new Bbs();
            $db->delete($params['delete']);
        }
        header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
        exit();
    }

    public function update(){
        $params = $_GET;
        $date   = $_POST;
        if(isset($params['update']) && empty($date)){
            $db = new Bbs();
            $ret = array_pop($db->select($params['update']));
            include('../view/update.php');
            exit();
        }else{
            $db = new Bbs();
            $db->update($date);
            header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
            exit();
        }

    }

}

$instance = new BbsController();

$url = $_SERVER['REQUEST_URI'];

if(!strstr($url,'?')){
    $instance->index();
    exit;
}

list($host, $route) = explode('?', $url);

if(strpos($route, 'insert') !== FALSE){
    $instance->insert();
}elseif(strpos($route, 'delete') !== FALSE){
    $instance->delete();
}elseif(strpos($route, 'logicDelete') !== FALSE){
    $instance->logicDelete();
}elseif(strpos($route, 'update') !== FALSE){
    $instance->update();
}
