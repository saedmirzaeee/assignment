## Take Home Assignment

- In this project I implemented a tiny API for Leaderboard Application. 

- I used the latest **Laravel** Framework for Backend and **MySQL** as Database.

- There is no dedicated webserver like **NGINX** in this project. If we want to deploy the application in real world we have to use
a dedicated web server.

These are the main routes for implementing this API:


This endpoint list all the users in the system.

- /api/v1/users [GET](http://34.228.79.89/api/v1/users)

This endpoint is used to create new "User" based on input. First the input is validated and new user will be created and passed to the user as response afterward. This list is ordered based on "points" attribute descending.

- /api/v1/users/ POST

This endpoint is used to fetch detail "User" information.

- /api/v1/users/{userId} [GET](http://34.228.79.89/api/v1/users)

This endpoint is used to update the User with the corresponding {userId}. If we push the + or - button the User will be updated using this endpoint. The "point" attribute can be increased or decreased only by 1.

- /api/v1/users/{userId} PUT

This is endpoint is used to delete the User with corresponding {userId}

- /api/v1/users/{userId} DELETE

It is obvious that we should add Authentication and Authorization capability in real world deployment.

The response format contains 'data' and 'error' attribute. If the response is successful the 'error' is empty and the 'data' is the response body, otherwise the 'error' contains the problem.

I also develop some sample unit test to test these endpoints. 
you can run the test using "php artisan test".

You can see the deployed API on this [link.](http://34.228.79.89/) 
