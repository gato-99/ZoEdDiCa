<!-- slider noticias -->
<?php include "../php/conexion-mysql/conexion.php"; ?>

<div class="flexslider">
    <div class="slides">
        <?php 
        $query_conteo = mysqli_query($conection,"SELECT COUNT(*) as conteo FROM noticias");
        $resultado_conteo=mysqli_fetch_array($query_conteo);

        $conteo = $resultado_conteo['conteo'];
        $por_pagina =5;
        if(empty($_GET['pagina'])){
            $pagina = 1;
        }
        else {
            $pagina=$_GET['pagina'];
        }
        $desde = ($pagina - 1) * $por_pagina;
        $total_de_pagina = ceil($conteo / $por_pagina);?>

        <?php $query= mysqli_query($conection,"SELECT l.id_noticias,l.titulo,l.foto FROM noticias l INNER JOIN iniciopn n ON l.creador_id = n.id_user ORDER BY l.id_noticias DESC LIMIT $desde,$por_pagina");

        $resultado = mysqli_num_rows($query);
        if($resultado>0){
            while($data=mysqli_fetch_array($query)){
                if ($data['foto'] != 'imagen_noticia.png' ) {
                    $foto = '../imagenes/noticias-img/'.$data['foto'];
                }else{
                    $foto = '../imagenes/'.$data['foto'];
                }?>
                <li>
                    <a href="../pagina-principal/link_noticia.php?buscar=<?php echo $data['id_noticias']; ?>"> 
                        <img src="<?php echo $foto; ?>" alt=""></a>
                        <section class="caption"> 
                            <h2><?php echo $data['titulo'];?></h2>
                        </section>
                    </li>
                <?php } }?>
            </div>
        </div>



