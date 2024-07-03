# README

Welcome to the PML SHIP Backend project! This README file will guide you through the setup and usage of the Laravel framework.

## Installation

To get started with Laravel, follow these steps:

1. Clone the repository: `git clone https://github.com/FadhilPrawira/pml_ship_backend.git`
2. Install dependencies: `composer install`
3. Configure the environment: Copy the `.env.example` file to `.env` and update the necessary configuration values.
4. Generate application key: `php artisan key:generate`
5. Run database migrations: `php artisan migrate`
6. Run database migrations fresh and seed: `php artisan migrate:fresh --seed`
7. Run the command to create a symbolic link from "public/storage" to "storage/app/public": `php artisan storage:link`
8. Start the development server: `php artisan serve`

