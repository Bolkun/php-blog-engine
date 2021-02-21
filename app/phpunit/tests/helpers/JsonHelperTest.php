<?php

declare(strict_types=1);

require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

require_once '../helpers/json_helper.php';

define('URLROOT', 'https://test.net/bolkun');
define('URLCURRENT', 'https://test.net/bolkun/index/1');
define('VIEWSROOT', 'app/views');
define('PUBLIC_CORE_IMG_SOCIALURL', 'https://test.net/bolkun/public/core/social');
define('DEFAULT_SOCIAL_IMAGE', 'default_social_image-min.png');
define('PUBLIC_CORE_IMG_PREVIEWURL', 'https://test.net/bolkun/public/core/preview');
define('DEFAULT_PREVIEW_IMAGE', 'default_preview_image-min.png');

final class JsonHelperTest extends TestCase
{

    /** @test */
    public function jsonEncodeArray()
    {
        $asoc_array = array('id'=>1, 'created'=>'John');
        $expected_string = '{"array":{"id":1,"created":"John"}}';
        $result_string = jsonEncodeArray($asoc_array);

        $this->assertIsString($result_string);
        $this->assertEquals($result_string, $expected_string);
    }

    /** @test */
    public function jsonEncodeURLRoot()
    {
        $expected_string = '{"URLROOT":"https:\/\/test.net\/bolkun"}';
        $result_string = jsonEncodeURLRoot();

        $this->assertIsString($result_string);
        $this->assertEquals($result_string, $expected_string);
    }

    /** @test */
    public function jsonEncodeMenu()
    {
        $id = 1;
        $title = 'title';
        $expected_string = '{"blog_id":1,"title":"title","URLCURRENT":"https:\/\/test.net\/bolkun\/index\/1","URLROOT":"https:\/\/test.net\/bolkun","VIEWSROOT":"app\/views"}';
        $result_string = jsonEncodeMenu($id, $title);

        $this->assertIsString($result_string);
        $this->assertEquals($result_string, $expected_string);
    }

    /** @test */
    public function jsonSelectedSocialImage()
    {
        $social_image = 'test.png';
        $expected_string = '{"URLROOT":"https:\/\/test.net\/bolkun","PUBLIC_CORE_IMG_SOCIALURL":"https:\/\/test.net\/bolkun\/public\/core\/social","DEFAULT_SOCIAL_IMAGE":"default_social_image-min.png","social_image":"test.png"}';
        $result_string = jsonSelectedSocialImage($social_image);

        $this->assertIsString($result_string);
        $this->assertEquals($result_string, $expected_string);
    }

    /** @test */
    public function jsonSelectedPreviewImage()
    {
        $preview_image = 'test.png';
        $expected_string = '{"URLROOT":"https:\/\/test.net\/bolkun","PUBLIC_CORE_IMG_PREVIEWURL":"https:\/\/test.net\/bolkun\/public\/core\/preview","DEFAULT_PREVIEW_IMAGE":"default_preview_image-min.png","preview_image":"test.png"}';
        $result_string = jsonSelectedPreviewImage($preview_image);

        $this->assertIsString($result_string);
        $this->assertEquals($result_string, $expected_string);
    }

    /** @test */
    public function jsonEncodeDeleteSocialMedia()
    {
        $id = 1;
        $name = 'vk';
        $expected_string = '{"URLROOT":"https:\/\/test.net\/bolkun","id":1,"name":"vk"}';
        $result_string = jsonEncodeDeleteSocialMedia($id, $name);

        $this->assertIsString($result_string);
        $this->assertEquals($result_string, $expected_string);
    }
}
