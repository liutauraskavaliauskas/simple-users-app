#!/bin/bash

read -p "Do you wish to create setup a database (y/n)? " yesNo

if [[ $yesNo = "y" ]]; then
    echo "============= Creating database ============="

    php create_database.php

    echo "============= Database created =============="

    echo "============= Creating tables ==============="

    php create_users_table.php
    php create_groups_table.php
    php create_permissions_table.php
    php create_group_permissions_table.php
    php create_user_group_table.php

    echo "============= Tables created ================"

    echo "============= Adding data =================="

    php create_admin_user.php
    php create_default_groups.php
    php create_default_permissions.php
    php create_default_group_permissions.php
    php create_default_user_groups.php

    echo "============= Admin data ==================="
fi
