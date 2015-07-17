<?php

class Admin_ extends CI_Model{  
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function index()  
    {          
        $turn=$this->db->query("select * from image_turn");
        return $turn;
    }   
    function column(){
        $res=array();
        $data=$this->db->query("select * from `column` group by `module` order by `id` asc")->result();
        foreach ($data as $key=>$value) {
            $sql="select * from `column` where module='".$value->module."' order by `id` asc";
            $res[$key]=$this->db->query($sql)->result();
        }
       return $res;
    } 
    function getarticle($method){
        return  $this->db->query("select * from `article_content` where `cid`=(SELECT `id` FROM `column` WHERE `url`='".$method."') order by `id` desc limit 1")->result();
    }
    public function login($user,$pwd){
         $sql="SELECT * FROM `user` WHERE `user`='$user' AND `password`='$pwd'";
         return  $this->db->query($sql)->result();
    }
    /*
     *获取自身下的同一级侧边栏
     */
    public function get_mate($method){
        return $this->db->query("select * from `column` where id in(select id from `column` where `module`=(select `module` from `column` where `url`='".$method."'))")->result();
    }
}  