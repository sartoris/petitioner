<?php
    $petitionNumbers = preg_replace("/[^A-Za-z0-9\-\,]/", '', strtoupper($_GET["petitionNumbers"]));
    $petitionNumbersStringLength = strlen($petitionNumbers);
    $currentLocation = 0;
    $petitionArray = array();
    $noError = true;
    $error = "Bad format. Petition numbers are 6 characters: two alpha, followed by 4 numeric digits. Numeric part is left padded with zeroes.";

    function getNextPetition() {
        // Look for the next petition number or next series of petition numbers.
        // Assume petition numbers are 6 characters: two alpha, followed by 4 numeric digits.
        // Numeric part is left padded with zeroes.
        global $petitionNumbers;
        global $petitionNumbersStringLength;
        global $petitionArray;
        global $currentLocation;
        global $noError;
        global $error;
        $petitionStringLength = 6;
        $batchStringLength = 2;
        $petitionNumberLength = 4;
        $petitionNumberFormat = "%4d";

        $hyphenLocation = strpos($petitionNumbers,"-",$currentLocation);
        if ($hyphenLocation === false) $hyphenLocation = -1;
        $commaLocation = strpos($petitionNumbers,",",$currentLocation);
        if ($commaLocation === false) $commaLocation = -1;

        if ($hyphenLocation == $commaLocation) {
            // only happens when both are not found - only 1 petition number
            if($petitionNumbersStringLength - $currentLocation == $petitionStringLength) {
                $petitionArray[] = substr($petitionNumbers, $currentLocation);
                $currentLocation = $petitionNumbersStringLength;
            } else {
                $error = "invalid petition number length";
                $noError = false;
            }
        } else if($hyphenLocation == -1 || ($commaLocation > -1 && $commaLocation < $hyphenLocation) ) {
            // comma comes first - get the petition number
            if($commaLocation == $currentLocation) {
                $currentLocation++;
            } else if($commaLocation - $currentLocation == $petitionStringLength) {
                $petitionArray[] = substr($petitionNumbers, $currentLocation, $petitionStringLength);
                $currentLocation = $commaLocation + 1;
            } else {
                $error = "invalid petition number length";
                $noError = false;
            }
        } else {
            // hyphen comes first - get the series of petition numbers
            if (
                $hyphenLocation - $currentLocation == $petitionStringLength
                && (
                        (
                            $commaLocation == -1 
                            && $petitionNumbersStringLength - ($hyphenLocation+1) == $petitionStringLength
                        )
                        || 
                        (
                            $commaLocation - $hyphenLocation == $petitionStringLength+1
                        )
                    )
                ) {
                $batch = substr($petitionNumbers, $currentLocation, $batchStringLength);
                if(substr($petitionNumbers, $hyphenLocation+1, $batchStringLength) == $batch) {
                    $currentNumber = substr($petitionNumbers, $currentLocation+$batchStringLength, $petitionNumberLength) + 0;
                    $endNumber = substr($petitionNumbers, $hyphenLocation+1+$batchStringLength, $petitionNumberLength) + 0;
                    if ($currentNumber >= $endNumber) {
                        $temp = $endNumber;
                        $endNumber = $currentNumber;
                        $currentNumber = $temp;
                    }

                    while($currentNumber <= $endNumber) {
                        $petitionArray[] = $batch . sprintf($petitionNumberFormat, $currentNumber++);
                    }
                } else {
                    $error = "Range must include only one batch.";
                    $noError = false;
                }
            } else {
                $error = "invalid petition number length";
                $noError = false;
            }
            $currentLocation = $hyphenLocation + $petitionStringLength+1;
        }
    }

    while($noError && $currentLocation < $petitionNumbersStringLength) {
        getNextPetition();
    }
    $record = new stdClass();
    if ($noError) {
        $record->petitionList = $petitionArray;
        $record->error = "";
        $record->count = count($petitionArray);
    } else {
        $record->petitionList = "";
        $record->error = $error;
    }
    echo json_encode($record);
?>