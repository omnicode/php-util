<?php

namespace Tests;

class ConstantsTest extends \PHPUnit\Framework\TestCase
{
    /**
     *
     */
    public function testDS()
    {
        $this->assertEquals(DIRECTORY_SEPARATOR, DS);
    }

    /**
     *
     */
    public function testSECOND()
    {
        $this->assertEquals(1, SECOND);
    }

    /**
     *
     */
    public function testMINUTE()
    {
        $this->assertEquals(60, MINUTE);
    }

    /**
     *
     */
    public function testHOUR()
    {
        $this->assertEquals(3600, HOUR);
    }

    /**
     *
     */
    public function testDAY()
    {
        $this->assertEquals(86400, DAY);
    }

    /**
     *
     */
    public function testWEEK()
    {
        $this->assertEquals(604800, WEEK);
    }

}

