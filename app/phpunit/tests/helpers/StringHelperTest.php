<?php

declare(strict_types=1);

require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

require_once '../helpers/string_helper.php';

final class StringHelperTest extends TestCase
{
    /** @test */
    public function checkIfStringHasWord()
    {
        $string1 = 'How are you?';
        $word1 = 'you';
        $expected_bool1 = true;
        $result_bool1 = checkIfStringHasWord($string1, $word1);

        $string2 = 'How are you?';
        $word2 = 'to';
        $expected_bool2 = false;
        $result_bool2 = checkIfStringHasWord($string2, $word2);

        $this->assertIsBool($result_bool1);
        $this->assertEquals($result_bool1, $expected_bool1);
        $this->assertIsBool($result_bool2);
        $this->assertEquals($result_bool2, $expected_bool2);
    }
}
