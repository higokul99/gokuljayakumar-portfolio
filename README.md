# gokuljayakumar-portfolio
My personal portfolio website built using modern web technologies. Showcasing my projects, skills, and journey in tech.

## How to Run

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache Web Server (or similar)

### Installation

1.  **Clone the repository** to your web server's root directory (e.g., `htdocs` or `/var/www/html`).
2.  **Configure Database**:
    -   Open `db.php` and `setup_db.php`.
    -   Update the `$servername`, `$username`, and `$password` variables to match your MySQL configuration.
3.  **Initialize Database**:
    -   Run the setup script by navigating to `http://localhost/setup_db.php` in your browser or running `php setup_db.php` in the terminal.
    -   This will create the `portfolio` database, necessary tables, and populate them with initial data.
4.  **Delete Setup Script**:
    -   For security, delete `setup_db.php` after initialization.

### Usage

-   **Frontend**: Visit `http://localhost/` to view the portfolio.
-   **Admin Panel**: Visit `http://localhost/admin/` to access the control panel.
    -   **Default Credentials**:
        -   Username: `admin`
        -   Password: `admin123`

### Security

#### Change Password
1.  Log in to the Admin Panel.
2.  Click "Change Password" in the header.
3.  Enter your current password and the new password.

#### Reset Password (Emergency)
If you forget your password:
1.  Navigate to `http://localhost/reset_password.php` (or run `php reset_password.php` in terminal).
2.  This will reset the `admin` password to `admin123`.
3.  **Important**: Delete `reset_password.php` immediately after use to prevent unauthorized access.
