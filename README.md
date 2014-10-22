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

New proj
========
On host

 `git clone --bare https://github.com/maxcgit/sf_user.git site.com`
 
Local 

 `cd /home/www`
 
 `git clone ~/git/site.com`
 
or remote

 `git clone ssh://user@ip:port/pathto/git/site.com`
 
 `cd site.com`
 
 `chmod 777 var/cache/ var/logs/ web/ app/AppCache.php`
 
 `cp app/config/parameters.yml.dist app/config/parameters.yml`
 
 `vim app/config/parameters.yml`
 
 `composer self-update; composer update`
 
 APC correct tag 'sf2_user' in  web/app.php
 
 $apcLoader = new ApcClassLoader('sf2_user', $loader);