package data;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;
import model.AdministradorModel;
import model.SuperAdminModel;
import model.DirectorDeSedeModel;
import model.UsuarioComunModel;
import model.VisitanteModel;

public class Conexion {
    
    private static Connection myCon;
    public static String MENSAJE;
    String bd = "bd_opstry";
    String url = "jdbc:mysql://localhost:3307/";
    String user = "root";
    String password = "";
    String driver = "com.mysql.cj.jdbc.Driver";

    
    
    public Conexion() {
        crearTablas();
    }  
    
    
    public Connection conectar(){
        try {
                Class.forName(driver);
            myCon = DriverManager.getConnection(url+bd,user,password);
            System.out.println("Se conectó a "+bd);   
        } catch (ClassNotFoundException | SQLException ex) {
            MENSAJE = "Error de conexion: " + ex.getMessage();
        }
          return myCon;   
    }
    
     public void crearTablas(){
        crearTablaAdministrador();
        crearTablaSuperAdmin();
        crearTablaDirector();
        crearTablaVisitante();
        crearTablaUsuarioComun();
    }
    
        private void crearTablaAdministrador() {
            final String SQL="CREATE TABLE IF NOT EXISTS " + AdministradorModel.TABLA
                + " ("
                + AdministradorModel.IDENTIFICACION+" VARCHAR(11) PRIMARY KEY AUTO_INCREMENT, "
                + AdministradorModel.TIPO_DOCUMENTO+" VARCHAR(20) NOT NULL, " 
                + AdministradorModel.NOMBRE+" VARCHAR(100) NOT NULL, "
                + AdministradorModel.APELLIDO+" VARCHAR(100) NOT NULL, "
                + AdministradorModel.SEDE+" VARCHAR(100) NOT NULL, "
                + AdministradorModel.DEPARTAMENTO+" VARCHAR (100) NOT NULL "
                + "); ";
        
            Connection con= conectar();
            try {
                Statement sentencia= con.createStatement();
                int resultado= sentencia.executeUpdate(SQL);
                if (resultado == 0){
                    MENSAJE="Se creó la tabla: "+AdministradorModel.TABLA;
                }
                con.close();
            } catch (SQLException ex) {
                MENSAJE= ex.getMessage();
            }
        
    }
        
        private void crearTablaSuperAdmin() {
            final String SQL="CREATE TABLE IF NOT EXISTS " + SuperAdminModel.TABLA
                + " ("
                + SuperAdminModel.IDENTIFICACION+" VARCHAR(11) PRIMARY KEY AUTO_INCREMENT, "
                + SuperAdminModel.TIPO_DOCUMENTO+" VARCHAR(100) NOT NULL, "    
                + SuperAdminModel.NOMBRE+" VARCHAR(100) NOT NULL, "
                + SuperAdminModel.APELLIDO+" VARCHAR(100) NOT NULL, "
                + SuperAdminModel.SEDE+" VARCHAR(100) NOT NULL, "
                + SuperAdminModel.DEPARTAMENTO+" VARCHAR (100) NOT NULL "
                + "); ";
        
            Connection con= conectar();
            try {
                Statement sentencia= con.createStatement();
                int resultado= sentencia.executeUpdate(SQL);
                if (resultado == 0){
                    MENSAJE="Se creó la tabla: "+SuperAdminModel.TABLA;
                }
                con.close();
            } catch (SQLException ex) {
                MENSAJE= ex.getMessage();
            }              
        
    }   
        
        private void crearTablaDirector() {
            final String SQL="CREATE TABLE IF NOT EXISTS " + DirectorDeSedeModel.TABLA
                + " ("
                + DirectorDeSedeModel.IDENTIFICACION+" VARCHAR(11) PRIMARY KEY AUTO_INCREMENT, "
                + DirectorDeSedeModel.TIPO_DOCUMENTO+" VARCHAR(20) NOT NULL, "
                + DirectorDeSedeModel.NOMBRE+" VARCHAR(100) NOT NULL, "
                + DirectorDeSedeModel.APELLIDO+" VARCHAR(100) NOT NULL, "
                + DirectorDeSedeModel.SEDE+" VARCHAR(100) NOT NULL, "
                + DirectorDeSedeModel.DEPARTAMENTO+" VARCHAR (100) NOT NULL "
                + "); ";
        
            Connection con= conectar();
            try {
                Statement sentencia= con.createStatement();
                int resultado= sentencia.executeUpdate(SQL);
                if (resultado == 0){
                    MENSAJE="Se creó la tabla: "+DirectorDeSedeModel.TABLA;
                }
                con.close();
            } catch (SQLException ex) {
                MENSAJE= ex.getMessage();
            }   
        
        }
        
        private void crearTablaVisitante() {
            final String SQL="CREATE TABLE IF NOT EXISTS " + VisitanteModel.TABLA
                + " ("
                + VisitanteModel.IDENTIFICACION+" VARCHAR(11) PRIMARY KEY AUTO_INCREMENT, "
                + VisitanteModel.TIPO_DOCUMENTO+" VARCHAR(20) NOT NULL, "
                + VisitanteModel.NOMBRE+" VARCHAR(100) NOT NULL, "
                + VisitanteModel.APELLIDO+" VARCHAR(100) NOT NULL, "
                + VisitanteModel.SEDE+" VARCHAR(100) NOT NULL, "
                + VisitanteModel.ORIGEN+ " VARCHAR(1500) NOT NULL, "
                + VisitanteModel.DEPARTAMENTO+" VARCHAR (100) NOT NULL "
                + "); ";
        
            Connection con= conectar();
            try {
                Statement sentencia= con.createStatement();
                int resultado= sentencia.executeUpdate(SQL);
                if (resultado == 0){
                    MENSAJE="Se creó la tabla: "+VisitanteModel.TABLA;
                }
                con.close();
            } catch (SQLException ex) {
                MENSAJE= ex.getMessage();
            }   
        }
        
        private void crearTablaUsuarioComun() {
            final String SQL="CREATE TABLE IF NOT EXISTS " + UsuarioComunModel.TABLA
                + " ("
                + UsuarioComunModel.IDENTIFICACION+" VARCHAR(11) PRIMARY KEY AUTO_INCREMENT, "
                + UsuarioComunModel.NOMBRE+" VARCHAR(100) NOT NULL, "
                + UsuarioComunModel.TIPO_DOCUMENTO+" VARCHAR(100) NOT NULL, "
                + UsuarioComunModel.SEDE+" VARCHAR(100) NOT NULL, "
                + UsuarioComunModel.CADENA_FORMACION+ " VARCHAR(1500) NOT NULL, "
                + UsuarioComunModel.ROL+ " VARCHAR(50) NOT NULL, "
                + UsuarioComunModel.DEPARTAMENTO+" VARCHAR (100) NOT NULL "
                + "); ";
            
        
            Connection con= conectar();
            try {
                Statement sentencia= con.createStatement();
                int resultado= sentencia.executeUpdate(SQL);
                if (resultado == 0){
                    MENSAJE="Se creó la tabla: "+UsuarioComunModel.TABLA;
                }
                con.close();
            } catch (SQLException ex) {
                MENSAJE= ex.getMessage();
            }            
        }
        
    public static void llenarTablas(JTable table, String Query){            
        try
        {
            Connection c = new Conexion().conectar();
            Statement s = c.createStatement();
            ResultSet r = s.executeQuery(Query);
            
            while(table.getRowCount() > 0) {
            ((DefaultTableModel) table.getModel()).removeRow(0);
            
            }
                
            int columns = r.getMetaData().getColumnCount();
            while(r.next()) {  
            Object[] row = new Object[columns];
            for (int i = 1; i <= columns; i++)
            {  
                row[i - 1] = r.getObject(i);
            }
            ((DefaultTableModel) table.getModel()).insertRow(r.getRow()-1,row);
        }

            r.close();
            s.close();
            c.close();
        }
            catch(SQLException e) {
        
        }
}
    
   
}

