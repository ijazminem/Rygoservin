jQuery(document).ready(function(){
    /**
     * Ver / Ocultar Contraseña
    */
    jQuery('.see_pass').click(function(){
        if(jQuery(this).children('.fa-eye-slash').hasClass('fa-eye-dn')){
            jQuery(this).children('.fa-eye-slash').removeClass('fa-eye-dn');
            jQuery(this).children('.fa-eye').addClass('fa-eye-dn');
            jQuery('#pass').attr('type', 'text');
            jQuery('#contrasena').attr('type', 'text');
            jQuery('#contrasena_u').attr('type', 'text');
        }else{
            jQuery(this).children('.fa-eye').removeClass('fa-eye-dn');
            jQuery(this).children('.fa-eye-slash').addClass('fa-eye-dn');
            jQuery('#pass').attr('type', 'password');
            jQuery('#contrasena').attr('type', 'password');
            jQuery('#contrasena_u').attr('type', 'password');
        }
    });

    /* ACCIONES DEL MENU MOBILE */
    /* abrir */
    jQuery(".menu_button").click(function(){
        jQuery(".nav_mobile").css("animation-name","open_menu_content");
        jQuery(".content_menu_mobile").css("animation-name","open_menu");
        jQuery("body").css('overflow','hidden');
    });

    /* cerrar al hacer click afuera del contenido */
    jQuery(".nav_mobile").click(function() {
        jQuery(".nav_mobile").css("animation-name","close_menu_content");
        jQuery(".content_menu_mobile").css("animation-name","close_menu");
        jQuery("body").css('overflow','initial');
    });

    /* detener la propagacion de hacer click dentro del contenedor */
    jQuery('.nav_mobile .content_menu_mobile').click(function (e) {
        e.stopPropagation();
    });

    /* mostrar/ocultar sub menu */
    jQuery('.nav_mobile .menu-item-has-children').click(function(){
        if(jQuery(this).children('ul').hasClass('show_menu_mobile')){
            jQuery(this).children('ul').removeClass('show_menu_mobile');
            jQuery(this).children('ul').addClass('hide_menu_mobile');

            jQuery(this).children('a').removeClass('rotate_icon_menu_mobile');
        }else{
            jQuery(this).children('ul').removeClass('hide_menu_mobile');
            jQuery(this).children('ul').addClass('show_menu_mobile');

            jQuery(this).children('a').addClass('rotate_icon_menu_mobile');
        }
    });

    /* ACCIONES DEL MENU PRINCIPAL */
    jQuery('.menu_escritorio .menu-item-has-children').click(function(){
        if(jQuery(this).children('ul').hasClass('show_menu')){
            jQuery(this).children('ul').removeClass('show_menu');
            jQuery(this).children('ul').addClass('hide_menu');

            jQuery(this).children('a').removeClass('rotate_icon_menu');
        }else{
            jQuery(this).children('ul').removeClass('hide_menu');
            jQuery(this).children('ul').addClass('show_menu');

            jQuery(this).children('a').addClass('rotate_icon_menu');
        }
    });
});

/**
 * URL
*/
let URLactual = "" + window.location + "";
let separador = "/";
let array = URLactual.split(separador);
URLactual = "";

for(let i = 0; i < 3; i++){
    if(i==2){
        URLactual += array[i];
    }else{
        URLactual += array[i]  + "/";
    }
}

URLactual += "/rygo";


/**
 * Control buttons
*/
function button_control(id, type, text){
    if(type == 'activar'){
        jQuery(id).removeAttr('disabled');
        jQuery(id).css('opacity', '1');
        jQuery(id).css('cursor', 'pointer');
    }else{
        jQuery(id).attr('disabled');
        jQuery(id).css('opacity', '0.5');
        jQuery(id).css('cursor', 'not-allowed');
    }

    jQuery(id).val(text);
}

/**
 * Validaciones
*/
function comprobar_validaciones(id, regex = null, empty = false, size = 0){
    if(empty == false){
        if(jQuery(id).val() == '' || jQuery(id).val() == ' ' || jQuery(id).val().length == 0){
            return 'empty';
        }
    }

    if(regex != null){
        if(empty){
            if(jQuery(id).val().length > 0){
                if(!regex.test(jQuery(id).val())){
                    return 'regex';
                }
            }else{
                return 'empty';
            }
        }else{
            if(!regex.test(jQuery(id).val())){
                return 'regex';
            }
        }
    }

    if(size != 0){
        if(jQuery(id).val().length < size){
            return 'size';
        }
    }

    return 'success';
}

/**
 * Control Input
*/
function input_control(id, type){
    if(type == 'empty'){
        jQuery(id).css('border-color', '#e3e3e3');
    }else if(type == 'regex'){
        jQuery(id).css('border-color', 'red');
    }else if(type == 'size'){
        jQuery(id).css('border-color', 'red');
    }else if(type == 'error'){
        jQuery(id).css('border-color', 'red');
    }else{
        jQuery(id).css('border-color', '#00b939');
    }
}