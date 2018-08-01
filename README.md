# BE Test

Lumen is a lightweight version of Laravel. Less boilerplate to deal with.
Please refer to the [installation notes](https://lumen.laravel.com/docs/5.6/installation) to check Lumen's requirements.

  - `composer update`
  - `ln -s ./storage/app/public ./public/storage` (full path is needed)
  - `php -S localhost:8000 -t public` to start the dev server

# The challenge

### Description
Write an application which allows users to upload (and manage) multiple documents to an
application. Your application should handle the following use cases:
1. Upload an individual document
2. List previously uploaded documents
3. Delete a document

### Requirements
● Use a PHP web framework like Laravel. Note: If you're more comfortable with other
languages like Python, Ruby, Go, etc. you can use any equivalent framework if you're more
comfortable in that
● Use React for the front end
● Use common security practices to secure your application
● Assume there is no form of authentication or login, we don't expect you to build a user
management system or anything like that.
Nice to Have
● Use a state-management framework for React (such as Redux, Mobx, Relay, Vue, etc.)
● Use any additional technology/frameworks you'd think would help make this application
better
● Searchable Documents by name or type
● Use git and provide well-written git commit messages, as you would in any other application
● A docker container
