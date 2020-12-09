# cpsc-471-api

For read:
1. Set request to GET and input URL: http://localhost/api/item/read.php

For search:
1. Set request to GET and input URL: http://localhost/api/item/search.php?item_id=1

For create:
1. Set request to POST and input URL: http://localhost/api/item/create.php
2. In Headers put Content-Type for Key and application/json as value
3. In body input raw with sample: 
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
1. Set request to PUT and input URL: http://localhost/api/item/update.php
2. In Headers put Content-Type for Key and application/json as value
2. In body input raw with sample:
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
1. Set request to DELETE and input URL: http://localhost/api/item/delete.php
2. In Headers put Content-Type for Key and application/json as value
2. In body input raw with sample:
```
{
    "item_id": "4"
}
```




FOR SHOPPING_LIST
SEARCH AND DELETE BY NAME
