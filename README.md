# Utility Functions for PHP

Functions are added to global namespace

## Contents

* <a href="#dbg">dbg</a>
* <a href="#h">h</a>
* <a href="#is_natural">is_natural</a>
* <a href="#between">between</a>
* <a href="#is_numeric_list">is_numeric_list</a>
* <a href="#last_chars">last_chars</a>
* <a href="#create_slug">create_slug</a>
* <a href="#coalesce">coalesce</a>
* <a href="#get_first_fey">get_first_key</a>
* <a href="#get_first_value">get_first_value</a>
* <a href="#get_last_key">get_last_key</a>
* <a href="#get_last_value">get_last_value</a>
* <a href="#array_unset">array_unset</a>
* <a href="#array_iunique">array_iunique</a>
* <a href="#get_directory_size">get_directory_size</a>
* <a href="#get_file_name">get_file_name</a>
* <a href="#get_file_extension">get_file_extension</a>
* <a href="#check_file_exists">check_file_exists</a>
* <a href="#format_bytes">format_bytes</a>
* <a href="#datetotime">datetotime</a>
* <a href="#is_date">is_date</a>
* <a href="#t2d">t2d</a>
* <a href="#t2dt">t2dt</a>
* <a href="#get_range">get_range</a>
* <a href="#_humanize">_humanize</a>
* <a href="#get_class_constant">get_class_constant</a>
* <a href="#get_class_constants">get_class_constants</a>
* <a href="#shorten">shorten</a>
* <a href="#safe_json_encode">safe_json_encode</a>
* <a href="#get_client_ip">get_client_ip</a>
* <a href="#rm_rf">rm_rf</a>
* <a href="#copy_r">copy_r</a>
* <a href="#get_query_params">get_query_params</a>
* <a href="#get_class_name">get_class_name</a>
* <a href="#extract_number">extract_number</a>
* <a href="#seconds_to_hour_minute">seconds_to_hour_minute</a>
* <a href="#is_cli">is_cli</a>


### <a id="dbg"></a>dbg
```
/**
 * debug method from Cakephp - convenient wrapper for print_r
 *
 * @param $var
 * @param bool|false $return
 * @return string
 */
function dbg($var, $return = false)
```

### <a id="h"></a>h
```
/**
 * Convenience method for htmlspecialchars.
 *
 * @param string|array|object $text Text to wrap through htmlspecialchars. Also works with arrays, and objects.
 *    Arrays will be mapped and have all their elements escaped. Objects will be string cast if they
 *    implement a `__toString` method. Otherwise the class name will be used.
 * @param bool $double Encode existing html entities.
 * @param string|null $charset Character set to use when escaping. Defaults to config value in `mb_internal_encoding()`
 * or 'UTF-8'.
 * @return string Wrapped text.
 * @link http://book.cakephp.org/3.0/en/core-libraries/global-constants-and-functions.html#h
 */
function h($text, $double = true, $charset = null)
```


### <a id="is_natural"></a>is_natural

```
/**
 * checks if the given number is a natural number
 *
 * @param int|float|array $number
 * @param bool $zero - if set to true zero will be considered
 * @return bool
 */
function is_natural($number, $zero = false)
```

### <a id="between"></a> between

```
/**
 * checks if the given value is between 2 values(inclusive)
 *
 * @param int $number
 * @param int $min
 * @param int $max
 * @return bool
 */
function between($number, $min, $max)
```

### <a id="is_numeric_list"></a>is_numeric_list
```
/**
 * if an array is provided checks the values of the array all to be numeric,
 * if string is provided, will check to be comma separated list
 *
 * @param mixed $data - array of numbers or string as comma separated numbers
 * @return bool
 */
function is_numeric_list($data)
```

### <a id="last_chars"></a>last_chars
```
/**
 * returns given amount of characters counting backwards
 *
 * @param string $str
 * @param int $count
 * @return string
 */
function last_chars($str, $count = 1)
```


### <a id="create_slug"></a>create_slug
```
/**
 * create slug from string
 *
 * @param string $str
 * @param string $symbol
 * @return string - e.g. in word1-word2-word3 format
 */
function create_slug($str = "", $symbol = "-")
```

### <a id="coalesce"></a>coalesce
```
/**
 * mysql coalesce equivalent
 *
 * @param mixed - list of arguments
 * @return mixed
 * @link http://stackoverflow.com/a/4688108/932473
 */
function coalesce()
```

### <a id="get_first_key"></a>get_first_key
```
/**
 * returns the first key of the array
 *
 * @param array $array
 * @return mixed
 */
function get_first_key(array $array = [])
```


### <a id="get_first_value"></a>get_first_value
```
/**
 * returns the first value of the array
 *
 * @param array $array
 * @return mixed
 */
function get_first_value($array)
```


### <a id="get_last_key"></a>get_last_key
```
/**
 * returns the last key of the array
 *
 * @param array $array
 * @return mixed
 */
function get_last_key($array)
```

### <a id="get_last_value"></a>get_last_value
```
/**
 * returns the last value of the array
 *
 * @param array $array
 * @return mixed
 */
function get_last_value($array)
```

### <a id="array_unset"></a>array_unset
```
/**
 * unsets array's items by value
 *
 * @param array $array - the original array
 * @param array|string - the value or array of values to be unset
 * @return array - the processed array
 */
function array_unset($array, $values = [])
```


### <a id="array_iunique"></a>array_iunique
```
/**
 * case-insensitive array_unique
 *
 * @param array
 * @return array
 * @link http://stackoverflow.com/a/2276400/932473
 */
function array_iunique($array)
```



### <a id="get_directory_size"></a>get_directory_size
```
/**
 * returns the size of the directory
 *
 * @param null $path
 * @param bool|false $unit
 * @param bool|false $intOnly
 * @return string
 * @throws Exception
 * @link http://stackoverflow.com/a/478161/932473
 */
function get_directory_size($path = null, $unit = false, $intOnly = false)
```

### <a id="get_file_name"></a>get_file_name
```
/**
 * returns the file name without the extension
 *
 * @param string $fileName
 * @return string
 */
function get_file_name($fileName = '')
```

### <a id="get_file_extension"></a>get_file_extension
```
/**
 * returns the file extension from full file name
 *
 * @param string $fileName
 * @return string
 */
function get_file_extension($fileName)
```

### <a id="check_file_exists"></a>check_file_exists
```
/**
 * if file exists will return it - with number concatenated
 *
 * @param $path
 * @param $fileName
 * @param int $n
 * @return bool|string
 */
function check_file_exists($path, $fileName, $n = 100)
```


### <a id="format_bytes"></a>format_bytes
```
/**
 * @param $bytes
 * @param int $precision
 * @return string
 * @link http://stackoverflow.com/a/2510459/932473
 */
function format_bytes($bytes, $precision = 0)
```

### <a id="datetotime"></a>datetotime
```
/**
 * return timestamp from date considering "/" delimiter
 *
 * @return string
 */
function datetotime($date)
```


### <a id="is_date"></a>is_date
```
/**
 * checks if the given date(s) are valid mysql dates
 *
 * @param null $date1
 * @param null $date
 * @return bool - true if all dates are valid, false otherwise
 */
function is_date($date1 = null, $date = null)
```


### <a id="t2d"></a>t2d
```
/**
 * returns date in Y-m-d format from seconds
 *
 * @param time $timeStr
 * @return date
 */
function t2d($timeStr = null)
```

### <a id="t2dt"></a>t2dt
```
/**
 * returns date in Y-m-d H:i:s format from seconds
 *
 * @param time $timeStr
 * @return datetime
 */
function t2dt($timeStr = null)
```

### <a id="get_range"></a>get_range
```
/**
 * returns array with options for select box
 *
 * @param $min
 * @param $max
 * @param int $step
 * @return array
 */
function get_range($min, $max, $step = 1)
```

### <a id="_humanize"></a>_humanize
```
/**
 * @param $val
 * @return string
 */
function _humanize($val)
```


### <a id="get_class_constant"></a>get_class_constant
```
/**
 * returns constant of the class based on its value
 *
 * @param $className
 * @param $value
 * @param bool|true $humanize
 * @return string
 * @throws Exception
 */
function get_class_constant($className, $value, $humanize = true)
```


### <a id="get_class_constants"></a>get_class_constants
```
/**
 * returns the list of constants of the given class
 *
 * @param $className
 * @param bool|false $reverse
 * @param bool|true $humanize
 * @return array
 * @throws Exception
 */
function get_class_constants($className, $reverse = false, $humanize = true)
```

### <a id="shorten"></a>shorten
```
/**
 * returns the short string based on $length if string's length is more than $length
 *
 * @param string $str
 * @param number $length
 * @param bool $raw
 * @return string
 */
function shorten($str = '', $length = null, $raw = false)
```


### <a id="safe_json_encode"></a>safe_json_encode
```
/**
 * safe json_encode
 *
 * @param string $value
 * @return string
 */
function safe_json_encode($value)
```


### <a id="get_client_ip"></a>get_client_ip
```
/**
 * get client ip
 *
 * @return string
 */
function get_client_ip()
```

### <a id="rm_rf"></a>rm_rf
```
/**
 * linux "rm -rf" command equivalent
 * recursively deletes directory
 *
 * @param string $path
 * @throws Exception
 * @return bool
 */
function rm_rf($path)
```


### <a id="copy_r"></a>copy_r
```
/**
 * recursively copies files and directories
 *
 * @param string $src
 * @param string $dst
 * @return bool
 */
function copy_r($src, $dst)
```


### <a id="get_query_params"></a>get_query_params
```
/**
 * parses the url and returns the specified or all list of params
 *
 * @access public
 * @param string $url
 * @param bool $onlyQuery - if true the param will be checked only in the query string, default - false
 * @return mixed - string if found the param, bool false otherwise
 */
function get_query_params($url, $param = '', $onlyQuery = false)
```


### <a id="get_class_name"></a>get_class_name
```
/**
 * returns class name from object - without namespace
 *
 * @param string $object
 * @return mixed
 */
function get_class_name($object = '')
```

### <a id="extract_number"></a>extract_number
```
/**
 * returns numbers from the string
 *
 * @param string $str
 * @return string
 */
function extract_number($str = '')
```

### <a id="seconds_to_hour_minute"></a>seconds_to_hour_minute
```
/**
 * converts given seconds to hours and minutes
 *
 * @param null $seconds
 * @return string
 */
function seconds_to_hour_minute($seconds = null)
```


### <a id="is_cli"></a>is_cli
```
/**
 * check if the current request is from CLI
 *
 * @return bool
 */
function is_cli()
```
