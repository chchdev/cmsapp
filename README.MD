# CMSApp

A simple and flexible Content Management System (CMS) built with PHP and MySQL.

## Features

- User authentication and roles
- Create, edit, and delete posts and pages
- Media management (images, files)
- Responsive admin dashboard

## Requirements

- PHP
- MySQL
- Apache web server

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/chchdev/cmsapp.git
    ```
2. Copy files to your web server directory.
3. Import the `database.sql` file into your MySQL database.
4. Configure database settings in `config/config.php`.
5. Run `config/first_time.php`. Due to security this should be CHMOD'd appropritately and it is recommended only using it for testing. 
6. Access the app via your browser.

## Usage

- Log in as an admin to manage content.
- Create and organize posts and pages.
- Upload and manage media files.