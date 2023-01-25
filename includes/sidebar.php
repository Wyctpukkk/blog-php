<div class="block">
  <h3>Мы_знаем</h3>
  <div class="block__content">
    <script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=02op3nb0crr&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
  </div>
</div>
<div class="block">
  <h3>Топ читаемых статей</h3>
  <div class="block__content">
    <div class="articles articles__vertical">
      <?php
      $posts = mysqli_query($connection, "SELECT * FROM `posts`  ORDER BY 'views' DESC LIMIT 5");
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
  <h3>Комментарии</h3>
  <div class="block__content">
    <div class="articles articles__vertical">
      <?php
      $comments = mysqli_query($connection, "SELECT * FROM `comments`  ORDER BY 'id' DESC LIMIT 5");
      while ($comment = mysqli_fetch_assoc($comments)) {
      ?>
        <article class="article">
          <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo md5($comment['email']) ?>);"></div>
          <div class="article__info">
            <a href="/post.php?id=<?php echo $comment['post_id'] ?>"><?php echo $comment['author'] ?></a>
            <div class="article__info__meta">
            </div>
            <div class="article__info__preview"><?php echo mb_substr(strip_tags($comment['text']), 0, 50, 'utf-8') . ' ...' ?></div>
          </div>
        </article>
      <?php
      }
      ?>
    </div>
  </div>
</div>