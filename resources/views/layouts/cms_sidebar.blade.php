<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
  <div class="slimscroll-menu" id="remove-scroll">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu" id="side-menu">
        <li class="menu-title">Acesso geral</li>
        <li @if(Route::is('dashboard')) class="active" @endif>
          <a href="{{route('dashboard')}}" class="waves-effect">
            <i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
          </a>
        </li>

        @if($auth->role->id != 5)
        <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
        <li @if(Route::is('pages.edit')) class="active" @endif>
          <a href="{{route('pages.index')}}" class="waves-effect"><i class="mdi mdi-file-document"></i> <span> Ver Páginas</span> </a>
        </li>
        @endif

        {{-- <li @if(Route::is('slides.index') || Route::is('slides.create') || Route::is('slides.edit')) class="active" @endif>
          <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-view-carousel"></i> <span> Slideshow <span class="badge badge-primary badge-pill">home</span> <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
          <ul class="submenu">
            <li><a href="{{route('slides.index')}}">Listar slides</a></li>
            <li><a href="{{route('slides.create')}}">Adicionar slide</a></li>
          </ul>
        </li> --}}

        @if($auth->role->id == 1 || $auth->role->id == 2 || $auth->role->id == 3)
        <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
        <li @if(Route::is('informacoes.edit')) class="active" @endif>
          <a href="{{route('informacoes.edit', 1)}}" class="waves-effect"><i class="mdi mdi-information"></i> <span> Informações</span> </a>
        </li>
        @endif

        {{-- @if($auth->role->id != 4)
        <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
        <li @if(Route::is('categorias.index') || Route::is('categorias.create') || Route::is('categorias.edit')) class="active" @endif>
          <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-tag-multiple"></i> <span> Categorias <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
          <ul class="submenu">
            <li><a href="{{route('categorias.index')}}">Listar categorias</a></li>
            <li><a href="{{route('categorias.create')}}">Adicionar nova categoria</a></li>
          </ul>
        </li> --}}

        {{-- <li @if(Route::is('posts.index') || Route::is('posts.create') || Route::is('posts.edit')) class="active" @endif>
          <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-newspaper"></i> <span> Posts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
          <ul class="submenu">
            <li><a href="{{route('posts.index')}}">Listar postagens</a></li>
            <li><a href="{{route('posts.create')}}">Adicionar novo post</a></li>
          </ul>
        </li>
        @endif --}}

        {{-- <li @if(Route::is('galerias.index') || Route::is('galerias.create') || Route::is('galerias.edit')) class="active" @endif>
          <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-image-multiple"></i> <span> Galeria de imagens <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
          <ul class="submenu">
            <li><a href="{{route('galerias.index')}}">Listar galerias</a></li>
            <li><a href="{{route('galerias.create')}}">Adicionar nova galeria</a></li>
          </ul>
        </li> --}}

        <li @if(Route::is('estados.index') || Route::is('estados.create') || Route::is('estados.edit') || Route::is('cidades.index') || Route::is('cidades.create') || Route::is('cidades.edit')) class="active" @endif>
          <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-google-maps"></i> <span> Localidades <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
          <ul class="submenu">
            <li><a href="{{route('estados.index')}}">Listar estados</a></li>
            <li><a href="{{route('cidades.index')}}">Listar cidades</a></li>
          </ul>
        </li>

        @if($auth->role->id == 1 || $auth->role->id == 2)
        <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
        <li class="menu-title">Acesso de administrador</li>

        <li @if(Route::is('usuarios.index') || Route::is('usuarios.create') || Route::is('usuarios.edit')) class="active" @endif>
          <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-account-multiple"></i> <span> Usuários <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
          <ul class="submenu">
            <li><a href="{{route('usuarios.index')}}">Listar usuários</a></li>
            <li><a href="{{route('usuarios.create')}}">Adicionar novo usuário</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
    <!-- Sidebar -->
  </div>
  <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->