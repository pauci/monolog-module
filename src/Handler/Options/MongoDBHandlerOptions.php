<?php

namespace MonologModule\Handler\Options;

class MongoDBHandlerOptions extends CommonHandlerOptions
{
    /**
     * @var \MongoClient|\Mongo|string
     */
    protected $mongo;

    /**
     * @var \MongoDB|string
     */
    protected $database;

    /**
     * @var string
     */
    protected $collection;

    /**
     * @param string $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param \MongoDB|string $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }

    /**
     * @param \Mongo|\MongoClient|string $mongo
     */
    public function setMongo($mongo)
    {
        $this->mongo = $mongo;
    }

    /**
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @return \MongoDB|string
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return \Mongo|\MongoClient|string
     */
    public function getMongo()
    {
        return $this->mongo;
    }
}
