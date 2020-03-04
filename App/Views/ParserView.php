<?php

namespace App\Views;

class ParserView extends BaseView
{
    /**
     * @param array $data
     */
    public function displayVkData(array $data): void
    {
        foreach ($data as $item)
        {
            if (!is_array($item)) {
                continue;
            }
            if (!empty($item['text'])) {
                echo '<p>' . $item['text'] . '</p>';
            }
            if (is_array($item['photos']) && !empty($item['photos'])) {
                foreach ($item['photos'] as $photoSrc) {
                    echo '<img src="' . $photoSrc . '" alt="Фотография не загрузилась">';
                }
            }
            echo '<br><br>';
        }
    }
}
