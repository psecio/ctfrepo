#!/bin/bash

echo "Running migrations and seeding data"

/var/www/html/vendor/bin/phinx migrate
/var/www/html/vendor/bin/phinx seed:run