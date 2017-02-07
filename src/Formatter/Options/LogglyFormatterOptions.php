<?php

namespace MonologModule\Formatter\Options;

use Monolog\Formatter\LogglyFormatter;

class LogglyFormatterOptions extends JsonFormatterOptions
{
    /**
     * @var int
     */
    protected $batchMode = LogglyFormatter::BATCH_MODE_NEWLINES;

    /**
     * @var bool
     */
    protected $appendNewline = false;
}
