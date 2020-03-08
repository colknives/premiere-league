# Premier League API

## Introduction

This API demonstrates importing player data from premiere league data provider and ability to fetch all the listing and details of each player from the imported records.

## Prerequisite

1. [MySQL >= 15.1](https://www.mysql.com/)
2. [PHP >= 7.2](https://www.php.net/)
3. [Composer](https://getcomposer.org/)

## Install

1. Download / Clone this repository
2. Create a .env file and define your database information, you can use .env.example file as a basis
3. Run the following command to install all the vendor needed:
```bash
composer install
```
4. Migrate needed table using the following command:
```bash
php artisan migrate
```

## Data Importer

Add the following command in your Cron Job
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## API Documentation

### Status Codes
* `200` - Success
* `404` - Entity not found
* `405` - Invalid Method

### Player API

* [List - Player](docs/api/player.list.md) `GET /player/list`
* [View - Player](docs/api/player.view.md) `GET /player/view/{player_id}`
