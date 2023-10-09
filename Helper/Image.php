<?php

namespace BrunoDuarte\Blog\Helper;

use Mageplaza\Core\Helper\Media;

/**
 * Class Image
 * @package Mageplaza\Blog\Helper
 */
class Image extends Media
{
    const TEMPLATE_MEDIA_PATH = 'brunoduarte/blog';
    const TEMPLATE_MEDIA_TYPE_AUTH = 'auth';
    const TEMPLATE_MEDIA_TYPE_POST = 'post';

    /**
     * @param string $type
     *
     * @return string
     */
    public function getBaseMediaPath($type = '')
    {
        return trim(static::TEMPLATE_MEDIA_PATH . '/' . $type, '/');
    }
}
