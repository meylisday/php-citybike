<h1> How to run the app </h1>

RUN ``docker-compose up --build``  
RUN ``docker exec -it <name or container ID> bash``  

RUN ``composer i`` (from the container)

RUN for execute script ``php script.php`` (from the container)

RUN for execute tests ``./vendor/bin/phpunit tests`` (from the container)