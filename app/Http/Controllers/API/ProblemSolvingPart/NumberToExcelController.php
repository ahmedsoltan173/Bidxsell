<?php

namespace App\Http\Controllers\API\ProblemSolvingPart;

use App\Http\Controllers\Controller;
use App\Trait\ResponseFormater;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class NumberToExcelController extends Controller
{
    use ResponseFormater;
    public function __invoke($index){
            $output = '';

            while ($index > 0) {
                $mod = ($index - 1) % 26;
                $output = chr($mod + 65) . $output;
                $index = (int)(($index - $mod) / 26);

            }

            return $this->success("excel_column",$output);
        }

}
