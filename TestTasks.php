<?php

//First Task

class First
{
    public static $letter = 'A';

    public function getClassName()
    {
        return 'First';
    }

    public static function getLetter()
    {
        return static::$letter;
    }
}

class Second extends First
{
    public static $letter = 'B';

    public function getClassName()
    {
        return 'Second';
    }
}

Second::getLetter();



//Second Task

$colors = ['red','blue','green','yellow','lime','magenta','black','gold','gray','tomato'];

function randomColor($colors)
{
    return sprintf('%s', $colors[array_rand($colors)]);
}

$j = 0;
for ($i = 0; $i < 50; $i++) {
    $result = '';
    $randomColor = randomColor($colors);
    $randomWord = $colors[array_rand($colors)];
    if ($randomColor === $randomWord) {
        continue;
    }

    $result .= '<span style="color:'.$randomColor.'">' . $randomWord . '</span>' . ' ';
    $j++;

    if ($j === 5 || $j === 10 || $j === 15 || $j === 20) {
        $result .= '<br>';
    }
    if ($j === 26) {
        break;
    }

    echo $result;
}



//Third Task

$argv = explode(' ', $argv[1]);
$argv = array_unique($argv);
sort($argv);
foreach ($argv as $a) {
    if (is_numeric($a)) {
        $a = +$a;
        if (is_int($a)) {
            echo $a . ' ';
        }
    }
}



//Forth Task

include 'simple_html_dom.php';

class Team
{
    public function index()
    {
        $this->render('/team/page');
    }

    public function parse()
    {
        if (!empty($_POST['team'])) {
            $year = 2009;
            while ($year != date('Y', time())) {
                $season = $year . '-' . ($year - 1999);
                $place = $this->getTeamPlaceBySeason($season, $_POST['team']);
                echo $season . ': ' . $place . '<br>';
                $year++;
            }
            exit();
        }
    }

    public function getTeamPlaceBySeason($season, $team)
    {
        $data = file_get_html('https://terrikon.com/football/italy/championship/' . $season . '/table');
        $counter = 0;
        foreach ($data->find('table.big a[href*="football/teams/"]') as $a) {
            $counter++;
            if ($a->innertext == $team) {
                return $counter;
            }
        }
        return null;
    }
}

'File page.php:

<form style="display: inline-block" method="post" action="team/parse">
    <input name="team" placeholder="Enter team"></br>
    <button type="submit">Submit</button>
</form>';



//Fifth Task

1;

'SELECT id,COALESCE((SELECT (100 + SUM(if (t.from_person_id = p.id, amount * (-1), amount))) FROM `transactions` AS t WHERE t.from_person_id = p.id OR t.to_person_id = p.id),100) AS sum
FROM `persons` AS p
ORDER BY id ASC';

2;

'SELECT cities.name FROM `persons` 
JOIN `cities` ON persons.city_id = cities.id
JOIN `transactions` ON persons.id = transactions.from_person_id
GROUP BY cities.name
ORDER BY COUNT(transactions.from_person_id) DESC LIMIT 1';

3;

'SELECT * FROM `transactions`
JOIN `persons` AS persons_from ON transactions.from_person_id = persons_from.id
JOIN `persons` AS persons_to ON transactions.to_person_id = persons_to.id
WHERE persons_from.city_id = persons_to.city_id';
