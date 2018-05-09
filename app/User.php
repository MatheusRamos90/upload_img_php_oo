<?php

require 'dataUser.php';

class User extends dataUser{

    protected $table = 'user_info';

    public function create(){

        $extension = strtolower(substr($this->image['name'], -4)); //take the image's extension
        $image = md5(time()).$extension; //give a name for the new image
        $path = 'uploads/'; //select the path for upload

        if(!empty($this->image['name'])){
            move_uploaded_file($this->image['tmp_name'],$path.$image);
        }else{
            $image = 'noimage.png';
        }

        $insert_user = "INSERT INTO $this->table(name,email,technology,image) VALUES(:name,:email,:technology,:image)";
        $user = DB::prepare($insert_user);
        $user->bindParam(':name',$this->name);
        $user->bindParam(':email',$this->email);
        $user->bindParam(':technology',$this->technology);
        $user->bindParam(':image',$image);
        return $user->execute();

    }

    public function getAll(){

        $all_user = "SELECT * FROM $this->table";
        $stm = DB::prepare($all_user);
        $stm->execute();
        return $stm->fetchAll();

    }

    public function delete($id){

        $delete_user = "DELETE FROM $this->table WHERE id = :id";
        $stm = DB::prepare($delete_user);
        $stm->bindParam(':id',$id);
        return $stm->execute();

    }

    public function messageSuccess($msg){

        return "<p class='alert alert-success alert-dismissible' style='float: none;margin: auto' role='alert'><strong>Success!</strong> ".$msg." <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></p>";

    }

    public function messageError($msg){

        return "<p class='alert alert-danger alert-dismissible' style='float: none;margin: auto' role='alert'><strong>Error!</strong> ".$msg." <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></p>";

    }

}