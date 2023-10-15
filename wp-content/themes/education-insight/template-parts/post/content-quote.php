<?php
/**
 * Template part for displaying posts
 *
 * @subpackage Education Insight
 * @since 1.0
 */
?>

<div id="Category-section" class="entry-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class('quotepost'); ?>>
		<div class="postbox smallpostimage">
			
			<div class="box-content text-center">
		        	<a href="<?php the_permalink(); ?>"><h1 class="quote-content"><?php  echo get_the_content();?></h1></a> 
	            	
	            </div>
        	<div class="overlay">
        		<div class="date-box">
        			<?php if( get_option('education_insight_date',false) != '1'){ ?>
        				<span><i class="far fa-calendar-alt"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
        			<?php }?>
        			<?php if( get_option('education_insight_admin',false) != '1'){ ?>
        				<span class="entry-author"><i class="far fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
        			<?php }?>
        			<?php if( get_option('education_insight_comment',false) != '1'){ ?>
      					<span class="entry-comments"><i class="fas fa-comments"></i> <?php comments_number( __('0 Comments','education-insight'), __('0 Comments','education-insight'), __('% Comments','education-insight')); ?></span>
      				<?php }?>
    			</div>
        	</div>
	      	<div class="clearfix"></div> 
	  	</div>
	</div>
</div>