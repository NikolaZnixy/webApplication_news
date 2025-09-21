<?php
include_once "connect.php";
function saveArticle($title,$summary,$text,$category,$image_name,$archived){
    global $dbc;
    $determineCategoryStmt=$dbc -> prepare("SELECT id FROM categories WHERE LOWER(categoryName) = LOWER(?)"); //$category
    $determineCategoryStmt -> bind_param('s',$category);
    $determineCategoryStmt -> execute();
    $categoryResult=$determineCategoryStmt->get_result();
    if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
      $categoryData = mysqli_fetch_assoc($categoryResult);
      $categoryId = $categoryData['id'];
    }
    $archiveSqlString = $archived==true ? 1:0;

    $title=mysqli_real_escape_string($dbc,$title);
    $summary=mysqli_real_escape_string($dbc,$summary);
    $text=mysqli_real_escape_string($dbc,$text);
    $image_name=mysqli_real_escape_string($dbc,$image_name);


    $saveStmt=$dbc -> prepare("INSERT INTO article (publishDate, title, summary, content, imagePath, category, archived)
                                            VALUES (CURDATE(), ?, ?, ?, ?, ?, ?)");
                                                  //CURDATE(), '$title', '$summary', '$text', '$image_name', $categoryId, $archiveSqlString)
    $saveStmt -> bind_param('ssssii',$title,$summary,$text,$image_name,$categoryId,$archiveSqlString);
    $saveStmt -> execute();
    mysqli_close($dbc);
}


function showArticles($category,$numberOfArticles,$categoryName,$adminPrivilige){
  global $dbc;
  $category=mysqli_real_escape_string($dbc,$category);
  $stmt=$dbc ->prepare(  "SELECT article.id,publishDate,title,summary,content,imagePath,category,archived
  FROM article
  INNER JOIN categories ON article.category=categories.id
  WHERE article.category = ?
  ORDER BY publishDate DESC
  LIMIT ?");
  $stmt -> bind_param('ii',$category,$numberOfArticles);
  $stmt -> execute();
  $articleResults=$stmt -> get_result();
  if($articleResults->num_rows > 0){
    echo "<section class='category-articles-container'>";
    echo "<div class='article-header'><span>$categoryName</h2><i class='fa-solid fa-caret-right'></i></div>";
    echo"<div class='flex-row-articles'>";
    $articleCounter=0;
    while($row = $articleResults -> fetch_assoc()){
      if($row['archived'] ==1){
        continue;
      }
      echo "<div class='generated-article' id='article-". $row['id']."'>";
      echo"<figure class='generated-article-img-container'><img src='/pwa_Pravi/uploads/" .  $row['imagePath']. "' alt='article-image'></figure>";
      if($adminPrivilige==1){
        echo "<a href='/pwa_Pravi/pages/edit.php?id=" . $row['id'] . "'><p class='generated-title'><b>" . $row['title'] . "</b></p></a>"; 
      }else{
        echo "<a href='/pwa_Pravi/pages/clanak.php?id=" . $row['id'] . "'><p class='generated-title'><b>" . $row['title'] . "</b></p></a>"; 
      }
      echo "<p>" . $row['summary'] . "</p>"; 
      echo "</div>";
      $articleCounter++;
      if($articleCounter%3==0){
        echo"</div>";
        echo"<div class='flex-row-articles'>";
      }
    }
    echo"</div>";
    echo "</section>";
  }
}

function determineCategory($categoryNumber){
  global $dbc;
  $stmt = $dbc->prepare("SELECT categoryName FROM categories WHERE id = ?");
  $stmt->bind_param('i', $categoryNumber);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row['categoryName'];
  } else {
    return "Nepoznato";
  }
}

function getArticle($articleId){
  global $dbc;
  $stmt = $dbc->prepare("SELECT * FROM article WHERE id = ?");
  $stmt->bind_param('i', $articleId);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row;
  }
}

function displayArticle($articleId){
  global $dbc;

  $stmt = $dbc->prepare("SELECT * FROM article WHERE id = ?");
  $stmt->bind_param('i', $articleId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title=$row['title'];
    $summary=$row['summary'];
    $category=$row['category'];
    $text=$row['content'];
    $archive = $row['archived']==1 ? true : false;
    $targetDir = "../uploads/"; 
    $image_name=$row['imagePath'];
    $targetFile = $targetDir . $image_name;
    echo"<div class='text-section'>";
    echo"<h1>$title</h1>";
    echo "</div>";
    echo "<img src='$targetFile' alt='Uploaded Image' id='displayImage'>";
    echo"<div class='text-section'>";
    echo"<p><b>$summary</b></p>";
    echo "<p> $text<p>";
    echo "</div>";
  }

}


function updateArticle($title,$summary,$text,$category,$archived,$articleId,$imageName){
  global $dbc;
  $determineCategoryStmt=$dbc -> prepare("SELECT id FROM categories WHERE LOWER(categoryName) = LOWER(?)"); //$category
  $determineCategoryStmt -> bind_param('s',$category);
  $determineCategoryStmt -> execute();
  $categoryResult=$determineCategoryStmt->get_result();
  if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
    $categoryData = mysqli_fetch_assoc($categoryResult);
    $categoryId = $categoryData['id'];
  }
  $archiveSqlString = $archived==true ? 1:0;

$title=mysqli_real_escape_string($dbc,$title);
$summary=mysqli_real_escape_string($dbc,$summary);
$text=mysqli_real_escape_string($dbc,$text);

if ($imageName != '') {
  $stmt = $dbc->prepare("UPDATE article SET title = ?, summary = ?, content = ?, category = ?, archived = ?, imagePath = ? WHERE id = ?");
  $stmt->bind_param('sssiisi', $title, $summary, $text, $categoryId, $archiveSqlString, $imageName, $articleId);
  unlinkOldImage($articleId);
} else {
  $stmt = $dbc->prepare("UPDATE article SET title = ?, summary = ?, content = ?, category = ?, archived = ? WHERE id = ?");
  $stmt->bind_param('sssiii', $title, $summary, $text, $categoryId, $archiveSqlString, $articleId);
}

$stmt->execute();
header('location: administracija.php?message=Article+successfully+updated');
mysqli_close($dbc);
}

function deleteArticle($articleId){
  global $dbc;
  $stmt = $dbc->prepare("DELETE FROM article WHERE id = ?");
  $stmt->bind_param('i', $articleId);
  $stmt->execute();
header('location: administracija.php?message=Article+successfully+deleted');
mysqli_close($dbc);
}

function unlinkOldImage($id){
  global $dbc;
  $stmt=$dbc ->prepare("SELECT imagePath from article where id=?");
  $stmt -> bind_param('i',$id);
  $stmt -> execute();
  $result=$stmt -> get_result();
  if($row=$result -> fetch_assoc()){
    unlink('../uploads/'.$row['imagePath']);
  }
}
?>