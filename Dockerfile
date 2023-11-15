FROM php:apache

RUN apt-get update && apt upgrade -y

ADD ./src /var/www/html

EXPOSE 80

# Start Apache when the container starts
CMD ["apache2-foreground"]