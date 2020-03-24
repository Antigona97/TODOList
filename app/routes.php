 <?php

 $router->get('', 'pageControllers@home');
 $router->get('today', 'pageControllers@todayTasks');
 $router->get('today', 'taskControllers@displayTasksAction');

 $router->get('thisweek', 'pageControllers@thisweek');
 $router->get('profile', 'pageControllers@changeProfile');
 $router->post('profile', 'userController@ProfileAction');

 $router->post('searchTasks','taskControllers@display');
 $router->get('searchTasks', 'pageControllers@todayTasks');

 $router->get('openTask', 'pageControllers@openTask');

 $router->post('saveTask', 'taskControllers@updateTaskAction');

 $router->get('tasks', 'taskControllers@createTasks');
 $router->post('tasks', 'taskControllers@createTasks');

 $router->post('completed', 'taskControllers@completedTasks');
 $router->get('completed','taskControllers@completedTasks');



 $router->post('account/login', 'userController@loginAction');

 $router->get('register', 'pageControllers@register');
 $router->post('account/register', 'userController@registerAction');

 $router->post('logout','userController@logoutAction');
 $router->get('logout', 'userController@logoutAction');