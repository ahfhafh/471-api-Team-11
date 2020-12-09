# cpsc-471-api

api was developed in ...\Appserv\www\

For read:
1. Set request to GET and input URL: http://localhost/api/"table-name"/read.php replace "table-name" with the name of the table.
For example:
```
http://localhost/api/item/read.php
```

For search:
1. Set request to GET and input URL: http://localhost/api/"table-name"/search.php?"attribute"="3" replace "table-name" with the name of the table and "attribute" with
the primary key attribute searched by and "#" with the desired indexed number.
For example:
```
http://localhost/api/item/search.php?item_id=3
```

For create:
1. Set request to POST and input URL: http://localhost/api/"table-name"/create.php replace "table-name" with the name of the table.
For exmaple:
```
http://localhost/api/item/create.php
```
2. In Headers put Content-Type for Key and application/json as value
3. In body input raw with example sample: 
```
{
    "brand": "Coca-cola",
    "price": "2.99",
    "description": "coke",
    "in_stock": "Y",
    "type": "1",
    "section": "Beverages"
}
```


For Update:
1. Set request to PUT and input URL: http://localhost/api/"table-name"/update.php replace "table-name" with the name of the table.
For exmaple:
```
http://localhost/api/item/update.php
```
2. In Headers put Content-Type for Key and application/json as value
2. In body input raw with example sample:
```
{
    "item_id": "1",
    "brand": "Coca-cola",
    "price": "2.99",
    "description": "coke",
    "in_stock": "Y",
    "type": "1",
    "section": "Beverages"
}
```


For Delete:
1. Set request to DELETE and input URL: http://localhost/api/"table-name"/delete.php replace "table-name" with the name of the table.
```
http://localhost/api/item/delete.php
```
2. In Headers put Content-Type for Key and application/json as value
2. In body input raw with sample:
```
{
    "item_id": "4"
}
```
