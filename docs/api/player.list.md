# Get Player List

**URL** : `player/list`

**Method** : `GET`

## Success Response
**Code**: `200`

**Response**
```json
{
    "message": "[String]",
    "list": [
        {
            "player_id" : "Integer",
            "full_name" : "String"
        }
    ],
    "pagination": [
        {
            "total" : "Integer",
            "per_page" : "Integer",
            "current_page" : "Integer",
            "last_page" : "Integer",
            "next_page_url" : "String",
            "prev_page_url" : "String",
            "last_page_url" : "String",
            "from" : "Integer",
            "to" : "Integer"
        }
    ]
}
```