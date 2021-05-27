##Laravel: Data to Monthly Converter
Using this package you will be able to converts your collection using a timestamp field to order data monthly or yearly and calculate monthly/yearly expenses.
You can use this package to build some expenses app and apply in chart.js efficiently.

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
Monthly::current($data,'created_at'));

// $data must be a Collection
// 'created_at' exist in collection, holds a timestamp or date
```
Result
It counts the data found on the respective month and returns an array.
```
array:5 [▼
  0 => 0
  1 => 0
  2 => 0
  3 => 0
  4 => 1
]
```
To get a sum of a field grouped monthly.
```
Monthly::expenseMonthly($data,'created_at','price');
```
Result 
It sums all the 'price' field and group monthly.
```
array:12 [▼
  0 => 150
  1 => 900
  2 => 300
  3 => 600
  4 => 300
  5 => 450
  6 => 0
  7 => 0
  8 => 0
  9 => 0
  10 => 0
  11 => 0
]
```

Some List of Available Codes
```
Monthly::current($data,'created_at'));
Monthly::monthly($data,'created_at'));
Monthly::yearly($data,'created_at'));
Monthly::expenseCurrent($data,'created_at','price'));
Monthly::expenseMonthly($data,'created_at','price));
Monthly::expenseYearly($data,'created_at','price'));
```

Using in chart.js

```
<?=json_encode($data);?>
```