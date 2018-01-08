<?php
if (!function_exists('dbg')) {
    /**
     * debug method from Cakephp - convenient wrapper for print_r
     *
     * @param $var
     * @param bool|false $return
     * @return string
     */
    function dbg($var, $return = false)
    {
        $trace = debug_backtrace();
        $rootPath = dirname(dirname(__FILE__));
        $file = str_replace($rootPath, '', $trace[0]['file']);
        $line = $trace[0]['line'];
        $var = $trace[0]['args'][0];
        $lineInfo = sprintf('<div><strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $line);
        $debugInfo = sprintf('<pre>%s</pre>', print_r($var, true));
        if ($return) {
            return ($lineInfo . $debugInfo);
        }
        print_r($lineInfo . $debugInfo);
    }
}


if (!function_exists('h')) {
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
    {
        if (is_string($text)) {
            //optimize for strings
        } elseif (is_array($text)) {
            $texts = [];
            foreach ($text as $k => $t) {
                $texts[$k] = h($t, $double, $charset);
            }
            return $texts;
        } elseif (is_object($text)) {
            if (method_exists($text, '__toString')) {
                $text = (string)$text;
            } else {
                $text = '(object)' . get_class($text);
            }
        } elseif (is_bool($text)) {
            return $text;
        }
        static $defaultCharset = false;
        if ($defaultCharset === false) {
            $defaultCharset = mb_internal_encoding();
            if ($defaultCharset === null) {
                $defaultCharset = 'UTF-8';
            }
        }
        if (is_string($double)) {
            $charset = $double;
        }
        return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, ($charset) ? $charset : $defaultCharset, $double);
    }
}

if (!function_exists('is_natural')) {
    /**
     * checks if the given number is a natural number
     *
     * @param int|float|array $number
     * @param bool $zero - if set to true zero will be considered
     * @return bool
     */
    function is_natural($number, $zero = false)
    {
        if (!is_array($number)) {
            $number = [
                $number
            ];
        }

        $s = false;
        foreach ($number as $n) {
            $n = (string)$n;
            if (ctype_digit($n) && ($zero ? $n >= 0 : $n > 0)) {
                $s = true;
                continue;
            }

            $s = false;
            break;
        }

        return $s;
    }
}


if (!function_exists('between')) {
    /**
     * checks if the given value is between 2 values(inclusive)
     *
     * @param int $number
     * @param int $min
     * @param int $max
     * @return bool
     */
    function between($number, $min, $max)
    {
        if ($number >= $min && $number <= $max) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_numeric_list')) {
    /**
     * if an array is provided checks the values of the array all to be numeric,
     * if string is provided, will check to be comma separated list
     *
     * @param mixed $data - array of numbers or string as comma separated numbers
     * @return bool
     */
    function is_numeric_list($data)
    {
        if (is_array($data)) {
            $data = implode(",", $data);
        }

        return preg_match('/^([0-9]+,)*[0-9]+$/', $data);
    }
}

if (!function_exists('lastChars')) {
    /**
     * returns given amount of characters counting backwards
     *
     * @param string $str
     * @param int $count
     * @return string
     */
    function lastChars($str, $count = 1)
    {
        return mb_substr($str, -$count, $count);
    }

}


if (!function_exists('createSlug')) {
    /**
     * create slug from string
     *
     * @param string $str
     * @param string $symbol
     * @return string - e.g. in word1-word2-word3 format
     */
    function createSlug($str = "", $symbol = "-")
    {
        // if not english
        $regex = '/^[ -~]+$/';
        if (!preg_match($regex, $str)) {
            $str = transliterator_transliterate('Any-Latin;Latin-ASCII;', $str);
        }

        $str = mb_strtolower($str);
        $str = str_replace("'", "", $str);
        $str = str_replace('"', "", $str);
        $str = str_replace(".", $symbol, $str);
        $str = str_replace("\\", $symbol, $str);
        $str = str_replace("/", $symbol, $str);
        $str = preg_replace("/[~\:;\,\?\s\(\)\'\"\[\]\{\}#@&%\$\!\^\+\*=\!\<\>\|?`]/", $symbol, trim($str));

        // everything but letters and numbers
        $str = preg_replace('/(.)\\1{2,}/', '$1', $str);

        // letters replace only with 2+ repetition
        $str = preg_replace("/[-]{2,}/", $symbol, $str);
        $str = rtrim($str, $symbol);

        return mb_strtolower($str);
    }
}


if (!function_exists('getRandomStr')) {
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
    {
        if (!$length) {
            $length = 50;
        }

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // this is provided for compatibility during development
            // on windows machines
            // windows should not be used in production
            $pr_bits = rand(1, getrandmax());
        } else {
            $fp = @fopen('/dev/urandom', 'rb');

            if ($fp === false) {
                throw new Exception('Can not use urandom');
            }

            $pr_bits = @fread($fp, $length);
            @fclose($fp);
        }


        if (!$pr_bits) {
            throw new Exception('Unable to read from urandom');
        }

        if ($hash) {
            if (is_string($hash) && in_array($hash, hash_algos())) {
                $string = hash($hash, $pr_bits);
            } else {
                $string = hash('sha512', $pr_bits);
            }

            return $string;
        }

        return substr(base64_encode($pr_bits), 0, $length);
    }
}

if (!function_exists('coalesce')) {
    /**
     * mysql coalesce equivalent
     *
     * @param mixed - list of arguments
     * @return mixed
     * @link http://stackoverflow.com/a/4688108/932473
     */
    function coalesce()
    {
        $res = array_filter(func_get_args());
        return array_shift($res);
    }
}


if (!function_exists('getFirstKey')) {
    /**
     * returns the first key of the array
     *
     * @param array $array
     * @return mixed
     */
    function getFirstKey(array $array = [])
    {
        if (!is_array($array)) {
            return false;
        }
        reset($array);
        return key($array);
    }
}

if (!function_exists('getFirstValue')) {
    /**
     * returns the first value of the array
     *
     * @param array $array
     * @return mixed
     */
    function getFirstValue($array)
    {
        if (!is_array($array)) {
            return false;
        }
        return reset($array);
    }
}

if (!function_exists('getLastKey')) {
    /**
     * returns the last key of the array
     *
     * @param array $array
     * @return mixed
     */
    function getLastKey($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $array = array_reverse($array, true);
        reset($array);
        return key($array);
    }
}


if (!function_exists('getLastValue')) {
    /**
     * returns the last value of the array
     *
     * @param array $array
     * @return mixed
     */
    function getLastValue($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $array = array_reverse($array);
        return reset($array);
    }
}

if (!function_exists('array_unset')) {
    /**
     * unsets array's items by value
     *
     * @param array $array - the original array
     * @param array|string - the value or array of values to be unset
     * @return array - the processed array
     */
    function array_unset($array, $values = [])
    {
        if (is_string($values)) {
            $values = [$values];
        }

        return array_diff($array, $values);
    }
}

if (!function_exists('array_iunique')) {
    /**
     * case-insensitive array_unique
     *
     * @param array
     * @return array
     * @link http://stackoverflow.com/a/2276400/932473
     */
    function array_iunique($array)
    {
        $lowered = array_map('mb_strtolower', $array);
        return array_intersect_key($array, array_unique($lowered));
    }
}


if (!function_exists('in_arrayi')) {
    /**
     * case-insensitive in_array
     *
     * @param string $needle
     * @param array $haystack
     * @return bool
     *
     * @link http://us2.php.net/manual/en/function.in-array.php#89256
     * @link https://stackoverflow.com/a/2166524
     * @link https://stackoverflow.com/a/2166522
     */
    function in_arrayi($needle, $haystack)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }
}

if (!function_exists('is_numeric_array')) {
    /**
     * check if array's keys are all numeric
     *
     * @param array
     * @return bool
     * @link https://codereview.stackexchange.com/q/201/32948
     */
    function is_numeric_array($array)
    {
        $result = true;
        foreach ($array as $k => $v) {
            if (!is_int($k)) {
                $result = false;
                break;
            }
        }
        
        return $result;
    }
}


if (!function_exists('getDirectorySize')) {
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
    {
        if (!$path || !is_dir($path)) {
            throw new Exception('Invalid directory');
        }

        $io = popen('/usr/bin/du -sk ' . $path, 'r');
        $size = fgets($io, 4096);
        $size = substr($size, 0, strpos($size, "\t"));
        pclose($io);

        if ($unit) {
            $unit = strtoupper($unit);
            $typeStr = $intOnly ? '' : ' ' . $unit;

            if ($unit == 'B') {
                return ($size * 1024) . $typeStr;
            } elseif ($unit == 'MB') {
                return round($size / 1024, 1) . $typeStr;
            } elseif ($unit == 'GB') {
                return round($size / (1024 * 1024), 1) . $typeStr;
            } else {
                return $size . $typeStr;
            }
        }

        if ($size < 1000) {
            return $size . ' KB';
        } elseif ($size < 999999) {
            return round(($size / 1024), 1) . ' MB';
        } else {
            return round(($size / (1024 * 1024)), 1) . ' GB';
        }
    }

}

if (!function_exists('getFileName')) {
    /**
     * returns the file name without the extension
     *
     * @param string $fileName
     * @return string
     */
    function getFileName($fileName = '')
    {
        $arr = explode(".", $fileName);
        array_pop($arr);
        return implode(".", $arr);
    }
}

if (!function_exists('getFileExtension')) {
    /**
     * returns the file extension from full file name
     *
     * @param string $fileName
     * @return string
     */
    function getFileExtension($fileName)
    {
        return substr(strrchr($fileName, '.'), 1);
    }
}

if (!function_exists('checkFileExists')) {
    /**
     * if file exists will return it - with number concatenated
     *
     * @param $path
     * @param $fileName
     * @param int $n
     * @return bool|string
     */
    function checkFileExists($path, $fileName, $n = 100)
    {
        // just in case
        $path = rtrim($path, DS) . DS;

        if (!file_exists($path . $fileName)) {
            return $fileName;
        }

        $name = getFileName($fileName);
        $ext = getFileExtension($fileName);

        $i = 1;
        $status = true;
        while (file_exists($path . $fileName)) {
            $fileName = $name . '_' . $i . '.' . $ext;
            $i++;

            if ($i > $n) {
                $status = false;
                break;
            }
        }

        if ($status) {
            return $fileName;
        }

        return false;
    }
}

if (!function_exists('formatBytes')) {
    /**
     * @param $bytes
     * @param int $precision
     * @return string
     * @link http://stackoverflow.com/a/2510459/932473
     */
    function formatBytes($bytes, $precision = 0)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}


if (!function_exists('datetotime')) {
    /**
     * return timestamp from date considering "/" delimiter
     *
     * @return string
     */
    function datetotime($date)
    {
        return strtotime(str_replace("/", "-", $date));
    }
}


if (!function_exists('isDate')) {
    /**
     * checks if the given date(s) are valid mysql dates
     *
     * @param null $date1
     * @param null $date
     * @return bool - true if all dates are valid, false otherwise
     */
    function isDate($date1 = null, $date = null)
    {
        if (!$date1 || $date1 == '1970-01-01') {
            return false;
        }
        $status = true;
        for ($i = 0; $i < func_num_args(); $i++) {
            $res = date_parse(func_get_arg($i));
            if ($res['year'] && $res['year'] != '1970' && $res['month'] && $res['day'] &&
                $res['warning_count'] == 0 && $res['error_count'] == 0
            ) {
                continue;
            }

            $status = false;
            break;
        }

        return $status;
    }

}


if (!function_exists('t2d')) {
    /**
     * returns date in Y-m-d format from seconds
     *
     * @param time $timeStr
     * @return date
     */
    function t2d($timeStr = null)
    {
        $timeStr = $timeStr ? $timeStr : time();
        return date("Y-m-d", $timeStr);
    }
}

if (!function_exists('t2dt')) {
    /**
     * returns date in Y-m-d H:i:s format from seconds
     *
     * @param time $timeStr
     * @return datetime
     */
    function t2dt($timeStr = null)
    {
        $timeStr = $timeStr ? $timeStr : time();
        return date("Y-m-d H:i:s", $timeStr);
    }
}


if (!function_exists('getRange')) {
    /**
     * returns array with options for select box
     *
     * @param $min
     * @param $max
     * @param int $step
     * @return array
     */
    function getRange($min, $max, $step = 1)
    {
        return array_combine(range($min, $max, $step), range($min, $max, $step));
    }

}

if (!function_exists('_humanize')) {
    /**
     * @param $val
     * @return string
     */
    function _humanize($val)
    {
        $val = str_replace("_", "", $val);
        $matches = preg_split('/(?=[A-Z])/', $val);
        return trim(implode(" ", $matches));
    }
}

if (!function_exists('getClassConstant')) {
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
    {
        if (class_exists($className)) {
            $reflection = new ReflectionClass($className);
            $val = trim(array_search($value, $reflection->getConstants()), '_');

            if ($humanize) {
                return _humanize($val);
            }

            return $val;
        }

        throw new Exception(sprintf('%s class does not exist', $className));
    }

}

if (!function_exists('getClassConstants')) {
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
    {
        if (!class_exists($className)) {
            throw new Exception(sprintf('%s class does not exist', $className));
        }

        $refl = new ReflectionClass($className);
        $constants = $refl->getConstants();

        if ($reverse) {
            $constants = array_flip($constants);

            array_walk($constants, function (&$val, $k) use($humanize) {
                if ($humanize) {
                    $val = _humanize($val);
                } else {
                    $val = $val;
                }
            });
        }

        return $constants;
    }

}


if (!function_exists('shorten')) {
    /**
     * returns the short string based on $length if string's length is more than $length
     *
     * @param string $str
     * @param number $length
     * @param bool $raw
     * @return string
     */
    function shorten($str = '', $length = null, $raw = false)
    {
        if ($length === null) {
            $length = defined('_PHP_UTIL_SHORTEN_LENGTH') ? _PHP_UTIL_SHORTEN_LENGTH : 50;
        }

        if (mb_strlen($str) > $length) {
            $shortStr = mb_substr($str, 0, $length) . "...";

            if ($raw) {
                return h($shortStr);
            }
        } else {
            return h($str);
        }

        return '<span title="' . h(str_ireplace("/", "", $str)) . '">' . h($shortStr) . '</span>';
    }
}


if (!function_exists('safeJsonEncode')) {
    /**
     * safe json_encode
     *
     * @param string $value
     * @return string
     */
    function safeJsonEncode($value)
    {
        return json_encode($value, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
    }
}

if (!function_exists('getClientIp')) {
    /**
     * get client ip
     *
     * @return string
     */
    function getClientIp()
    {
        if (empty($_SERVER['REMOTE_ADDR'])) {
            return '';
        }

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_VIA'])) {
            $ip = $_SERVER['HTTP_VIA'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}


if (!function_exists('rm_rf')) {
    /**
     * linux "rm -rf" command equivalent
     * recursively deletes directory
     *
     * @param string $path
     * @throws Exception
     * @return bool
     */
    function rm_rf($path)
    {
        if (@is_dir($path) && is_writable($path)) {
            $dp = opendir($path);
            while ($ent = readdir($dp)) {
                if ($ent == '.' || $ent == '..') {
                    continue;
                }
                $file = $path . DS . $ent;
                if (@is_dir($file)) {
                    rm_rf($file);
                } elseif (is_writable($file)) {
                    unlink($file);
                } else {
                    throw new \Exception($file . '. is not writable and cannot be removed. Please fix the permission or select a new path');
                }
            }
            closedir($dp);
            return rmdir($path);
        } else {
            return @unlink($path);
        }
    }
}


if (!function_exists('copyR')) {
    /**
     * recursively copies files and directories
     *
     * @param string $src
     * @param string $dst
     * @return bool
     */
    function copyR($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);

        $status = true;
        while (($file = readdir($dir)) !== false) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . DS . $file)) {
                    if (copyR($src . DS . $file, $dst . DS . $file)) {
                        ;
                    } else {
                        $status = false;
                        break;
                    }
                } else {
                    if (copy($src . DS . $file, $dst . DS . $file)) {
                        ;
                    } else {
                        $status = false;
                        break;
                    }
                }
            }
        }
        closedir($dir);

        return $status;
    }
}

if (!function_exists('getQueryParams')) {
    /**
     * parses the url and returns the specified or all list of params
     *
     * @access public
     * @param string $url
     * @param bool $onlyQuery - if true the param will be checked only in the query string, default - false
     * @return mixed - string if found the param, bool false otherwise
     */
    function getQueryParams($url, $param = '', $onlyQuery = false)
    {
        if (!$onlyQuery && in_array($param, ['scheme', 'host', 'path', 'query'])) {
            $p = parse_url($url);
            return isset($p[$param]) ? $p[$param] : false;
        }

        $parts = parse_url($url, PHP_URL_QUERY);
        parse_str($parts, $queryParams);

        if ($param) {
            return !empty($queryParams[$param]) ? $queryParams[$param] : false;
        }

        return $queryParams;
    }
}


if (!function_exists('getClassName')) {
    /**
     * returns class name from object - without namespace
     *
     * @param string $object
     * @return mixed
     */
    function getClassName($object = '')
    {
        return getLastValue(explode("\\", get_class($object)));
    }
}


if (!function_exists('extractNumber')) {

    /**
     * returns numbers from the string
     *
     * @param string $str
     * @return string
     */
    function extractNumber($str = '')
    {
        return trim(rtrim(trim(preg_replace("/[^0-9\.]/", "", $str)), '.'));
    }
}

if (!function_exists('secondsToHourMinute')) {
    /**
     * converts given seconds to hours and minutes
     *
     * @param null $seconds
     * @return string
     */
    function secondsToHourMinute($seconds = null)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        // $seconds = $seconds % 60;

        return sprintf("%02d:%02d", $hours, $minutes);
    }
}


if (!function_exists('isCli')) {

    /**
     * check if the current request is from CLI
     *
     * @return bool
     */
    function isCli()
    {
        return (php_sapi_name() === 'cli');
    }
}


