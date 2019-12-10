# Links by Softers

### Notas para docker

~~~~
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  --user $(id -u):$(id -g) \
  composer require php-di/php-di
~~~~

~~~~
`docker run -it --rm --name linksapp -v "$PWD":/usr/src/myapp -w /usr/src/myapp -p 8080:8080 php:7.4-cli php -S 0.0.0.0:8080 -t public/
~~~~

### TODO
- [ ] agregar slug
- [ ] agregar login (tomando inspiración de https://github.com/subtitulamos/subtitulamos)
- [ ] probar de hacer tabla más linda como en video de refactor ui
