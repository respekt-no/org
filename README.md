# org

This application handles the organization, memberships and the landing page of the political organization Respekt,
and is built on the Laravel framework.

## Initial setup

### Set required .env variables

_@todo Describe required .env variables_

### Install dependencies

```composer install```

```npm install```

### Run migrations (create database tables)

```php artisan migrate```

### Import postal codes


```php artisan app:import-postal-codes app:import-postal-codes https://www.bring.no/tjenester/adressetjenester/postnummer/postnummertabeller-veiledning/_/attachment/download/7f0186f6-cf90-4657-8b5b-70707abeb789:81735252d0e42ee10b4fe7a1c60c1068b3301c95/Postnummerregister-ansi.txt```

### Import municipality and county municipality names



```php artisan app:import-municipalities https://data.ssb.no/api/klass/v1//correspondencetables/1286.csv```


## License

This application and the Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
