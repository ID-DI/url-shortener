# URL Shortener

This is a simple PHP application to shorten URLs.

## Getting Started

Follow these steps to get started with the URL shortener:

### Prerequisites

- PHP (>= 7.0)
- MySQL or MariaDB

### Installation

1. Clone this repository to your local machine:

```bash
git clone https://github.com/ID-DI/url-shortener.git

cd url-shortener

Import the SQL file (url_shortener.sql) into your MySQL or MariaDB database to create the necessary tables.

Update the database connection settings in classes/db.php with your database credentials.

Start your PHP development server:
php -S localhost:8000
Usage
Enter a long URL in the input field and click "Shorten".
You will be redirected to the index page with the shortened URL displayed.
Copy the shortened URL and use it to redirect to the original URL.
The shortened URLs will be displayed in a table on the index page.
Features
Shortens long URLs into a compact format.
Tracks the number of times each shortened URL is accessed.
Provides simple web interface for URL shortening and management.
# url-shortener
