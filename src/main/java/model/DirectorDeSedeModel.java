 package model;
 
 public class DirectorDeSedeModel {
    
    public static final String TABLA = "tabla_director" ;
    public static String IDENTIFICACION = "identificacion" ;
    public static String TIPO_DOCUMENTO = "tipo_documento";
    public static String NOMBRE= "nombre" ;
    public static String APELLIDO = "apellido" ;
    public static String SEDE = "sede" ;
    public static String DEPARTAMENTO = "departamento" ;
    
    private String identificacion;
    private String nombre;
    private String apellido;
    private String sede;
    private String departamento;
    
    public  DirectorDeSedeModel(){
    
    }

    public DirectorDeSedeModel(String identificacion, String nombre, String apellido, String sede, String departamento) {
        this.identificacion = identificacion;
        this.nombre = nombre;
        this.apellido = apellido;
        this.sede = sede;
        this.departamento = departamento;
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
