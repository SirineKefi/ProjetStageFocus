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
Route::get('/template1', function () {
    return view('First');
});

Route::get('/EditClientDetails/{id}','ClientContoller@GoToEditClient');

Route::get('/','ClientController@welcome');
Route::get('/view_client/Client/{id}', 'ClientContoller@ViewClient');
Route::get('/table', function () {
    return view('welcome');
});
Route::get('/Clients','ClientContoller@ListClient');
Route::get('/actioncreate','ClientContoller@NewClientTemplate');
Route::post('/actioncreate','ClientController@createClient');
Route::post('/editServer/{id}','ServerController@EditServer');
Route::get('/editServer/{id}','ServerController@EditServer');

Route::post('/saveUpdate/server/{id_s}','ServerController@saveUpdate');
Route::get('/server/{id_s}','ServerController@ViewServer');

/*Route::get('/saveUpdate',function(){
    return view('ViewClient_Server_lpars');
});*/
Route::get('/editClient/{id}','ClientContoller@EditClient');
Route::get('/deleteClient/{id}','ClientContoller@DeleteClient');
Route::post('/SaveClient/{id}','ClientContoller@SaveUpdateClient');
Route::get('/SaveClient/{id}','ClientContoller@SaveUpdateClient');

Route::post('/NewServer/Client/{id}','ServerController@NewServer');
Route::post('/createServer','ServerController@createServer');
Route::get('/ok', function () {
    return view('template');
});
Route::get('/template','ClientController@ReadClients');

Route::post('/servers/{id}','ClientController@ReadServers');
Route::post('/templates/{id}','ClientController@ReadTemplates');


Route::get('/delete/Client/{id_c}/Server/{id_s}/{id}','LPARController@delete');
Route::get('/goedit/Client/{id_c}/Server/{id_s}/{id}','LPARController@go_edit');

Route::get('/edit/Client/{id_c}/Server/{id_s}/{id}','LPARController@edit');
Route::post('/delete/Client/{id_c}/Server/{id_s}/{id}','LPARController@delete');
Route::post('/edit/Client/{id_c}/Server/{id_s}/{id}','LPARController@edit');

Route::put('/addTemplate/Client/{id}','TemplateController@Gotoadd');
Route::get('/addTemplate/Client/{id}','TemplateController@Gotoadd');
Route::get('/addLPAR/Server/{id}','LPARController@Gotoadd');


Route::post('/delete/{id}','ServerController@deleteServer');
Route::get('/delete/{id}','ServerController@deleteServer');
Route::get('/Template/{id_t}','TemplateController@ReadTemplate');

Route::post('/addTemplate/Client/{id}/template/{id_t}/actioncreatePhysicalIO','TemplateController@createphysicalIO');
Route::post('/addTemplate/Client/{id}/template/{id_t}/actioncreateSCSI','TemplateController@createSCSI');
Route::post('/addTemplate/Client/{id}/template/{id_t}/actioncreateEthernet','TemplateController@createEthernet');
Route::post('/addTemplate/Client/{id}/template/{id_t}/actioncreateFC','TemplateController@createFC');
Route::post('/addTemplate/Client/{id}/actioncreateTemplate/{id_t}','TemplateController@createTemplate');
Route::post('DeleteTemplate/{id_t}','TemplateController@DeleteTemplate');
Route::get('DeleteTemplate/{id_t}','TemplateController@DeleteTemplate');

Route::get('EditTemplate/{id_t}','TemplateController@GoToEdit');
Route::post('/template','ClientController@ReadClients');
Route::get('/addTemplate/Client/{id}/actioncreateTemplate/{id_t}','TemplateController@createTemplate');
Route::post('/addLpar/Client/{id}/lpar/{id_t}','LparController@createphysicalIO');
Route::post('/addLpar/Client/{id}/lpar/{id_t}/createSCSI','LparController@createSCSI');
Route::post('/addLpar/Client/{id}/lpar/{id_t}/createEthernet','LparController@createEthernet');
Route::post('/addLpar/Client/{id}/lpar/{id_t}/createFC','LparController@createFC');


Route::get('/editTemplate/{id}','TemplateController@GoToEdit');
Route::post('/CreateLPAR/{id}','LPARController@CreateLPAR');
Route::get('/CreateLPAR/{id}','LPARController@CreateLPAR');

Route::get('/Server/{id}/GenerateScript','ServerController@Script');
Route::get('/SCSI/{id}/deleteSCSI','LparController@deleteSCSI');
Route::get('/Ethernet/{id}/deleteEthernet','LparController@deleteEth');
Route::get('/FC/{id}/deleteFC','LparController@deleteFC');
Route::get('/PhysicalIO/{id}/deletePhy','LparController@deletephy');
Route::get('/PhysicalIO/{id}/editPhy','LparController@editphy');
Route::get('/Ethernet/{id}/editEth','LparController@editEth');

