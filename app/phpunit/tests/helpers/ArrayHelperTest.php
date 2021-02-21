<?php

declare(strict_types=1);

require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

require_once '../helpers/array_helper.php';

final class ArrayHelperTest extends TestCase
{
    /** @test */
    public function resetArrayKeys()
    {
        $array = array();
        $array[5] = 35;
        $array[32] = 37;
        $expected_array = array(35, 37);
        $result_array = resetArrayKeys($array);

        $asoc_array = array('Peter' => 35, 'Ben' => 37, 'Joe' => 43);
        $expected_asoc_array = array(35, 37, 43);
        $result_asoc_array = resetArrayKeys($asoc_array);

        $this->assertIsArray($result_array);
        $this->assertIsArray($result_asoc_array);
        $this->assertEquals($result_array, $expected_array);
        $this->assertEquals($result_asoc_array, $expected_asoc_array);
    }

    /** @test */
    public function mergeAsocArrays()
    {
        $asoc_array1 = array('Peter' => 35, 'Ben' => 37);
        $asoc_array2 = array('Peter' => 6);
        $expected_asoc_array = array('Peter' => 6, 'Ben' => 37);
        $result_asoc_array = mergeAsocArrays($asoc_array1, $asoc_array2);

        $this->assertIsArray($result_asoc_array);
        $this->assertEquals($result_asoc_array, $expected_asoc_array);
    }
}
