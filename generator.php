<?php

    function parse($text, $key = "\t")
    {

		$items       = array_values(
			array_filter(
				explode("\n", $text)
			)
		);

		$countItem = count($items);
        $output = "";

        $indentLevel = 0;
        $lastIndent = 0;
        
		for ($i=0; $i < $countItem; $i++) {
			$newIndentLevel = indentLevel($items[$i], $key);
			$indentDiff = $newIndentLevel - $indentLevel;
            $indentLevel = $newIndentLevel;

			if ($indentDiff >= 1) {
				for ($i2=$indentDiff; $i2>0; $i2--) {
					$lastIndent++;
					$output .= ($lastIndent > 0) ? str_repeat("\t", ($lastIndent)) : null;
					$output .= "<ul>\n";
				}
			} 

			$output .= ($lastIndent > 0) ? str_repeat("\t", ($lastIndent)) : null;
			
			if ($indentDiff < 0) {
				for ($i2=$indentDiff; $i2<0; $i2++) {
					$output .= ($lastIndent > 0) ? str_repeat("\t", ($lastIndent)) : null;	
					$output .= "</ul>\n";
					$lastIndent--;
				}

			} 

			$output .= ($lastIndent > 0) ? str_repeat("\t", ($lastIndent)) : null;	
            $output .= "<li>".str_replace($key, '', $items[$i]);

            if (($indentDiff <= 0 || $indentDiff == 1) && @$items[($i+1)] >= 0) {
            	$output .= "</li>\n";
            }

		}

        for ($i3 = 0; $i3<$lastIndent; $i3++) {
        	$output .= ($lastIndent > 0) ? str_repeat("\t", ($lastIndent)) : null;	
        	$output .= "</ul>\n";
        } 

        $output .= "\n\t\n";
		return $output;
	}

	function indentLevel($item, $key)
	{
		return substr_count($item, $key)+1;
	}



    if (isset($_POST['input'])) {
        echo parse($_POST['input']);
    } 