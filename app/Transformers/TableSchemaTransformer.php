<?php

namespace App\Transformers;

use App\Models\Data;
use App\Models\TableSchema;

class TableSchemaTransformer
{
    protected TableSchema $data;
    public function __construct(TableSchema $data)
    {
        $this->data = $data;
    }

    public function transform(): array
    {
        return [
            "slug" => $this->data->slug,
            "schema" => $this->data->schema,
            "user_id" => $this->data->user_id,
            "created_at" => $this->data->created_at,
        ];
    }
    public static function collection($items): array
    {
        return collect($items)->map(fn($item) => (new self($item))->transform())->toArray();
    }
}
