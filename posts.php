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
                            <a href="/post.php">Все записи</a>
                            <h3>Все статьи</h3>
                            <div class="block__content">
                                <div class="articles articles__horizontal">

                                    <?php
                                    $per_page = 4;
                                    $page = 1;

                                    if (isset($_GET['page'])) {
                                        $page = (int) $_GET['page'];
                                    }


                                    $total_count_q = mysqli_query($connection, "SELECT COUNT('id') AS `total_count` FROM `posts`");
                                    $total_count = mysqli_fetch_assoc($total_count_q);
                                    $total_count = $total_count['total_count'];

                                    $total_pages = ceil($total_count / $per_page);
                                    if ($page <= 1 || $page > $total_pages) {
                                        $page = 1;
                                    }

                                    $offset = ($per_page * $page) - $per_page;
                                    $posts = mysqli_query($connection, "SELECT * FROM `posts` ORDER BY 'id' DESC LIMIT $offset,$per_page");
                                    $posts_exist = true;

                                    if (mysqli_num_rows($posts) <= 0) {
                                        echo "Нет статей";
                                        $posts_exist = false;
                                    }

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
                                <?php
                                if ($posts_exist == true) {
                                    echo '<div class="paginator">';
                                    if ($page > 1) {
                                        echo  '<a href="/posts.php?page=' . ($page - 1) . '">Предыдущая страница</a>';
                                    }
                                    if ($page < $total_pages) {
                                        echo  '<a href="/posts.php?page=' . ($page + 1) . '">Следующая страница</a>';
                                    }
                                    echo '</div>';
                                }
                                ?>
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