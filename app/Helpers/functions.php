<?php
/*
    Arquivo com funções úteis para resolver problemas rotineiros
 */
function filterItemsByStoreId(array $items, $storeId)
{
    return array_filter($items, function ($line) use ($storeId) {
        return $line['store_id'] == $storeId;
    });
}
