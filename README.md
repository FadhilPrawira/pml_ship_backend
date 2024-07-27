# README

Welcome to the PML SHIP Backend project! This README file will guide you through the setup and usage of the Laravel framework.

## Installation on local machine

To get started with Laravel, follow these steps:

1. Clone the repository: `git clone https://github.com/FadhilPrawira/pml_ship_backend.git`
2. Install dependencies: `composer install`
3. Configure the environment: Copy the `.env.example` file to `.env` and update the necessary configuration values.
4. Generate application key: `php artisan key:generate`
5. Run database migrations: `php artisan migrate`
6. Run database migrations fresh and seed: `php artisan migrate:fresh --seed`
7. Run the command to create a symbolic link from "public/storage" to "storage/app/public": `php artisan storage:link`
8. Start the development server: `php artisan serve`

## Deployment on VPS

Here are the steps to deploy the application on a VPS that runs Ubuntu 22.04:

1. `sudo apt-get update`

2. `sudo apt install curl git unzip`

### Set the domain
1. Buy a domain from registar

2. Go to DNS Management and add an A record with the IP address of the server

3. Wait for the DNS to propagate. You can check the propagation status using [DNS Checker](https://dnschecker.org/). It may take up to 48 hours.

### Setting database
1. `sudo apt install mariadb-server mariadb-client`

2. `sudo mysql_secure_installation`

### Install PHP
1. `sudo add-apt-repository ppa:ondrej/php`

2. `sudo apt update`

3. `sudo apt install php8.3-{bcmath,bz2,cli,common,curl,fpm,gd,intl,mysql,pdo,zip,mbstring,xml}`

### Install Composer
1. `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`

2. `php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`

3. `php composer-setup.php`

4. `php -r "unlink('composer-setup.php');"`

5. `sudo mv composer.phar /usr/local/bin/composer`

### Clone repository
1. `sudo ssh-keygen`

2. `sudo cat /root/.ssh/id_rsa.pub`

3. Add the public key to the [Github SSH keys](https://github.com/settings/keys)

4. `cd /var/www`

5. `sudo git clone git@github.com:FadhilPrawira/pml_ship_backend.git`

6. `cd /var/www/pml_ship_backend`

7. `composer install`

8. `cp /var/www/pml_ship_backend/.env.example /var/www/pml_ship_backend/.env`

9. Get the API Key from [FreecurrencyAPI](https://freecurrencyapi.com/) and PML API from IT Division

10. Change `APP_DEBUG=false` and `APP_ENV=production` in `.env` file

11. `php artisan storage:link`

12. `php artisan key:generate`

13. `php artisan migrate`

14. `php artisan migrate:fresh --seed`

15. `sudo chmod -R 775 storage bootstrap/cache`

16. `sudo chown -R www-data:www-data storage bootstrap/cache`

### Setting Nginx
1. `sudo apt install nginx`

2. `sudo nano /etc/nginx/sites-available/pml_ship_backend.conf`

3. Add the following configuration to the file:
```
server {
 listen 80;
 server_name <YOUR_DOMAIN> www.<YOUR_DOMAIN>;
 root /var/www/pml_ship_backend/public;
 index index.php;
 location / {
 try_files $uri $uri/ /index.php?$query_string;
 }
 location ~ \.php$ {
 include snippets/fastcgi-php.conf;
 fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
 }
}
```

5. `sudo ln -s /etc/nginx/sites-available/pml_ship.conf /etc/nginx/sites-enabled/`

6. `sudo nginx -t`

7. `sudo systemctl reload nginx`

### Setting SSL/HTTPS
1. `sudo snap install core; sudo snap refresh core`

2. `sudo apt remove certbot`

3. `sudo snap install --classic certbot`

4. `sudo ln -s /snap/bin/certbot /usr/bin/certbot`

5. `sudo ufw status`

6. `sudo ufw enable`

7. `sudo ufw allow 'OpenSSH'`

8. `sudo ufw allow 'Nginx Full'`

9. `sudo ufw delete allow 'Nginx HTTP'`

10. `sudo ufw status`

11. `sudo certbot --nginx -d <YOUR_DOMAIN> -d www.<YOUR_DOMAIN>`

12. `sudo systemctl status snap.certbot.renew.service`

13. `sudo certbot renew --dry-run`

### Add PHPMyAdmin
1. `sudo apt install phpmyadmin`

2. `sudo mysql -u root -p`

3. `CREATE USER 'padmin'@'localhost' IDENTIFIED BY '<YOUR_PHPMyAdmin_PASSWORD';`

4. `GRANT ALL PRIVILEGES ON *.* TO 'padmin'@'localhost' WITH GRANT OPTION;`

5. `EXIT;`

6. `sudo nano /etc/nginx/snippets/phpmyadmin.conf`

7. Add the following configuration to the file:
```
location /phpmyadmin {
    root /usr/share/;
    index index.php index.html index.htm;
    location ~ ^/phpmyadmin/(.+\.php)$ {
        try_files $uri =404;
        root /usr/share/;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include /etc/nginx/fastcgi_params;
    }

    location ~* ^/phpmyadmin/(.+\.(jpg|jpeg|gif|css|png|js|ico|html|xml|txt))$ {
        root /usr/share/;
    }
}
```

8. `sudo nano /etc/nginx/sites-available/default`

9. Add the following configuration to the file:
```
        include snippets/phpmyadmin.conf;
```

The file should look like this:
```
server {
        include snippets/phpmyadmin.conf; # Add this line
        listen 80 default_server;
        listen [::]:80 default_server;
        root /var/www/html;
}
```

10. `sudo nginx -t`

11. `sudo systemctl reload nginx`

12. `sudo systemctl reload php8.3-fpm`

PHPMyAdmin should be accessible at `http://<YOUR_IP_ADDRESS>/phpmyadmin/`

## TODO
1. Implement authorization with Laravel Spatie
2. Schedule get data from PML API every hour and update into our database
3. Schedule get data from Freecurrency API every day
