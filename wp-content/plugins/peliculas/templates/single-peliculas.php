<?php 

get_header(); ?>
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single');

				// Start custom code
					$peli_info =  api_movie_info();
				?>
				<div class="row">
					<div class="col-md-8">
					<p> <strong>Nombre:</strong> <?php echo $peli_info['Title'];  ?></p>
					<p> <strong>Año:</strong> <?php echo $peli_info['Year'];  ?></p>
					<p> <strong>Rated:</strong> <?php echo $peli_info['Rated'];  ?></p>
					<p> <strong>Released:</strong> <?php echo $peli_info['Released'];  ?></p>
					<p> <strong>Language:</strong> <?php echo $peli_info['Language'];  ?></p>
					<p> <strong>Country:</strong> <?php echo $peli_info['Country'];  ?></p>
					<p> <strong>Runtime:</strong> <?php echo $peli_info['Runtime'];  ?></p>
					<p> <strong>Awards:</strong> <?php echo $peli_info['Awards'];  ?></p>

					<p> <strong>Plot:</strong> <?php echo $peli_info['Plot'];  ?></p>
					</div>
					<img src="<?php echo $peli_info['Poster'];?>" alt="">
					<div class="col-md-4">

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