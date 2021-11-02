<?php

		if ( true ) {
		echo "coucou"; // block 6
		} else {
			while ( $row = @mysql_fetch_object($this->result) ) { // block 29 (row) & 22 (fetch)
				echo $row->title; // block 33
			} 
    } 
		echo "salut"; // block 13
