<?php

Class  Database implements Crud {
    
    private $con=false;
    private $database='cat';
    private $HostName='localhost';
    private $port='3306';
    private $Uname='root';
    private $pass='123456';
    
    public function  __construct(){
        if(!$this->con){
      $this->connect();
        }
    }
    
    public function connect(){
      if(!$this->con){
        $this->con=  mysqli_connect($this->HostName, $this->Uname, $this->pass, $this->database, $this->port);
      }
    }
    
    public function Categories() {
    $sql = 'select * from categories';
    $res = mysqli_query($this->con, $sql) or die("error  Occerd" . $sql);
    while ($row = mysqli_fetch_object($res)) {
        $cat[$row->id] = $row->category_name;
    }
    return $cat;
}
public function ViewCategories() {
    $sql = 'select * from categories';
    $res = mysqli_query($this->con, $sql) or die("error  Occerd" . $sql);
    while ($row = mysqli_fetch_object($res)) {
        $sql1 = "select * from categories where parent_id=" . $row->id;
        $resSub = mysqli_query($this->con, $sql1) or die("error  Occerd" . $sql1);
        while ($rowSub = mysqli_fetch_object($resSub)) {
            $cat[$row->category_name][$rowSub->id] = $rowSub->category_name;
        }
    }
    return $cat;
}
public function Add($a) {
    $parent_id = $_REQUEST['cat'];
      $Cat = $_REQUEST['subCat'];
    $sql = "INSERT INTO categories SET parent_id='$parent_id', category_name='$Cat' ";
    $res = mysqli_query($this->con, $sql) or die("error  Occerd" . $sql);
    echo 'data saved';
    exit();
}


    
}

interface  Crud{
    public function Add($a);
    public function ViewCategories();
    public function Categories();
}

