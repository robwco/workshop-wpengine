<?php

if( !class_exists( 'radium_walker' ) ) {

	/**
	 * The radium walker is the frontend walker and necessary to display the menu, this is a advanced version of the Wordpress menu walker
	 * @package WordPress
	 * @since 1.0.0
	 * @uses Walker
	 */
	class radium_walker extends Walker {
		/**
		 * @see Walker::$tree_type
		 * @var string
		 */
		var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	
		/**
		 * @see Walker::$db_fields
		 * @todo Decouple this.
		 * @var array
		 */
		var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	
		/**
		 * @var int $columns 
		 */
		var $columns = 0;
		
		/**
		 * @var int $max_columns maximum number of columns within one mega menu 
		 */
		var $max_columns = 0;
		
		/**
		 * @var int $rows holds the number of rows within the mega menu 
		 */
		var $rows = 1;
		
		/**
		 * @var array $rowsCounter holds the number of columns for each row within a multidimensional array
		 */
		var $rowsCounter = array();
		
		/**
		 * @var string $mega_active hold information whatever we are currently rendering a mega menu or not
		 */
		var $mega_active = 0;
	
	
		/**
		 * @see Walker::start_lvl()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		function start_lvl(&$output, $depth) {
			$indent = str_repeat("\t", $depth);
			if($depth === 0) $output .= "\n{replace_one}\n";
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}
	
		/**
		 * @see Walker::end_lvl()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		function end_lvl(&$output, $depth) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
			
			if($depth === 0) 
			{
				if($this->mega_active)
				{

					$output .= "\n</div>\n";
					$output = str_replace("{replace_one}", "<div class='radium_mega_div radium_mega".$this->max_columns."'>", $output);
					
					foreach($this->rowsCounter as $row => $columns)
					{
						$output = str_replace("{current_row_".$row."}", "radium_mega_menu_columns_".$columns, $output);
					}
					
					$this->columns = 0;
					$this->max_columns = 0;
					$this->rowsCounter = array();
					
				}
				else
				{
					$output = str_replace("{replace_one}", "", $output);
				}
			}
		}
	
		/**
		 * @see Walker::start_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		function start_el(&$output, $item, $depth, $args) {
			global $wp_query;
			
			//set maxcolumns
			if(!isset($args->max_columns)) $args->max_columns = 5;

			
			$item_output = $li_text_block_class = $column_class = "";
			
			if($depth === 0) {	
				$this->mega_active = false; //get_post_meta( $item->ID, '_menu-item-radium-megamenu', true);
			}
			
			if($depth === 1 && $this->mega_active) {
				$this->columns ++;
				
				//check if we have more than $args['max_columns'] columns or if the user wants to start a new row
				if($this->columns > $args->max_columns || (get_post_meta( $item->ID, '_menu-item-radium-division', true) && $this->columns != 1)) {
				
					$this->columns = 1;
					$this->rows ++;
					$output .= "\n<li class='radium-mega-hr'></li>\n";
				}
				
				$this->rowsCounter[$this->rows] = $this->columns;
				
				if($this->max_columns < $this->columns) $this->max_columns = $this->columns;
				
				
				$title = apply_filters( 'the_title', $item->title, $item->ID );
				
				if($title != "-" && $title != '"-"') { //fallback for people who copy the description o_O
					$item_output .= "<h4>".$title."</h4>";
				}
				
				$column_class  = ' {current_row_'.$this->rows.'}';
				
				if($this->columns == 1) {
					$column_class  .= " radium-mega-menu-columns-first";
				}
				
			} else if($depth >= 2 && $this->mega_active && get_post_meta( $item->ID, '_menu-item-radium-textarea', true) ) {
			
				$li_text_block_class = 'radium-mega-text-block ';
			
				$item_output.= do_shortcode( $item->post_content );
 			
			} else {
			
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';			
				$prepend = '<strong><span class="menu-title">';
					   $append = '</span></strong>';
					   $description  = ! empty( $item->description ) ? '<span class="menu-desc">'.esc_attr( $item->description ).'</span>' : '';
					
					   if( $depth != 0 ) { 
					   		$description = $append = $prepend = ""; 
					   	}
					   
				$item_output .= $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
				$item_output .= $description.$args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;
			}
 			
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$class_names = $value = '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'.$li_text_block_class. esc_attr( $class_names ) . $column_class.'"';
	
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	
		/**
		 * @see Walker::end_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Page data object. Not used.
		 * @param int $depth Depth of page. Not Used.
		 */
		function end_el(&$output, $item, $depth) {
			$output .= "</li>\n";
		}
	}
}


if( !function_exists( 'radium_fallback_menu' ) ) {
	/**
	 * Create a navigation out of pages if the user didn't create a menu in the backend
	 *
	 */
	function radium_fallback_menu()	{
		$current = "";
		if (is_front_page()){$current = "class='current-menu-item'";} 
		
		echo "<div class='fallback_menu'>";
		echo "<ul class='radium_mega menu'>";
		echo "<li $current><a href='".get_bloginfo('url')."'>Home</a></li>";
		wp_list_pages('title_li=&sort_column=menu_order');
		echo "</ul></div>";
	}
}
