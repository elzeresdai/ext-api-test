<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Services\Resources\ApiDataResource;
use App\Services\WeArePentagon\WeArePentagonService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class WeArePentagonController extends Controller
{
    public function __construct(
        private readonly ApiDataResource $api
    ) {
    }

    public function storeData()
    {
        try {
            $data = $this->api->getApiData();
            $this->parseandSaveData($data->body());
        } catch (\Exception $exception) {
            Log::error('Error fetching and saving data: ' . $exception->getMessage());
            return response()->json(['error' => 'An error occurred while parsing and saving data.']);
        }
    }

    private function parseandSaveData($encodedData)
    {
        $items = explode('||', $encodedData);
        $fields = [];
        foreach ($items as $item) {
            $item = str_replace('{', ':', $item);
            list($type, $fieldData) = explode(':', $item, 2);
            $fieldData = str_replace(['{', '}'], '', $fieldData);
            $fields[$type] = $fieldData;
        }
        $this->setDataForStore($fields);
    }

    private function setDataForStore($fields)
    {
        dd($fields);
        foreach ($fields as $key => $field) {
            $key = str_replace('"', '', $key);
            if ($key === 'order') {
                list($k, $val) = explode(':', $field, 2);
                Orders::create(['id' => $val], $fields);
            } else {
                $sku = $fields['SKU'];
                // TODO encode base64
                Products::udateOrCreate(['sku' => $sku], ['fields' => $fields]);
            }
        }
    }
}
