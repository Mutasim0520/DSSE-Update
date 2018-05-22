<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/test', function () {
    return view('researches.updateResearch');
});

    Route::get('/user/download/{filename}','IndexController@download');
    Route::get('/check/email','IndexController@checkEmail');
    Route::get('/password/change/check/email','IndexController@checkEmailForPasswordReset');
    Route::get('/forgot/password','IndexController@showPasswordResetForm');
    Route::post('/send/password/recovery/mail','IndexController@sendPasswordRecoveryMail');

//Routes for user end
    Route::get('/','IndexController@showIndex');
    Route::get('/MEMBERS','IndexController@showMembers');
    Route::get('/PROJECTS/{id}','IndexController@showProjects');
    Route::get('/MEMBERPROFILE/{id}','IndexController@showMemberProfile');
    Route::get('/PUBLICATIONS/{type}','IndexController@showPublications');
    Route::get('/sd/{name}','IndexController@showSupportingDocs');
    Route::get('/events','IndexController@showEvents');
    Route::get('/events/{id}','IndexController@showEventDetail');
    Route::get('/indivisual/publication/{id}','IndexController@showIndivisualPublication');
    Route::get('/tagWiseItem/{id}','IndexController@showTagWiseResult');
    Route::get('/indivisual/project/{id}','IndexController@showIndivisualProject');
    Route::get('/publisherWiseItem/{name}','IndexController@showPublisherWiseResult');
    Route::get('/conferenceWiseItem/{name}','IndexController@showConferenceWiseResult');
    Route::get('/journalWiseItem/{name}','IndexController@showJournalWiseResult');
    Route::get('/publication','IndexController@showAllPublication');

    Route::group(['middleware' =>'auth'], function (){

        Route::get('/delete/project/{id}','UserController@deleteProject');
        Route::get('/delete/publication/{id}','UserController@deletePublication');
        Route::get('/update/publication/{id}','UserController@showUpdatePublicationForm');
        Route::get('/update/project/{id}','UserController@showUpdateProjectForm');
        Route::post('/pub_update/{id}','PublicationController@update');
        Route::post('/p_update/{id}','ProjectController@update');

        Route::post('/user/add/publication/name','UserController@addPublicationName');
        Route::post('/add/social/link','UserController@addSocialLink');
        Route::get('/add/publication','PublicationController@addPublication');
        Route::get('/add/project','ProjectController@addProject');
        Route::get('/add/supporting/doc','SupportingDocController@addSupportingDocs');
        Route::get('/indivisual/profile/{id}','UserController@showProfile');
        Route::post('/user/storepublication','PublicationController@store');

        Route::post('/user/storeproject','ProjectController@store');

        Route::post('/add/education','UserController@addEducation');
        Route::post('/add/experience','UserController@addExperience');
        Route::post('/upload/pp','UserController@uploadPP');
        Route::post('/update/profile/image','UserController@updatePP');
        Route::post('/update/profile/info','UserController@updateUserInfo');

        Route::get('/add/publication/project','ProjectController@addProjectFromPublication');
    });

    Route::post('/user/storefile','PublicationController@storeFile');
        Route::post('/user/storekeyword','PublicationController@storeKeyword');
        Route::post('/user/store/external/author','PublicationController@storeExternalAuthor');



Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');


Route::get('/checkProject','ProjectController@checkProject');
Route::post('/storekeyword','PublicationController@storeKeyword');
Route::post('/storefile','PublicationController@storeFile');



Route::group(['middleware' => 'auth:admin'], function (){

    Route::get('/admin/dashboard','AdminController@showIndex');
    Route::get('/admin/sync/exauth/{member_id}/{id}','AdminController@externalAuthorSynchronization');
    //Routes For Members
    Route::get('/admin/userRequest','AdminController@showMemberShipRequest');
    Route::get('/admin/index','AdminController@showIndex')->name('admin.index');
    Route::get('/members','AdminController@memberList');
    Route::get('/memberProfile/{id}','AdminController@memberProfile');
    Route::get('/addmember','AdminController@addMember');
    Route::post('/storemember','AdminController@store');
    Route::get('/updatemember/{id}','AdminController@updateMember');
    Route::post('/update/{id}','AdminController@update');
    Route::get('/deletemember/{id}','AdminController@delete');

    Route::get('/admin/acceptUser/{id}','AdminController@acceptUser');
    Route::get('/admin/rejectUser/{id}','AdminController@rejectUser');
    Route::get('/admin/sd/{name}','SupportingDocController@showSupportingDocs');
    Route::get('/addSupportingDocs','SupportingDocController@addSupportingDocs');
    Route::post('/admin/storeSupportingDocs','SupportingDocController@storeSupportingDocs');
    Route::post('/admin/deleteSD','SupportingDocController@deleteSupportingDoc');
   

//Routes For Projects

    Route::get('/admin/projectDetail/{id}','ProjectController@projectDescription');
    Route::get('/admin/addproject','ProjectController@addProjectAdmin');
    Route::post('/admin/storeproject','ProjectController@store');
    Route::get('/admin/updateproject/{id}','ProjectController@updateProject');

    Route::get('/admin/deleteproject/{id}','ProjectController@delete');
    Route::get('/admin/ongoingproject','ProjectController@onGoingProject');
    Route::get('/admin/completeproject','ProjectController@completeProject');
    Route::get('/admin/fundedproject','ProjectController@fundedProject');
    Route::get('/admin/nonfundedproject','ProjectController@nonFundedProject');
    Route::get('/admin/projectlist/{id}','ProjectController@show');

//Routes for publications
   Route::get('/admin/publications','PublicationController@show');
    Route::get('/admin/publicationsDetail/{id}','PublicationController@publicationDetail');
    Route::get('/admin/updatepublication/{id}','PublicationController@updatePublication');
    Route::get('/addpublications','PublicationController@addPublication');
    Route::post('/storepublication','PublicationController@store');
    Route::get('/download/{filename}', 'PublicationController@download');
    Route::get('/admin/deletepublication/{id}','PublicationController@delete');


    //Routes for event
    Route::get('/admin/eventlist','EventController@Show');
    Route::get('/admin/addevent','EventController@addEvent');
    Route::post('/admin/storeEvent','EventController@store');
    Route::post('/admin/deleteEvent','EventController@delete');
    Route::get('/admin/update/event/{id}','EventController@showUpdateEventForm');
    Route::post('/admin/update/event/{id}','EventController@update');
    Route::post('/admin/logout','Auth\AdminLoginController@logout');

});

Auth::routes();

//Route::get('/home', 'HomeController@index');
