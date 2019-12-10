# linksapp

docker run --rm --interactive --tty \
  --volume $PWD:/app \
  --user $(id -u):$(id -g) \
  composer require php-di/php-di

docker run -it --rm --name linksapp -v "$PWD":/usr/src/myapp -w /usr/src/myapp -p 8080:8080 php:7.4-cli php -S 0.0.0.0:8080 -t public/