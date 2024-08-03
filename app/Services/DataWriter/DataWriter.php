<?php

namespace Alex\CodingTaskDataFeed\Services\DataWriter;

use Doctrine\DBAL\Types\Types;

class DataWriter implements DataWriterInterface
{

    public function insertData($data, $tableOptions, $table, $colsFilter): void
    {
        $values = [];
        foreach ($tableOptions as $key => $option) {
            $values[$key] = '?';
        }

        $insertQuery = db()->insert($table);
        $insertQuery->values($values);

        foreach ($data as $row) {
            foreach ($row as $itemKey => $itemValue) {
                if (in_array($itemKey, $colsFilter)) {
                    continue;
                }
                $itemValue = $this->typeCheckValue($itemValue, $tableOptions[$itemKey]['type']);
                $insertQuery->setParameter(array_search($itemKey, array_keys($values)), $itemValue);
            }
            $insertQuery->executeQuery();
            $insertQuery = db()->insert($table);
            $insertQuery->values($values);
        }
    }

    protected function typeCheckValue($value, $type)
    {
        if ($type == Types::INTEGER) {
            $value = (int)$value;
        } elseif ($type == Types::FLOAT) {
            $value = (float)$value;
        } elseif ($type == Types::STRING || $type == Types::TEXT) {
            $value = is_array($value) ? '' : (string)$value;
        } elseif ($type == Types::BOOLEAN) {
            $value = (bool)$value;
        }
        return $value;
    }
}