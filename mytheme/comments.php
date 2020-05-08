<?php if( have_comments()): ?>
  <?php wp_list_comments( array(
    'style' => 'div',
    'reply_text'=> '返信する'
  ));?>
<?php endif; ?>

<?php comment_form(); ?>