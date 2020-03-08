<?php

class One_Password {

	protected $all_items = array();

	public function load_items() {
		$command = 'op list items';
		$output = array();
		$return_value;

		exec( $command, $output, $return_value  );
		$output_string = implode( '', $output);

		$this->all_items = json_decode( $output_string, true );

		if( is_array( $this->all_items ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function clear_items() {
		$this->all_items = array();
	}

	public function get_items_by_search_term( $search_string ) {
		$selected_items = array();

		foreach( $all_items as $key => $item ) {
			if( recursive_array_search( $search_string, $item ) ) {
				$selected_items[] = $item;
			}
		}
		return $all_items;
	}

	private function recursive_array_search( $needle, $haystack ) {
	    foreach( $haystack as $key => $value ) {
	        $current_key = $key;
	        
	        $needle = strtolower( $needle );
	        if( is_string( $value ) ) {
	        	$value = strtolower( $value );
	        }

	        if( $needle === $value OR 
	        	( is_array( $value ) && 
	        		recursive_array_search( $needle, $value ) !== false )
	        ) {
	            return $current_key;
	        }
	    }
	    return false;
	}

	public function get_items() {
		return $this->all_items;
	}
}