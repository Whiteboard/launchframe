<?php

use App\Http\Launchframe;

/* :: Create App Controller
{+} ---------------------------------- */

$app = require_once 'bootstrap/app.php';

/* :: Bootstrap Launchframe from the Container
{+} ---------------------------------- */
$launchframe = $app->make(Launchframe::class);
$launchframe->bootstrap();

/* :: Import our routes file
{+} ---------------------------------- */
require_once 'routes.php';

/* :: Set global params in the Timber context
{+} ---------------------------------- */
add_filter('timber_context', [$launchframe, 'addToContext']);
