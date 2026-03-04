<?php

use Illuminate\Support\Facades\Route;

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

Route::get('admin', 'IndexController@index')->name('login'); // for redirection purpose
Route::name('admin.')->group(
    function () {

    	Route::get('/', 'IndexController@index');

        # to show login form
        Route::get('/auth/login', [
            'uses'  => 'Auth\LoginController@showLoginForm',
            'as'    => 'auth.login'
        ]);

        # login form submits to this route
        Route::post('/auth/login', [
            'uses'  => 'Auth\LoginController@login',
            'as'    => 'auth.login'
        ]);

        # logs out admin user
        # it was post method before I recieved MethodNotAllowedHttpException
        Route::any('/auth/logout', [
            'uses'  => 'Auth\LoginController@logout',
            'as'    => 'auth.logout'
        ]);

        # Password reset routes
        Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

        # shows dashboard
        Route::get('dashboard', [
            'uses'  => 'DashboardController@index',
            'as'    => 'dashboard.index'
        ]);

        Route::get('crm', 'DashboardController@crm')->name('crm');
        Route::get('forms', 'DashboardController@forms')->name('forms');

        Route::get('update-profile', 'AdministratorsController@editProfile')->name('update-profile');
        Route::resource('administrators', 'AdministratorsController');
        Route::resource('site-settings', 'SiteSettingsController');
        Route::get('quiz-settings', 'SiteSettingsController@quizSettings')->name('quiz-settings.index');
        Route::put('quiz-settings/{id}', 'SiteSettingsController@updateQuizSettings')->name('quiz-settings.update');
        Route::resource('users', 'UsersController');
        Route::get('categories/reports', 'CategoriesController@reports')->name('categories.reports.all');
        Route::get('categories/{id}/reports', 'CategoriesController@reports')->name('categories.reports');
        Route::resource('categories', 'CategoriesController');
        
        // Quiz Management
        Route::post('quizzes/bulk-action', 'QuizController@bulkAction')->name('quizzes.bulk-action');
        Route::post('quizzes/{quiz}/publish', 'QuizController@publish')->name('quizzes.publish');
        Route::post('quizzes/{quiz}/archive', 'QuizController@archive')->name('quizzes.archive');
        Route::resource('quizzes', 'QuizController');
        
        // Question Bank Management
        Route::get('questions/download-template', 'QuestionsController@downloadTemplate')->name('questions.download-template');
        Route::post('questions/import', 'QuestionsController@import')->name('questions.import');
        Route::post('questions/{question}/quick-update', 'QuestionsController@quickUpdate')->name('questions.quick-update');
        Route::resource('questions', 'QuestionsController');
        
        // Quiz Attempts / Results Management
        Route::get('quiz-attempts/export', 'QuizAttemptController@export')->name('quiz-attempts.export');
        Route::resource('quiz-attempts', 'QuizAttemptController');
        
        // Grading Schemes Management (Edit Only)
        Route::get('grading-schemes', 'GradingSchemeController@index')->name('grading-schemes.index');
        Route::get('grading-schemes/{grading_scheme}/edit', 'GradingSchemeController@edit')->name('grading-schemes.edit');
        Route::put('grading-schemes/{grading_scheme}', 'GradingSchemeController@update')->name('grading-schemes.update');
    }
);
