<?php 
  $twitter_url = get_the_author_meta('twitter'); 
  $twitter_user = str_replace("https://twiter.com/","",$twitter_url);
  $twitter_url = get_the_author_meta( 'twitter' );
  $twitter_user = str_replace("https://twitter.com/", "" , $twitter_url);
?>

<div class="row py-5">
  <dic class="col-6">
    <a class="text-white" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" rel="nofollow" target="_blank">
    <div class="facebook p-3">
      Facebookシェア
    </div>
    </a>
  </dic>
  <dic class="col-6">
    <a class="text-white" href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=<?php echo $twitter_user; ?>">
      <div class="twitter p-3">
        Twitterシェア
      </div>
    </a>
  </dic>
</div>

