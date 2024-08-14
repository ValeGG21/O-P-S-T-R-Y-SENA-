package model;

public class AdministradorModel {
     
     public static final String TABLA = "tabla_admin" ;
     public static String TIPO_DOCUMENTO = "tipo_documento";
     public static String IDENTIFICACION = "identificacion" ; 
     public static String NOMBRE = "nombre" ;
     public static String APELLIDO = "apellido" ;
     public static String SEDE = "sede" ;
     public static String DEPARTAMENTO ="departamento" ;  
             
     private String identificacion;
     private String tipo_documento;
     private String nombre;
     private String apellido;
     private String sede;
     private String departamento;

    public AdministradorModel() {
    }

    public AdministradorModel(String identificacion, String tipo_documento ,String nombre, String apellido, String sede, String departamento) {
        this.identificacion = identificacion;
        this.tipo_documento = tipo_documento;
        this.nombre = nombre;
        this.apellido = apellido;
        this.sede = sede;
        this.departamento = departamento;
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

    public String getDepartamento() {
        return departamento;
    }

    public void setDepartamento(String departamento) {
        this.departamento = departamento;
    }

     
}
