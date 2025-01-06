# Light-it Patient Registration App

---

## **Installation**

### **Requirements**

Before starting, ensure you have the following installed on your system:

- **Docker** 
- **Docker Compose** 
- **Make** (optional, for using the provided `make` commands)

---

### **Setup Steps**

1. **Clone the repository in your favorite directory and**
```bash
   cd light-it-challenge/laravel-app/
```

3. Copy `.env.template` file content into a new `.env` file and set DB , QUEUE and MAIL (or specify own mailtrap account) env vars as follow: 

```enviroment
DB_CONNECTION=mysql
DB_HOST=mysql_db 
DB_PORT=3306
DB_DATABASE=db   
DB_USERNAME=root
DB_PASSWORD=root

MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=25
MAIL_USERNAME=fb5f5fdc3ffc70
MAIL_PASSWORD=d34eba51e070a2

QUEUE_CONNECTION=database
```
4. Change permissions for logging (surely there is a better way)
```bash
sudo chmod -R 777 storage
```

5. Use the make commands to build the containers, run migrations and init the app:
```bash
make setup && make data
```
6. Go to http://localhost:9000 and just register yourself!



## API Documentation

## Register a new patient

### Endpoint
`POST /api/patients`

### Description
This endpoint is used to create a new patient record.

### Headers
| Key             | Value                        | Required | Description                     |
|------------------|------------------------------|----------|---------------------------------|
| `Content-Type`   | `multipart/form-data`        | Yes      | Specifies the content type      |


### Request Parameters
| Parameter          | Type        | Required | Description                     |
|---------------------|-------------|----------|---------------------------------|
| `name`             | `string`    | Yes      | Full name of the patient        |
| `email`            | `string`    | Yes      | Email address of the patient    |
| `phone`            | `string`    | Yes      | Phone number of the patient     |
| `document_photo`   | `file`      | Yes      | Upload a document as a photo    |

