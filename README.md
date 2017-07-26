# Itris Magento 2 starters Theme and Module

### Usefull for starting Theme Development on Magento 2

Includes a basic Theme and Module structure, composer.json file for installing Magento 2 (2.1.7 CE), Latest versions of [Snowdog Frontools](https://github.com/SnowdogApps/magento2-frontools), [Snowdog Blank theme - SASS version](https://github.com/SnowdogApps/magento2-theme-blank-sass), [H&O Magento 2 Advanced Template Hints module](https://github.com/ho-nl/magento2-Ho_Templatehints) and ofcourse a .gitignore file for a great kick start of your project.



## You need to have already installed
* A local development environment with a web server with PHP7 (not 7.1), database server and dnsmasq so you can run a domain like `.dev`
* [Composer](https://getcomposer.org/) dependency manager for PHP



## How to Use

#### Setup Magento 2
* Clone this repo
* Add database `mysql -h localhost -u user -p password` and type `create  database magento2;` check with `show databases;` if it excists
* Run `composer install`
* Type `chmod +x bin/magento` in the commandline to make Magento 2 a extendable
* Test the Magento 2 CLI by type `bin/magento`
* Then run `bin/magento setup:install --admin-email="admin+magento2@topleveldomain.com" --admin-firstname="admin" --admin-lastname="admin" --admin-password="password123" --admin-user="admin" --backend-frontname="admin" --base-url="http://magento2.dev" --db-host="127.0.0.1" --db-name="magento2" --db-user="databaseuser" --db-password="databasepassword123" --use-rewrites="1" --use-secure="0"` to install Magento 2
* Run `bin/magento setup:static-content:deploy` to deploy the themes and backend

#### Put Magento 2 in developers mode
* run `bin/magento deploy:mode:set developer` to set Magento 2 in developers mode
* Check if Magento 2 is in developers mode and run `bin/magento deploy:mode:show` always check de `core_config_data` table if Magento 2 is in developers mode by looking up `dev/static/sign` value must be `0`. You can set developers mode manualy by running this query 

```sql
INSERT INTO core_config_data (scope, scope_id, path, value) VALUES ('default', 0, 'dev/static/sign', '1');
```

* Turn off Magento 2 Page Cache with `bin/magento cache:disable` or just elements of the Cache with `bin/magento cache:disable layout block_html` for example

#### Check if your _theme type_ is in **Physical**

```sql
INSERT INTO `theme` (`theme_id`, `parent_id`, `theme_path`, `theme_title`, `preview_image`, `is_featured`, `area`, `type`, `code`) VALUES (NULL, '4', NULL, 'Itris Iris', NULL, '0', 'frontend', '0', 'Itris/iris');
```

#### Sample Data
* Install Magento 2 sample data with `bin/magento sampledata:deploy` (you need you [public key and private key](https://www.magentocommerce.com/magento-connect/customerdata/accessKeys/list/) for this, you can get them by making a free account on [magentocommerce.com](https://www.magentocommerce.com/magento-connect/customer/account/login/))
* When you installed the sample data run `bin/magento setup:upgrade`

#### Develop with SASS
* Setup _frontools_ by going to package directory `vendor/snowdog/frontools` and run `yarn` or `npm install` and run `gulp setup` check the theme configuration in `dev/tools/frontools/config`
* Run `gulp` in `dev/tools/frontools` too see all _frontools_ commands
* Run `gulp styles --theme iris` or `gulp watch --theme iris` when starting development

#### Nice to Have
Turn off admin notifications with n98-magerun2, run `n98-magerun2 admin:notifications`



## Usefull Magento 2 CLI commands in development
* `bin/magento setup:upgrade` When installing a Magento 2 plugin/module via composer
* `bin/magento setup:di:compile` Generates DI configuration and all missing classes that can be auto-generated
* `bin/magento setup:static-content:deploy --theme iris` Deploys static view files



## Must haves in Magento 2 Development 

**[Alan Storm Pestle](https://github.com/astorm/pestle)** A collection of command line scripts for Magento 2 code generation, and a PHP module system for organizing command line scripts.

**[n98-magerun2](https://github.com/netz98/n98-magerun2)** The swiss army knife for Magento developers, sysadmins and devops. The tool provides a huge set of well tested command line commands which save hours of work time. All commands are extendable by a module API. 

When developing on OSX you can use **[Valet](https://laravel.com/docs/master/valet)** as a easy to use development environment. With Nginx and DnsMasq out of the box.



---

