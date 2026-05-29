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


Route::get('/', 'BerandaController@index')->name('frontendx');
Route::get('/login','BerandaController@login')->name('login');
Route::post('/getDataLogin', 'BerandaController@loginProses');
Route::get('/home','BerandaController@home');
Route::get('/logout', 'BerandaController@logout')->name('logout');
Route::post('/savePeserta', 'BerandaController@store');

Route::get('/potensi-investasi','TentangKamiController@potensi');
Route::get('/sejarah-singkat','TentangKamiController@sejarah_singkat');
Route::get('/visi-misi','TentangKamiController@visi_misi');
Route::get('/arti-logo','TentangKamiController@arti_logo');
Route::get('/kegiatan','TentangKamiController@kegiatan');
Route::get('/kegiatan/{id}','TentangKamiController@det_kegiatan');
Route::get('/news','TentangKamiController@news');
Route::get('/news/{id}','TentangKamiController@det_news');
Route::get('/rilisAll','TentangKamiController@rilis');
Route::get('/rilis/{id}','TentangKamiController@det_rilis');
Route::get('/sektor/{id}','TentangKamiController@sektor');
Route::get('/op','TentangKamiController@opini');
Route::get('/op/{id}','TentangKamiController@det_opini');
Route::get('/album','TentangKamiController@album');
Route::get('/umkm/{id}','TentangKamiController@det_umkm');
Route::get('/umkms','TentangKamiController@umkm');
Route::get('/vd','TentangKamiController@vd');
Route::get('/contact','TentangKamiController@contact');


Route::group( ['middleware' => 'auth' ], function()
{
	// Kategori Berita
	Route::get('/kb','KategoriBeritaController@index')->name('kb.index');    
	Route::get('/getDataJson/kb','KategoriBeritaController@getData')->name('kb.show');    
	Route::get('/addKb','KategoriBeritaController@add')->name('kb.add');      
	Route::get('/editKb/{id}','KategoriBeritaController@edit')->name('kb.edit');      	
	Route::post('/saveKb','KategoriBeritaController@store')->name('kb.save');    
	Route::get('/delete/kb/{id}','KategoriBeritaController@destroy')->name('kb.delete');    
	Route::put('/updateKb/{id}','KategoriBeritaController@update')->name('kb.update');     
	Route::get('/updateStatusKb/{id}/{id2}','KategoriBeritaController@updateStatus')->name('kb.status'); 
	
	// Profil Kadin
	Route::get('/profil_kadin','ProfilKadinController@index')->name('profil_kadin.index'); 
	Route::get('/getDataJson/profil_kadin','ProfilKadinController@getData')->name('profil_kadin.show'); 
	Route::get('/addProfilKadin','ProfilKadinController@add')->name('profil_kadin.add'); 
	Route::get('/editProfilKadin/{id}','ProfilKadinController@edit')->name('profil_kadin.edit');   	
	Route::post('/saveProfilKadin','ProfilKadinController@store')->name('profil_kadin.save'); 
	Route::get('/delete/profil_kadin/{id}','ProfilKadinController@destroy')->name('profil_kadin.delete'); 
	Route::put('/updateProfilKadin/{id}','ProfilKadinController@update')->name('profil_kadin.update'); 
	
	// User
	Route::get('/user','UserController@index')->name('user.index');       
	Route::get('/getDataJson/user','UserController@getData')->name('user.show');
	Route::get('/addUser','UserController@add')->name('user.add'); 
	Route::get('/editUser/{id}','UserController@edit')->name('user.edit'); 	
	Route::post('/saveUser','UserController@store')->name('user.save');
	Route::get('/delete/user/{id}','UserController@destroy')->name('user.delete');
	Route::put('/updateUser/{id}','UserController@update')->name('user.update'); 
	
	// Level
	Route::get('/level','LevelController@index')->name('level.index');      
	Route::get('/getDataJson/level','LevelController@getData')->name('level.show');  
	Route::get('/getDataJson/detlevel/{id}','LevelController@getDataDetail')->name('level.show_detail');  
	Route::get('/addLevel','LevelController@add')->name('level.add');   
	Route::get('/editLevel/{id}','LevelController@edit')->name('level.edit');   	
	Route::get('/detailLevel/{id}','LevelController@detail')->name('level.detail');  	
	Route::post('/saveLevel','LevelController@store')->name('level.save');  
	Route::get('/delete/level/{id}','LevelController@destroy')->name('level.delete');  
	Route::put('/updateLevel/{id}','LevelController@update')->name('level.update');  
	Route::get('/addMenuUser/{id}/{id2}','LevelController@saveMenu')->name('level.add_menu');  
	Route::get('/deleteMenuUser/{id}','LevelController@deleteMenu')->name('level.delete_menu');  
	
	// Rilis
	Route::get('/rilis','RilisController@index')->name('rilis.index');    
	Route::get('/getDataJson/rilis','RilisController@getData')->name('rilis.show');
	Route::get('/addRilis','RilisController@add')->name('rilis.add'); 
	Route::get('/editRilis/{id}','RilisController@edit')->name('rilis.edit'); 	
	Route::get('/uploadRilis/{id}','RilisController@upload')->name('rilis.upload'); 	
	Route::post('/saveRilis','RilisController@store')->name('rilis.save');
	Route::get('/delete/rilis/{id}','RilisController@destroy')->name('rilis.delete');
	Route::put('/updateRilis/{id}','RilisController@update')->name('rilis.update');
	Route::get('/updateStatusRilis/{id}/{id2}','RilisController@updateStatus')->name('rilis.status'); 
	
	// Rilis Image
	Route::post('/saveRilisImage','RilisController@simpan_image')->name('rilis.save_image');  
	Route::put('/updateRilisImage/{id}','RilisController@update_image')->name('rilis.update_image');  
	Route::get('/getDataJson/rilis_image/{id}','RilisController@getDataImage')->name('rilis.show_image');  
	Route::get('/delete/rilis_image/{id}','RilisController@hapus_image')->name('rilis.delete_image');
	Route::get('/updateStatusRilisImage/{id}/{id2}','RilisController@updateStatusImage')->name('rilis.status_image'); 
	
	// Berita
	Route::get('/berita','BeritaController@index')->name('berita.index');    
	Route::get('/getDataJson/berita','BeritaController@getData')->name('berita.show');
	Route::get('/addBerita','BeritaController@add')->name('berita.add'); 
	Route::get('/editBerita/{id}','BeritaController@edit')->name('berita.edit'); 	
	Route::post('/saveBerita','BeritaController@store')->name('berita.save');
	Route::get('/delete/berita/{id}','BeritaController@destroy')->name('berita.delete');
	Route::put('/updateBerita/{id}','BeritaController@update')->name('berita.update');
	Route::get('/updateStatusBerita/{id}/{id2}','BeritaController@updateStatus')->name('berita.status'); 
	
	// Investasi
	Route::get('/investasi','InvestasiController@index')->name('investasi.index');    
	Route::get('/getDataJson/investasi','InvestasiController@getData')->name('investasi.show');
	Route::get('/addInvestasi','InvestasiController@add')->name('investasi.add'); 
	Route::get('/editInvestasi/{id}','InvestasiController@edit')->name('investasi.edit'); 	
	Route::post('/saveInvestasi','InvestasiController@store')->name('investasi.save');
	Route::get('/delete/investasi/{id}','InvestasiController@destroy')->name('investasi.delete');
	Route::put('/updateInvestasi/{id}','InvestasiController@update')->name('investasi.update');
	Route::get('/updateStatusInvestasi/{id}/{id2}','InvestasiController@updateStatus')->name('investasi.status'); 
	
	// Umkm
	Route::get('/umkm','UmkmController@index')->name('umkm.index');    
	Route::get('/getDataJson/umkm','UmkmController@getData')->name('umkm.show');
	Route::get('/addUmkm','UmkmController@add')->name('umkm.add'); 
	Route::get('/editUmkm/{id}','UmkmController@edit')->name('umkm.edit'); 	
	Route::get('/profilUmkm/{id}','UmkmController@profil')->name('umkm.profil'); 	
	Route::post('/saveUmkm','UmkmController@store')->name('umkm.save');
	Route::get('/delete/umkm/{id}','UmkmController@destroy')->name('umkm.delete');
	Route::put('/updateUmkm/{id}','UmkmController@update')->name('umkm.update');
	Route::get('/updateStatusUmkm/{id}/{id2}','UmkmController@updateStatus')->name('umkm.status'); 
	Route::get('/uploadUmkm/{id}','UmkmController@upload')->name('umkm.upload'); 	
	
	// Umkm Produck
	Route::post('/saveUmkmImage','UmkmController@simpan_image')->name('umkm.save_image');  
	Route::put('/updateUmkmImage/{id}','UmkmController@update_image')->name('umkm.update_image');  
	Route::get('/getDataJson/umkm_image/{id}','UmkmController@getDataImage')->name('umkm.show_image');  
	Route::get('/delete/umkm_image/{id}','UmkmController@hapus_image')->name('umkm.delete_image');
	Route::get('/updateStatusUmkmImage/{id}/{id2}','UmkmController@updateStatusImage')->name('umkm.status_image'); 
	
	// Opini
	Route::get('/opini','OpiniController@index')->name('opini.index');  
	Route::get('/getDataJson/opini','OpiniController@getData')->name('opini.show');
	Route::get('/addOpini','OpiniController@add')->name('opini.add');  
	Route::get('/editOpini/{id}','OpiniController@edit')->name('opini.edit'); 	
	Route::post('/saveOpini','OpiniController@store')->name('opini.save');
	Route::get('/delete/opini/{id}','OpiniController@destroy')->name('opini.delete');
	Route::put('/updateOpini/{id}','OpiniController@update')->name('opini.update');
	Route::get('/updateStatusOpini/{id}/{id2}','OpiniController@updateStatus')->name('opini.status');
	
	// Event
	Route::get('/event','EventsController@index')->name('event.index');     
	Route::get('/getDataJson/event','EventsController@getData')->name('event.show');  
	Route::get('/getDataJson/info_peserta/{id}','EventsController@getDataPeserta')->name('event.show_detail');  
	Route::get('/addEvent','EventsController@add')->name('event.add');  
	Route::get('/editEvent/{id}','EventsController@edit')->name('event.edit');   	
	Route::get('/infoEvent/{id}','EventsController@info')->name('event.info');    	
	Route::post('/saveEvent','EventsController@store')->name('event.save');  
	Route::get('/delete/event/{id}','EventsController@destroy')->name('event.delete');  
	Route::put('/updateEvent/{id}','EventsController@update')->name('event.update');   
	Route::get('/updateStatusEvent/{id}/{id2}','EventsController@updateStatus')->name('event.status');   
	
	// Gambar
	Route::get('/gallery','GambarController@index')->name('gallery.index');     
	Route::get('/getDataJson/gallery/{id}','GambarController@getData')->name('gallery.show');  
	Route::get('/getDataJson/galleryKategori','GambarController@getDataKat')->name('gallery.show_kat');  
	Route::get('/addGallery/{id}','GambarController@add')->name('gallery.add');   
	Route::get('/detGallery/{id}','GambarController@detGallery')->name('gallery.det_gallery');   
	Route::get('/editGallery/{id}','GambarController@edit')->name('gallery.edit');   	
	Route::post('/saveGallery','GambarController@store')->name('gallery.save');  
	Route::post('/saveKatGallery','GambarController@save_kat')->name('gallery.save_kat');  
	Route::get('/delete/gallery/{id}','GambarController@destroy')->name('gallery.delete');  
	Route::get('/delete/galleryKat/{id}','GambarController@delete_kat')->name('gallery.delete_kat');  
	Route::put('/updateGallery/{id}','GambarController@update')->name('gallery.update');  
	Route::put('/updateKatGallery/{id}','GambarController@update_kat')->name('gallery.update_kat');  
	Route::get('/updateStatusGallery/{id}/{id2}','GambarController@updateStatus')->name('gallery.status');
	Route::get('/updateStatusGalleryKat/{id}/{id2}','GambarController@updateStatusKat')->name('gallery.status_kat');

	// File
	Route::get('/file','FileController@index')->name('file.index');     
	Route::get('/getDataJson/file','FileController@getData')->name('file.show');  
	Route::get('/addFile','FileController@add')->name('file.add');   
	Route::get('/editFile/{id}','FileController@edit')->name('file.edit');   	
	Route::post('/saveFile','FileController@store')->name('file.save');  
	Route::get('/delete/file/{id}','FileController@destroy')->name('file.delete');  
	Route::put('/updateFile/{id}','FileController@update')->name('file.update');  
	Route::get('/updateStatusFile/{id}/{id2}','FileController@updateStatus')->name('file.status');	
	
	// Banner
	Route::get('/banner','BannerController@index')->name('banner.index');      
	Route::get('/getDataJson/banner','BannerController@getData')->name('banner.show');   
	Route::get('/addBanner','BannerController@add')->name('banner.add');    
	Route::get('/editBanner/{id}','BannerController@edit')->name('banner.edit');   	
	Route::post('/saveBanner','BannerController@store')->name('banner.save');   
	Route::get('/delete/banner/{id}','BannerController@destroy')->name('banner.delete');   
	Route::put('/updateBanner/{id}','BannerController@update')->name('banner.update');   
	Route::get('/updateStatusBanner/{id}/{id2}','BannerController@updateStatus')->name('banner.status');   
	
	// Video
	Route::get('/video','VideoController@index')->name('video.index');    
	Route::get('/getDataJson/video','VideoController@getData')->name('video.show');  
	Route::get('/addVideo','VideoController@add')->name('video.add');   
	Route::get('/editVideo/{id}','VideoController@edit')->name('video.edit');   	
	Route::post('/saveVideo','VideoController@store')->name('video.save');  
	Route::get('/delete/video/{id}','VideoController@destroy')->name('video.delete');  
	Route::put('/updateVideo/{id}','VideoController@update')->name('video.update');  
	Route::get('/updateStatusVideo/{id}/{id2}','VideoController@updateStatus')->name('video.status');   
	
	// Iklan
	Route::get('/iklan','IklanController@index')->name('iklan.index');      
	Route::get('/getDataJson/iklan','IklanController@getData')->name('iklan.show');    
	Route::get('/addIklan','IklanController@add')->name('iklan.add');    
	Route::get('/editIklan/{id}','IklanController@edit')->name('iklan.edit');      	
	Route::post('/saveIklan','IklanController@store')->name('iklan.save');    
	Route::get('/delete/iklan/{id}','IklanController@destroy')->name('iklan.delete');    
	Route::put('/updateIklan/{id}','IklanController@update')->name('iklan.update');     
	Route::get('/updateStatusIklan/{id}/{id2}','IklanController@updateStatus')->name('iklan.status'); 
	
});