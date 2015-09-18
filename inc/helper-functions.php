<?php
/**
 * Get blockquote from the post content
 */
function knacc_get_content_blockquote() 
{
    $dom = new DOMDocument;
    $dom->loadHTML( apply_filters( 'the_content', get_the_content( '' ) ) );
    $blockquotes = $dom->getElementsByTagname( 'blockquote' );

    if ( $blockquotes->length > 0 ) {

        // First blockquote
        $blockquote = $blockquotes->item(0);

        $cite = $blockquote->getElementsByTagName( 'cite' )->item( 0 );
        $p = $blockquote->getElementsByTagName( 'p' );

        $cite_content = '';
        if ( $cite && $p ) {

            // Remove the cite from the paragraph
            foreach ( $p as $paragraph )
                try { $paragraph->removeChild( $cite ); }
                catch( Exception $e ) {}

            $cite_content = $dom->saveXML( $cite );
        }

        $blockquote_content = '';
        foreach ( $p as $paragraph ) {
            if ( strlen( trim( $paragraph->nodeValue ) ) > 0 )
                $blockquote_content .= $dom->saveXML( $paragraph );
            else
                $paragraph->parentNode->removeChild( $paragraph );

        $blockquote->parentNode->removeChild( $blockquote );
        $remaining_content = $dom->saveXML();
    }
    	return $blockquote_content; // $cite_content or $remaining_content
    	
	} else {

		return false;
	}
}

/**
 * Get first link from the post content
 */
function knacc_get_content_link()
{
	$dom = new DOMDocument;
    $dom->loadHTML( apply_filters( 'the_content', get_the_content( '' ) ) );
    $link = $dom->getElementsByTagname( 'a' );

    if ($link->item(0)) {
    	foreach ($link->item(0)->attributes as $attribute) {
    		if ($attribute->name == 'href') {
				$link = $attribute->value;
    		}
    	}

    	return $link;

    } else {

    	return false;
    }
}

/**
 * Google maps - geocode address
 */
function knacc_geocode_address() 
{	
	$field = get_field_object('google_map_address');
	$address = urlencode($field['value']);
	$request_url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=true';
	$xml = simplexml_load_file($request_url);
	$status = $xml->status;

	if ($status == "OK") {
	    $geo['lat'] = $xml->result->geometry->location->lat;
	    $geo['lon'] = $xml->result->geometry->location->lng;
	} else {
		$geo = false;
	}

	return $geo;
}

/**
 * Formats a google font option
 */
function knacc_format_google_font($font) {
    $font = explode(',', $font);
    $font = $font[0];
    $font = str_replace(" ", "+", $font);

    return $font;
}

/**
 * Returns the featured image or first image of a portfolio post
 */
function knacc_portfolio_first_image() {
    
    //  Get the portfolio item images
    $portfolio_images = get_field('portfolio_images');
    
    // If there is a featured image then use this
    if (has_post_thumbnail()) {

        $the_image = knacc_get_thumbnail_image_url(get_the_ID());

    } elseif ($portfolio_images) {

        //  Otherwise we use the first portfolio item image from the post
        if ($portfolio_images[0]['image_upload']['url']) {
            $the_image = $portfolio_images[0]['image_upload']['url'];
        } else {
            $the_image = 'http://' . $portfolio_images[0]['image_url'];
        }

    } else {
        $the_image = get_template_directory_uri() . '/images/no-image.jpg';
    }

    return $the_image;
}

/**
 * Returns post image for the portfolio featured item slider
 */
function knacc_get_featured_slider_image($post_id) {

    $portfolio_images = get_field('portfolio_images', $post_id);

    if (has_post_thumbnail($post_id)) {

        return knacc_get_thumbnail_image_url($post_id);

    } elseif ($portfolio_images) {
        if ($portfolio_images[0]['image_upload']['url']){
            $image = $portfolio_images[0]['image_upload']['url'];
        } else {
            $image = 'http://' . $portfolio_images[0]['image_url'];
        }

        return $image;

    } else {
        return get_template_directory_uri() . '/images/no-image.jpg';
    }
}

/**
 * Returns clean thumbnail image url
 */
function knacc_get_thumbnail_image_url($post_id) {
    $image_id = get_post_thumbnail_id($post_id);
    $image_url = wp_get_attachment_image_src($image_id,'large', true);
    $image = $image_url[0];

    return $image;
}
