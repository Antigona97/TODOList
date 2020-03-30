 <?php

 $router->get('', 'pageControllers@home');
 $router->get('today', 'taskControllers@displayTasksAction');
 $router->post('today', 'taskControllers@updatePriorityAction');

 $router->get('thisweek', 'pageControllers@thisweek');
 $router->get('profile', 'pageControllers@changeProfile');
 $router->post('profile', 'userController@ProfileAction');

 $router->post('searchTasks','taskControllers@displayTasksAction');
 $router->get('searchTasks', 'taskControllers@displayTasksAction');

 $router->get('openTask', 'pageControllers@openTask');
 $router->get('openTask', 'taskControllers@displayTasksAction');

 $router->post('saveTask', 'taskControllers@updateTaskAction');

 $router->get('tasks', 'taskControllers@createTasks');
 $router->post('tasks', 'taskControllers@createTasks');

 $router->get('completedTasks', 'pageControllers@finished');
 $router->post('completedTasks', 'taskControllers@displayTasksAction');
 $router->post('completed', 'taskControllers@completedTasks');



 $router->post('account/login', 'userController@loginAction');

 $router->get('register', 'pageControllers@register');
 $router->post('account/register', 'userController@registerAction');

 $router->post('logout','userController@logoutAction');
 $router->get('logout', 'userController@logoutAction');