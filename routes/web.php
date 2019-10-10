<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

//Ucitel
Route::get('/ucitel', 'TeacherController@index')->name('teacher');

//Ziak - docasne
Route::get('/ziak', function () {
    return view('user-student.index');
});

//Tasks
Route::get('/tasks/mytasks', 'TaskController@mytasks')->name('tasks.my');
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create');
Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::get('/tasks/{task}', 'TaskController@show')->name('tasks.show');
Route::get('/tasks/{task}/edit', 'TaskController@edit')->name('tasks.edit');
Route::get('/tasks/{task}/destroy', 'TaskController@destroy')->name('tasks.destroy');
Route::post('/tasks/filter', 'TaskController@filter')->name('tasks.filter');
Route::post('/tasks/resetfilter', 'TaskController@resetFilter')->name('tasks.resetfilter');
Route::post('/tasks/store', 'TaskController@store')->name('tasks.store');
Route::post('/tasks/{task}/update', 'TaskController@update')->name('tasks.update');

//Students
Route::get('/students', 'StudentController@index')->name('student');
Route::get('/students/create', 'StudentController@create')->name('student.create');
Route::get('/students/import', 'StudentController@import')->name('student.import');
Route::get('/students/pdf/{group?}', 'StudentController@generatePDF')->name('student.pdf');
Route::get('/students/{student}', 'StudentController@show')->name('student.show');
Route::get('/students/{student}/edit', 'StudentController@edit')->name('student.edit');
Route::post('/students/store', 'StudentController@store')->name('student.store');
Route::post('/students/multistore', 'StudentController@multiStore')->name('student.multistore');
Route::post('/students/multiaddgroup', 'StudentController@multiAddToGroup')->name('student.maddgroup');
Route::post('/students/multidestroy', 'StudentController@multiDestroy')->name('student.multidestroy');
Route::post('/students/{student}/destroy', 'StudentController@destroy')->name('student.destroy');
Route::post('/students/{student}/update', 'StudentController@update')->name('student.update');
Route::post('/students/{student}/addgroup', 'StudentController@addToGroup')->name('student.addgroup');
Route::post('/students/{student}/removegroup', 'StudentController@removeFromGroup')->name('student.removegroup');

//Groups
Route::get('/groups', 'GroupController@index')->name('group');
Route::get('/groups/create', 'GroupController@create')->name('group.create');
Route::get('/groups/{group}', 'GroupController@show')->name('group.show');
Route::get('/groups/{group}/edit','GroupController@edit')->name('group.edit');
Route::post('/groups/store', 'GroupController@store')->name('group.store');
Route::post('/groups/{group}/destroy', 'GroupController@destroy')->name('group.destroy');
Route::post('/groups/{group}/update', 'GroupController@update')->name('group.update');
Route::post('/groups/{group}/addstudents', 'GroupController@addStudents')->name('group.addstudents');
Route::post('/groups/{group}/removestudents', 'GroupController@removeStudents')->name('group.removestudents');
Route::post('/groups/{group}/removestudent/{student}', 'GroupController@removeStudent')->name('group.removestudent');

//Test
Route::get('/tests', 'TestController@index')->name('test');
Route::get('/tests/create', 'TestController@create')->name('test.create');
Route::get('/tests/{test}/edit','TestController@edit')->name('test.edit');
Route::get('/tests/{test}', 'TestController@show')->name('test.show');
Route::post('/tests/store', 'TestController@store')->name('test.store');
Route::post('/tests/{test}/selecttasks', 'TestController@selectTasks')->name('test.selecttasks');
Route::post('/tests/addtasks', 'TestController@addTasks')->name('test.addtasks');
Route::post('/tests/{test}/destroy', 'TestController@destroy')->name('test.destroy');
Route::post('/tests/{test}/storetasks', 'TestController@storeTasks')->name('test.storetasks');
Route::post('/tests/{test}/removetasks', 'TestController@removeTasks')->name('test.removetasks');
Route::post('/tests/{test}/update', 'TestController@update')->name('test.update');

//Assignments
Route::get('/assignment/create/{test?}/{group?}', 'AssignmentController@create')->name('assignment.create');
Route::get('/assignment/edit/{assignment}', 'AssignmentController@edit')->name('assignment.edit');
Route::post('/assignment/store', 'AssignmentController@store')->name('assignment.store');
Route::post('/assignment/update/{assignment}', 'AssignmentController@update')->name('assignment.update');
Route::post('/assignment/destroy/{assignment}', 'AssignmentController@destroy')->name('assignment.destroy');