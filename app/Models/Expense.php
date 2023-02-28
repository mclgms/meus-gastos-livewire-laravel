<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'type','amount','user_id',
        'photo','expense_date'
    ];

    protected $dates = ['expense_date'];

    public function getAmountAttribute()
    {
        return $this->attributes['amount'] / 100;
    }

    public function setAmountAttribute($prop)
    {
        return $this->attributes['amount'] = $prop * 100;
    }

    public function setExpenseDateAttribute($prop)
    {
        $res = $this->attributes['expense_date'] = (\DateTime::createFromFormat('d/m/Y H:i:s',$prop))->format('Y-m-d H:i:s');
        return $res;
    }

    public function getCategoriesArrAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Formata uma data para o Banco de dados
     * d/m/Y H:i:s para Y-m-d H:i:s
     * @param $date d/m/Y H:i:s
     * @return string Y-m-d H:i:s
     */
    public static function formatExpenseDateUS($date)
    {
        $arr = explode(" ", $date);
        $d = explode("/", $arr[0]);

        $dia = $d[0];
        $mes = $d[1];
        $ano = $d[2];

        return $ano . '-' . $mes . '-' . $dia . ' ' . $arr[1];
    }

    /**
     * Formata uma data US para BR
     *
     * @param $date Y-m-d H:i:s
     * @return string d/m/Y H:i:s
     */
    public static function formatExpenseDateBR($date)
    {
        $arr = explode(" ", $date);
        $d = explode("-", $arr[0]);

        $dia = $d[2];
        $mes = $d[1];
        $ano = $d[0];

        $res = $dia . '/' . $mes . '/' . $ano . ' ' . $arr[1];
        return $res;
    }
}
