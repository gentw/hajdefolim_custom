<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'gutentype_storage_get' ) ) {
	function gutentype_storage_get( $var_name, $default = '' ) {
		global $GUTENTYPE_STORAGE;
		return isset( $GUTENTYPE_STORAGE[ $var_name ] ) ? $GUTENTYPE_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'gutentype_storage_set' ) ) {
	function gutentype_storage_set( $var_name, $value ) {
		global $GUTENTYPE_STORAGE;
		$GUTENTYPE_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'gutentype_storage_empty' ) ) {
	function gutentype_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $GUTENTYPE_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $GUTENTYPE_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $GUTENTYPE_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $GUTENTYPE_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'gutentype_storage_isset' ) ) {
	function gutentype_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $GUTENTYPE_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $GUTENTYPE_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $GUTENTYPE_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $GUTENTYPE_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'gutentype_storage_inc' ) ) {
	function gutentype_storage_inc( $var_name, $value = 1 ) {
		global $GUTENTYPE_STORAGE;
		if ( empty( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = 0;
		}
		$GUTENTYPE_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'gutentype_storage_concat' ) ) {
	function gutentype_storage_concat( $var_name, $value ) {
		global $GUTENTYPE_STORAGE;
		if ( empty( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = '';
		}
		$GUTENTYPE_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'gutentype_storage_get_array' ) ) {
	function gutentype_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $GUTENTYPE_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) ? $GUTENTYPE_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $GUTENTYPE_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $GUTENTYPE_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'gutentype_storage_set_array' ) ) {
	function gutentype_storage_set_array( $var_name, $key, $value ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$GUTENTYPE_STORAGE[ $var_name ][] = $value;
		} else {
			$GUTENTYPE_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'gutentype_storage_set_array2' ) ) {
	function gutentype_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$GUTENTYPE_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$GUTENTYPE_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'gutentype_storage_merge_array' ) ) {
	function gutentype_storage_merge_array( $var_name, $key, $value ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array_merge( $GUTENTYPE_STORAGE[ $var_name ], $value );
		} else {
			$GUTENTYPE_STORAGE[ $var_name ][ $key ] = array_merge( $GUTENTYPE_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'gutentype_storage_set_array_after' ) ) {
	function gutentype_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			gutentype_array_insert_after( $GUTENTYPE_STORAGE[ $var_name ], $after, $key );
		} else {
			gutentype_array_insert_after( $GUTENTYPE_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'gutentype_storage_set_array_before' ) ) {
	function gutentype_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			gutentype_array_insert_before( $GUTENTYPE_STORAGE[ $var_name ], $before, $key );
		} else {
			gutentype_array_insert_before( $GUTENTYPE_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'gutentype_storage_push_array' ) ) {
	function gutentype_storage_push_array( $var_name, $key, $value ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $GUTENTYPE_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) ) {
				$GUTENTYPE_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $GUTENTYPE_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'gutentype_storage_pop_array' ) ) {
	function gutentype_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $GUTENTYPE_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $GUTENTYPE_STORAGE[ $var_name ] ) && is_array( $GUTENTYPE_STORAGE[ $var_name ] ) && count( $GUTENTYPE_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $GUTENTYPE_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) && is_array( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) && count( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $GUTENTYPE_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'gutentype_storage_inc_array' ) ) {
	function gutentype_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( empty( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ][ $key ] = 0;
		}
		$GUTENTYPE_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'gutentype_storage_concat_array' ) ) {
	function gutentype_storage_concat_array( $var_name, $key, $value ) {
		global $GUTENTYPE_STORAGE;
		if ( ! isset( $GUTENTYPE_STORAGE[ $var_name ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ] = array();
		}
		if ( empty( $GUTENTYPE_STORAGE[ $var_name ][ $key ] ) ) {
			$GUTENTYPE_STORAGE[ $var_name ][ $key ] = '';
		}
		$GUTENTYPE_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'gutentype_storage_call_obj_method' ) ) {
	function gutentype_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $GUTENTYPE_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $GUTENTYPE_STORAGE[ $var_name ] ) ? $GUTENTYPE_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $GUTENTYPE_STORAGE[ $var_name ] ) ? $GUTENTYPE_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'gutentype_storage_get_obj_property' ) ) {
	function gutentype_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $GUTENTYPE_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $GUTENTYPE_STORAGE[ $var_name ]->$prop ) ? $GUTENTYPE_STORAGE[ $var_name ]->$prop : $default;
	}
}
