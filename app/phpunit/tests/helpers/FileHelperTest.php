<?php

declare(strict_types=1);

require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

require_once '../helpers/file_helper.php';

final class FileHelperTest extends TestCase
{
    /** @test */
    public function getAllFilesInDir()
    {
        // delete dir
        deleteFolderTreeRecursively('tmp');

        // create dir 'tmp'
        if (!file_exists('tmp')) {
            mkdir('tmp', 0777, true);
        }
        // create 'file1.txt'
        if (!is_file('tmp/file1.txt')) {
            $contents = 'This is a test1!';
            file_put_contents('tmp/file1.txt', $contents);
        }
        // create 'file2.txt'
        if (!is_file('tmp/file2.txt')) {
            $contents = 'This is a test2!';
            file_put_contents('tmp/file2.txt', $contents);
        }

        $expected_array = array('file1.txt', 'file2.txt');
        $result_array = getAllFilesInDir('tmp');

        $this->assertIsArray($result_array);
        $this->assertEquals($result_array, $expected_array);

        // delete dir
        deleteFolderTreeRecursively('tmp');
    }

    /** @test */
    public function deleteFolderTreeRecursively()
    {
        // create dir 'tmp'
        if (!file_exists('tmp')) {
            mkdir('tmp', 0777, true);
        }
        // create 'file1.txt'
        if (!is_file('tmp/file1.txt')) {
            $contents = 'This is a test1!';
            file_put_contents('tmp/file1.txt', $contents);
        }

        deleteFolderTreeRecursively('tmp');

        if (is_dir('tmp')) {
            $exists = true;
        } else {
            $exists = false;
        }

        $this->assertEquals($exists, false);
    }
}
