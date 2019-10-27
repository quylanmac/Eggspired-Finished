<?php

require __DIR__ . '\..\vendor\autoload.php';
//tasks/FirstTasks.php

use Crunz\Schedule;

$schedule = new Schedule();
$task = $schedule->run('../send_sms.php');
$task
	->every5Minutes();


return $schedule;

