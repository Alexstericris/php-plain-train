<?php

return [
  'channel'=>env('LOG_CHANNEL','file'),
  'channels'=>[
      'file'=>env('LOG_CHANNEL_FILE','storage/logs/cli.log'),
  ]
];