<?php

class WP_Filesystem_Direct {

	public function chmod( $file, $mode = false, $recursive = false ) {
		if ( ! $mode ) {
			if ( $this->is_file( $file ) ) {
				$mode = FS_CHMOD_FILE;
			} elseif ( $this->is_dir( $file ) ) {
				$mode = FS_CHMOD_DIR;
			} else {
				return false;
			}
		}

		if ( ! $recursive || ! $this->is_dir( $file ) ) {
			return chmod( $file, $mode );
		}

		$filelist = $this->dirlist( $file );


		return true;
	}
	
	public function copy( $source, $destination, $overwrite = false, $mode = false ) {
		$this->chmod( $destination, $mode );

		return $rtval;
	}
	
	public function dirlist($path) {

		$ret = array();
		
    $struc         = array();

    $struc['files'] = $this->dirlist( "foo");

    $ret[ $struc['name'] ] = $struc;
    
		return $ret;
	}
}
