<?

function random_b36($length){

    $rangeMin = pow(36, $length-1); //smallest number to give length digits in base 36
    $rangeMax = pow(36, $length)-1; //largest number to give length digits in base 36
    $base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number
    $newRand = base_convert($base10Rand, 10, 36); //convert it
   
    return $newRand; //spit it out

}

function contextualize($region, $context) {
		
}

?> 