## fastreading for Laravel 5

Reads the file types (Xls, xlsx, csv).

---

```php
Excel::load("path your file")->getFile();
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
