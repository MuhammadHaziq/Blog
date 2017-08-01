<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/25/2017
 * Time: 3:43 PM
 */
class db{
    private $conn;
    public function connection(){
     try {
         $this->conn = new PDO("mysql:host=localhost;dbname=blog", 'root', '');
         $this->conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
         //echo "database connected";
           }catch (PDOException $e){
               echo "error" . $e->getMessage();
     }
     }

     public function select($tablename){
         $this->connection();
         $query="SELECT * FROM $tablename";
            $result= $this->conn->prepare($query);
             $result->execute();
               $result->setFetchMode(PDO::FETCH_ASSOC);
         return $result;

     }
    public function Register($name, $email, $status, $password)
    {

            $this->connection();
            $query = $this->conn->prepare("INSERT INTO users(name, email,password , status) VALUES (:name,:email,:password, :status)");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->bindParam("status", $status, PDO::PARAM_STR);
            return $query->execute();


    }
    public function posts($title , $text, $userid ,$username ){

        $this->connection();
        $query = $this->conn->prepare("INSERT INTO posts(title , text, userid , username ) VALUES (:title , :text , :userid , :username)");
        $query->bindparam("title" , $title , PDO::PARAM_STR);
        $query->bindparam("text" , $text , PDO::PARAM_STR);
        $query->bindparam("userid" , $userid , PDO::PARAM_STR);
        $query->bindparam("username" , $username ,PDO::PARAM_STR);
        return $query->execute();



    }
    public function comment($comment ,$username, $userid )
    {
        $this->connection();
        $query = $this->conn->prepare("INSERT INTO comment(comment , username, userid) VALUES (:comment , :username ,:userid) ");
        $query->bindparam("comment", $comment, PDO::PARAM_STR);
        $query->bindparam("username", $username, PDO::PARAM_STR);
        $query->bindparam("userid", $userid, PDO::PARAM_STR);
        return $query->execute();
    }
    public function select1($id)
    {
        $this->connection();
        $query = $this->conn->prepare('SELECT * FROM posts WHERE id=:id');
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $query->fetchAll(PDO::FETCH_ASSOC);
        return $query->execute();
    }

     public function selectbyemail($tablename, $email){
         $this->connection();
         $query="SELECT * FROM $tablename WHERE email = $email";
         $result= $this->conn->prepare($query);
         $result->execute();
         $result->setFetchMode(PDO::FETCH_ASSOC);
         return $result->execute();
     }
     public function alreadyexist($tablename , $id){
         $this->connection();
         $query= $this->conn->prepare("SELECT * FROM $tablename WHERE id = :id");
         $query->bindParam(':id' ,$id , PDO::PARAM_STR);
         $query->execute();
         $query->fetchAll(PDO::FETCH_ASSOC);
         return $query->execute();
     }
     public function query($query){
         $this->connection();
         if($this->conn->$query("query")){
             $query->execute();
             return true;
         }else{
             return false;
         }
     }
     public function delete($table , $id){
         $this->connection();
         $sql = "DELETE FROM $table WHERE id =  :id";
         $query = $this->conn->prepare($sql);
         $query->bindParam(':id', $id, PDO::PARAM_INT);
          return $query->execute();
     }
     /*public function update($table , $id ,$title , $text){
         $this->connection();
         $sql = "UPDATE $table SET title = :title, text = :text  
            WHERE id = :id";
         $query = $this->conn->prepare($sql);
         $query->bindParam(':text', $text, PDO::PARAM_STR);
         $query->bindParam(':title', $title, PDO::PARAM_STR);
         $query->bindParam(':id', $id, PDO::PARAM_STR);
          return $query->execute();

     }*/
}