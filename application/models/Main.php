<?php

namespace application\models;

use application\core\Model;
use application\models\orm\Task;

class Main extends Model
{
    const LIMIT = 2;
    public function validate($post)
    {
        $nameLen = iconv_strlen($post['name']);
        $textLen = iconv_strlen($post['text']);
        if (empty($post['name'] || $post['email'] || $post['text'])) {
            throw new \Exception('Поле не должно быть пустым');
        }
        if ($nameLen < 3 or $nameLen > 20) {
            throw new \Exception('Имя должно содержать от 3 до 20 символов');
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('E-mail указан неверно');
        } elseif ($textLen < 10 or $textLen > 500) {
            throw new \Exception('Сообщение должно содержать от 10 до 500 символов');
        }
        return true;
    }

    public static function getTasks(array $route, string $sort = '')
    {
        $max   = self::LIMIT;
        $start = ((($route['page'] ?? 1) - 1) * $max);
        if (!empty($sort)) {
            $arrSort = explode('-', $sort);
            $key     = $arrSort[0];
            $value   = $arrSort[1];
        } else {
            $key   = 'id';
            $value = 'ASC';
        }
        return Task::findBy([], '', [$key => $value], $max, $start);
    }
}
