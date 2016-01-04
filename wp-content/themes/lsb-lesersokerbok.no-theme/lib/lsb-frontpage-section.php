<?php

  class LsbFrontpageSection {
    public function __construct() {
      add_action('init', array($this, 'register_field_group_frontpage_section_field_group'));
      add_action('init', array($this, 'add_filter_for_allowing_unsafe_urls_in_development'));
    }

    public function register_field_group_frontpage_section_field_group()
    {
      if( function_exists('register_field_group') ):

        register_field_group(array (
        	'key' => 'lsb_frontpage_sections',
        	'title' => 'Forsideseksjoner',
        	'fields' => array (
        		array (
        			'key' => 'lsb_frontpage_section',
        			'label' => 'Seksjoner',
        			'name' => 'section',
        			'prefix' => '',
        			'type' => 'repeater',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'min' => '1',
        			'max' => '',
        			'layout' => 'row',
        			'button_label' => 'Legg til seksjon',
        			'sub_fields' => array (
        		        array (
                          'key' => 'lsb_frontpage_section_type',
                          'label' => 'Seksjonstype',
                          'name' => 'section_type',
                          'prefix' => '',
                          'type' => 'radio',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => 0,
                          'column_width' => '',
                          'choices' => array (    
                            'text' => 'Tekst',
                            'grid' => 'Grid',
                            'hero' => 'Hero',
                            'normal_feed' => 'Vanlig feed',
                            'lsb_book_feed' => 'Bok-feed',
                          ),
                          'other_choice' => 0,
                          'save_other_choice' => 0,
                          'default_value' => '',
                          'layout' => 'horizontal',
        				),
                        array (
                          'key' => 'lsb_frontpage_section_video',
                          'label' => 'Video',
                          'name' => 'section_video',
                          'prefix' => '',
                          'type' => 'wysiwyg',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => array (
                            array (
                              array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'hero',
                              ),
                            ),
                          ),
                          'column_width' => '50%',
                          'default_value' => '',
                          'toolbar' => 'full',
                          'media_upload' => 0,
                        ),
                        array (
                          'key' => 'lsb_frontpage_section_text',
                          'label' => 'Tekst',
                          'name' => 'section_text',
                          'prefix' => '',
                          'type' => 'wysiwyg',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => array (
                            array (
                              'rule_0' => array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'text',
                              ),
                            ),
                            array (
                              'rule_0' => array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'hero',
                              ),
                            ),
                          ),
                          'column_width' => '50%',
                          'default_value' => '',
                          'toolbar' => 'full',
                          'media_upload' => 0,
                        ),
                        array (
                          'key' => 'lsb_frontpage_section_heading',
                          'label' => 'Overskrift',
                          'name' => 'section_heading',
                          'prefix' => '',
                          'type' => 'text',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => array (
                            array (
                              array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '!=',
                                'value' => 'hero',
                              ),
                              array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '!=',
                                'value' => 'text',
                              ),
                            ),
                          ),
                          'column_width' => '',
                          'default_value' => '',
                          'placeholder' => '',
                          'prepend' => '',
                          'append' => '',
                          'maxlength' => '',
                          'readonly' => 0,
                          'disabled' => 0,
        		        ),
                        array (
                          'key' => 'lsb_frontpage_section_subheading',
                          'label' => 'Underoverskrift',
                          'name' => 'section_subheading',
                          'prefix' => '',
                          'type' => 'text',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => array (
                            array (
                              array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '!=',
                                'value' => 'hero',
                              ),
                              array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '!=',
                                'value' => 'text',
                              ),
                            ),
                          ),
                          'column_width' => '',
                          'default_value' => '',
                          'placeholder' => '',
                          'prepend' => '',
                          'append' => '',
                          'maxlength' => '',
                          'readonly' => 0,
                          'disabled' => 0,
        		        ),
                        array (
                          'key' => 'lsb_frontpage_section_feed_link',
                          'label' => 'Lenke til feeden',
                          'name' => 'section_feed_link',
                          'prefix' => '',
                          'type' => 'url',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => array (
                            array (
                              'rule_0' => array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'normal_feed',
                              ),
                            ),
                            array (
                              'rule_0' => array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'lsb_book_feed',
                              ),
                            ),
                          ),
                          'column_width' => '',
                          'default_value' => '',
                          'placeholder' => '',
                          'prepend' => '',
                          'append' => '',
                          'maxlength' => '',
                          'readonly' => 0,
                          'disabled' => 0,
                        ),
                        array (
                          'key' => 'lsb_frontpage_section_feed_url',
                          'label' => 'Feed URL',
                          'name' => 'section_feed_url',
                          'prefix' => '',
                          'type' => 'url',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => array (
                            array (
                              'rule_0' => array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'normal_feed',
                              ),
                            ),
                            array (
                              'rule_0' => array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'lsb_book_feed',
                              ),
                            ),
                          ),
                          'column_width' => '',
                          'default_value' => '',
                          'placeholder' => '',
                          'prepend' => '',
                          'append' => '',
                          'maxlength' => '',
                          'readonly' => 0,
                          'disabled' => 0,
                        ),
                        array (
                          'key' => 'lsb_frontpage_section_feed_max_items',
                          'label' => 'Maks innlegg',
                          'name' => 'section_feed_max_items',
                          'prefix' => '',
                          'type' => 'number',
                          'instructions' => '',
                          'required' => 0,
                          'conditional_logic' => array (
                            array (
                              'rule_0' => array (
                                'field' => 'lsb_frontpage_section_type',
                                'operator' => '==',
                                'value' => 'normal_feed',
                              ),
                            ),
                          ),
                          'column_width' => '',
                          'default_value' => 3,
                          'min' => 1,
                          'max' => '',
                          'step' => 1,
                          'placeholder' => '',
                          'prepend' => '',
                          'append' => '',
                          'maxlength' => '',
                          'readonly' => 0,
                          'disabled' => 0,
                        ),
        				array (
        					'key' => 'lsb_frontpage_section_grid',
        					'label' => 'Grid',
        					'name' => 'section_grid',
        					'prefix' => '',
        					'type' => 'repeater',
        					'instructions' => '',
        					'required' => 0,
        					'conditional_logic' => array (
        						array (
        							array (
        								'field' => 'lsb_frontpage_section_type',
        								'operator' => '==',
        								'value' => 'grid',
        							),
        						),
        					),
        					'column_width' => '',
        					'min' => '1',
        					'max' => '4',
        					'layout' => 'row',
        					'button_label' => 'Legg til element',
        					'sub_fields' => array (
        						array (
        							'key' => 'lsb_frontpage_section_grid_element_heading',
        							'label' => 'Overskrift',
        							'name' => 'section_grid_element_heading',
        							'prefix' => '',
        							'type' => 'text',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => 0,
        							'column_width' => '',
        							'default_value' => '',
        							'placeholder' => '',
        							'prepend' => '',
        							'append' => '',
        							'maxlength' => '',
        							'readonly' => 0,
        							'disabled' => 0,
        						),
        						array (
        							'key' => 'lsb_frontpage_section_grid_element_text',
        							'label' => 'Tekst',
        							'name' => 'section_grid_element_text',
        							'prefix' => '',
        							'type' => 'wysiwyg',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => 0,
        							'column_width' => '',
        							'default_value' => '',
        							'toolbar' => 'basic',
        							'media_upload' => 0,
        						),
        						array (
        							'key' => 'lsb_frontpage_section_grid_element_link_type',
        							'label' => 'Lenketype',
        							'name' => 'section_grid_element_link_type',
        							'prefix' => '',
        							'type' => 'radio',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => 0,
        							'column_width' => '',
        							'choices' => array (
        								'internal' => 'Internt innhold',
        								'external' => 'Ekstern lenke',
        							),
        							'other_choice' => 0,
        							'save_other_choice' => 0,
        							'default_value' => '',
        							'layout' => 'horizontal',
        						),
        						array (
        							'key' => 'lsb_frontpage_section_grid_element_link_internal',
        							'label' => 'Lenke til innhold',
        							'name' => 'section_grid_element_internal',
        							'prefix' => '',
        							'type' => 'page_link',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => array (
        								array (
        									array (
        										'field' => 'lsb_frontpage_section_grid_element_link_type',
        										'operator' => '==',
        										'value' => 'internal',
        									),
        								),
        							),
        							'column_width' => '',
        							'post_type' => array (
        								0 => 'post',
        								1 => 'page',
        							),
        							'taxonomy' => '',
        							'allow_null' => 0,
        							'multiple' => 0,
        						),
        						array (
        							'key' => 'lsb_frontpage_section_grid_element_external',
        							'label' => 'Ekstern lenke',
        							'name' => 'section_grid_element_link_external',
        							'prefix' => '',
        							'type' => 'url',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => array (
        								array (
        									array (
        										'field' => 'lsb_frontpage_section_grid_element_link_type',
        										'operator' => '==',
        										'value' => 'external',
        									),
        								),
        							),
        							'column_width' => '',
        							'default_value' => '',
        							'placeholder' => 'http://',
        							'prepend' => '',
        							'append' => '',
        							'maxlength' => '',
        							'readonly' => 0,
        							'disabled' => 0,
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
        				'value' => 'template-frontpage.php',
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
        ));

      endif;
    }

    public function add_filter_for_allowing_unsafe_urls_in_development() {
      // Allow for parsing localhost URLs when testing feeds
      if ( WP_ENV === 'development') {
        add_filter( 'http_request_args', array($this, 'set_reject_unsafe_urls_to_false'));
      }
    }

    public function set_reject_unsafe_urls_to_false( $args ) {
      $args['reject_unsafe_urls'] = false;
      return $args;
    }

  }

?>
