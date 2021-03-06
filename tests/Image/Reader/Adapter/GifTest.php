<?php
namespace Image\Reader\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-05-30 at 11:00:21.
 */
class GifTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Gif
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Gif;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * @covers Image\Reader\Adapter\Gif::getImage
     */
    public function testGetImage()
    {
        $image = $this->object->getImage(dirname(__FILE__) . '/../../../image.gif');
        $this->assertTrue(($image && 'gd' == get_resource_type($image)));
    }
}
