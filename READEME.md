# install Settings for DockerHost
sudo apt -y update
sudo apt -y upgrade
sudo apt -y install unzip
sudo apt -y install php php-fpm php-cli php-zip php-mbstring php-xml
sudo curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

cd ~
https://github.com/HermanRas/Docker_Laravel8_Base.git
cd Docker_Laravel8_Base

cd src
composer update

## first time
cd ..
docker-composer up -d --build

## to stop
docker-composer down

## to start
docker-composer up -d