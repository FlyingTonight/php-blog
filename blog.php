<?php 
$title = 'Blog';
require 'includes/header.php'; 

require 'database.php';

$statement = $pdo->prepare("SELECT * FROM posts");
$statement->execute();
$posts = $statement->fetchAll();


if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['DELETE']))
{
  $post_id = $_POST['post_id'];
  $statement = $pdo->prepare("DELETE  FROM posts WHERE id=?");
  $statement->execute([$post_id]);
}

?>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Bizning Blog</h1>
        <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="post-create.php" class="btn btn-primary my-2">Post yaratish</a>
          <a href="#" class="btn btn-secondary my-2">Bosh Sahifa</a>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">

      <?php if(isset($_SESSION['post-yaratildi'])):?>
    <div class="alert alert-info" role="alert">
        <?php $_SESSION['post-yaratildi']?>
        <?php unset($_SESSION['post-yaratildi']); ?>
</div>
<?php endif; ?>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($posts as $post): ?>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            <div class="card-body">
              <a href="post.php?id=<?php echo $post['id'] ?>">
                 <h5><?php echo $post['title'] ?></h5>
              </a>
              <p class="card-text"><? echo $post['body'] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>

                  <form method="POST" action=""> 
                    <input type="hidden" name="post_id" valur="<?php echo $post['id']?>">
                    <input type="hidden" name="DELETE">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                  </form>

                </div>
                <small class="text-body-secondary"><? echo $post['created_at'] ?></small>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <div class="col">

      </div>
    </div>
  </div>

</main>

<?php require 'includes/footer.php'; ?>