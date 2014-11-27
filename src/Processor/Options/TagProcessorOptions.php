<?php

namespace MonologModule\Processor\Options;

use Zend\Stdlib\AbstractOptions;

class TagProcessorOptions extends AbstractOptions
{
    /**
     * @var array
     */
    protected $tags = [];

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }
}
