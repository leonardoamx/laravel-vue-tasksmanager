# Installation

1. Once you have cloned the repository, install the required dependencies using:
   ```bash
   composer install
   npm install
   ```
2. Create a `.env` file by copying the example:
   ```bash
   cp .env.example .env
   ```
3. Generate an application key:
   ```bash
   php artisan key:generate
   ```
4. Create a new MySQL database and set the connection params in the `.env` file.
5. Run the migrations to set up the database:
   ```bash
   php artisan migrate
   ```
6. Seed the database with initial data (optional):
   ```bash
   php artisan db:seed
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```
8. Access the application in your web browser at `http://localhost:8000`.
