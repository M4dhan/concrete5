<?php

namespace Concrete\Tests\File\Image\Thumbnail;

use Concrete\Core\Entity\File\Image\Thumbnail\Type\Type as ThumbnailTypeEntity;
use Concrete\Core\File\Image\Thumbnail\Type\Version as ThumbnailTypeVersion;
use PHPUnit_Framework_TestCase;

class ThumbnailTypeTest extends PHPUnit_Framework_TestCase
{
    public function typeShouldExistForProvider()
    {
        return [
            [100, 100, 10, 10, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, true],
            [100, 100, 10, 100, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, true],
            [100, 100, 10, 1000, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, true],
            [100, 100, 100, 10, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, true],
            [100, 100, 100, 100, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, 100, 1000, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, 1000, 10, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, true],
            [100, 100, 1000, 100, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, 1000, 1000, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, 10, null, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, true],
            [100, 100, 100, null, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, 1000, null, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, null, 10, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, true],
            [100, 100, null, 100, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, null, 1000, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],
            [100, 100, null, null, ThumbnailTypeEntity::RESIZE_PROPORTIONAL, false],

            [100, 100, 10, 10, ThumbnailTypeEntity::RESIZE_EXACT, true],
            [100, 100, 10, 100, ThumbnailTypeEntity::RESIZE_EXACT, true],
            [100, 100, 10, 1000, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 100, 10, ThumbnailTypeEntity::RESIZE_EXACT, true],
            [100, 100, 100, 100, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 100, 1000, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 1000, 10, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 1000, 100, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 1000, 1000, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 10, null, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 100, null, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, 1000, null, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, null, 10, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, null, 100, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, null, 1000, ThumbnailTypeEntity::RESIZE_EXACT, false],
            [100, 100, null, null, ThumbnailTypeEntity::RESIZE_EXACT, false],
        ];
    }

    /**
     * @dataProvider typeShouldExistForProvider
     *
     * @param int|null $thumbnailWidth
     * @param int|null $thumbnailHeight
     * @param int|null $imageWidth
     * @param int|null $imageHeight
     * @param string $sizingMode
     * @param bool $expectedResult
     */
    public function testTypeShouldExistFor($imageWidth, $imageHeight, $thumbnailWidth, $thumbnailHeight, $sizingMode, $expectedResult)
    {
        $version = new ThumbnailTypeVersion(
            null, // $directoryName
            null, // $handle
            null, // $name
            $thumbnailWidth,
            $thumbnailHeight,
            false, // $isDoubledVersion = false
            $sizingMode
        );
        $this->assertSame($expectedResult, $version->shouldExistFor($imageWidth, $imageHeight));
    }
}
