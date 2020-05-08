<!--パンクズりすと-->
<div class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo home_url(); ?>">
      HOME
    </a>
  </li>
  <?php if(is_single()): ?>
    <?php
      $cats = $sort = array();
      $category = get_the_category();
      foreach ($category as $cat){
        $layer = count(get_ancestors($cat->term_id,'category'));
        $cats[] = array(
          'name' => $cat->name,
          'id' => $cat->term_id,
          'layer' => $layer
        );
        $sort[] = $layer;
      }
      //var_dump($sort);
      array_multisort($sort, SORT_ASC, $cats);
      //var_dump($cats);
      ?>
      <?php foreach ($cats as $cat): ?>
        <li class="breadcrumb-item">
          <a href="<?php echo get_category_link($cat['id']); ?>">
            <?php echo $cat['name']; ?>
          </a>
        </li>
      <?php endforeach; ?>
  <?php endif; ?>

</div>