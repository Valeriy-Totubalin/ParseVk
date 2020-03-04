<?php

namespace App\Controllers;

use App\Models\ParserModel;
use App\Views\ParserView;

class ParserController extends BaseController
{
    /**
     * @var string
     */
    protected $url;

    /**
     * ParserController constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Парсит и отображает посты группы вк
     */
    public function parseVkGroup(): void
    {
        $parser = new ParserModel($this->url);
        $data = $parser->getParserData();
        $dataArray = explode('<div class="wi_head">', $data);

        $result = [];
        foreach ($dataArray as $key => $value) {
            /**
             * Все что до первой находки нас не интересует
             */
            if ($key === 0 || empty($value)) {
                continue;
            }

            /**
             * Если у поста есть текст, то найдем его
             */
            if (empty(strpos($value, 'wi_no_text'))) {
                $textArray = $parser->parseBetween($value, '<div class="pi_text">', '</div>');
                $text = $textArray[0];
            } else {
                $text = null;
            }
            /**
             * Сформируем массив url фотографий поста
             */
            if (!empty(strpos($value, 'background-image:'))) {
                $photosUrl = $parser->parseBetween($value, 'url\(', '\)');
            } else {
                $photosUrl = [];
            }
            $result[$key] = [
                'text' => $text,
                'photos' => $photosUrl,
            ];
        }

        $parserView = new ParserView();
        $parserView->displayVkData($result);
    }
}
