<?php

function convertToDecimal($hours, $minutes)
{
    // Convert the minutes to decimal by dividing by 60
    $decimalMinutes = $minutes / 60;

    // Add the decimal minutes to the hours
    $decimalHours = $hours + $decimalMinutes;

    // Return the decimal hours
    return number_format($decimalHours, 2); // format to 2 decimal places
}

function convertToHoursMinutes($decimalHours)
{
    // Extract the hours by getting the integer part
    $hours = floor($decimalHours);

    // Get the remaining decimal part and convert it to minutes
    $minutes = round(($decimalHours - $hours) * 60);

    // Return the result as an array of hours and minutes
    return [
        'hours' => $hours,
        'minutes' => $minutes
    ];
}

// Example usage
// $decimalHours = 3.75;

// $time = convertToHoursMinutes($decimalHours);
// echo "Hours: " . $time['hours'] . ", Minutes: " . $time['minutes'];

?>
