<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Transformers\APIFractalManager;
use App\Transformers\CurrencyTransformer;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/filter",
     *     summary="Filter currencies by get parameters",
     *     tags={"Currency"},
     *     @OA\Parameter(
     *         name="valuteID",
     *         in="path",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="from",
     *         in="path",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array"
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     * )
     */

    private $fractal;

    public function __construct(
        APIFractalManager $fractal
    )
    {
        $this->fractal = $fractal;
    }
    public function filterCurrency(CurrencyRequest $request){
        $currencies = Currency::whereBetween('date', [$request->from,$request->to])
                                ->where('valuteID',$request->valuteID)
                                ->get();

        $resource = $this->fractal->collection($currencies, new CurrencyTransformer());

        return $resource;
    }
}
