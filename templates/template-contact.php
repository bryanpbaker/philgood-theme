<?php 
/**
 * Template Name: Contact Template
 */

get_header(); ?>

<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
			
			<?php
			if (get_field('display_google_map')):

				// Get the geocoded address from contact page options
				$geocode = knacc_geocode_address();
				$map_zoom = get_field('google_map_zoom');
			?>
        		<script>
        			function initialize() {
  						var myLatlng = new google.maps.LatLng(<?php echo $geocode['lat'] . ',' . $geocode['lon'] ?>);
  						var mapOptions = {
    						zoom: <?php echo $map_zoom ?>,
    						center: myLatlng
  						}
  	
  						var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
  						var marker = new google.maps.Marker({
      						position: myLatlng,
      						map: map,
  						});
  						map.set('styles', [
						  {
						    "featureType": "administrative",
						    "elementType": "labels.text.fill",
						    "stylers": [
						      { "visibility": "simplified" },
						      { "color": "#ffffff" }
						    ]
						  },{
						    "featureType": "landscape.man_made",
						    "elementType": "geometry.fill",
						    "stylers": [
						      { "color": "#cccccc" }
						    ]
						  },{
						    "featureType": "road.highway",
						    "elementType": "geometry.fill",
						    "stylers": [
						      { "visibility": "on" },
						      { "color": "#41acab" }
						    ]
						  },{
						    "featureType": "road.arterial",
						    "stylers": [
						      { "visibility": "simplified" },
						      { "color": "#dddddd" }
						    ]
						  },{
						    "featureType": "poi",
						    "elementType": "geometry",
						    "stylers": [
						      { "color": "#aaaaaa" }
						    ]
						  },{
						    "featureType": "road.local",
						    "stylers": [
						      { "visibility": "simplified" },
						      { "color": "#dddddd" }
						    ]
						  },{
						    "featureType": "road.arterial",
						    "stylers": [
						      { "color": "#aaaaaa" }
						    ]
						  },{
						  },{
						    "featureType": "road.highway",
						    "elementType": "geometry",
						    "stylers": [
						      { "color": "#41acab" }
						    ]
						  },{
						    "featureType": "transit.line",
						    "elementType": "geometry",
						    "stylers": [
						      { "color": "#f46161" }
						    ]
						  },{
						    "featureType": "poi",
						    "elementType": "geometry",
						    "stylers": [
						      { "color": "#bbbbbb" }
						    ]
						  },{
						    "featureType": "water",
						    "elementType": "geometry",
						    "stylers": [
						      { "color": "#f46161" }
						    ]
						  },{
						  }
						]);
					}

	
					google.maps.event.addDomListener(window, 'load', initialize);
        		</script>
	
        		<div class="contact-map">
        			<div id="map-canvas" style="height:400px"></div>
        		</div><!-- .contact-map-->
        	<?php 
        	endif; ?>

			<?php 
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ): ?>
				<figure class="post-thumb">	
					<?php the_post_thumbnail(); ?>
				</figure><!-- .post-thumb -->
			<?php
			endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content-->
			
			<div class="contact-content">
				<?php 
					if (get_field('display_contact_form') == true && get_field('display_contact_details') == true):
						$contact_form_col_class = 'col-md-7';
						$contact_details_col_class = 'col-md-5';
					elseif (get_field('display_contact_form') == true && get_field('display_contact_details') == false):
						$contact_form_col_class = 'col-md-12';
						$contact_details_col_class = 'hidden';
					elseif (get_field('display_contact_form') == false && get_field('display_contact_details') == true):
						$contact_form_col_class = 'hidden';
						$contact_details_col_class = 'col-md-12';
					else:
						$contact_form_col_class = 'col-md-7';
						$contact_details_col_class = 'col-md-5';
					endif;
				?>
				<div class="clearfix">
					<div class="contact-form <?php echo $contact_form_col_class; ?>">
						<?php echo the_field('contact_form') ?>
					</div>
					<div class="contact-details <?php echo $contact_details_col_class; ?>">
						<ul class="contact-list">
							<?php if (get_field('phone')) 			echo '<li class="phone">' . get_field('phone') . '</li>'; ?>
							<?php if (get_field('mobile')) 			echo '<li class="mobile">' . get_field('mobile') . '</li>'; ?>
							<?php if (get_field('email')) 			echo '<li class="email"><a href="mailto:' . get_field('email') . '">' . get_field('email') . '</a></li>'; ?>
							<?php if (get_field('address_line_1') || get_field('address_line_2') || get_field('town_city') || get_field('zip_postcode') || get_field('country')): ?>
							<li class="address">
								<ul>
									<?php if (get_field('address_line_1')) 	echo '<li class="address-1">' . get_field('address_line_1') . '</li>'; ?>
									<?php if (get_field('address_line_2')) 	echo '<li class="address-2">' . get_field('address_line_2') . '</li>'; ?>
									<?php if (get_field('town_city')) 		echo '<li class="town-city">' . get_field('town_city') . '</li>'; ?>
									<?php if (get_field('state_county')) 	echo '<li class="state-county">' . get_field('state_county') . '</li>'; ?>
									<?php if (get_field('zip_postcode')) 	echo '<li class="zip-postcode">' . get_field('zip_postcode') . '</li>'; ?>
									<?php if (get_field('country')) 		echo '<li class="country">' . get_field('country') . '</li>'; ?>
								</ul>
							</li>
						<?php endif; ?>
						</ul>
						<div class="contact-social-icons">
							<ul>
								<?php knacc_output_social_networks(); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
    		
        </article><!-- #post-<?php the_ID(); ?>-->

		<?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>