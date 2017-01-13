<?php

if(!function_exists("pr"))
{
	function pr($val)
	{
		echo "<pre>";
		print_r($val);
		echo "</pre>";
	}
}

if(!function_exists("base_url"))
{
	function base_url()
	{
		$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$base_url .= "://".$_SERVER['HTTP_HOST'];
		$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		
		return $base_url;
	}
}


if(!function_exists("base_path"))
{
	function base_path()
	{
		return $_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	}
}

if(!function_exists("getSameId"))
{
	function getSameId($id=array(), $idx = 0)
	{
	
		if(!empty($id))
		{
			
			foreach($id as $menuId)
			{
				if($menuId==$idx)
				{
					return true;
				}
			}
			
			return false;
			
		}else
		{
			return false;
		}

	}
}

if(!function_exists("getActivemenu"))
{
	function getActivemenu($page, $segment_page)
	{
		$active = "";
		if($page==$segment_page)
		{
			$active = "active selected";
		}
		
		return $active;
	}
}
if(!function_exists("getActiveOption"))
{
	function getActiveOption($selected, $tmpselected)
	{
		
		$active = "";
		if($selected==$tmpselected)
		{
			$active = "selected = 'selected'";
		}
		
		return $active;
	}
}
if(!function_exists("getActiveCheckbox"))
{
	function getActiveCheckbox($checked, $tmpchecked)
	{
		$active = "";
		if($checked==$tmpchecked)
		{
			$active = "checked = 'checked'";
		}
		
		return $active;
	}
}
if(!function_exists("getCheckmenu"))
{
	function getCheckmenu($id=array(), $menu_id)
	{
		$checked = "";
		if(!empty($id))
		{
			foreach($id as $tmpid)
			{
				if($tmpid==$menu_id)
				{
					$checked = "checked='checked'";
				}
			}
		}
		return $checked;
	}
}
if (!function_exists("decode_base64"))
{
	function decode_base64($value)
	{
		$decode = base64_decode($value);
		
		return $decode;
		
	}
}
if (!function_exists("decode_base64_serialize"))
{
	function decode_base64_serialize($value)
	{
		$decode = base64_decode($value);
		$decode = unserialize($decode);
		
		return $decode;
		
	}
}

if (!function_exists("getImageWidthHeight"))
{
	function getImageWidthHeight($type,$imagefilepath)
	{
		$photo1		= "";
		$foto1W		= 0;
		$foto1H		= 0;
		if($type==="image/jpeg")
		{
			$photo1 		= imagecreatefromjpeg($imagefilepath);
		}
		if($type==="image/png")
		{
			$photo1 		= imagecreatefrompng($imagefilepath);
		}
		
		if($photo1!="")
		{
			$foto1W 		= imagesx($photo1);
			$foto1H 		= imagesy($photo1);
		}
		$arr_return			= array(
									"width"		=> $foto1W,
									"height"	=> $foto1H
							);
		
		return $arr_return;
	}
}
if (!function_exists("array_sort_by_column"))
{
	function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
		$reference_array = array();

		foreach($array as $key => $row) {
			$reference_array[$key] = $row[$column];
		}

		array_multisort($reference_array, $direction, $array);
	}
}

if(!function_exists("uri_segment"))
{
	function uri_segment($segment)
	{
		$pathinfo		= explode('/',$_SERVER['REQUEST_URI']);
		$pathinfo		= array_filter($pathinfo);
		$arrcount		= count($pathinfo);
		$retvalue		= '';
		if($segment<=$arrcount)
		{
			$retvalue		= $pathinfo[$segment];
		
		}
		return $retvalue;
	}
}

if(!function_exists('diff'))
{
	function diff($start,$end = false) {
		/*
		* For this function, i have used the native functions of PHP. It calculates the difference between two timestamp.
		*
		* Author: Toine
		*
		* I provide more details and more function on my website
		*/

		// Checks $start and $end format (timestamp only for more simplicity and portability)
		if(!$end) { $end = time(); }
		if(!is_numeric($start) || !is_numeric($end)) { return false; }
		// Convert $start and $end into EN format (ISO 8601)
		$start  = date('Y-m-d H:i:s',$start);
		$end    = date('Y-m-d H:i:s',$end);
		
		
		
		$d_start    = new DateTime($start);
		$d_end      = new DateTime($end);

		$diff = $d_start->diff($d_end);
		// return all data
		$data				= array();
		$data['years']   	= $diff->format('%y');
		$data['months']    	= $diff->format('%m');
		$data['days']      	= $diff->format('%d');
		$data['hours']     	= $diff->format('%h');
		$data['minutes']    = $diff->format('%i');
		$data['secs']     	= $diff->format('%s');
		return $data;
	} 
}

if(!function_exists('dateTimeRange'))
{
	function dateTimeRange($start_date, $end_date, $todays_date)
	{
	  return (($todays_date >= $start_date) && ($todays_date <= $end_date));

	}
}

if(!function_exists("isWeekdays"))
{
	function isWeekdays($date) 
	{
	    $weekDay = date('w', strtotime($date));
	    if($weekDay>0 && $weekDay<6)
	    {
	    	return true;
	    }
	    return false;
	}
}

if(!function_exists('hex2rgba'))
{
	function hex2rgba($color, $opacity = false) 
	{
 
		$default = 'rgb(0,0,0)';
	 
		//Return default if no color provided
		if(empty($color))
	          return $default; 
	 
		//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
	    return $output;
	}
}
?>