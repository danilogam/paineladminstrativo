<?php

/* ROUTES SITE */
Route::get('/', 'PagesController@home')->name('home');
Route::get('/quem-somos', 'PagesController@quemsomos')->name('quemsomos');

/* ROUTES AUTHENTICATE */
Route::group(['prefix'=>'cms'], function(){
	Auth::routes();
});

/* ROUTES CMS */
Route::group(['prefix'=>'cms','middleware' => 'auth'], function(){
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	//Static Pages
	Route::resource('pages', 'PagesController');
	Route::resource('informacoes', 'InformacoesController');

	//Dynamic Content
	Route::resource('posts', 'PostsController');
	Route::resource('categorias', 'CategoriasController');
	Route::resource('galerias', 'GaleriasController');
	Route::resource('usuarios', 'UsersController');
	Route::resource('slides', 'SlidesController');
	Route::resource('cidades', 'CidadesController');
	Route::resource('estados', 'EstadosController');

	//Filtros
	Route::get('filtrar/posts', 'FiltrosController@postsfiltro')->name('posts.filtro');
	Route::get('buscar/posts', 'FiltrosController@postsbusca')->name('posts.busca');
	Route::get('filtrar/slides', 'FiltrosController@slidesfiltro')->name('slides.filtro');
	Route::get('buscar/slides', 'FiltrosController@slidesbusca')->name('slides.busca');
	Route::get('filtrar/usuarios', 'FiltrosController@usuariosfiltro')->name('usuarios.filtro');
	Route::get('buscar/usuarios', 'FiltrosController@usuariosbusca')->name('usuarios.busca'); 
	Route::get('buscar/categorias', 'FiltrosController@categoriasbusca')->name('categorias.busca');
	Route::get('buscar/galerias', 'FiltrosController@galeriasbusca')->name('galerias.busca');
	Route::get('buscar/estados', 'FiltrosController@estadosbusca')->name('estados.busca');
	Route::get('buscar/cidades', 'FiltrosController@cidadesbusca')->name('cidades.busca');
	Route::get('filtrar/cidades', 'FiltrosController@cidadesfiltro')->name('cidades.filtro');
 
	//Medias content
	Route::get('galerias/files/{id}', 'GaleriasController@filesall')->name('files.all');
	Route::post('galerias/files/up/{id}', 'GaleriasController@fileup')->name('file.up');
	Route::post('galerias/files/del/{id}', 'GaleriasController@filedel')->name('file.del');
});