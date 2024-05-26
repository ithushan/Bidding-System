# Bidding System

A web-based bidding system where users can place bids on various products in an auction format.

## Features

- User Authentication
- Product Listings
- Bidding Functionality
- User Dashboard
- Auction Details and History
- Image Uploads for Products

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- Bootstrap

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/your-username/bidding-system.git
    ```

2. **Navigate to the project directory:**
    ```sh
    cd bidding-system
    ```

3. **Set up the database:**
   - Import the provided SQL file (`database.sql`) into your MySQL database.
   - Update the database connection details in `backend/conn.php` with your MySQL credentials.

4. **Configure your web server:**
   - Ensure your web server (Apache, Nginx, etc.) is set up to serve PHP files.
   - Place the project directory in your web server's root directory.

5. **Start the server:**
   - If you're using XAMPP, WAMP, or another local server, start it accordingly.

## Usage

1. **Open the application:**
   - Navigate to the application's URL in your web browser (e.g., `http://localhost/bidding-system`).

2. **Register and Login:**
   - Create a new user account or log in with existing credentials.

3. **Browse Products:**
   - View available products and their details.

4. **Place Bids:**
   - Place bids on products you're interested in.

5. **Dashboard:**
   - Access your user dashboard to see your bidding history and current bids.

## Project Structure

bidding-system/
│
├── backend/
│ ├── conn.php # Database connection
│ └── ... # Other backend PHP scripts
│
├── uploads/ # Directory for storing product images
│
├── index.php # Home page
├── userPanel.php # User dashboard
├── viewProduct.php # Product detail page
├── account.php # Login/Register page
│
├── links/
│ ├── headLinks.php # Head links (CSS/JS includes)
│ └── footerLinks.php # Footer links (CSS/JS includes)
│
└── README.md # Project documentation  
