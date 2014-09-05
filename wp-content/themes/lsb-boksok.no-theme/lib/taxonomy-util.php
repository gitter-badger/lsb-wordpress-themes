<?php

class TaxonomyUtil {

  public static function get_id($object) {
    if ( is_object($object) && isset($object->term_id) ) {
      return $object->term_id;
    } else {
      return null;
    }
  }

  public static function get_name($object) {
    if ( is_object($object) && isset($object->name) ) {
      return $object->name;
    } else {
      return null;
    }
  }

  public static function the_terms_slug($post_id, $taxonomy) {
    if($post_id && $taxonomy) {
      $terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ));
      echo implode( ' ', $terms );
    }
  }
}

?>