<div id="contents-container" class="container">
  <h1>Contents</h1>
  <ul id="contents-list">
  <?php foreach ($links as $link) { ?>
    <li>
      <a href="<?php echo $link->link(); ?>"><?php echo $link->name(); ?></a>: <?php echo $link->desc(); ?>
    </li>
  <?php } ?>
  </ul>
</div>