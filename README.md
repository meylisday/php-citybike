<h1> How to run the app </h1>

RUN ``docker-compose up --build``  
RUN ``docker exec -it php-citybike-app-1 bash``  

RUN for execute script ``php script.php`` (from the container)

RUN for execute tests ``./vendor/bin/phpunit tests`` (from the container)