<?php
require "includes/config.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title'] ?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>

<body>
  <div id="wrapper">

    <?php include "includes/header.php"; ?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a href="/posts.php">Все записи</a>
              <h3>Новейшее_в_блоге</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                  <?php
                  $posts = mysqli_query($connection, "SELECT * FROM `posts` ORDER BY 'id' DESC LIMIT 10");
                  while ($post = mysqli_fetch_assoc($posts)) {
                  ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(/media/images/<?php echo $post['image'] ?>);"></div>
                      <div class="article__info">
                        <a href="/post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a>
                        <div class="article__info__meta">
                          <?php
                          $post_cat = false;
                          foreach ($categories as $cat) {
                            if ($cat['id'] == $post['categories_id']) {
                              $post_cat = $cat;
                              break;
                            }
                          }
                          ?>
                          <small>Категория: <a href="/post.php?category=<?php echo $post_cat['id'] ?>"><?php echo $post_cat['title'] ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo mb_substr(strip_tags($post['text']), 0, 90, 'utf-8') . ' ...' ?></div>
                      </div>
                    </article>
                  <?php
                  }
                  ?>

                </div>
              </div>
            </div>

            <div class="block">
              <a href="/post.php?category=7">Все записи</a>
              <h3>Безопасность [Новейшее]</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                  <?php
                  $posts = mysqli_query($connection, "SELECT * FROM `posts` WHERE `categories_id` = 10 ORDER BY 'id' DESC LIMIT 10");
                  while ($post = mysqli_fetch_assoc($posts)) {
                  ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(/media/images/<?php echo $post['image'] ?>);"></div>
                      <div class="article__info">
                        <a href="/post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a>
                        <div class="article__info__meta">
                          <?php
                          $post_cat = false;
                          foreach ($categories as $cat) {
                            if ($cat['id'] == $post['categories_id']) {
                              $post_cat = $cat;
                              break;
                            }
                          }
                          ?>
                          <small>Категория: <a href="/post.php?category=<?php echo $post_cat['id'] ?>"><?php echo $post_cat['title'] ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo mb_substr(strip_tags($post['text']), 0, 90, 'utf-8') . ' ...' ?></div>
                      </div>
                    </article>
                  <?php
                  }
                  ?>

                </div>
              </div>
            </div>

            <div class="block">
              <a href="#">Все записи</a>
              <h3>Программирование [Новейшее]</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                  <?php
                  $posts = mysqli_query($connection, "SELECT * FROM `posts` WHERE `categories_id` = 7 ORDER BY 'id' DESC LIMIT 10");
                  while ($post = mysqli_fetch_assoc($posts)) {
                  ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(/media/images/<?php echo $post['image'] ?>);"></div>
                      <div class="article__info">
                        <a href="/post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a>
                        <div class="article__info__meta">
                          <?php
                          $post_cat = false;
                          foreach ($categories as $cat) {
                            if ($cat['id'] == $post['categories_id']) {
                              $post_cat = $cat;
                              break;
                            }
                          }
                          ?>
                          <small>Категория: <a href="/post.php?category=<?php echo $post_cat['id'] ?>"><?php echo $post_cat['title'] ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo mb_substr(strip_tags($post['text']), 0, 90, 'utf-8') . ' ...' ?></div>
                      </div>
                    </article>
                  <?php
                  }
                  ?>

                </div>
              </div>
            </div>
          </section>
          <section class="content__right col-md-4">

            <?php include "includes/sidebar.php" ?>


          </section>
        </div>
      </div>
    </div>

    <?php
    include 'includes/footer.php'
    ?>

  </div>
</body>

</html>