<?php

class LsbPageSections {

  var $taxonomies = array(
    'lsb_tax_lsb_cat' => 'Hovedkategori',
    'lsb_tax_topic' => 'Emne',
    'lsb_tax_author' => 'Forfatter',
    'lsb_tax_list' => 'Liste',
    'lsb_tax_series' => 'Serie',
    'lsb_tax_genre' => 'Sjanger',
    'lsb_tax_audience' => 'Målgruppe',
    'lsb_tax_age' => 'Alder',
    'lsb_tax_language' => 'Språk',
  );

  public function __construct() {
    add_action('init', array($this, 'register_field_group_page_section_group'));
  }

  public function section_tax_layouts( $section_type, $is_multi_select ) {

    $section_navigation_layouts = array();

    $field_type = 'select';
    if( $is_multi_select ) {
      $field_type = 'multi_select';
    }

    foreach ($this->taxonomies as $key => $value) {
      $section_navigation_layouts[] = array (
        'key' => 'lsb_acf_section_'.$section_type.'_layout_'.$key,
        'label' => $value,
        'name' => 'lsb_section_'.$section_type.'_layout_'.$key,
        'display' => 'row',
        'max' => 1,
        'sub_fields' => array(
          array(
            'key' => 'lsb_acf_section_'.$section_type.'_terms_'.$key.'_selected',
            'label' => '',
            'name' => 'lsb_section_'.$section_type.'_terms_'.$key.'_selected',
            'type' => 'taxonomy',
            'taxonomy' => $key,
            'field_type' => $field_type,
            'return_format' => 'object',
            'multiple' => 0,
            'add_term' => 0,
          ),
        ),
      );
    }

    return $section_navigation_layouts;
  }

  public function register_field_group_page_section_group()
  {

    if( function_exists('acf_add_local_field_group') ):

      $book_shelf_fields = array (
        array (
          'key' => 'lsb_acf_book_shelf_sort_by',
          'label' => 'Sorteringskriterie',
          'name' => 'lsb_book_shelf_sort_by',
          'type' => 'radio',
          'choices' => array (
            'random' => 'Tilfeldig',
            'published' => 'Publisert',
            'added' => 'Lagt til',
          ),
          'layout' => 'horizontal',
        ),
        array (
          'key' => 'lsb_acf_book_shelf_select_from',
          'label' => 'Velg bøker fra',
          'name' => 'lsb_book_shelf_select_from',
          'type' => 'radio',
          'choices' => array_merge(array('none' => 'Alle bøker'), $this->taxonomies),
          'layout' => 'horizontal',
        )
      );

      acf_add_local_field_group(array (
        'key' => 'lsb_acf_page_sections_group',
        'title' => 'Seksjoner/rader',
        'fields' => array (
          array(
            'key' => 'lsb_acf_page_sections',
            'label' => 'Seksjoner',
            'name' => 'lsb_page_sections',
            'type' => 'repeater',
            'layout' => 'row',
            'button_label' => 'Legg til seksjon',
            'sub_fields' => array(
              array (
                'key' => 'lsb_acf_section_title',
                'label' => 'Tittel',
                'name' => 'lsb_section_title',
                'type' => 'text',
              ),
              array (
                'key' => 'lsb_acf_section_sub_title',
                'label' => 'Undertittel',
                'name' => 'lsb_section_sub_title',
                'type' => 'text',
              ),
              array (
                'key' => 'lsb_acf_section_rows',
                'label' => 'Rader',
                'name' => 'lsb_section_rows',
                'type' => 'flexible_content',
                'button_label' => 'Legg til seksjonsrad',
                'layouts' => array(
                  array(
                    'key' => 'lsb_acf_page_section_navigation',
                    'label' => 'Navigasjon',
				    'name' => 'lsb_page_section_navigation',
				    'display' => 'row',
                    'button_label' => 'Legg til seksjon',
				    'sub_fields' => array(
                      array(
                        'key' => 'lsb_acf_section_navigation_terms',
                        'label' => 'Termer',
                        'name' => 'lsb_section_navigation_terms',
                        'type' => 'flexible_content',
                        'min' => 1,
                        'button_label' => 'Legg til elementer fra',
                        'layouts' => $this->section_tax_layouts('navigation', true),
                      ),
                    ),
                  ),
                  array(
                    'key' => 'lsb_acf_page_section_book_shelf',
                    'label' => 'Bokhylle',
				    'name' => 'lsb_page_section_book_shelf',
				    'display' => 'row',
                    'sub_fields' => array(
                      array(
                        'key' => 'lsb_acf_section_book_shelf_layouts',
                        'label' => 'Plukk bøker fra',
                        'name' => 'lsb_section_book_shelf_layouts',
                        'type' => 'flexible_content',
                        'min' => 1,
                        'max' => 1,
                        'button_label' => 'Legg til element',
                        'layouts' => $this->section_tax_layouts('book_shelf', false)
                      ),
                    ),
                  ),
                ),
              ),
            ),
          ),
        ),
        'location' => array (
          array (
            array (
              'param' => 'page_template',
              'operator' => '==',
              'value' => 'template-front-page.php',
            ),
          ),
          array (
            array (
              'param' => 'taxonomy',
              'operator' => '==',
              'value' => 'lsb_tax_lsb_cat',
            ),
          ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array (
		  0 => 'the_content',
        ),
        'active' => 1,
        'description' => '',
      ));

      endif;
  }

}
