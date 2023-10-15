<?php
/**
 * Template part for displaying posts
 *
 * @subpackage Education Insight
 * @since 1.0
 */
?>

<?php
	$education_insight_post_sidebar = get_option( 'education_insight_single_post_sidebar' );
	if ( '1' == $education_insight_post_sidebar ) {
	$education_insight_column = 'col-lg-12 col-md-12';
	} else { 
	$education_insight_column = 'col-lg-8 col-md-8';
	}
?>

<main id="content">
	<?php while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="outer-div">
			<div class="single-post-image">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="inner-div">
	    		<h2><?php the_title();?></h2>
	    		<div class="date-box my-3 align-self-center">
	    			<?php if( get_option('education_insight_date',false) != '1'){ ?>
	    				<span class="mr-2"><i class="far fa-calendar-alt mr-2"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
	    			<?php } ?>
	    			<?php if( get_option('education_insight_admin',false) != '1'){ ?>
	    				<span class="entry-author mr-2"><i class="far fa-user mr-2"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
	    			<?php }?>
	    			<?php if( get_option('education_insight_comment',false) != '1'){ ?>
	  					<span class="entry-comments"><i class="fas fa-comments mr-2"></i> <?php comments_number( __('0 Comments','education-insight'), __('0 Comments','education-insight'), __('% Comments','education-insight')); ?></span>
	  				<?php }?>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	<div class="container">
		<div class="content-area my-5">
			<div id="main" class="site-main" role="main">
		       	<div class="row m-0">
		    		<div class="content_area <?php echo esc_attr( $education_insight_column ); ?>">
				    	<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post(); ?>
								<div id="single-post-section" class="single-post-page entry-content">
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								        <div class="entry-content">
							            	<?php the_content(); ?>
								        </div>
								      	<div class="clearfix"></div> 
									</div>
								</div>
								<?php // If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'education-insight' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'education-insight' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'education-insight' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'education-insight' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
					<?php if ( '1' != $education_insight_post_sidebar ) {?>
						<div id="sidebar" class="col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</main>