#about project 
Designing a helpdesk microservice to allow customers to create tickets and receive assistance for technical, financial, and other service-related doubts involves several components and considerations. Below is a high-level design for such a microservice:

#Setup Project on development machine : 

Step-1: clone project using **git clone https://github.com/Instaatech/helpdesk-microservice.git**
Step 2: Install project and dependency **composer install**
Step 3: Make sure the Docker desktop is installed on your development computer. else you can download and install https://www.docker.com/products/docker-desktop/

Step 4: cd src
Step 5: composer install
Step 6: Copy .env.example to .env
Step 7: docker-compose build
Step 8: docker compose up -d
You can see the project on 127.0.0.1:8080

Step 9: RUN php artisan migrate --seed 

for username and password . you can check UserSeeder.php 

