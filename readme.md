

## fastreading for Laravel 5 ( lib in development )

Reads the file types (Xls, xlsx, csv).

---

```php
Excel::load("path your file")->getFile();// return a File type with array of your file change
```

---

# Installation

Require this package in your `composer.json` .

```php
composer require "fastreading/excel"
```

#Functions

method   |             attributes     |return
---------|----------------------------|--------
getFile()| $withHeader (default false)| array 
getHeader()||array
getColls()||array
