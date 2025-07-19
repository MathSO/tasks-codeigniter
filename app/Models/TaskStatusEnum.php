<?php

namespace App\Models;

class TaskStatusEnum {
    public static function toHuman(string $status) : string {
        return [
            'pendente' => 'Pendente',
            'em_andamento' => 'Em andamento',
            'concluida' => 'Concluída',
        ][$status];
    }

    public static function getValues() : array {
        return [
            'pendente',
            'em_andamento',
            'concluida',
        ];
    }
}