# Utility Functions for PHP

Functions are added to global namespace

## Contents

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





### <a id="is_natural"></a> is_natural

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
```
