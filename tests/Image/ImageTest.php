<?php

class ImageTest extends PHPUnit_Framework_TestCase {


    public function testGD2Extension() {

        $image = new Image\Canvas();
        //$this->assertWithinMargin($image->gd_version, 2, 1);

    }

    public function testCreateAndDestroyImage() {

        $image = new Image\Canvas();
        
        $image->createImage(100,100);
        $this->assertEquals($image->testImageHandle(), true);
        
        $image->destroyImage();
        $this->assertTrue(!isset($image->image));

    }

    public function testImageIsTrueColor() {

        $image = new Image\Canvas();

        $this->assertNotEmpty($image->openImage(TEST_BASE.DIRECTORY_SEPARATOR."image.gif"));
        $this->assertEquals($image->imageIsTrueColor(), false);

        $this->assertNotEmpty($image->openImage(TEST_BASE.DIRECTORY_SEPARATOR."image.jpg"));
        $this->assertEquals($image->imageIsTrueColor(), true);    
    }

    public function testImageColorAt() {

        $image = new Image\Canvas();


        $this->assertNotEmpty($image->openImage(TEST_BASE.DIRECTORY_SEPARATOR."image.gif")); //8 bit GIF image
        $this->assertEquals($image->imageColorAt(3,3), 255); //Solid blue


        $this->assertNotEmpty($image->openImage(TEST_BASE.DIRECTORY_SEPARATOR."image.png")); //32 bit PNG image
        $this->assertEquals($image->imageColorAt(3,3), 255); //Solid blue


        $this->assertNotEmpty($image->openImage(TEST_BASE.DIRECTORY_SEPARATOR."image.jpg")); //24 bit JPEG image
        $this->assertEquals($image->imageColorAt(3,3), 2279); //Solid blue (with jpg compression so it's the wrong color)

    }
    
    public function testEvaluateFXStack() {
    
        $image = new Image\Canvas();
        $analyser = $image->attach(new Image\Helper\Analyser());

        $this->assertNotEmpty($image->openImage(TEST_BASE.DIRECTORY_SEPARATOR."image.png")); //32 bit PNG image
        $this->assertNotEmpty($image->apply());

    }

}
