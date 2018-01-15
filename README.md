# Utility Functions for PHP

Functions are added to global namespace

## Contents

* <a href="#dbg">dbg</a>
* <a href="#h">h</a>
* <a href="#is_natural">is_natural</a>
* <a href="#between">between</a>
* <a href="#is_numeric_list">is_numeric_list</a>
* <a href="#lastChars">lastChars</a>
* <a href="#createSlug">createSlug</a>
* <a href="#getRandomStr">getRandomStr</a>
* <a href="#coalesce">coalesce</a>
* <a href="#getFirstKey">getFirstKey</a>
* <a href="#getFirstValue">getFirstValue</a>
* <a href="#getLastKey">getLastKey</a>
* <a href="#getLastValue">getLastValue</a>
* <a href="#array_unset">array_unset</a>
* <a href="#array_iunique">array_iunique</a>
* <a href="#getDirectorySize">getDirectorySize</a>
* <a href="#getFileName">getFileName</a>
* <a href="#getFileExtension">getFileExtension</a>
* <a href="#checkFileExists">checkFileExists</a>
* <a href="#formatBytes">formatBytes</a>
* <a href="#datetotime">datetotime</a>
* <a href="#isDate">isDate</a>
* <a href="#t2d">t2d</a>
* <a href="#t2dt">t2dt</a>
* <a href="#getRange">getRange</a>
* <a href="#_humanize">_humanize</a>
* <a href="#getClassConstant">getClassConstant</a>
* <a href="#getClassConstants">getClassConstants</a>
* <a href="#shorten">shorten</a>
* <a href="#safeJsonEncode">safeJsonEncode</a>
* <a href="#getClientIp">getClientIp</a>
* <a href="#rm_rf">rm_rf</a>
* <a href="#copyR">copyR</a>
* <a href="#getQueryParams">getQueryParams</a>
* <a href="#getClassName">getClassName</a>
* <a href="#extractNumber">extractNumber</a>
* <a href="#secondsToHourMinute">secondsToHourMinute</a>
* <a href="#isCli">isCli</a>


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

### <a id="lastChars"></a>lastChars
```
/**
 * returns given amount of characters counting backwards
 *
 * @param string $str
 * @param int $count
 * @return string
 */
function lastChars($str, $count = 1)
```


### <a id="createSlug"></a>createSlug
```
/**
 * create slug from string
 *
 * @param string $str
 * @param string $symbol
 * @return string - e.g. in word1-word2-word3 format
 */
function createSlug($str = "", $symbol = "-")
```


### <a id="getRandomStr"></a>getRandomStr
```
/**
 * get random string using /dev/urandom
 * @link http://security.stackexchange.com/a/3939/38200
 *
 * @param null $length
 * @param bool|false $hash
 * @return string
 * @throws Exception
 */
function getRandomStr($length = null, $hash = false)
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

### <a id="getFirstKey"></a>getFirstKey
```
/**
 * returns the first key of the array
 *
 * @param array $array
 * @return mixed
 */
function getFirstKey(array $array = [])
```


### <a id="getFirstValue"></a>getFirstValue
```
/**
 * returns the first value of the array
 *
 * @param array $array
 * @return mixed
 */
function getFirstValue($array)
```


### <a id="getLastKey"></a>getLastKey
```
/**
 * returns the last key of the array
 *
 * @param array $array
 * @return mixed
 */
function getLastKey($array)
```

### <a id="getLastValue"></a>getLastValue
```
/**
 * returns the last value of the array
 *
 * @param array $array
 * @return mixed
 */
function getLastValue($array)
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



### <a id="getDirectorySize"></a>getDirectorySize
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
function getDirectorySize($path = null, $unit = false, $intOnly = false)
```

### <a id="getFileName"></a>getFileName
```
/**
 * returns the file name without the extension
 *
 * @param string $fileName
 * @return string
 */
function getFileName($fileName = '')
```

### <a id="getFileExtension"></a>getFileExtension
```
/**
 * returns the file extension from full file name
 *
 * @param string $fileName
 * @return string
 */
function getFileExtension($fileName)
```

### <a id="checkFileExists"></a>checkFileExists
```
/**
 * if file exists will return it - with number concatenated
 *
 * @param $path
 * @param $fileName
 * @param int $n
 * @return bool|string
 */
function checkFileExists($path, $fileName, $n = 100)
```


### <a id="formatBytes"></a>formatBytes
```
/**
 * @param $bytes
 * @param int $precision
 * @return string
 * @link http://stackoverflow.com/a/2510459/932473
 */
function formatBytes($bytes, $precision = 0)
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


### <a id="isDate"></a>isDate
```
/**
 * checks if the given date(s) are valid mysql dates
 *
 * @param null $date1
 * @param null $date
 * @return bool - true if all dates are valid, false otherwise
 */
function isDate($date1 = null, $date = null)
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

### <a id="getRange"></a>getRange
```
/**
 * returns array with options for select box
 *
 * @param $min
 * @param $max
 * @param int $step
 * @return array
 */
function getRange($min, $max, $step = 1)
```

### <a id="_humanize"></a>_humanize
```
/**
 * @param $val
 * @return string
 */
function _humanize($val)
```


### <a id="getClassConstant"></a>getClassConstant
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
function getClassConstant($className, $value, $humanize = true)
```


### <a id="getClassConstants"></a>getClassConstants
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
function getClassConstants($className, $reverse = false, $humanize = true)
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


### <a id="safeJsonEncode"></a>safeJsonEncode
```
/**
 * safe json_encode
 *
 * @param string $value
 * @return string
 */
function safeJsonEncode($value)
```


### <a id="getClientIp"></a>getClientIp
```
/**
 * get client ip
 *
 * @return string
 */
function getClientIp()
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


### <a id="copyR"></a>copyR
```
/**
 * recursively copies files and directories
 *
 * @param string $src
 * @param string $dst
 * @return bool
 */
function copyR($src, $dst)
```


### <a id="getQueryParams"></a>getQueryParams
```
/**
 * parses the url and returns the specified or all list of params
 *
 * @access public
 * @param string $url
 * @param bool $onlyQuery - if true the param will be checked only in the query string, default - false
 * @return mixed - string if found the param, bool false otherwise
 */
function getQueryParams($url, $param = '', $onlyQuery = false)
```


### <a id="getClassName"></a>getClassName
```
/**
 * returns class name from object - without namespace
 *
 * @param string $object
 * @return mixed
 */
function getClassName($object = '')
```

### <a id="extractNumber"></a>extractNumber
```
/**
 * returns numbers from the string
 *
 * @param string $str
 * @return string
 */
function extractNumber($str = '')
```

### <a id="secondsToHourMinute"></a>secondsToHourMinute
```
/**
 * converts given seconds to hours and minutes
 *
 * @param null $seconds
 * @return string
 */
function secondsToHourMinute($seconds = null)
```


### <a id="isCli"></a>isCli
```
/**
 * check if the current request is from CLI
 *
 * @return bool
 */
function isCli()
```
