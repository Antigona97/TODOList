 <?php

 $router->get('', 'pageControllers@home');
 $router->get('today', 'taskControllers@displayTasks');
 $router->post('today', 'taskControllers@updateSortingAction');

 $router->get('calendar', 'pageControllers@calendar');
 $router->get('events', 'taskControllers@displayTasks');
 $router->post('event', 'taskControllers@createTasks');

 $router->get('profile', 'pageControllers@changeProfile');
 $router->post('profile', 'userController@ProfileAction');

 $router->post('searchTasks','taskControllers@displayTasks');
 $router->get('searchTasks', 'taskControllers@displayTasks');

 $router->get('openTask', 'pageControllers@openTask');
 $router->get('openTask', 'taskControllers@displayTasks');
 $router->post('updateTask', 'taskControllers@taskActions');

 $router->get('tasks', 'taskControllers@createTasks');
 $router->post('tasks', 'taskControllers@createTasks');

 $router->get('completedTasks', 'pageControllers@finished');
 $router->get('completedTasks', 'taskControllers@displayTasks');
 $router->post('completed', 'taskControllers@completedTasks');

 $router->get('allTasks', 'pageControllers@alltasks');
 $router->get('allTasks', 'taskControllers@displayTasks');
 $router->get('task', 'taskControllers@displayTasks');



 $router->post('account/login', 'userController@loginAction');

 $router->get('register', 'pageControllers@register');
 $router->post('account/register', 'userController@registerAction');

 $router->post('logout','userController@logoutAction');
 $router->get('logout', 'userController@logoutAction');