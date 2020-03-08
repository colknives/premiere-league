<?php

namespace App\Helpers;

class XmlJsonConverter
{
    protected $xml;

    protected $json;

    /**
     * XmlJsonConverter __construct method
     *
     * @param string $xml
     */
    public function __construct($xml = null)
    {
        $this->xml = $xml;

        if ($xml != null) {
            $this->convert();
        }
    }

    /**
     * Convert xml to json
     * 
     * @param $xml
     * @return $this
     */
    public function convert()
    {
        $xml = simplexml_load_string($this->xml);
        $this->json = json_decode(json_encode($xml));
        return $this;
    }

    /**
     * Return converted xml to json
     * 
     * @return json
     */
    public function getJson()
    {
        return $this->json;
    }

}