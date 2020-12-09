<?php

function compareDates(string $date1, string $date2): bool
{
    $date1 = explode("/", $date1);
    $date2 = explode("/", $date2);
    
    if ((int)$date1[2] < (int)$date2[2]){
        return true;
    }else{
        if ((int)$date1[1] < (int)$date2[1]){
            return true;
        }else{
            if ((int)$date1[0] < (int)$date2[0]){
                return true;
            }
        }
    }
    return false;
}