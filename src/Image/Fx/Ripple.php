<?php

namespace Image\Fx;

use Image\Fx\FxBase;
use Image\Plugin\PluginInterface;

class Ripple extends FxBase implements PluginInterface {

    public function __construct($frequency = 3, $amplitude = 4, $wrap_around = true) {
        $this->frequency = $frequency;
        $this->amplitude = $amplitude;
        $this->wrap_around = $wrap_around;
    }

    public function generate() {
        $width = $this->_owner->imagesx();
        $height = $this->_owner->imagesy();
        $map = array();
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $dis_x = $x + (sin(deg2rad(($y / $height) * 360) * $this->frequency) * $this->amplitude);
                $dis_y = $y + (sin(deg2rad(($x / $width) * 360) * $this->frequency) * $this->amplitude);
                if ($this->wrap_around == true) {
                    $dis_x = ($dis_x < 0) ? $dis_x + $width : $dis_x;
                    $dis_x = ($dis_x >= $width) ? $dis_x - $width : $dis_x;
                    $dis_y = ($dis_y < 0) ? $dis_y + $height : $dis_y;
                    $dis_y = ($dis_y >= $height) ? $dis_y - $height : $dis_y;
                } else {
                    $dis_x = ($dis_x < 0) ? 0 : $dis_x;
                    $dis_x = ($dis_x > $width) ? $width : $dis_x;
                    $dis_y = ($dis_y < 0) ? 0 : $dis_y;
                    $dis_y = ($dis_y > $height) ? $height : $dis_y;
                }
                $map['x'][$x][$y] = $dis_x;
                $map['y'][$x][$y] = $dis_y;
            }
        }
        
        $this->_owner->displace($map);
        return true;
    }

}
