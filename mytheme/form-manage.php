<div class="wrap">
<h2>MyTheme管理</h2>
  <form method="post" action="options.php"> 
    <?php
    settings_fields('original-field-manage');
    do_settings_sections('original-field-manage');
    ?>
    <label>ピックアップ記事</label>
    <?php $field_name = 'mytheme_pickup_article';?>
    <input type="text"
            placeholder="例)1,2,3"
            id="<?php echo $field_name; ?>"
            name="<?php echo $field_name; ?>"
            value="<?php echo esc_attr(get_option($field_name)); ?>">
    <p>投稿IDを「,」カンマ区切りで指定</p>
    <label>ファビコン </label>
    <?php $field_name = 'mytheme_favicon_img';?>
    <input type="text"
            id="<?php echo $field_name; ?>"
            name="<?php echo $field_name; ?>"
            value="<?php echo esc_attr(get_option($field_name)); ?>">
    <p>ファビコン のURLを指定</p>
    <?php submit_button(); ?>
  </form>
</div>