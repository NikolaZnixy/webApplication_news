<?php
include "connect.php";     
include "functions.php" ;
        if(isset($_POST['edit-article'])){
            $image = $_FILES['image-edit']['name'] ?? '';
            $image_name='';
            if($image!=''){
                $targetDir = "../uploads/"; 
                $image_name=basename($image);
                $targetFile = $targetDir . $image_name;
                move_uploaded_file($_FILES['image-edit']['tmp_name'], $targetFile);
            } 

            $archive = isset($_POST['archive']) ? true : false;
            updateArticle($_POST['title'],$_POST['summary'],$_POST['text'],$_POST['category'],$archive,$_POST['article-id'],$image_name);
        }
        if(isset($_POST['delete-article'])){
            deleteArticle($_POST['article-id']);
        }
?>