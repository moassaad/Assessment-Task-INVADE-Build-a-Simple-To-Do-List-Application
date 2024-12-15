# Assessment Task: Build a Simple To-Do List Application

## About Task

Build a simple to do list application objective.

## Get Started
### Requirements
- PHP version >= 8.1.
- Apache server to run MySQL.
- Composer to install packages.
- Postman or another program to test api end point.
- Git 
### Install project
Download project and open cli or terminal and run commands.

Install packages
```sh
composer install
```
### Setup database
1. create database with same name `DATABASE_NAME` in `.env` file.
2. create tables.
```sh
php artisan migrate:fresh
```
3. fill fake date to test.
```sh
php artisan db:seed
```
### Run project
1. run this command in cli or terminal.
```sh
php artisan serve
```
2. after running you can see the `URL` like `[http://127.0.0.1:8000]` open it with browser.
### Use existing mail
You can use email and password by default:
- Email: max@mail.com
- Password: password

Or you can register new one.



## RESTFul API end point

- {url}: *like* >>> "http://localhost:8000/api/"
- {token}: *like* >>> "1|2mviL1SU8apACwcjJZwaifrFbp7bMC2yEljeDbuF86a7c501"
### Auth
#### Login
___
```
POST: /login 
```
- Parameter
```json
{
  "email":"max@mail.com",
  "password":"password"
}
```
#### Register
___
```
POST: /register 
```
- Parameter
```json
{
  "name":"Min",
  "email":"min@mail.com",
  "password":"password"
}
```
### User
#### Show Profile User
___
```
POST: /profile 
```
#### Logout User
___
```
GET: /logout 
```
### Task
#### List Of Task
___
```
GET: /task 
```
#### Create New Task
___
```
POST: /task 
```
```json
{
  "title":"title",
  "description":"description",
  "status":"ok",
  "due_date":"2024-12-17",
  "catigory":"UTjKbYuL1C"
}
```
#### Update Task
___
```
PUT: /task/{task_id}
```
```json
{
  "title":"title",
  "description":"description",
  "status":"ok",
  "due_date":"2024-12-17",
  "catigory":"UTjKbYuL1C"
}
```
#### Delete Task
___
```
DELETE: /task/{task_id}
```
#### Completion Task
___
```
PATCH: /task/completion/{task}
```
#### Today Task
___
```
GET: /task/today
```
#### Filter With Catigory
___
```
GET: /task/filter/catigory/{catigory_id}
```
#### Filter With Completion
___
```
GET: /task/filter/completion/{status}
```
```
status = 'completed';
status = 'pending';
```
### Catigory
#### Catigory List
___
```
GET: /catigory 
```
#### Create New Catigory
___
```
POST: /catigory 
```
```json
{
  "catigory_name":"catigory name",
  "color":"red"
}
```
#### Update Catigory
___
```
PUT: /catigory/{catigory_id}
```
```json
{
  "catigory_name":"catigory name",
  "color":"black"
}
```
#### Delete Catigory
___
```
DELETE: /catigory/{catigory_id}
```

## Features
1. Login and logout user account , you can create new one.
2. Management catigories (add and edit and soft delete).
3. Each catigory has a color that is determined upon creation to distinguish it , and you can edit it.
4. You can create task and input description and due date and select catigory.
5. Show list today task.
6. Filter task with catigory.
7. You can create, edit, delete, and filter task from one page.
8. Each user has a one or many catigory or task.
9. Filter task with completion.

## License
[MIT license](https://opensource.org/licenses/MIT).
