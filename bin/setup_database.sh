#!/bin/bash

read -p "Do you wish to create setup a database (y/n)? " yesNo

if [[ $yesNo = "y" ]]; then
    echo "============= Creating database ============="

    php create_database.php

    echo "============= Database created =============="

    echo "============= Creating tables ============="

    php create_users_table.php

    echo "============= Tables created =============="
fi
