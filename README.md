User
=======
`php bin/console doctrine:database:drop --force`

`php bin/console doctrine:database:create` 

`php bin/console doctrine:schema:update --force`
 
`bin/console fos:user:create admin --super-admin` 

`php bin/console doctrine:fixtures:load`

`php bin/console doctrine:generate:entities MaxcUserBundle`

`bin/console assetic:dump`

`php composer.phar require vendor/bundle`

`phpunit -c .`

`ab -n 10 user.dev/`