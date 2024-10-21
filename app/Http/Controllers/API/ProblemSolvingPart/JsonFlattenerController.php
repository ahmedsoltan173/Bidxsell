<?php

namespace App\Http\Controllers\API\ProblemSolvingPart;

use App\Http\Controllers\Controller;
use App\Trait\ResponseFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class JsonFlattenerController extends Controller
{
    use ResponseFormater;
    public function __invoke($input_json){

        if(is_null($input_json)){
            return $this->error("Input Should Have Valid Json",Response::HTTP_BAD_REQUEST);
        }


            $json_data = json_decode($input_json, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->error("Input Should Have Valid Json",Response::HTTP_BAD_REQUEST);

            }

            $result = Arr::dot($json_data);
            return $this->success("flatten_data",$result);

        }
    }

