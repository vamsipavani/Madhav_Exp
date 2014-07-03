<?php

$service= new WSM_Service("MySQL");
if($service->status() != SERVICE_RUNNING)
{
  $service->start();
  echo "The __MY__SERVICE__ service is starting.";
  while ($service->status() != SERVICE_RUNNING)
  {
    echo ".";sleep(2);
  }
}
echo "\nThe __MY__SERVICE__ service was started successfully.\n";

?>