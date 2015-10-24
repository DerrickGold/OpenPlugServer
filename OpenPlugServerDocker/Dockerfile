From debian:jessie

#Get dependencies
RUN apt-get update\
    && apt-get install -y php5 mcrypt php5-sqlite php5-mcrypt openssl curl unzip git supervisor \
    && rm -rf /var/lib/apt/lists/*

#Install composer
RUN curl -sS "https://getcomposer.org/installer" | php


#Clone the project and install project dependencies
RUN git clone https://github.com/DerrickGold/OpenPlugServer.git


WORKDIR /OpenPlugServer
RUN /composer.phar install --prefer-source

#make the database persistent
VOLUME ["/OpenPlugServer/storage/db"]


RUN php artisan key:generate
#expose the server port
EXPOSE 25222

ADD start_server.sh /
ADD supervisord.conf /supervisord.conf
CMD supervisord -c /supervisord.conf