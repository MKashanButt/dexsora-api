<?php

namespace App\Transformers;

use App\Models\Data;

class DataTransformer
{
    protected Data $data;
    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function transform(): array
    {
        return [
            "user_id" => $this->data->user_id,
            "data" => $this->data->data,
            "schema" => $this->data->schema,
            "created_at" => $this->data->created_at,
        ];
    }
    public static function collection($items): array
    {
        return collect($items)->map(fn($item) => (new self($item))->transform())->toArray();
    }
}
