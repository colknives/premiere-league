# View Player List

**URL** : `player/view/{player_id}`

**Method** : `GET`

## Success Response
**Code**: `200`

**Response**
```json
{
    "message": "[String]",
    "player": [
        {
            "player_id" : "Integer",
            "first_name" : "String",
            "second_name" : "String",
            "form" : "Integer",
            "total_points" : "Integer",
            "web_name" : "String",
            "photo" : "String",
            "statistics" : "Array"
        }
    ]
}
```

## 404 Error Response
**Code** : `404`

**Response**
```json
{
    "message" : "String"
}
```