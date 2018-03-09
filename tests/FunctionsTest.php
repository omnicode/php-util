<?php

namespace Tests;

use function PhpUtil\_humanize;
use function PhpUtil\array_iunique;
use function PhpUtil\array_unset;
use function PhpUtil\between;
use function PhpUtil\check_file_exists;
use function PhpUtil\coalesce;
use function PhpUtil\create_slug;
use function PhpUtil\datetotime;
use function PhpUtil\dbg;
use function PhpUtil\extract_number;
use function PhpUtil\format_bytes;
use function PhpUtil\get_class_constant;
use function PhpUtil\get_class_constants;
use function PhpUtil\get_class_name;
use function PhpUtil\get_client_ip;
use function PhpUtil\get_file_extension;
use function PhpUtil\get_file_name;
use function PhpUtil\get_first_key;
use function PhpUtil\get_first_value;
use function PhpUtil\get_last_key;
use function PhpUtil\get_last_value;
use function PhpUtil\get_query_params;
use function PhpUtil\get_range;
use function PhpUtil\h;
use function PhpUtil\in_array_i;
use function PhpUtil\is_cli;
use function PhpUtil\is_natural;
use function PhpUtil\is_numeric_array;
use function PhpUtil\is_numeric_list;
use function PhpUtil\last_chars;
use function PhpUtil\safe_json_encode;
use function PhpUtil\seconds_to_hour_minute;
use function PhpUtil\shorten;
use function PhpUtil\t2d;
use function PhpUtil\t2dt;

/**
 * Class FunctionsTest
 */
class FunctionsTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     */
    public function testDbg()
    {
        $expected = "<div><strong>" . __FILE__ . "</strong> (line <strong>" . (__LINE__ + 1) . "</strong>)</div><pre>12</pre>";
        $this->assertEquals($expected ,dbg(12, true));
        $this->assertNull(dbg(12));
    }

    /**
     *
     */
    public function testH()
    {
        $double = "UTF-8";
        $this->assertEquals('text', h('text', $double));
        $this->assertEquals(['text1', 'text2'], h(['text1', 'text2'], $double));
        $this->assertTrue(h(true));
        $this->assertFalse(h(false));

        $object = $this->getMockBuilder(\stdClass::class)->setMethods(['__toString'])->getMock();
        $object->expects($this->once())->method('__toString')->willReturn('true');
        $this->assertEquals('true', h($object, $double));

        $object = new \stdClass();
        $this->assertEquals('(object)stdClass', h($object, $double));
    }

    /**
     *
     */
    public function testIsNatural()
    {
        $this->assertFalse(is_natural(0));
        $this->assertTrue(is_natural(1));
        $this->assertFalse(is_natural([1, 'as']));
        $this->assertTrue(is_natural([1, 2]));
        $this->assertFalse(is_natural([0, 2]));
    }

    /**
     *
     */
    public function testBetween()
    {
        $this->assertFalse(between(1, 2, 3));
        $this->assertTrue(between(2, 1, 3));
    }

    /**
     *
     */
    public function testIsNumericList()
    {
        $this->assertTrue(is_numeric_list([1, 5, 0, 6]));
        $this->assertFalse(is_numeric_list([1, 5, 0, 's']));
        $this->assertFalse(is_numeric_list([1, 5, 0, true]));
        $this->assertFalse(is_numeric_list([1, 5, 0, false]));
    }

    /**
     *
     */
    public function testLastChar()
    {
        $this->assertEquals('s', last_chars('cars'));
    }

    /**
     * @param $original
     * @param $expected
     * @dataProvider providerTestCreateSlug
     */
    public function testCreateSlug($original, $expected)
    {
        $this->assertEquals($expected, create_slug($original));
    }

    /**
     * @return array
     */
    public function providerTestCreateSlug()
    {
        return [
            ['This string will be sluggified', 'this-string-will-be-sluggified'],
            ['THIS STRING WILL BE SLUGGIFIED', 'this-string-will-be-sluggified'],
            ['This1 string2 will3 be 44 sluggified10', 'this1-string2-will3-be-44-sluggified10'],
            ['This! @string#$ %$will ()be "sluggified', 'this-string-will-be-sluggified'],
        ];
    }
//
//    /**
//     *
//     */
//    public function testGetRandomStr()
//    {
//        //TODO discuss Tigo does not work correctly multiple test
//        $str = get_random_str(15);
//        $this->assertTrue(is_string($str));
//        $this->assertEquals(15, strlen($str));
//    }

    /**
     *
     */
    public function testCoalesce()
    {
        $this->assertNull(coalesce());
        $data = [
            'data1',
            'data2',
            'data3'
        ];
        $this->assertEquals(get_first_value($data), coalesce(...$data));
        $this->assertEquals(5, coalesce(5));
    }

    /**
     * @param $array
     * @param $expected
     * @dataProvider providerTestGetFirstKey
     */
    public function testGetFirstKey($array, $expected)
    {
        $this->assertEquals($expected, get_first_key($array));
    }

    /**
     * @return array
     */
    public function providerTestGetFirstKey()
    {
        return [
            [[2], 0],
            [[2,3], 0],
            [[2,3,4], 0],
            [['key' => 'value'], 'key'],
            [['key1' => 'value1', 'key2' => 'value2'], 'key1'],
        ];
    }

    /**
     * @param $array
     * @param $expected
     * @dataProvider providerTestGetFirstValue
     */
    public function testGetFirstValue($array, $expected)
    {
        $this->assertEquals($expected, get_first_value($array));
    }

    /**
     * @return array
     */
    public function providerTestGetFirstValue()
    {
        return [
            [[2], 2],
            [[2,3], 2],
            [[2,3,4], 2],
            [['key' => 'value'], 'value'],
            [['key1' => 'value1', 'key2' => 'value2'], 'value1'],
        ];
    }

    /**
     * @param $array
     * @param $expected
     * @dataProvider providerTestGetLastKey
     */
    public function testGetLastKey($array, $expected)
    {
        $this->assertEquals($expected, get_last_key($array));
    }

    /**
     * @return array
     */
    public function providerTestGetLastKey()
    {
        return [
            [[2], 0],
            [[2,3], 1],
            [[2,3,4], 2],
            [['key' => 'value'], 'key'],
            [['key1' => 'value1', 'key2' => 'value2'], 'key2'],
        ];
    }

    /**
     * @param $array
     * @param $expected
     * @dataProvider providerTestGetLastValue
     */
    public function testGetLastValue($array, $expected)
    {
        $this->assertEquals($expected, get_last_value($array));
    }

    /**
     * @return array
     */
    public function providerTestGetLastValue()
    {
        return [
            [[2], 2],
            [[2,3], 3],
            [[2,3,4], 4],
            [['key' => 'value'], 'value'],
            [['key1' => 'value1', 'key2' => 'value2'], 'value2'],
        ];
    }

    /**
     * @param $array
     * @param $values
     * @param $expected
     * @dataProvider providerTestArrayUnset
     */
    public function testArrayUnset($array, $values, $expected)
    {
        $this->assertEquals($expected, array_unset($array, $values));
    }

    /**
     * @return array
     */
    public function providerTestArrayUnset()
    {
        return [
            [[100, 200, 300], [100], [1 => 200, 2 => 300]],
            [[100, 200, 300], [100, 300], [1 => 200]],
            [[100, 200, 300], [100, 200, 300], []],
        ];
    }

    /**
     *
     */
    public function testArrayIUnique()
    {
        $array = ['value', 'Value', 'VaLue', 'VALUE'];
        $this->assertEquals(['value'], array_iunique($array));
    }

    /**
     *
     */
    public function testInArrayI()
    {
        $array = ['value', 'Value', 'VaLue', 'VALUE'];
        $this->assertTrue(in_array_i('valUE', $array));
    }

    /**
     *
     */
    public function testIsNumericArray()
    {
        $this->assertTrue(is_numeric_array([1]));
        $this->assertTrue(is_numeric_array(['value']));
        $this->assertFalse(is_numeric_array(['key' => 'value']));
    }

    /**
     *
     */
    public function testGetDirectorySize()
    {
        //TODO get_directory_size()
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testGetFileName()
    {
        $this->assertEquals('file', get_file_name('file.ext'));
    }

    /**
     *
     */
    public function testGetFileExtension()
    {
        $this->assertEquals('ext', get_file_extension('file.ext'));
    }

    /**
     * @param $path
     * @param $fileName
     * @param $n
     * @param $expected
     * @dataProvider providerTestCheckFileExists
     */
    public function testCheckFileExists($path, $fileName, $n, $expected)
    {
        $this->assertEquals($expected, check_file_exists($path, $fileName, $n));
    }

    /**
     * @return array
     */
    public function providerTestCheckFileExists()
    {
        return [
            [__DIR__ , 'aa.txt', 5, 'aa.txt'],
            [sprintf('%s%shelp%s',__DIR__ , DS , DS) , 'file.txt', 1, false],
            [sprintf('%s%shelp%s',__DIR__ , DS , DS) , 'file.txt', 2, false],
            [sprintf('%s%shelp%s',__DIR__ , DS , DS) , 'file.txt', 3, false],
            [sprintf('%s%shelp%s',__DIR__ , DS , DS) , 'file.txt', 4, 'file_3.txt'],
            [sprintf('%s%shelp%s',__DIR__ , DS , DS) , 'file.txt', 5, 'file_3.txt'],
        ];
    }

    /**
     * @param $bytes
     * @param $precision
     * @param $expected
     * @dataProvider providerTestFormatBytes
     */
    public function testFormatBytes($bytes, $precision, $expected)
    {
        $this->assertEquals($expected, format_bytes($bytes, $precision));
    }

    /**
     * @return array
     */
    public function providerTestFormatBytes()
    {
        return [
            [1, 0, '1 B'],
            [100, 1, '100 B'],
            [1024, 1, '1 KB'],
            [1025, 1, '1 KB'],
            [1600, 1, '1.6 KB'],
            [2000, 2, '1.95 KB'],
            [1024*1060, 2, '1.04 MB'],
            [1024*1024*1024, 1, '1 GB'],
            [1024*1024*1024*1024, 1, '1 TB'],
        ];
    }

    /**
     *
     */
    public function testDateToTime()
    {
       $this->assertEquals(1514761200, datetotime('02/09/2018'));
    }
//
//    /**
//     * @param $dates
//     * @param $expected
//     * @dataProvider providerIsDate
//     */
//    public function testIsDate($dates , $expected)
//    {
//        $this->assertEquals($expected, is_date(...$dates));
//    }
//
//    /**
//     * @return array
//     */
//    public function providerIsDate()
//    {
//        return [
//            [['1970-01-01', 0], false],
//            [['1971-01-02', '1971-01-03'], true],
//        ];
//    }

    /**
     *
     */
    public function testT2D()
    {
       $this->assertEquals(date("Y-m-d", time()), t2d());
       $this->assertEquals('2018-01-01', t2d(1514761700));
    }

    /**
     *
     */
    public function testT2DT()
    {
       $this->assertEquals(date("Y-m-d H:i:s", time()), t2dt());
       $this->assertEquals('2018-01-01 00:00:00', t2dt(1514761999));
    }

    /**
     *
     */
    public function testGetRange()
    {
        $this->assertEquals([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], get_range(1, 5));
        $this->assertEquals([1 => 1, 3 => 3, 5 => 5], get_range(1, 5, 2));
        $this->assertEquals([1 => 1, 4 => 4], get_range(1, 5, 3));
    }

    /**
     * @param $val
     * @param $expected
     * @dataProvider providerHumanize
     */
    public function test_Humanize($val, $expected)
    {
        $this->assertEquals($expected, _humanize($val));
    }

    /**
     * @return array
     */
    public function providerHumanize()
    {
        return [
            ['human_ize', 'humanize'],
            ['Human_ize', 'Humanize'],
            ['human_izeHuman', 'humanize Human'],
        ];
    }

    /**
     *
     */
    public function testGetClassConstantWhenClassNotExists()
    {
        $this->expectExceptionMessage('ConstTest class does not exist');
        get_class_constant('ConstTest', 'TestConst1');
    }

    /**
     *
     */
    public function testGetClassConstantWhenClassExists()
    {
        require_once __DIR__ . DS . 'help' . DS . 'class_constant.php';
        $this->assertEquals('', get_class_constant(\Tests\Help\ConstTest::class, 'sda'));
        $this->assertEquals('Test Constant3', get_class_constant(\Tests\Help\ConstTest::class, 'TestConst3'));
        $this->assertEquals('TestConstant3', get_class_constant(\Tests\Help\ConstTest::class, 'TestConst3', false));
    }

    /**
     *
     */
    public function testGetClassConstantsWhenClassNotExists()
    {
        $this->expectExceptionMessage('ConstTest class does not exist');
        get_class_constants('ConstTest');
    }

    /**
     * @param $className
     * @param $reverse
     * @param $humanize
     * @param $expected
     * @dataProvider providerTestGetClassConstantsWhenClassExists
     */
    public function testGetClassConstantsWhenClassExists($className, $reverse, $humanize, $expected )
    {
        require_once __DIR__ . DS . 'help' . DS . 'class_constant.php';
        $this->assertEquals($expected, get_class_constants($className, $reverse, $humanize));
    }

    /**
     * @return array
     */
    public function providerTestGetClassConstantsWhenClassExists()
    {
        return [
            [
                \Tests\Help\ConstTest::class,
                false,
                true,
                [
                    'TestConstant1' => 'TestConst1',
                    'TestConstant2' => 'TestConst2',
                    'TestConstant3' => 'TestConst3'
                ]
            ],
            [
                \Tests\Help\ConstTest::class,
                false,
                false,
                [
                    'TestConstant1' => 'TestConst1',
                    'TestConstant2' => 'TestConst2',
                    'TestConstant3' => 'TestConst3'
                ]
            ],
            [
                \Tests\Help\ConstTest::class,
                true,
                true,
                [
                    'TestConst1' => 'Test Constant1',
                    'TestConst2' => 'Test Constant2',
                    'TestConst3' => 'Test Constant3'
                ]
            ],
            [
                \Tests\Help\ConstTest::class,
                true,
                false,
                [
                    'TestConst1' => 'TestConstant1',
                    'TestConst2' => 'TestConstant2',
                    'TestConst3' => 'TestConstant3'
                ]
            ],
        ];
    }

    /**
     * @param $str
     * @param $length
     * @param $raw
     * @param $expected
     * @dataProvider providerTestShorten
     */
    public function testShorten($str, $length, $raw, $expected)
    {
        $this->assertEquals($expected, shorten($str, $length, $raw));
    }

    /**
     * @return array
     */
    public function providerTestShorten()
    {
        return [
            [
                'test example short length',
                null,
                false,
                'test example short length'
            ],
            [
                'test example short length',
                10,
                false,
                '<span title="test example short length">test examp...</span>'
            ],
            [
                'test example short length',
                10,
                true,
                'test examp...'
            ],
            [
                'test example short length',
                26,
                false,
                'test example short length'
            ],
        ];
    }

    /**
     * @param $value
     * @param $expected
     * @dataProvider providerTestSaveJsonEncode
     */
    public function testSafeJsonEncode($value, $expected)
    {
        $this->assertEquals($expected, safe_json_encode($value));
    }

    /**
     * @return array
     */
    public function providerTestSaveJsonEncode()
    {
        return [
            ['one', '"one"'],
            [['one', 'two'], '["one","two"]'],
        ];
    }

    /**
     *
     */
    public function testGetClientApi()
    {
        $this->assertEmpty(get_client_ip());

        $_SERVER['REMOTE_ADDR'] = 'ip1';
        $this->assertEquals('ip1', get_client_ip());

        $_SERVER['HTTP_VIA'] = 'ip2';
        $this->assertEquals('ip2', get_client_ip());

        $_SERVER['HTTP_FORWARDED_FOR'] = 'ip3';
        $this->assertEquals('ip3', get_client_ip());

        $_SERVER['HTTP_X_FORWARDED_FOR'] = 'ip4';
        $this->assertEquals('ip4', get_client_ip());

        $_SERVER['HTTP_CLIENT_IP'] = 'ip5';
        $this->assertEquals('ip5', get_client_ip());
    }

    /**
     *
     */
    public function testRmRf()
    {
        // @TODO
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testCopyR()
    {
        // @TODO
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testGetQueryParams()
    {
        $url = 'http::/url/path?param1=value1&param2=value2';
        $this->assertEquals([
            'param1' => 'value1',
            'param2' => 'value2',
        ], get_query_params($url));

        $this->assertEquals('value1', get_query_params($url, 'param1', true));
        $this->assertEquals(false, get_query_params($url, 'param11', true));

        $this->assertEquals(false, get_query_params($url, 'host', false));
        $this->assertEquals('http', get_query_params($url, 'scheme', false));
        $this->assertEquals(':/url/path', get_query_params($url, 'path', false));
        $this->assertEquals('param1=value1&param2=value2', get_query_params($url, 'query', false));
    }

    /**
     *
     */
    public function testGetClassNameBasedString()
    {
        $this->assertEquals('Class', get_class_name('Namespace' . DS . 'Class'));
    }

    /**
     *
     */
    public function testGetClassNameBasedObject()
    {
        require_once __DIR__ . DS . 'help' . DS . 'class_constant.php';
        $obj = new \Tests\Help\ConstTest();
        $this->assertEquals(\Tests\Help\ConstTest::class, get_class_name($obj));
    }

    /**
     * @param $str
     * @param $expected
     * @dataProvider providerTestExtractNumber
     */
    public function testExtractNumber($str, $expected)
    {
        $this->assertEquals($expected, extract_number($str));
    }

    /**
     * @return array
     */
    public function providerTestExtractNumber()
    {
        return [
            ['15', 15],
            ['a1a5a', 15],
            ['a1/5a', 15],
            ['/1/5a', 15],
        ];
    }

    /**
     * @param $seconds
     * @param $expected
     * @dataProvider providerTestSecondsToHour
     */
    public function testSecondsToHour($seconds, $expected)
    {
        $this->assertEquals($expected, seconds_to_hour_minute($seconds));
    }

    /**
     * @return array
     */
    public function providerTestSecondsToHour()
    {
        return [
            [60, '00:01'],
            [65, '00:01'],
            [60*60, '01:00'],
            [60*60 + 60 , '01:01'],
        ];
    }

    /**
     *
     */
    public function testIsCli()
    {
        $this->assertTrue(is_cli());
    }
}
