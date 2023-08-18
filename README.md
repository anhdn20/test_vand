# APPLICATION MANAGE STORES AND PRODUCTS

Help users manage their stores and products in stores

Design the following API endpoints to handle authentication, store management, and product management:

- Authentication Endpoints:

    - `/api/auth/login` (POST): Logs in the user by checking the provided credentials.
    - `/api/auth/logout` (POST): Logs out the currently authenticated user.
- Store Endpoints:

    - `/api/stores` (GET): Retrieves a list of all stores.
    - `/api/stores/{id}` (GET): Retrieves details of a specific store.
    - `/api/stores` (POST): Creates a new store.
    - `/api/stores/{id}` (PUT): Updates details of a specific store.
    - `/api/stores/{id}` (DELETE): Deletes a specific store.
- Product Endpoints:

    - `/api/products` (GET): Retrieves a list of all products.
    - `/api/products/{id}` (GET): Retrieves details of a specific product.
    - `/api/products` (POST): Creates a new product.
    - `/api/products/{id}` (PUT): Updates details of a specific product.
    - `/api/products/{id}` (DELETE): Deletes a specific product.

## API Detail

### AUTH

API authenticate Users

#### API LOGIN
```
  POST /login : Logs in the user by checking the provided credentials.
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
  POST /logout : Logs out the currently authenticated user.
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
  GET /stores : Retrieves a list of all stores.
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
  GET /stores/{id} : Retrieves details of a specific store.
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
  POST /stores : Creates a new store.
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
  PUT /stores/{id} : Updates details of a specific store.
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
  DELETE /stores/{id} : Deletes a specific store.
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
  GET /products : Retrieves a list of all products.
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
  GET /products/{id} : Retrieves details of a specific product.
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
  POST /products : Creates a new product.
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
  PUT /products/{id} : Updates details of a specific product.
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
  DELETE /products/{id} : Deletes a specific product.
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
