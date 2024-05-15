FROM php:8.1.13-cli

RUN apt-get update && apt-get install -y vim git sudo wget

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  && php composer-setup.php \
  && php -r "unlink('composer-setup.php');" \
  && sudo mv composer.phar /usr/local/bin/composer \
  && wget https://github.com/clue/phar-composer/releases/download/v1.4.0/phar-composer-1.4.0.phar \
  && chmod +x phar-composer-1.4.0.phar \
  && mv phar-composer-1.4.0.phar /bin/phar-composer.phar

ARG USERNAME=developer
ARG USER_UID=1000
ARG USER_GID=$USER_UID

RUN groupadd --gid $USER_GID $USERNAME \
  && useradd -s /bin/bash --uid $USER_UID --gid $USER_GID -m $USERNAME
