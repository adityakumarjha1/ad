<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
  <?php if( get_option('education_insight_hide_show') == '1'){ ?>
    <section id="slider">
      <div class="slid-bg">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <?php
            for ( $i = 1; $i <= 4; $i++ ) {
              $educate_training_coach_mod =  get_theme_mod( 'education_insight_post_setting' . $i );
              if ( 'page-none-selected' != $educate_training_coach_mod ) {
                $education_insight_slide_post[] = $educate_training_coach_mod;
              }
            }
             if( !empty($education_insight_slide_post) ) :
            $educate_training_coach_args = array(
              'post_type' =>array('post','page'),
              'post__in' => $education_insight_slide_post
            );
            $educate_training_coach_query = new WP_Query( $educate_training_coach_args );
            if ( $educate_training_coach_query->have_posts() ) :
              $i = 1;
          ?>
          <div class="carousel-inner" role="listbox">
            <?php  while ( $educate_training_coach_query->have_posts() ) : $educate_training_coach_query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php if(has_post_thumbnail()){ ?>
                  <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                <?php }else { ?><div class="bg-color"></div> <?php } ?>
              <div class="carousel-caption slider-inner">
                <div class="inner_carousel">
                  <h2><?php the_title();?></h2>
                  <p><?php echo wp_trim_words( get_the_content(),25 );?></p>
                  <div class="slide-btn mt-4 mt-md-4">
                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','educate-training-coach'); ?></a>
                  </div>
                </div>
              </div>
            </div>
            <?php $i++; endwhile;
            wp_reset_postdata();?>
          </div>
          <?php else : ?>
          <div class="no-postfound"></div>
            <?php endif;
          endif;?>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="clearfix"></div>
      </div>      
    </section>
  <?php }?>  
  <?php if( get_option('education_insight_popular_courses_hide_show') == '1'){ ?>
    <?php if( get_theme_mod('education_insight_popular_courses_heading') != '' || get_theme_mod('education_insight_popular_courses_setting') != ''){ ?>
      <section id="course-cat">
        <div class="container">
          <div class="cours-head">
            <?php if( get_theme_mod('educate_training_coach_courses_heading') != ''){ ?>
              <h3 class="cour-main-hd text-center mb-3"><?php echo esc_html(get_theme_mod('educate_training_coach_courses_heading','')); ?></h3>
            <?php }?>
            <?php if( get_theme_mod('educate_training_coach_courses_text') != ''){ ?>
            <h6 class="cours-txt text-center mx-auto w-50"><?php echo esc_html(get_theme_mod('educate_training_coach_courses_text','')); ?></h6>
            <?php }?>          
          </div>
          <div class="row">
            <?php
            $educate_training_coach_catData1=  get_theme_mod('education_insight_popular_courses_setting');if($educate_training_coach_catData1){
            $educate_training_coach_page_query = new WP_Query(array( 'category_name' => esc_html($educate_training_coach_catData1 ,'educate-training-coach')));?>
              <?php while( $educate_training_coach_page_query->have_posts() ) : $educate_training_coach_page_query->the_post(); ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="box mb-4">
                    <?php the_post_thumbnail(); ?>
                    <div class="lesson-box px-4">
                      <?php if( get_post_meta($post->ID, 'educate_training_coach_courses_lesson', true) ) {?>
                        <span class="crs-less mr-3"><i class="fas fa-book mr-2"></i><?php echo esc_html(get_post_meta($post->ID,'educate_training_coach_courses_lesson',true)); ?></span>
                      <?php }?>
                      <?php if( get_post_meta($post->ID, 'educate_training_coach_courses_student', true) ) {?>
                        <span class="crs-std"><i class="fas fa-user mr-2"></i><?php echo esc_html(get_post_meta($post->ID,'educate_training_coach_courses_student',true)); ?></span>
                      <?php }?>
                    </div>
                    <div class="box-inner p-4">
                      <?php if( get_post_meta($post->ID, 'educate_training_coach_courses_amount', true) ) {?>
                        <h5><?php echo esc_html(get_post_meta($post->ID,'educate_training_coach_courses_amount',true)); ?></h5>
                      <?php }?>
                      <h4 class="mb-3"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>                    
                    </div>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            }?>
          </div>
        </div>
      </section>
    <?php }?>
  <?php }?> 
  <?php if( get_option('education_insight_middle_sec_hide_show') == '1'){ ?>
    <?php if( get_theme_mod('education_insight_middle_sec_page_settigs') != '' || get_theme_mod('education_insight_middle_sec_settigs') != ''){ ?>
      <section id="middle-sec">
        <div class="container">
          <div class="middle-sec-inner">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <?php
                  $educate_training_coach_mod =  get_theme_mod( 'education_insight_middle_sec_page_settigs' );
                  if ( 'page-none-selected' != $educate_training_coach_mod ) {
                    $education_insight_page[] = $educate_training_coach_mod;
                  }
                  if( !empty($education_insight_page) ) :
                  $educate_training_coach_args = array(
                    'post_type' =>'page',
                    'post__in' => $education_insight_page
                  );
                  $educate_training_coach_query = new WP_Query( $educate_training_coach_args );
                  if ( $educate_training_coach_query->have_posts() ) :
                ?>
                <?php  while ( $educate_training_coach_query->have_posts() ) : $educate_training_coach_query->the_post(); ?>
                  <div class="middle-sec-box">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                    <p><?php echo wp_trim_words( get_the_content(),40);?></p>
                  </div>
                <?php endwhile;
                wp_reset_postdata();?>
                <?php else : ?>
                <div class="no-postfound"></div>
                  <?php endif;
                endif;?>
              </div>
              <div class="col-lg-8 col-md-8">
                <div class="row">
                  <?php
                    for ( $education_insight_s = 1; $education_insight_s <= 4; $education_insight_s++ ) {
                      $educate_training_coach_mod =  get_theme_mod( 'education_insight_middle_sec_settigs' . $education_insight_s );
                      if ( 'page-none-selected' != $educate_training_coach_mod ) {
                        $education_insight_post[] = $educate_training_coach_mod;
                      }
                    }
                     if( !empty($education_insight_post) ) :
                    $educate_training_coach_args = array(
                      'post_type' =>array('post','page'),
                      'post__in' => $education_insight_post
                    );
                    $educate_training_coach_query = new WP_Query( $educate_training_coach_args );
                    if ( $educate_training_coach_query->have_posts() ) :
                      $education_insight_s = 1;
                  ?>
                  <?php  while ( $educate_training_coach_query->have_posts() ) : $educate_training_coach_query->the_post(); ?>
                    <div class="col-lg-3 col-md-6 pl-lg-0 pl-md-0">
                      <div class="<?php echo esc_html(('mid-inner-box').$education_insight_s) ?>">
                        <i class="<?php echo esc_html(get_theme_mod('education_insight_mid_section_icon'. $education_insight_s)); ?>"></i>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                        <p><?php echo wp_trim_words( get_the_content(),8 );?></p>
                      </div>
                    </div>
                  <?php $education_insight_s++; endwhile;
                  wp_reset_postdata();?>
                  <?php else : ?>
                  <div class="no-postfound"></div>
                    <?php endif;
                  endif;?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php }?>
  <?php }?> 
</main>

<?php get_footer(); ?>
