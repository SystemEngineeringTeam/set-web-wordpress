<!DOCTYPE html>
<html>
<head>
<?php get_template_part('common/head'); ?>
<title>愛知工業大学 システム工学研究会-Blog- <?php the_title(); ?></title>
</head>
<body class="mdl-base">
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <?php get_template_part('common/header'); ?>
      <?php get_template_part('common/drawer'); ?>
      <main class="mdl-layout__content">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--8-col">
        <div class="mdl-grid">
              <?php if(have_posts()): while(have_posts()): the_post(); ?>
              <div
            class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
            <div class="mdl-card__media">
                 <?php if ( has_post_thumbnail() ) {?>
                    <?php the_post_thumbnail(); ?>
                 <?php } else { ?>
                 <img
                src="<?php bloginfo('stylesheet_directory'); ?>/images/no.jpg"
                class="card-image" border="0" alt="">
                 <?php }?>
               </div>
            <div class="card-date mdl-card__supporting-text">
              <i class="material-icons">access_time</i> <span><?php echo get_the_date(); ?></span>
            </div>
            <div class="mdl-card__title">
              <h2 class="mdl-card__title-text">
                 <?php the_title(); ?></h2>
            </div>
            <div class="mdl-card__supporting-text">
               <?php the_content(); ?>
               </div>
          </div>
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
</body>
</html>