<!DOCTYPE html>
<html>
<head>
<?php get_template_part('common/head'); ?>
<title><?php the_title(); ?> | Blog - 愛知工業大学 システム工学研究会</title>
</head>
<body class="mdl-base">
<?php 
 $image_url = null;
?>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--no-desktop-drawer-button">
      <?php get_template_part('common/header'); ?>
      <?php get_template_part('common/drawer'); ?>
      <main class="mdl-layout__content">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--8-col">
        <div class="mdl-grid">
              <?php if(have_posts()): while(have_posts()): the_post(); ?>
              <article
                class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                  <div class="mdl-card__media">
                 <?php if ( has_post_thumbnail() ) {?>
                    <?php the_post_thumbnail('large', array('class' => 'card-image-single')); ?>
                    <?php 
                    $image_id = get_post_thumbnail_id();
                    $image_url = wp_get_attachment_image_src($image_id, true)[0];
                    ?>
                 <?php } else { ?>
                 <img
                    <?php 
                      $image_url = (bloginfo('stylesheet_directory') . "/images/no.jpg");
                    ?>
                src="<?php bloginfo('stylesheet_directory'); ?>/images/no.jpg"
                class="card-image-single" border="0" alt="">
                 <?php }?>
               </div>
            <div class="card-date mdl-card__supporting-text">
              <i class="material-icons">access_time</i>
              <span> 
                <time datetime="<?php the_time('c'); ?>"><?php echo get_the_date();?> </time>
                <span>, 著者 <?php the_author(); ?></span>
              </span>
            </div>
            
            <div class="mdl-card__title">
              <h2 class="mdl-card__title-text">
                 <?php the_title(); ?></h2>
            </div>
            <div class="mdl-card__supporting-text">
               <?php the_content(); ?>
               </div>
          </article>
          
              <?php endwhile; endif; ?>
            </div>
      </div>
      <div class="mdl-cell mdl-cell--4-col">
            <?php get_sidebar();?>
      </div>
      </div>
        <?php get_template_part('common/footer'); ?>
      </main>
  </div>
  
<script type="application/ld+json">
{
  "@context":"http://schema.org",
  "@type":"BlogPosting",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"<?php echo get_permalink(); ?>"
  },
  "image": {
    "@type": "ImageObject",
    "url": "<?php echo $image_url; ?>",
    "height": "1024",
    "width": "1024"
  },
  "headline":"<?php the_title(); ?>",
  "datePublished": "<?php the_time('c'); ?>",
  "dateModified": "<?php the_modified_date('c'); ?>",
  "articleBody": "<?php global $post; echo(str_replace(PHP_EOL, '', $post->post_content));?>",
  "author": {
    "@type": "Person",
    "name": "<?php the_author(); ?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "システム工学研究会",
    "logo": {
      "@type": "ImageObject",
      "url": "http://set1.ie.aitech.ac.jp/images/set_icon.jpg",
      "height": "370",
    "width": "370"
    }
  }
}
</script>
</body>
</html>