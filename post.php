<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Блог IT_Минималиста!</title>
  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>

<body>
  <div id="wrapper">

    <?php include "includes/header.php";
    $post = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` = " . (int)$_GET['id']);
    if (mysqli_num_rows($post) <= 0) {
    ?>
      <div id="content">
        <div class="container">
          <div class="row">
            <section class="content__left col-md-8">
              <div class="block">
                <h3>Обо мне</h3>
                <div class="block__content">
                  <img src="/media/images/post-image.jpg">
                  <div class="full-text">
                    Запрашиваемая статья не найдена
                  </div>
                </div>
              </div>
            </section>
            <section class="content__right col-md-4">
              <?php include "../includes/sidebar.php" ?>
            </section>
          </div>
        </div>
      </div>
    <?php
    } else {
      $first_post = mysqli_fetch_assoc($post);
      mysqli_query($connection, "UPDATE `posts` SET `views` = `views` + 1 WHERE `id` =" . (int) $first_post['id']);
    ?>
      <div id="content">
        <div class="container">
          <div class="row">
            <section class="content__left col-md-8">
              <div class="block">
                <a><?php echo $first_post['views'] ?> Просмотров</a>
                <h3><?php echo $first_post['title'] ?></h3>
                <div class="block__content">
                  <img src="/media/images/<?php echo $first_post['image'] ?>" style='max-width:100%'>
                  <div class="full-text">
                    <?php echo $first_post['text'] ?>
                  </div>
                </div>
              </div>

              <div class="block">
                <a href="#comment-add-form">Добавить свой</a>
                <h3>Комментарии</h3>
                <div class="block__content">
                  <div class="articles articles__vertical">
                    <?php
                    $comments = mysqli_query($connection, "SELECT * FROM `comments`  WHERE `post_id` = " . (int) $first_post['id'] . " ORDER BY `id` DESC");
                    if (mysqli_num_rows($comments) <= 0) {
                      echo "Комментариев еще нет!";
                    }
                    while ($comment = mysqli_fetch_assoc($comments)) {
                    ?>
                      <article class="article">
                        <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo $comment['email'] ?>);"></div>
                        <div class="article__info">
                          <a href="/post.php?id=<?php echo $comment['post_id'] ?>"><?php echo $comment['author'] ?></a>
                          <div class="article__info__meta">
                          </div>
                          <div class="article__info__preview"><?php echo $comment['text'] ?></div>
                        </div>
                      </article>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>

              <div class="block">
                <a href="#comment-add-form">Добавить свой</a>
                <h3>Добавить комментарий</h3>
                <div class="block__content">
                  <form class="form" method="POST" action="/post.php?id=<?php echo $first_post['id'] ?>#comment-add-form">
                    <?php
                    if (isset($_POST['do_post'])) {
                      $errors = array();
                      if ($_POST['name'] == '') {
                        $errors[] = 'Введите имя!';
                      }
                      if ($_POST['nickname'] == '') {
                        $errors[] = 'Введите ваш никнейм!';
                      }
                      if ($_POST['email'] == '') {
                        $errors[] = 'Введите Email!';
                      }
                      if ($_POST['text'] == '') {
                        $errors[] = 'Введите Текст!';
                      }
                      if (empty($errors)) {

                        mysqli_query($connection, "INSERT INTO `comments` (`author`,`nickname`,
                        `email`,`text`,`pubdate`,`post_id`) VALUES ('" . $_POST['name'] . "',
                        '" . $_POST['nickname'] . "','" . $_POST['email'] . "','" . $_POST['text'] . "', NOW(), '" . $first_post['id'] . "')");


                        echo '<span style="color:green; font-weight:bold;
                         margin-bottom:10px; display-block:done"> Комментарий добавлен! </span>';
                      } else {
                        echo '<span style="color:red; font-weight:bold;
                        margin-bottom:10px; display-block:done">' . $errors['0'] . '</span>';
                      }
                    } ?>
                    <div class="form__group">
                      <div class="row">
                        <div class="col-md-4">
                          <input type="text" name="name" class="form__control" placeholder="имя">
                        </div>
                        <div class="col-md-4">
                          <input type="text" name="nickname" class="form__control" placeholder="Никнейм">
                        </div>
                        <div class="col-md-4">
                          <input type="text" name="email" class="form__control" placeholder="Email (не будет показан)">
                        </div>
                      </div>
                    </div>
                    <div class="form__group">
                      <textarea class="form__control" name="text" placeholder="Текст комментария ..."></textarea>
                    </div>
                    <div class="form__group">
                      <input type="submit" name="do_post" value="Добавить комментарий" class="form__control">
                    </div>
                  </form>
                </div>
              </div>

            </section>
            <section class=" content__right col-md-4">
              <?php include "includes/sidebar.php" ?>
            </section>
          </div>
        </div>
      </div>
    <?php
    }
    include 'includes/footer.php'
    ?>
  </div>
</body>

</html>