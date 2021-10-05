<?php

namespace App\Transformers;

use App\Models\Currency;
use League\Fractal\TransformerAbstract;


class CurrencyTransformer extends TransformerAbstract
{
    /**
     * Transform the Currency entity.
     *
     * @param Currency $currency
     *
     * @return array
     */
    public function transform(Currency $currency)
    {
        $response = [
            'valuteID' => $currency->valuteID,
            'numCode' => $currency->numCode,
            'charCode' => $currency->charCode,
            'name' => $currency->name,
            'value' => number_format($currency->value,4),
            'date' => $currency->date
        ];

        return $response;
    }
}
