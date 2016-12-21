<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cards</title>
  </head>
  <body>
    <h1>Cards</h1>
    <?php foreach($cards as $card): ?>
      <div class="card">
        <p><a href="cards/<?php echo e($card->id); ?>">Title: <?php echo e($card->title); ?></a></p>
      </div>
    <?php endforeach; ?>
  </body>
</html>
