# Utility Functions for PHP

Functions are added to global namespace

## Contents

* <a href="#is_natural">is_natural</a>
* <a href="#between">between</a>


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
