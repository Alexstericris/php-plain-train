<?php

namespace Alex\CodingTaskDataFeed\Services\DataWriter;

interface DataWriterInterface
{
    public function insertData($data,$tableOptions,$table,$colsFilter);
}