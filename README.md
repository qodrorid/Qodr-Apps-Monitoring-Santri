## About Qodr Apps Monitoring Santri

Qodr Apps Monitoring Santri is an application that is used to monitoring student activities in carrying out daily activities

## How to install
```
# clone repository
git clone https://github.com/qodrorid/Qodr-Apps-Monitoring-Santri.git -d qodr-smd

# enter to the directory
cd qodr-smd

# run install library php
composer install

# run script composer
composer run-script post-autoload-dump
composer run-script post-root-package-install
composer run-script post-create-project-cmd

# setup database
....
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
....

# run migration
php artisan migrate:refresh --seed

# running server
php artisan serve

```