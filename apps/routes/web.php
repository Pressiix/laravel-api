<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    function dumpDetail($rawFunctionText, $resultArray, $title, $originalArray1, $originalArray2 = null)
    {
        echo "<h3>$title</h3>";
        echo "\$variable1\n";
        dump($originalArray1);

        if ($originalArray2 != null) {
            echo "\$variable2\n";
            dump($originalArray2);
        }
        echo "Try <b>$rawFunctionText</b> and then we got this:\n";
        dump($resultArray);
    }

    $array1 = array('red', 'green', 'blue', 'yellow');
    $array2 = array('green', 'blue', 'yellow', 'purple');

    // remove two
    $array_without_two = array_filter($array1, function ($a) {
        return $a !== 2;
    });
    dumpDetail("array_filter(\$variable1, function (\$a) {return \$a !== 2;})", $array_without_two, "1. Remove matching value from array", $array1);

    // swap between key and value
    $swap_between_key_and_value =  array_flip($array1);
    dumpDetail("array_flip(\$variable1)", $swap_between_key_and_value, "2. Swap between key and value", $array1);

    // Compare the values of two arrays, and return the matches
    $intersect = array_intersect($array1, $array2);
    dumpDetail("array_intersect(\$variable1, \$variable2)", $intersect, "3. Compare the values of two arrays, and return the matches", $array1, $array2);

    // Compare the values of two arrays, and return the non-matches
    $diff = array_diff($array1, $array2);
    dumpDetail("array_diff(\$variable1, \$variable2)", $diff, "4. Compare the values of two arrays, and return the non-matches", $array1, $array2);

    // Change all keys in an array to uppercase
    $array_upper = array_change_key_case($array1, CASE_UPPER);
    dumpDetail("array_change_key_case(\$variable1, CASE_UPPER)", $array_upper, "5. Change all keys in an array to uppercase", $array1);

    // Get column from two dimensional array
    $two_dimension_array = array_chunk($array1, 1);
    $column = array_column($two_dimension_array, '0');
    dumpDetail("array_column(\$variable1, '0')", $column, "6. Get column from two dimensional array", $two_dimension_array);

    // Create an array by using the elements from one "keys" array and one "values" array
    $key_array = $array1;
    $value_array = $array2;
    $array_combine = array_combine($key_array, $value_array);
    dumpDetail("array_combine(\$variable1, \$variable2)", $array_combine, "7. Create an array by using the elements from one \"keys\" array and one \"values\" array", $key_array, $value_array);
    // Merge two arrays
    $merged_array = array_merge($array1, $array2);
    dumpDetail("array_merge(\$variable1, \$variable2)", $merged_array, "8. Merge two arrays", $array1, $array2);

    // Count array values
    $array_count = array_count_values($merged_array);
    dumpDetail("array_count_values(\$variable1)", $array_count, "9. Count array values", $merged_array);

    // Create array from variable
    $firstname = "John";
    $lastname = "Doe";
    $array_from_variable = compact('firstname', 'lastname');
    dumpDetail("compact(\$variable1, \$variable2)", $array_from_variable, "10. Create array from variable", $firstname, $lastname);
});
