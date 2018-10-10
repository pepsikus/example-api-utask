# API Specifications

- [Users endpoints](#users)
- [Tasks endpoints](#tasks)

## Users

### Get User list

`GET /api/users`

No parameters required

Additional options: `page`

Returns: code 200, JSON (example)
```JSON
{
    "data": [
        {
            "id": 1,
            "first_name": "Nickolas",
            "last_name": "Mante",
            "email": "alessia.yundt@example.net"
        },
        {
            "id": 2,
            "first_name": "Buster",
            "last_name": "McGlynn",
            "email": "lilliana34@example.com"
        },
        {
            "id": 3,
            "first_name": "Misty",
            "last_name": "Jast",
            "email": "gerhold.haven@example.org"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/users?page=1",
        "last": "http://localhost:8000/api/users?page=6",
        "prev": null,
        "next": "http://localhost:8000/api/users?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 6,
        "path": "http://localhost:8000/api/users",
        "per_page": 3,
        "to": 3,
        "total": 16
    }
}
```

### Create User

`POST /api/users`

Required fields: `first_name`, `last_name`, `email`, `password`

Example request body:
```JSON
{
    "first_name": "Mikle",
    "last_name": "Jackson",
    "email": "mjackson@site.com",
    "password": "secret"
}
```

Returns: code 201, JSON (example)
```JSON
{
    "data": {
        "id": 1,
        "first_name": "Mikle",
        "last_name": "Jackson",
        "email": "mjackson@site.com"
    }
}
```

### Update User

`PUT /api/users/{user}`

Optional fields: `first_name`, `last_name`

Example request body:
```JSON
{
    "first_name": "Mikle Jr",
}
```

Returns: code 200, JSON (example)
```JSON
{
    "data": {
        "id": 1,
        "first_name": "Mikle Jr",
        "last_name": "Jackson",
        "email": "mjackson@site.com"
    }
}
```

### Delete User

`DELETE /api/users/{user}`

No parameters required

Returns: code 204


### Verify User email

`PUT /api/users/{user}/verify_email`

No parameters required

Returns: code 200, JSON (example)
```JSON
{
    "data": {
        "id": 1,
        "first_name": "Mikle Jr",
        "last_name": "Jackson",
        "email": "mjackson@site.com"
    }
}
```

### Get User tasks

`GET /api/users/{user}/tasks`

No parameters required

Returns: code 200, JSON (example)
```JSON
{
    "data": [
        {
            "id": 7,
            "name": "Fuga nam rerum consequatur quidem eos.",
            "description": "Dormouse. 'Don't talk nonsense,' said Alice in a low, trembling voice. 'There's more evidence to come yet, please your Majesty,' the Hatter with a trumpet in one hand, and made a snatch in the.",
            "completed_at": null,
            "user_id": 3
        },
        {
            "id": 8,
            "name": "Sequi non sit atque suscipit deleniti aut.",
            "description": "William and offer him the crown. William's conduct at first she would keep, through all her fancy, that: they never executes nobody, you know. Which shall sing?' 'Oh, YOU sing,' said the others. 'We.",
            "completed_at": null,
            "user_id": 3
        },
        {
            "id": 9,
            "name": "Qui animi ut earum non.",
            "description": "This of course, Alice could only see her. She is such a neck as that! No, no! You're a serpent; and there's no use in crying like that!' said Alice desperately: 'he's perfectly idiotic!' And she.",
            "completed_at": null,
            "user_id": 3
        }
    ]
}
```


## Tasks

### Get Task list

`GET /api/tasks`

No parameters required

Additional options: `page`

Returns: code 200, JSON (example)
```JSON
{
    "data": [
        {
            "id": 1,
            "name": "Expedita labore vero inventore ducimus.",
            "description": "Gryphon. 'Well, I should be raving mad after all! I almost wish I'd gone to see that the hedgehog a blow with its tongue hanging out of a bottle. They all returned from him to you, Though they were.",
            "completed_at": null,
            "user": {
                "id": 1,
                "first_name": "Nickolas",
                "last_name": "Mante",
                "email": "alessia.yundt@example.net"
            }
        },
        {
            "id": 2,
            "name": "Doloribus vel perferendis aut natus enim deleniti.",
            "description": "Alice, 'when one wasn't always growing larger and smaller, and being ordered about in all my life!' Just as she went on talking: 'Dear, dear! How queer everything is queer to-day.' Just then she.",
            "completed_at": null,
            "user": {
                "id": 1,
                "first_name": "Nickolas",
                "last_name": "Mante",
                "email": "alessia.yundt@example.net"
            }
        },
        {
            "id": 3,
            "name": "Hic harum deleniti ea voluptatibus libero maxime.",
            "description": "Alice looked all round the court was a treacle-well.' 'There's no sort of thing that would happen: '\"Miss Alice! Come here directly, and get ready for your interesting story,' but she did not like.",
            "completed_at": null,
            "user": {
                "id": 1,
                "first_name": "Nickolas",
                "last_name": "Mante",
                "email": "alessia.yundt@example.net"
            }
        },
        {
            "id": 4,
            "name": "Eligendi enim expedita debitis sit unde.",
            "description": "Alice replied, so eagerly that the Queen of Hearts, carrying the King's crown on a branch of a treacle-well--eh, stupid?' 'But they were mine before. If I or she should chance to be lost, as she.",
            "completed_at": null,
            "user": {
                "id": 2,
                "first_name": "Buster",
                "last_name": "McGlynn",
                "email": "lilliana34@example.com"
            }
        },
        {
            "id": 5,
            "name": "Ipsum repudiandae totam incidunt sit vel accusamus eos.",
            "description": "Queen till she was now only ten inches high, and her face like the tone of delight, which changed into alarm in another moment that it was empty: she did not dare to laugh; and, as she could not.",
            "completed_at": null,
            "user": {
                "id": 2,
                "first_name": "Buster",
                "last_name": "McGlynn",
                "email": "lilliana34@example.com"
            }
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/tasks?page=1",
        "last": "http://localhost:8000/api/tasks?page=3",
        "prev": null,
        "next": "http://localhost:8000/api/tasks?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 3,
        "path": "http://localhost:8000/api/tasks",
        "per_page": 5,
        "to": 5,
        "total": 15
    }
}
```

### Create Task

`POST /api/task`

Required fields: `name`, `desription`, `user_id`

Example request body:
```JSON
{
    "name": "My first task",
    "description": "Where is API Documentation?",
    "user_id": 1
}
```

Returns: code 201, JSON (example)
```JSON
{
    "data": {
        "id": 16,
        "name": "My first task",
        "description": "Where is API Documentation?",
        "completed_at": null,
        "user_id": 1
    }
}
```

### Update Task

`PUT /api/tasks/{task}`

Optional fields: `name`, `description`

Example request body:
```JSON
{
    "description": "Where is API Documentation? - I don't know, sorry."
}
```

Returns: code 200, JSON (example)
```JSON
{
    "data": {
        "id": 16,
        "name": "My first tasks",
        "description": "Where is API Documentation? - I don't know, sorry.",
        "completed_at": null,
        "user_id": 1
    }
}
```

### Delete Task

`DELETE /api/tasks/{task}`

No parameters required

Returns: code 204


### Complete task

`PUT /api/tasks/{task}/complete`

No parameters required

Returns: code 200, JSON (example)
```JSON
{
    "data": {
        "id": 16,
        "name": "My first tasks",
        "description": "Where is API Documentation? - I don't know, sorry.",
        "completed_at": "2018-10-10 09:39:41",
        "user_id": 1
    }
}```


## Errors

Possible error messages

code 404
```JSON
{
    "error": "Resource not found"
}
```

code 405
```JSON
{
    "error": "Method not allowed"
}
```

Example request when errors will be returned 

`POST /api/tasks` without any parameters in body request

code 422
```JSON
{
    "message": "The given data was invalid.",
    "errors": {
        "user_id": [
            "The user id field is required."
        ],
        "name": [
            "The name field is required."
        ],
        "description": [
            "The description field is required."
        ]
    }
}
```
