 <?php

 $router->get('', 'pageControllers@home');
 $router->get('today', 'pageControllers@todayTasks');
 $router->get('todayTasks', 'taskControllers@todayTasks');

 $router->get('thisweek', 'pageControllers@thisweek');
 $router->get('profile', 'pageControllers@changeProfile');
 $router->post('profile', 'userController@ProfileAction');

 $router->post('searchTasks','taskControllers@displayTasks');
 $router->get('searchTasks', 'pageControllers@todayTasks');

 $router->get('tasks', 'pageControllers@todayTasks');
 $router->post('tasks', 'taskControllers@insertTasks');

 $router->post('completed', 'taskControllers@completedTasks');
 $router->get('completed','taskControllers@completedTasks');

 $router->post('account/login', 'userController@loginAction');

 $router->get('register', 'pageControllers@register');
 $router->post('account/register', 'userController@registerAction');