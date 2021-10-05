<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyService
{

    public function fillTable()
    {
        Currency::truncate();

//        for($i = 0; $i < 30; $i++){
        for($i = 0; $i <= 5; $i++){
            $date_req = Carbon::today()->subDays($i);

            $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date_req->format('d/m/Y'));
            foreach ($xml->Valute as $valute) {
                $fields = $this->get_xml_field($valute);
                Currency::create([
                    'valuteID' => $this->xml_attribute($valute, 'ID'),
                    'name' => $fields['Name'],
                    'numCode' => $fields['NumCode'],
                    'charCode' => $fields['CharCode'],
                    'value' => (float)str_replace(',','.', $fields['Value']),
                    'date' => $date_req
                ]);
            };
        }
        return true;
    }
    private function xml_attribute($object, $attribute)
    {
        if(isset($object[$attribute]))
            return (string) $object[$attribute];
    }

    private function get_xml_field($field)
    {
        return  json_decode(json_encode((array)$field), TRUE);
    }
}
