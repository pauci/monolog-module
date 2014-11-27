<?php

namespace MonologModule\Formatter\Options;

class LineFormatterOptions extends NormalizerFormatterOptions
{
    /**
     * @var string
     */
    protected $format;

    /**
     * @var bool
     */
    protected $allowInlineLineBreaks = false;

    /**
     * @var bool
     */
    protected $ignoreEmptyContextAndExtra = false;

    /**
     * @param boolean $allowInlineLineBreaks
     */
    public function setAllowInlineLineBreaks($allowInlineLineBreaks)
    {
        $this->allowInlineLineBreaks = $allowInlineLineBreaks;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @param boolean $ignoreEmptyContextAndExtra
     */
    public function setIgnoreEmptyContextAndExtra($ignoreEmptyContextAndExtra)
    {
        $this->ignoreEmptyContextAndExtra = $ignoreEmptyContextAndExtra;
    }

    /**
     * @return boolean
     */
    public function getAllowInlineLineBreaks()
    {
        return $this->allowInlineLineBreaks;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return boolean
     */
    public function getIgnoreEmptyContextAndExtra()
    {
        return $this->ignoreEmptyContextAndExtra;
    }
}
