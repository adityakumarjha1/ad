<?php
/**
 * The template for displaying all pages
 * 
 * @subpackage Education Insight
 * @since 1.0
 */

get_header(); ?>

<main id="content" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="outer-div">
			<div class="single-post-image">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="inner-div">
	    		<h2><?php the_title();?></h2>				
	    	</div>
		</div>
	<?php endwhile; ?>
	<div class="content-area my-5">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'education-insight' ),
								'after'  => '</div>',
							) );
						?>
					</div>
				</article>
			<?php endwhile; // End of the loop. ?>
		<div class="clearfix"></div> 
		</div>	
	</div>
</main>

<?php get_footer();
