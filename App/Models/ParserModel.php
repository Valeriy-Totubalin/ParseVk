<?php

namespace App\Models;

class ParserModel extends BaseModel
{
    /**
     * @var string
     */
    protected $url;
    /**
     * @var string
     */
    protected $data;

    /**
     * ParserModel constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->data = file_get_contents($url);
    }

    /**
     * @return string
     */
    public function getParserUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getParserData(): string
    {
        return $this->data;
    }

    /**
     * Возвращает массив совпадений
     *
     * @param string $string
     * @param string $firstPattern
     * @param string $secondPattern
     * @return array
     */
    public function parseBetween(string $string, string $firstPattern, string $secondPattern): array
    {
        $result = [];
        preg_match_all('#' . $firstPattern . '(.+?)' . $secondPattern . '#is', $string, $arr);
        $result = $arr[1];

        return $result;
    }
}
