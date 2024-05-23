# coding-task-data-feed

This repository contains the code for importing different data from files to database server. Follow the instructions below to set up and run the project.

### Message to K-Land reviewers: 

I choose to build a simple lightweight project with plain php since I need to train for another challenge. 
For this project, I was inspired by laravel framework and other projects I worked on.

### Disclaimer

This project was mainly built by me with the help of documentations and some help from ChatGpt(3.5).
There is still room for improvements.

The code should be readable and self-explanatory, so there are no comments.

## Installation

1. Clone the repository:

    ```bash
    git clone git@github.com:Alexstericris/coding-task-data-feed.git
    ```

2. Navigate to the project directory:

    ```bash
    cd coding-task-data-feed
    ```
   
3. Setup .env

    ```bash
    cp .env.example .env
    ```

4. Composer

    ```bash
    composer install
    ```
5. Run migrations

    ```bash
     php ./database/migrations/migration_1.php
     php ./database/migrations/migration_2.php
    ```

  


## Usage

1. Copy your import file to the project directory:

    ```bash
    cp <importfile> ./<importfile>
    ```

2. Run the import script:

    ```bash
    ./bin/run.php import:xml <importfile>
    ```

## Logs

Logs are stored in the `storage/logs` directory. Check this folder for any logs generated during the import process.

## Database

The default database used is `database.sqlite`. If you wish to change the database server, it is possible to switch to any server supported by DBAL (Doctrine Database Abstraction Layer).

### Running Migrations

To run database migrations, execute the following command:

    
    php ./database/migrations/migration_x.php
    

### Changing the Database Server

To change the database configuration, update config/db.php to match your desired database server settings. Make sure to install any required dependencies for the new database server.


