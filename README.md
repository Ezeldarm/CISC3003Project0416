# China Urban Life Guide

## Overview

The China Urban Life Guide is a web-based platform designed to assist international visitors and expatriates in navigating urban life in China. The project aims to bridge the informational divide encountered by foreigners by providing a comprehensive, user-centric resource. The platform offers insights into various facets of daily living, including cuisine, housing, healthcare, transportation, leisure, and climate, based on authentic, user-contributed content.

This project was developed by Team 02 as part of the CISC3003 course.

## Key Features

*   **City Profiles:** Detailed information on major Chinese cities covering six essential aspects of urban life.
*   **User Authentication:** Secure registration, login, email verification, and password recovery.
*   **Wishlist Functionality:** Allows users to save and track cities of interest.
*   **User-Generated Content:** Enables users to submit reviews, ratings, and participate in discussions (conceptual, with basic framework).
*   **Advanced Search & Filtering:** (Conceptual) To help users find specific information easily.
*   **Responsive Design:** Optimized for viewing on various devices (desktops, tablets, mobile).
*   **User Management Console:** For users to manage their profiles and contributions.

## Technology Stack

*   **Front-End:** HTML, CSS, JavaScript
*   **Back-End:** PHP
*   **Database:** MySQL
*   **Web Server:** Apache (typically run via XAMPP for local development)
*   **Libraries/Frameworks:** PHPMailer (for email functionalities)

## Project Structure

The project follows a standard web application structure:

```
CISC3003Project0416-main/
├── assets/                # CSS, JavaScript, images
│   ├── css/
│   ├── images/
│   └── js/
├── data/                  # JSON data files (e.g., city.json)
├── vendor/                # Composer dependencies (e.g., PHPMailer)
├── index.php              # Main landing page
├── login.php              # User login
├── register.html          # User registration form
├── register.php           # Handles user registration logic
├── db_config.php          # Database configuration
├── database.sql           # SQL schema for the database
├── cities.php             # Displays list of cities
├── specific_city.php      # Template for displaying specific city details
├── mylist.php             # User's wishlist page
├── toggle_favorite.php    # Handles adding/removing cities from wishlist
├── forgot_password.html   # Forgot password form
├── forgot_password.php    # Handles forgot password logic
├── reset_password.html    # Reset password form
├── reset_password.php     # Handles password reset logic
├── verify_email.php       # Handles email verification
├── header.php             # Common header component
├── sidebar.php            # Common sidebar component
├── footer.php             # Common footer component
└── ... other PHP and HTML files
```

## Setup and Installation

These instructions are for setting up the project on a local machine using XAMPP.

### Prerequisites

*   XAMPP (or any similar AMP stack like WAMP, MAMP, LAMP)
*   A web browser

### Steps

1.  **Start XAMPP:** Launch the XAMPP Control Panel and start the Apache and MySQL modules.
    *   **Note on MySQL Port:** The project is configured to use port `3307` for MySQL in `db_config.php`. Ensure your XAMPP MySQL is running on this port, or update `db_config.php` and `my.ini` (XAMPP MySQL config) if you use the default port `3306`.

2.  **Place Project Files:**
    *   Copy the entire `CISC3003Project0416-main` project folder into your XAMPP web root directory (usually `htdocs`).

3.  **Create and Populate Database:**
    *   Open your web browser and go to `http://localhost/phpmyadmin/`.
    *   Create a new database named `authentication_db` with `utf8mb4_unicode_ci` collation.
    *   Select the `authentication_db` database and go to the "Import" tab.
    *   Choose the `database.sql` file from the project folder (`CISC3003Project0416-main/database.sql`) and import it. This will create the necessary tables (`users`, `password_resets`, `email_verification`, `favorite_cities`).

4.  **Configure Email (Optional for Full Functionality):**
    *   For email verification to work, configure PHP's mail function. This involves setting up SMTP details in your `php.ini` file and potentially `sendmail.ini` if using XAMPP on Windows. Refer to the detailed installation instructions in the project report for guidance on configuring this with services like Gmail.

5.  **Access the Application:**
    *   Open your web browser and navigate to:
        `http://localhost/CISC3003Project0416-main/`
    *   (If you use a different Apache port, e.g., 8080, use `http://localhost:8080/CISC3003Project0416-main/`)

## Usage

*   Navigate the homepage to explore featured cities or articles.
*   Register for an account to access personalized features.
*   Log in with your credentials.
*   Browse the list of cities on the `cities.php` page.
*   Add cities to your wishlist by clicking the favorite icon.
*   View your saved cities on the `mylist.php` page.

## Team

*   **Team 02**
    *   DC325022 Pan Yangshen
    *   DC326264 Cheang Ngou Hin
    *   DC328536 Zhong Yu Zhang
    *   DC326958 Xie Yi

## Future Enhancements (Project Incomplete)

*   **Comprehensive Content for Six Core Modules:** Full data population and UI for Food, Housing, Medical Services, Transportation, Entertainment, and Climate modules.
*   **Full User-Generated Content System:** Robust review submission, display, and moderation tools.
*   **Advanced Search and Filtering:** Implement detailed filtering options across all content types.
*   **Personalized Onboarding & AI Suggestions:** Develop backend logic for personalized recommendations.
*   **Completed Email Verification Workflow:** Ensure reliable email sending and token handling.
*   **Full Implementation of `specific_city.php`:** Dynamically load and display all module content for selected cities.
*   **Expanded Community Features:** User following, browsing other user profiles, etc.

This README provides a basic guide to understanding, installing, and running the China Urban Life Guide project.
