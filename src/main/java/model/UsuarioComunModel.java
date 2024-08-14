package model;

public class UsuarioComunModel {
    
    public static final String TABLA = "tabla_usuariocomun" ;
    public static String TIPO_DOCUMENTO  ="tipo_documento" ;
    public static String IDENTIFICACION = "identificacion" ;
    public static String NOMBRE = "nombre" ;
    public static String SEDE = "sede" ;
    public static String ROL = "rol";
    public static String CADENA_FORMACION = "cadena_formacion" ;
    public static String DEPARTAMENTO = "departamento" ;
    public static String CARACTERISTICAS = "caracteristicas" ;
    public static int CANTIDAD = 0 ;
   
    private String tipo_documento;
    private String identificacion;
    private String nombre;
    private String apellido;
    private String sede;
    private String rol;
    private String cadena_formacion;
    private String departamento;
    private String caracteristicas;
    private int cantidad;
    
    public UsuarioComunModel() {
    }

    public UsuarioComunModel(String tipo_documento, String identificacion, String nombre, String apellido, String sede, String rol, String cadena_formacion, String departamento, String caracteristicas, int cantidad) {
        this.tipo_documento = tipo_documento;
        this.identificacion = identificacion;
        this.nombre = nombre;
        this.apellido = apellido;
        this.sede = sede;
        this.rol = rol;
        this.cadena_formacion = cadena_formacion;
        this.departamento = departamento;
        this.caracteristicas = caracteristicas;
        this.cantidad = cantidad;
    }

    public String getTipo_documento() {
        return tipo_documento;
    }

    public void setTipo_documento(String tipo_documento) {
        this.tipo_documento = tipo_documento;
    }
    
    public String getIdentificacion() {
        return identificacion;
    }

    public void setIdentificacion(String identificacion) {
        this.identificacion = identificacion;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getApellido() {
        return apellido;
    }

    public void setApellido(String apellido) {
        this.apellido = apellido;
    }

    public String getSede() {
        return sede;
    }

    public void setSede(String sede) {
        this.sede = sede;
    }

    public String getRol() {
        return rol;
    }

    public void setRol(String rol) {
        this.rol = rol;
    }

    public String getCadena_formacion() {
        return cadena_formacion;
    }

    public void setCadena_formacion(String cadena_formacion) {
        this.cadena_formacion = cadena_formacion;
    }

    public String getDepartamento() {
        return departamento;
    }

    public void setDepartamento(String departamento) {
        this.departamento = departamento;
    }

    public String getCaracteristicas() {
        return caracteristicas;
    }

    public void setCaracteristicas(String caracteristicas) {
        this.caracteristicas = caracteristicas;
    }

    public int getCantidad() {
        return cantidad;
    }

    public void setCantidad(int cantidad) {
        this.cantidad = cantidad;
    }
    
}