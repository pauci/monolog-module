<?php

namespace MonologModule\Handler\Options;

class StreamHandlerOptions extends CommonHandlerOptions
{
    /**
     * @var resource|string
     */
    protected $stream;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $filePermission;

    /**
     * @var bool
     */
    protected $useLocking = false;

    /**
     * @param resource|string $stream
     */
    public function setStream($stream)
    {
        $this->stream = $stream;
    }

    /**
     * @return resource|string
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param int $filePermission
     */
    public function setFilePermission($filePermission)
    {
        $this->filePermission = $filePermission;
    }

    /**
     * @return int
     */
    public function getFilePermission()
    {
        return $this->filePermission;
    }

    /**
     * @param boolean $useLocking
     */
    public function setUseLocking($useLocking)
    {
        $this->useLocking = $useLocking;
    }

    /**
     * @return boolean
     */
    public function getUseLocking()
    {
        return $this->useLocking;
    }
}
