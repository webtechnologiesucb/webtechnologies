using System;
using MySql.Data.MySqlClient;
namespace netapi.Models
{
    public class ConexionDB
    {
        private static ConexionDB instancia = null;
        private static readonly object lockObj = new object();
        private readonly string cadenaConexion;
        private MySqlConnection conexion;

        // Constructor privado de la clase
        private ConexionDB()
        {
            cadenaConexion = "Server=localhost;Database=sakila;Uid=root;Pwd=;";
            conexion = new MySqlConnection(cadenaConexion);
        }

        public static ConexionDB Instancia
        {
            get
            {
                if (instancia == null)
                {
                    lock (lockObj)
                    {
                        if (instancia == null)
                        {
                            instancia = new ConexionDB();
                        }
                    }
                }
                return instancia;
            }
        }

        public MySqlConnection ObtenerConexion()
        {
            if (conexion.State != System.Data.ConnectionState.Open)
            {
                conexion.Open();
            }
            return conexion;
        }
    }
}