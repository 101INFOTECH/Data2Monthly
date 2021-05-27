## Data to Monthly Converter
Using this package you will be able to converts your collection using a timestamp field to order data monthly or yearly and calculate monthly/yearly expenses.

Require this package in your composer.json and update composer.

```
composer require 101infotech/data2monthly
```

### Code Examples
```
use Infotech\Data2Monthly\Monthly;
```
To get a ordered monthly data upto current month.
```
Monthly::current(Collection $data,'created_at'));
//$data must be a collection
//'created_at' must be a timestamp or date
```
Result 
```
array:5 [▼
  0 => 0
  1 => 0
  2 => 0
  3 => 0
  4 => 1
]
```