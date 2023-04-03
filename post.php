<?php
$title = 'Post Yaratish';
require 'includes/header.php'; 
require 'database.php';

$id = $_GET['id'];

$statement = $pdo->prepare("SELECT * FROM posts WHERE id = ?");

$statement->execute([$id]);

$post = $statement->fetch();

?>

    <div class="container mt-5">

    <h3><?php echo $post['id'] ?></h3>
    <h1 class="text-body-emphasis"><?php echo $post['title'] ?></h1>
    <p class="fs-5 col-md-8"><?php echo $post['body'] ?></p>

      <p><?php echo $post['created_at'] ?></p>
    <hr class="col-3 col-md-2 mb-5">

   
  </main>
 
</div>
    </div>

<?php require 'includes/footer.php'; ?>