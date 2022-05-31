<?php

// só cria a função se ela não existir
if (!function_exists('convertItemsOfArrayToObject')) {
    function convertItemsOfArrayToObject(array $items): array
    {
        $items = array_map(function ($item) {
            // converte pra um stdclass
            $stdClass = new \stdClass;
            foreach ($item as $key => $value) {
                $stdClass->{$key} = $value;
            }
            return $stdClass; // agora temos um objeto genérico, não mais um array
        }, $items);

        return $items;
    }
}
