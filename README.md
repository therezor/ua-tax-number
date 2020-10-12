[![CircleCI](https://circleci.com/gh/therezor/ua-tax-number.svg?style=shield)](https://circleci.com/gh/circleci/circleci-docs)
# Ukrainian tax number (INN, IPN) decoder and validator 
Validate, get gender, birthdate, or age from tax number.

## Installation
_This package requires PHP 7.1 or higher._

Run ```composer require therezor/ua-tax-number``` in your project root folder.

## Usage example
```php
<?php

use TheRezor\UaTaxNumber\Decoder;

$inn = '3184710691';
// true
if (Decoder::isValid($inn)) {
    // "male"
    $gender = Decoder::gender($inn);
    // DateTime '1987-03-12'
    $birthDate = Decoder::birthDate($inn);
    // 33
    $age = Decoder::age($inn);
}
```

___
# Валідатор та декодер українського ІПН
[Індивідуальний ідентифікаційний номер](https://uk.wikipedia.org/wiki/Реєстраційний_номер_облікової_картки_платника_податків)
Валідуйте, отримуйте стать, дату народження, чи вік по ІПН.


## Встановлення
_Цей пакет потребує PHP версії 7.1 або новішу._

Запустіть ```composer require therezor/ua-tax-number``` в директорії з вашим проектом.

## Приклад використання
```php
<?php

use TheRezor\UaTaxNumber\Decoder;

$inn = '3184710691';
// true
if (Decoder::isValid($inn)) {
    // "male"
    $gender = Decoder::gender($inn);
    // DateTime '1987-03-12'
    $birthDate = Decoder::birthDate($inn);
    // 33
    $age = Decoder::age($inn);
}
```

___
# Валидатор и декодер украинського ИНН
[Индивидуальный идентификационный номер](https://ru.wikipedia.org/wiki/Идентификационный_номер_физического_лица)
Валидируйте, получайте пол, дату рождения, или возраст по ИНН.

## Установка
_Для работы пакета необходимо PHP версии 7.1 или новее._

Запустите ```composer require therezor/ua-tax-number``` в директории с вашим проектом.

## Пример использования
```php
<?php

use TheRezor\UaTaxNumber\Decoder;

$inn = '3184710691';
// true
if (Decoder::isValid($inn)) {
    // "male"
    $gender = Decoder::gender($inn);
    // DateTime '1987-03-12'
    $birthDate = Decoder::birthDate($inn);
    // 33
    $age = Decoder::age($inn);
}
```
