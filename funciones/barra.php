<header>
  <input id="B-menu" type="checkbox">
  <label for="B-menu">
    <i class="fas fa-bars fa-2x">
    </i>
  </label>
  <nav class="menu">
    <ul>
      <li class="c1"><a href="../pagina-principal/index.php"><i class="fas fa-home tamaño_icon"></i></a></li>
      <?php if ($_SESSION['rol'] == 1) {?>
      <li><a href=""><i class="fas fa-user-tie tamaño_icon"></i> Administrador</a>
        <nav class="sub-menu sub-menu2">
          <ul>
            <li><a href="../pagina-principal/crear-usuario.php"><i class="fas fa-user-plus tamaño_icon"></i> Agregar
                nuevo Usuario</a></li>
            <li><a href="../pagina-principal/consulta-modifica-elimina.php"><i class="fas fa-users tamaño_icon"></i>
                Consulta, Modifica y Elimina</a></li>
          </ul>
        </nav>
      </li>
      <?php }if ($_SESSION['rol'] == 2) {?>
      <li><a href=""><i class="fas fa-user tamaño_icon"></i> supervisor</a>
        <nav class="sub-menu sub-menu2">
          <ul>
            <li><a href="../pagina-principal/consultar_supervisor.php"><i class="fas fa-users tamaño_icon"></i>
                Consulta</a></li>
          </ul>
        </nav>
      </li>
      <?php }?>
      <li><a href=""><i class="fas fa-book tamaño_icon"></i> Nuestra Información</a>
        <nav class="sub-menu">
          <ul>
            <li><a href="../pagina-principal/historia.php"><i class="fas fa-book-reader tamaño_icon"></i> Historia</a>
            </li>
            <li><a href="../pagina-principal/Mision-Vision-Objetivo.php"><i class="fas fa-book-open tamaño_icon"></i>
                Mision, Visión y Objetivos</a></li>
            <li><a href=""><i class="fas fa-sitemap tamaño_icon"></i> Organigrama</a></li>
          </ul>
        </nav>
      </li>
      <li><a href=""><i class="far fa-newspaper tamaño_icon"></i> Noticias</a>
        <nav class="sub-menu noti-sub-menu">
          <ul>
            <li><a href="../pagina-principal/ver_noticia.php"><i class="fab fa-readme tamaño_icon"></i> Noticias
                recientes</a>
              <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
            <li><a href="../pagina-principal/publicar_noticias.php"><i class="far fa-newspaper tamaño_icon"></i><i
                  class="fas fa-plus icon-aco"></i> Añadir noticias</a></li>
            <?php }?>
      </li>
    </ul>
  </nav>
  </li>
  <li><a href=""><i class="fas fa-user-tie"></i> Trabajo</a>
    <nav class="sub-menu noti-sub-menu">
      <ul>
        <li><a href=""><i class="fas fa-archive"></i> Registro y contral de documentos probatorios</a></li>
        <li><a href=""><i class="fas fa-tasks"></i> Sistema de gestion interna</a></li>
        <li><a href=""><i class="fas fa-school"></i> Comtrol de estudio</a></li>
      </ul>
    </nav>
  </li>
  </ul>
  </nav>
</header>