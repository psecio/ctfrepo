#!/bin/bash

echo "Running migrations and seeding data"

cd /var/www/html
./vendor/bin/phinx migrate
./vendor/bin/phinx seed:run