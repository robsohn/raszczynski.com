<?php

namespace S2r;

class Gallery
{
    public function getImages($iterator)
    {
        $images = array();
        foreach ($iterator as $fileinfo) {
            if (! $fileinfo->isDot()) {
                $images[] = $fileinfo->getFilename();
            }
        }
        arsort($images);

        return $images;
    }
}