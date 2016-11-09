<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bstrap-lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('panel panel-info'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
				
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('post-img', array( 'class' => '' )); ?>
			</a>
	<?php endif; ?>
	<div class="panel-body">
<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<div><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></div>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
<?php
/*<header class="entry-header panel-heading">
		
		<div class="entry-meta">
		<?php bstrap_lite_posted_on(); ?>
			
		<?php endif; // End if categories ?>
		
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->*/?>

				
					
	
		
		
		<!-- display manual excerpt if it exists otherwise the content -->
		<?php the_excerpt(); ?>
			
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bstrap-lite' ),
				'after'  => '</div>',
			) );
		?>
		<p class="pull-right"><a class="more-link btn btn-primary" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php _e('Read More','bstrap-lite'); ?></a></p>
	</div><!-- .entry-content -->
	
	
	<footer class="entry-footer panel-footer entry-meta">
	<?php bstrap_lite_posted_on(); ?>
		<div><?php bstrap_lite_entry_footer(); ?></div>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
