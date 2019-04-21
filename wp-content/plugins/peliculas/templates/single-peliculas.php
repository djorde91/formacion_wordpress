<?php 

get_header(); ?>
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single');

				// Start custom code

					//$content_pelis = get_post_field('nombre', $post_id);
					//echo $content_pelis;
					 //$content_post = get_post();

				?>
				<div class="row peliculas_wrap_selector">
					<div class="col-md-8 peliculas_info">

						<?php 

						$fields = get_fields();
						//var_dump($fields);

						if( $fields ): ?>
						    
						        <?php foreach( $fields as $name => $value ): ?>

						        	<?php $field_label = get_field_object($name)['label'];
						        	//var_dump($field_label); 
						        	?>

									<?php if ($value !== '' && $name != "peli_autocompletar"): ?>
										 <p><b><?php echo $field_label .':'; ?></b> <?php echo $value; ?></p>
									<?php endif ?>
						           
						        <?php endforeach; ?>
						    
						<?php endif; ?>

					</div>
					
					<div class="col-md-4 peliculas_poster">
						<!-- <img src="<?php echo $peli_info['Poster'];?>" alt=""> -->
					</div>
				</div>


				<?php
				// END custom code

				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="post-navi" aria-hidden="true">' . __( 'NEXT POST', 'trade-hub' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'trade-hub' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="post-navi" aria-hidden="true">' . __( 'PREVIOUS POST', 'trade-hub' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'trade-hub' ) . '</span> ' .
						'<span class="post-title">%title</span>',

				) );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();
 ?>