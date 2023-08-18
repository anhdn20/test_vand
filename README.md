# APPLICATION MANAGE STORES AND PRODUCTS

Help users manage their Stores and Products in Stores

## API Reference

### AUTH

API authenticate Users

#### API LOGIN
```
  POST /login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Your account |
| `password` | `string` | **Required**. Your password |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": {
        "accessToken": "4b292ad8c7df07f2bc250fee9c507bad"
    }
}
```

#### API LOGOUT
```
  POST /logout
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": null
}
```

### STORES

```
  GET /stores
```
#### API GET LIST STORES
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `page` | `integer` | **Required**. Current page |
| `key` | `string` | **Required**. Keyword to search |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": [
        {
            "id": 2,
            "name": "Cửa hàng hàng 2",
            "address": "Phường 7, Gò Vấp"
        },
        {
            "id": 1,
            "name": "cửa hàng của anhdn20 số 5",
            "address": "20 Phan Văn Trị, Gò Vấp"
        },
        {
            "id": 6,
            "name": "cửa hàng của anhdn20 số 3",
            "address": "20 Phan Văn Trị, Gò Vấp"
        },
        {
            "id": 5,
            "name": "cửa hàng của anhdn20 số 2",
            "address": "20 Phan Văn Trị, Gò Vấp"
        }
    ]
}
```

#### API GET STORE DETAIL
```
  GET /stores/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": {
        "id": 2,
        "name": "Cửa hàng hàng 2",
        "address": "Phường 7, Gò Vấp"
    }
}
```

#### API CREATE STORE
```
  POST /stores
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Name store |
| `address` | `string` | **Required**. Address store |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": null
}
```
#### API UPDATE STORE
```
  PUT /stores/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` |  Name store |
| `address` | `string` | Address store |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": null
}
```

#### API DELETE STORE
```
  DELETE /stores/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": null
}
```
### PRODUCTS

#### API GET LIST PRODUCTS
```
  GET /products
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `page` | `integer` | **Required**. Current page |
| `key` | `string` | **Required**. Keyword to search |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": [
        {
            "id": 6,
            "name": "Túi",
            "price": "129000",
            "quantity": "4",
            "nameStore": "Cửa hàng hàng 2"
        },
        {
            "id": 4,
            "name": "Mũ",
            "price": "623000",
            "quantity": "4",
            "nameStore": "cửa hàng của anhdn20 số 5"
        },
        {
            "id": 5,
            "name": "Dép",
            "price": "323000",
            "quantity": "4",
            "nameStore": "Cửa hàng hàng 2"
        },
        {
            "id": 2,
            "name": "Áo 2",
            "price": "523000",
            "quantity": "4",
            "nameStore": "cửa hàng của anhdn20 số 5"
        }
    ]
}
```
#### API GET PRODUCT DETAIL
```
  GET /products/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": {
        "id": 6,
        "name": "Túi",
        "price": "129000",
        "quantity": "4",
        "nameStore": "Cửa hàng hàng 2"
    }
}
```

#### API CREATE PRODUCT
```
  POST /products
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Name store |
| `store_id` | `integer` | **Required**. ID store |
| `price` | `integer` | **Required**. Price product |
| `quantity` | `integer` | **Required**. Quantity product |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": null
}
```
#### API UPDATE PRODUCT
```
  PUT /products/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` |  Name store |
| `store_id` | `integer` |  ID store |
| `price` | `integer` |  Price product |
| `quantity` | `integer` |  Quantity product |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": null
}
```

#### API DELETE PRODUCT
```
  DELETE /products/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |

Output

```
{
    "statusCode": 0,
    "messenge": "Thành công",
    "data": null
}
```
