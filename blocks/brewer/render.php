<?php
/**
 * Block: Brewer
 * Affiche les brasseurs depuis le CPT "brasseurs" sous forme de slider.
 *
 * @var array $block      Données du bloc ACF.
 * @var bool  $is_preview True en mode éditeur.
 * @var int   $post_id    ID du post courant.
 *
 * @package Festipiousse
 */

$posts_per_page = get_field( 'brewer_posts_per_page' ) ?: 18;
$titre          = get_field( 'brewer_titre' ) ?: __( 'Les Brasseurs', 'festipiousse' );

$block_id    = ! empty( $block['anchor'] ) ? $block['anchor'] : 'brewer-' . $block['id'];
$class_names = 'wp-block-festipiousse-brewer block-brasseurs-home';
if ( ! empty( $block['className'] ) ) {
	$class_names .= ' ' . $block['className'];
}

$loop = new WP_Query( array(
	'post_type'      => 'brasseur',
	'posts_per_page' => (int) $posts_per_page,
	'orderby'        => 'title',
	'order'          => 'ASC',
) );
?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_names ); ?>">

	<h2 class="titre titre-brasseurs-home"><?php echo esc_html( $titre ); ?></h2>

	<div class="block-brasseurs-slider">
		<div class="owl-carousel">

			<?php while ( $loop->have_posts() ) : $loop->the_post();
				$image      = get_field( 'logo' );
				$url        = get_field( 'url' );
				$nom        = get_field( 'nom_du_brasseur' );
				$lieu       = get_field( 'localite' );
				$petite_desc = get_field( 'petite_desc' );
			?>

				<div class="brewer-item">
					<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="link-bra">
						<?php if ( $image ) : ?>
							<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
						<?php endif; ?>
						<h4 class="titre-bra"><?php echo esc_html( $nom ); ?></h4>
						<span class="lieux"><?php echo esc_html( $lieu ); ?></span>
						<?php if ( $petite_desc ) : ?>
							<p class="petite-desc"><?php echo esc_html( $petite_desc ); ?></p>
						<?php endif; ?>
					</a>
				</div>

			<?php endwhile; wp_reset_postdata(); ?>

		</div>
	</div>

</div>
