#!/bin/bash

set -a
source .env
set +a

export cmd="cd /var/www/sklad/
git checkout -- .
git pull
php artisan optimize:clear
"
expect << 'END_EXPECT'
    spawn ssh $env(USER)@$env(HOST) $env(cmd)
    expect "*assword*"
    send $env(PASSWORD)\r
    expect eof
END_EXPECT
