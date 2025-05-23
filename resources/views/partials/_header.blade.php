<!-- Anna Escribano -->
<nav class="navbar-expand-lg">
    <!--boto hamburguer -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <!--elements -->
    <div class="navbar" id="navbarNav">
      <!-- logo -->
      <a href="home">
        <img src="img/gui/logo.png" alt="" class="navbar_logo">
      </a>
  
      <!-- search -->
      @if ($Ruta != 'login' && $Ruta != 'registre')
        <form action="" method="post" class="navbar_search">
          <input class="form-control" type="text" name="buscadorArticle" placeholder="Nom de l'article">
          <button type="submit" class="button button-lil">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <g clip-path="url(#clip0_155_74)">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M15.6612 15.6633C15.8005 15.5239 15.9659 15.4132 16.148 15.3377C16.3301 15.2622 16.5253 15.2234 16.7224 15.2234C16.9196 15.2234 17.1147 15.2622 17.2968 15.3377C17.4789 15.4132 17.6444 15.5239 17.7837 15.6633L23.5587 21.4383C23.8401 21.7196 23.9983 22.1011 23.9985 22.499C23.9986 22.8969 23.8407 23.2786 23.5594 23.5601C23.2782 23.8415 22.8966 23.9997 22.4987 23.9999C22.1008 24 21.7191 23.8421 21.4377 23.5608L15.6627 17.7858C15.5232 17.6465 15.4126 17.4811 15.3371 17.299C15.2616 17.1169 15.2227 16.9217 15.2227 16.7246C15.2227 16.5274 15.2616 16.3323 15.3371 16.1502C15.4126 15.9681 15.5232 15.8026 15.6627 15.6633H15.6612Z"
                  fill="black" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M9.75 18C10.8334 18 11.9062 17.7866 12.9071 17.372C13.9081 16.9574 14.8175 16.3497 15.5836 15.5836C16.3497 14.8175 16.9574 13.9081 17.372 12.9071C17.7866 11.9062 18 10.8334 18 9.75C18 8.66659 17.7866 7.5938 17.372 6.59286C16.9574 5.59193 16.3497 4.68245 15.5836 3.91637C14.8175 3.15029 13.9081 2.5426 12.9071 2.12799C11.9062 1.71339 10.8334 1.5 9.75 1.5C7.56196 1.5 5.46354 2.36919 3.91637 3.91637C2.36919 5.46354 1.5 7.56196 1.5 9.75C1.5 11.938 2.36919 14.0365 3.91637 15.5836C5.46354 17.1308 7.56196 18 9.75 18ZM19.5 9.75C19.5 12.3359 18.4728 14.8158 16.6443 16.6443C14.8158 18.4728 12.3359 19.5 9.75 19.5C7.16414 19.5 4.68419 18.4728 2.85571 16.6443C1.02723 14.8158 0 12.3359 0 9.75C0 7.16414 1.02723 4.68419 2.85571 2.85571C4.68419 1.02723 7.16414 0 9.75 0C12.3359 0 14.8158 1.02723 16.6443 2.85571C18.4728 4.68419 19.5 7.16414 19.5 9.75Z"
                  fill="black" />
              </g>
              <defs>
                <clipPath id="clip0_155_74">
                  <rect width="24" height="24" fill="white" />
                </clipPath>
              </defs>
            </svg>
          </button>
        </form>
  
  
        <!-- user menu -->
        <div>
          @if (!isset($_SESSION['user']))
            <a class="nav-link" href="login">
              Login
            </a>
          @else
  
            <div class="dropdown">
              <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['user'] ?>
              </div>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile">Perfil</a></li>
                <li><a class="dropdown-item" href="login?isLogout=true">Logout</a></li>
              </ul>
            </div>
          @endif
        </div>
      @endif
    </div>
  </nav>