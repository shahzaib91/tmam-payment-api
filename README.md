## About

Purpose of this project is to demonstrate WebHook subscription and Payments simulation API.

## Pre Requisite

- Xampp/Wampp or Mamp server must be installed.
- Composer is installed and configured properly.
- Minimum PHP 7.2 (Not tested below or with later versions).

## Setup

- Fork the repository using this command: <code>git clone https://github.com/shahzaib91/tmam-payment-api.git</code>
- Run command <code>composer install</code> while you are inside the root folder.
- Configure .env file and setup database connection.
- Run command: <code>php artisan migrate</code> to generate database tables.
- Access postman requests to configure web hook via subscription api provided inside postman.
- Access payment API provided inside postman.
- Optionally access transactions list api to check if payment transactions are created inside payment database.

## putenv() Leakage

You may face the problem discussed here: <a href="https://stackoverflow.com/questions/35179397/laravel-environment-variables-leaking-between-applications-when-they-call-each-o">Laravel environment variables leaking between applications when they call each other through GuzzleHttp</a>

The dirty solution/hack is to configure cache like so:
<code>php artisan config:cache</code>

## Postman Collections

There are three postman collections provided in the source. 

- 01-Webhook: This collection contains subscription api and optionally you can enable and disable webhook sync.
- 02-Payment: This collection contains payment simulation api and optionally you can list merchant transactions recorded in payment system.
- 03-Webhook Postman End-point Test: The name is self explanatory you can test web hook post request directly using this end-point but make sure you have completed setup of: <a href="https://github.com/shahzaib91/tmam-expense-system">Expense System</a> 
