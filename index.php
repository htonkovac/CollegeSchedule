<?php
//ini_set('display_errors', 1);     //uncomment this line for debugging

const VISITOR_FILE_NAME = 'visitors.txt';

$dateTime = new CollegeDay(); //class that extends DateTime defined at the end of the file

$dateTime->changeWeekendsToMonday();

$dateTime->changeDateAfter6pm();

$anc = $dateTime->getAnchor();

if (!file_exists(VISITOR_FILE_NAME)) {
    $myFile = fopen(VISITOR_FILE_NAME, "w");
    fwrite($myFile, '0');

} else {
    $myFile = fopen(VISITOR_FILE_NAME, 'r');
}

//every time the script is run that is a new visit to the site so we increase the number of visits inside the file by one
$counter = fgets($myFile);
$counter += 1;
$myFile = fopen(VISITOR_FILE_NAME, "w");
fwrite($myFile, $counter);


header("Location: http://www.etfos.unios.hr/studenti/raspored-nastave-i-ispita/{$dateTime->format('Y-m-d')}/2-21#$anc");

class CollegeDay extends DateTime
{
    public function changeWeekendsToMonday()
    {

        if ($this->format('w') == '0') {
            $this->modify('+1 day');
        } elseif ($this->format('w') == '6') {
            $this->modify('+2 day');
        }

        $this->setTime(0, 0); //to ensure this function works without interference with other functions we set the time to zero
        return $this;
    }

    public function getAnchor()
    {
        $anchor = 'anc';

        switch ($this->format('w')) {
            case '1':
                $anchor = 'Pon';
                break;
            case '2':
                $anchor = 'Uto';
                break;
            case '3':
                $anchor = 'Sri';
                break;
            case '4':
                $anchor = 'Cet';
                break;
            case '5':
                $anchor = 'Pet';
                break;
        }

        return $anchor;
    }

    public function changeDateAfter6pm()
    {

        if ($this->format('H') > 17) {
            $this->modify('+1 day');
        }

        return $this;
    }
}
