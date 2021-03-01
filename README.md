# About

VacancyDiary is a service that provides API

## Installation

Use the package manager [pip](https://pip.pypa.io/en/stable/) to install foobar.

```bash
pip install foobar
```

# API

## Register
**You send**: Your register credentials. **You get**: An instance of created user and API-Token with wich you can make further actions.
#### Request
POST /register/

{  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Lychman",  
&nbsp;&nbsp;&nbsp;&nbsp;"email": "lychmanit@gmail.com",  
&nbsp;&nbsp;&nbsp;&nbsp;"password": "qwerty12345"   
}
#### Response
{  
"user":
{    
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Lychman",  
&nbsp;&nbsp;&nbsp;&nbsp;"email": "lychmanit@gmail.com",  
&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-03-01T04:34:20.000000Z",  
&nbsp;&nbsp;&nbsp;&nbsp;"created_at": "2021-03-01T04:34:20.000000Z",  
&nbsp;&nbsp;&nbsp;&nbsp;"id": 16  
},  
&nbsp;&nbsp;&nbsp;&nbsp;"access_token": "token"  
}
## Login
**You send**: Your *email* and *password*. **You get**: An instance of authenticated user and API-Token with wich you can make further actions.
#### Request

POST /login/

{  
&nbsp;&nbsp;&nbsp;&nbsp;"email": "lychmanit@gmail.com",  
&nbsp;&nbsp;&nbsp;&nbsp;"password": "qwerty12345"   
}
#### Response
{  
"user":
{    
&nbsp;&nbsp;&nbsp;&nbsp;"id": 16  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Lychman",  
&nbsp;&nbsp;&nbsp;&nbsp;"email": "lychmanit@gmail.com",  
&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-03-01T04:34:20.000000Z",  
&nbsp;&nbsp;&nbsp;&nbsp;"created_at": "2021-03-01T04:34:20.000000Z",
},  
&nbsp;&nbsp;&nbsp;&nbsp;"access_token": "token"  
}
## User info
**You get**: An instance of user, authenticated by API-Token.
#### Request

GET /user/

#### Response
{  
&nbsp;&nbsp;&nbsp;&nbsp;"id": 16  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Lychman",  
&nbsp;&nbsp;&nbsp;&nbsp;"email": "lychmanit@gmail.com",  
&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-03-01T04:34:20.000000Z",  
&nbsp;&nbsp;&nbsp;&nbsp;"created_at": "2021-03-01T04:34:20.000000Z",  
}

## Delete user
**You get**: Removes user, authenticated by API-Token.
#### Request

GET /delete_user/

#### Response

21421421

## Vacancy show
**You get**: Vacancy instance by id.
#### Request

GET /{user_id}/vacancy/{vacancy_id}

#### Response
{  
"vacancy": {  
&nbsp;&nbsp;&nbsp;&nbsp;"id": 3,  
&nbsp;&nbsp;&nbsp;&nbsp;"user_id": 1,  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Connelly, Abshire and Windler",  
&nbsp;&nbsp;&nbsp;&nbsp;"position": "Engineering",  
&nbsp;&nbsp;&nbsp;&nbsp;"salary": "2476",  
&nbsp;&nbsp;&nbsp;&nbsp;"link": "https://labadie and sons/",  
&nbsp;&nbsp;&nbsp;&nbsp;"contacts": "sadie31@king.info",  
&nbsp;&nbsp;&nbsp;&nbsp;"status": "Technical review",  
&nbsp;&nbsp;&nbsp;&nbsp;"status_last_update": "2021-03-01 06:01:05",  
&nbsp;&nbsp;&nbsp;&nbsp;"notes": "Dolor ea eum mollitia officiis et nihil. Dolorum dignissimos ut voluptatum blanditiis. Corporis aut vero est mollitia iusto. Porro quaerat possimus optio aut dolore qui et.",  
&nbsp;&nbsp;&nbsp;&nbsp;"created_at": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": null  
},  
"message": "Retrieved successfully"  
}

## Vacancies list
**You get**: Vacancies list user, authenticated by API-Token. The responce is paginated by 5.
#### Request

GET /{user_id}/vacancy?page=2

#### Response
{
"vacancy": [
{
"id": 6,
}
{
"id": 7,
}
{
"id": 8,
}
{
"id": 9,
}
{
"id": 10,
}
}
## Create vacancy
**You send**: vacancy fields (name, position, contacts and status are required). **You get**: JSON of stored vacancy
#### Request
POST /{user_id}/vacancy/

{  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Company",  
&nbsp;&nbsp;&nbsp;&nbsp;"position": "Developer",  
&nbsp;&nbsp;&nbsp;&nbsp;"contacts": "contacts@gmail.com",
&nbsp;&nbsp;&nbsp;&nbsp;"status": "TECH_REVIEW"   
}
#### Response
{  
"vacancy": {  
&nbsp;&nbsp;&nbsp;&nbsp;"id": 1,  
&nbsp;&nbsp;&nbsp;&nbsp;"user_id": 1,  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Company",  
&nbsp;&nbsp;&nbsp;&nbsp;"position": "Developer",  
&nbsp;&nbsp;&nbsp;&nbsp;"salary": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"link": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"contacts": "contacts@gmail.com",  
&nbsp;&nbsp;&nbsp;&nbsp;"status": "Technical review",  
&nbsp;&nbsp;&nbsp;&nbsp;"status_last_update": "2021-03-01 06:01:05",  
&nbsp;&nbsp;&nbsp;&nbsp;"notes": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"created_at": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-03-01T05:51:17.000000Z"  
&nbsp;&nbsp;&nbsp;&nbsp;"id": 249  
},  
"message": "Created successfully"  
}
## Update vacancy
**You send**: new vacancy fields(each field is overwritten) **You get**: JSON of saved vacancy
#### Request
PUT /{user_id}/vacancy/{vacancy_id}

{  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Company",  
&nbsp;&nbsp;&nbsp;&nbsp;"position": "Developer",  
&nbsp;&nbsp;&nbsp;&nbsp;"contacts": "contacts@gmail.com",
&nbsp;&nbsp;&nbsp;&nbsp;"status": "TECH_REVIEW"   
}
#### Response
{  
"vacancy": {  
&nbsp;&nbsp;&nbsp;&nbsp;"id": 1,  
&nbsp;&nbsp;&nbsp;&nbsp;"user_id": 1,  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Company",  
&nbsp;&nbsp;&nbsp;&nbsp;"position": "Developer",  
&nbsp;&nbsp;&nbsp;&nbsp;"salary": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"link": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"contacts": "contacts@gmail.com",  
&nbsp;&nbsp;&nbsp;&nbsp;"status": "Technical review",  
&nbsp;&nbsp;&nbsp;&nbsp;"status_last_update": "2021-03-01 06:01:05",  
&nbsp;&nbsp;&nbsp;&nbsp;"notes": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"created_at": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": "2021-03-01T05:51:17.000000Z"  
},  
"message": "Updated successfully"  
}

## Search vacancy
**You send**: *status code* and *company name* **You get**: founded results
#### Request
POST /search?status={status_code}&search={company_name}

#### Response
{  
"vacancy": [   
{  
&nbsp;&nbsp;&nbsp;&nbsp;"id": 3,  
&nbsp;&nbsp;&nbsp;&nbsp;"user_id": 1,  
&nbsp;&nbsp;&nbsp;&nbsp;"name": "Connelly, Abshire and Windler",  
&nbsp;&nbsp;&nbsp;&nbsp;"position": "Engineering",  
&nbsp;&nbsp;&nbsp;&nbsp;"salary": "2476",  
&nbsp;&nbsp;&nbsp;&nbsp;"link": "https://labadie and sons/",  
&nbsp;&nbsp;&nbsp;&nbsp;"contacts": "sadie31@king.info",  
&nbsp;&nbsp;&nbsp;&nbsp;"status": "Technical review",  
&nbsp;&nbsp;&nbsp;&nbsp;"status_last_update": "2021-03-01 06:01:05",    
&nbsp;&nbsp;&nbsp;&nbsp;"notes": "Dolor ea eum mollitia officiis et nihil. Dolorum dignissimos ut voluptatum blanditiis. Corporis aut vero est mollitia iusto. Porro quaerat possimus optio aut dolore qui et.",  
&nbsp;&nbsp;&nbsp;&nbsp;"created_at": null,  
&nbsp;&nbsp;&nbsp;&nbsp;"updated_at": null  
}  
],  
"message": "Vacancies founded successfully"  
}  

## Send mail
**You get**: send email via SMTP to the vacancy contact if status is "No response" and a week was passed from the last status update.
#### Request

GET /{user_id}/vacancy/{vacancy_id}/sendMail

#### Response

{
"message": "Mail sended"
}


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
