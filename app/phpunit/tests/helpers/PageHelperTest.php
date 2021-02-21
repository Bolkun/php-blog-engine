<?php

declare(strict_types=1);

require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

require_once '../helpers/page_helper.php';

define('URLROOT', 'https://test.net/bolkun');

final class PageHelperTest extends TestCase
{
    /** @test */
    public function getKeywords()
    {
        $expected_string = 'My, new, website, My new website';
        $result_string = getKeywords('My new website');

        $this->assertIsString($result_string);
        $this->assertEquals($result_string, $expected_string);
    }

}
