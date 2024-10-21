<?php

namespace App\Http\Controllers\API\ProblemSolvingPart;

use App\Http\Controllers\Controller;
use App\ResponseFormater;
use Illuminate\Http\Request;
use Str;
use Symfony\Component\HttpFoundation\Response;

class CipherEncoderController extends Controller
{
    use ResponseFormater;
    public function __invoke($input_string, $shift){
            $result['encodedText'] = $this->caesarCipher($input_string, $shift);
            $result['shift_value']=$shift;
        return $this->success("encoded_string",$result);

        }

    private function caesarCipher($text, $shift)
    {
        $tesxt=Str::lower($text);

        if($shift > 26){
            $shift=$shift % 26;
            // return $this->error('The Shift Should Not Be bigger Than 26',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $encoded = '';

        foreach (str_split($text) as $char) {
            if (ctype_alpha($char)) {
                $asciiOffset = ctype_upper($char) ? 65 : 97;
                $encoded .= chr((ord($char) + $shift - $asciiOffset) % 26 + $asciiOffset);
            } else {
                $encoded .= $char;
            }
        }

        return $encoded;
    }

}
