<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];


    public static $forbidden = ['laravel', 'mohammed', 'php', 'html', 'css'];

    public static function rules($id)
    {
        return [
            'name' => [
                'required', 'max:255', 'min:3', 'string',
                Rule::unique('categories', 'name')->ignore($id),
                function ($attribute, $value, $fails) {
                    if (in_array(strtolower($value), self::$forbidden)) {
                        $fails('The :attribute field is forbidden.');
                    }
                }
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id',
            ],
            'image' => [
                'image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
        ];
    }
}
