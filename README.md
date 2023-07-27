# Laravel UI Blog
Virtual Internship Experience (Investree) - Fullstack - Effel Zefanya Shuban

This is a project created to solve the 5th task of Investree's Fullstack Developer Virtual Internship Experience (VIX). Created by Effel Zefanya as his final project of the internship.

## Table of Contents
- [Overview](#overview)
- [My Process](#my-process)
    - [Built With](#built-with)
    - [What I Learned](#what-i-learned)
    - [Challenge I Encountered](#challenges-i-encountered)

## Overveiw
Goal: To be able to implement Blade features and Laravel UI into the project.

## Process
- Create authentication with Laravel UI and Bootstrap
- Create model for Articles and Categories, along with their corresponding factories, Migrations and Seeders
- Set eloquent relations for models
- Use Laravel Blade Template and Bootstrap for front-end pages
- Create a functional CRUD for Articles and categories, along with the ability to read one article at a time and data input validation
- Create unit testings to test CRUD Pages and Features

### Built with
- PHP
- Laravel
- Laravel UI
- Bootstrap
- XAMPP's myPHPadmin

### What I learned
- PHPUnit can be used to test web's features and page accesibility
- Laravel UI can be used to create authentication feature, boosting project progress
- Laravel blade is a versatile engine that can be used to integrate HTML, CSS and PHP. Creating an easier experience to connect web's back-end to web's front-end
- Eloquent relations can be utilized to connect models. Creating a connected relations between models that can be used to access data from another table easier.

### Challenges I encountered
- Foreign keys constraints in database made it hard to do unit testing since my category table is unable to detect the user. Even though the user has been created before and authenticated by the web.
