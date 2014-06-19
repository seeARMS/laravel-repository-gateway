Laravel Repository / Gateway Design Pattern
==========================

This is an implementation of the [repository / gateway design pattern](http://msdn.microsoft.com/en-us/library/ff649690.aspx) for Laravel 4.

###Overview

Repositories acts as an interface to your database layer by sitting in front of your models and performing CRUD operations. Repositories **only** communicate with your database. Gateways, on the other hand, contain all the business logic within your application. Gateways **only** communicate with as many repositories as required for the operation at hand. Your controllers simply act as an additional layer, bridging your views with your gateways.

###Benefits 
 * Improve maintainability and readability by keeping business logic and domain-specific logic separate (achieves a very clear separation of concerns) 
 * Allows for easier unit testing - in the case of Laravel, Mockery can be used to inject mock dependencies (such as mocking the database when testing the gateway)
 * Enables you to change databases very easily, since the only thing talking to the database is the repositories (meaning you won't have to search through an entire codebase for database references)
 
Read more about the benefits of using this design pattern within laravel [here](ryantablada.com/post/two-design-patterns-that-will-make-your-applications-better).