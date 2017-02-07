<?php

namespace MonologModule\Handler\Options;

use Elastica\Client;

class ElasticSearchHandlerOptions extends CommonHandlerOptions
{
    /**
     * @var Client|string
     */
    protected $client;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param Client|string $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return Client|string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
