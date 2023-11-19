<?php

function pcoCallbirthday($URL){
    global $username,$password,$datas,$includes;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    $results=curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_close($ch);
    //put the results into a json so it can be iterated through.
    $results = json_decode($results,true);
    $datas = $results['data'];

    return $datas;
}

function upcomingevents($results){
    $currentDate = new DateTime(); // Get current date and time
    // $currentDate = new DateTime('2023-11-12');
    $dayOfWeek = $currentDate->format('w'); // Get the day of the week (0 = Sunday, 1 = Monday, ...)

    // Calculate the previous Sunday
    if ($dayOfWeek != 0) {
        $currentDate->modify('last Sunday');
    }

    $previousSunday = $currentDate->format('Y-m-d'); // Format: 2023-08-06

    // Calculate +10 days from the previous Sunday
    $currentDate->modify('+6 days'); // Move 10 days ahead
    $nextTenDays = $currentDate->format('Y-m-d'); // Format: 2023-08-16


    $upcomingEvents = [];

    foreach ($results as $result) {
        if (isset($result['attributes']['birthdate'])){
            $birthdate = new DateTime($result['attributes']['birthdate']);
        }else{
            $birthdate ='No Birthday';
        }
        if(isset($result['attributes']['anniversary'])){
            $anniversary = new DateTime($result['attributes']['anniversary']);
        }else{
            $anniversary='Not Married';
        }
        $firstname = $result['attributes']['first_name'];
        $lastname = $result['attributes']['last_name'];

        if ($anniversary != 'Not Married' && $birthdate !='No Birthday'){
            if ($birthdate->format('m-d') >= (new DateTime($previousSunday))->format('m-d') && $birthdate->format('m-d') <= (new DateTime($nextTenDays))->format('m-d')) {
                $upcomingEvents[] = [
                    'type' => 'Birthday',
                    'date' => $birthdate->format('n/j'),
                    'name' => $firstname." ".$lastname,
                ];
            }
        
            if ($anniversary->format('m-d') >= (new DateTime($previousSunday))->format('m-d') && $anniversary->format('m-d') <= (new DateTime($nextTenDays))->format('m-d')) {
                $upcomingEvents[] = [
                    'type' => 'Anniversary',
                    'date' => $anniversary->format('n/j'),
                    'name' => $firstname." ".$lastname,
                ];
            }
        }
    }
    return $upcomingEvents;
}
