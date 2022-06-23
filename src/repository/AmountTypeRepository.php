<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/AmountType.php';

class AmountTypeRepository extends Repository
{
    protected $tableName = 'AmountTypes';

    public function convertFromStatement($statement): ?AmountType
    {
        if (!$statement) {
            return null;
        }
        return new AmountType($statement['id'], $statement['name']);
    }
}