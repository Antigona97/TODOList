 <?php

 $router->get('', 'pageControllers@home');
 $router->get('today', 'taskControllers@displayTasksAction');
 $router->post('today', 'taskControllers@updateSortingAction');

 $router->get('calendar', 'pageControllers@calendar');
 $router->get('events', 'taskControllers@events');

 $router->get('profile', 'pageControllers@changeProfile');
 $router->post('profile', 'userController@ProfileAction');

 $router->post('searchTasks','taskControllers@displayTasksAction');
 $router->get('searchTasks', 'taskControllers@displayTasksAction');

 $router->get('openTask', 'pageControllers@openTask');
 $router->get('openTask', 'taskControllers@displayTasksAction');
 $router->post('updateTask', 'taskControllers@taskActions');

 $router->get('tasks', 'taskControllers@createTasks');
 $router->post('tasks', 'taskControllers@createTasks');

 $router->get('completedTasks', 'pageControllers@finished');
 $router->get('completedTasks', 'taskControllers@tasks');
 $router->post('completed', 'taskControllers@completedTasks');

 $router->get('allTasks', 'pageControllers@alltasks');
 $router->get('allTasks', 'taskControllers@tasks');
 $router->get('task', 'taskControllers@displayTasksAction');


 $router->post('account/login', 'userController@loginAction');

 $router->get('register', 'pageControllers@register');
 $router->post('account/register', 'userController@registerAction');

 $router->post('logout','userController@logoutAction');
 $router->get('logout', 'userController@logoutAction');