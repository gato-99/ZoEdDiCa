  $(document).ready(function() {
     // -------------------editor de texto--------------------------
     $('#summernote').summernote({
        toolbar: [
           ['style', ['style', 'clear', 'undo', 'redo']],
           ['font', ['bold', 'underline', 'strikethrough']],
           ['fontname', ['fontname', 'fontsize']],
           ['color', ['color']],
           ['para', ['ul', 'ol', 'paragraph', 'height']],
           ['table', ['table']],
           ['insert', ['link', 'unlink']],
        ],
        height: 200
     });
     // -------------------fin editor de texto--------------------------
     //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
     $("#foto").on("change", function() {
        var uploadFoto = document.getElementById("foto").value;
        var foto = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        if (uploadFoto != '') {
           var type = foto[0].type;
           var name = foto[0].name;
           if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
              contactAlert.innerHTML = '<p class="alerta">El archivo no es válido.</p>';
              $("#img").remove();
              $(".delPhoto").addClass('notBlock');
              $('#foto').val('');
              return false;
           } else {
              contactAlert.innerHTML = '';
              $("#img").remove();
              $(".delPhoto").removeClass('notBlock');
              var objeto_url = nav.createObjectURL(this.files[0]);
              $(".prevPhoto").append("<img id='img' src=" + objeto_url + ">");
              $(".upimg label").remove();
           }
        } else {
           alert("No selecciono foto");
           $("#img").remove();
        }
     });
     $('.delPhoto').click(function() {
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();
        // mod foto
        if ($("#foto_actual") && $("#foto_remove")) {
           $("#foto_remove").val('imagen_noticia.png')
        }
     });
     //--------------------- fin SELECCIONAR FOTO PRODUCTO ---------------------
  });
  // -------------------loadin de pagina--------------------------
  window.onload = function() {
     var contenedor = document.getElementById('con_sinbolo');
     contenedor.style.visibility = 'hidden';
     contenedor.style.opacity = '0';
  }