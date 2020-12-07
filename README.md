## Starwars Backend
Features:
* Device registration
* Device search history
* Device view history
* Most viewd statistics
* Most searched statistics

### List of endpoints:
#### Tracking
http://localhost:8000/api/view/{category}?item={item name}  
http://localhost:8000/api/search/{category}?q={query}

#### Statistics  
http://localhost:8000/api/statistics/term  
http://localhost:8000/api/statistics/items

## Start using Docker Compose
```
$ docker-compose up -d
```

## Don't you have Docker (or enought memory)?
### Requirements
MySQL 5.7
PHP >= 7.3
BCMath PHP Extension
Ctype PHP Extension
Fileinfo PHP Extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension

### Project setup
Install dependencies
```
$ composer install
```
### Hosting
```
$ php artisan serve
```
# Now you're Good to go
