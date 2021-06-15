<?php
namespace App\functions;

use DateTime;


function hello()
{
    echo 'hello';
}


 function depuis($date)
    {
        date_default_timezone_set('Europe/Paris');
        $origin = new DateTime(date("Y-m-d H:i:s"));
        $target = new DateTime($date);
        $interval = $origin->diff($target);
        if ((int) floor($interval->y) === 0) {
            if ((int) floor($interval->m) === 0) {
                if ((int) floor($interval->d) === 0) {
                    if ((int) floor($interval->h) === 0) {
                        if ((int) floor($interval->i) === 0) {
                            if ((int) floor($interval->s) === 0) {
                                return 'maintenant';
                                
                            }
                            elseif ($interval->s === 1) {
                                return '1 seconde';
                                
                            }
                            else {
                                return $interval->s. ' secondes';
                                
                            }
                        }
                        elseif ($interval->i === 1) {
                            return '1 minute';
                            
                        }
                        else {
                            return $interval->i. ' minutes';
                            
                        }
                    }
                    elseif ($interval->h === 1) {
                        return '1 heure';
                        
                    }
                    else {
                        return $interval->h. ' heures';
                    }
                }
                elseif ($interval->d === 1) {
                    return '1 jour';
                    
                }
                else {
                    return $interval->d. ' jours';
                    
                }
            }
            elseif ($interval->m === 1) {
                return '1 mois';
                
            }
            else {
                return $interval->m. ' mois';
                
            }
        }
        elseif ($interval->y === 1) {
            return '1 jour';
            
        }
        else {
            return $interval->y. ' années';
            
        }
    }
