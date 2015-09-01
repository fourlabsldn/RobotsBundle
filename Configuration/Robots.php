<?php

namespace FourLabs\RobotsBundle\Configuration;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Enum;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Robots
{
    /**
     * @var string
     * @Required
     * @Enum({"all", "noindex", "nofollow", "none", "noarchive", "nosnippet", "noodp", "notranslate", "noimageindex", "unavailable_after"})
     */
    public $directive;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $userAgent;

    public function getHttpHeader()
    {
        $header = '';

        if(!is_null($this->userAgent)) {
            $header .= $this->userAgent.': ';
        }

        $header .= $this->directive;

        if(!is_null($this->value)) {
            $header .= ': '.$this->value;
        }

        return $header;
    }
}
