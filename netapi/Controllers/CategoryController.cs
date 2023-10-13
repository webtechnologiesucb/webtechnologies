using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Net;
using MySql.Data.MySqlClient;
using System.Net.Http;
using System.Web.Http;
using netapi.Models;
using System.Data;

namespace netapi.Controllers
{
    public class CategoryController : ApiController
    {

        // GET: api/category
        public IEnumerable<Category> GetCategories()
        {
            List<Category> oLista = new List<Category>();
            using (MySqlCommand oComando = new MySqlCommand("SELECT * FROM Category", ConexionDB.Instancia.ObtenerConexion()))
            {
                oComando.CommandType = CommandType.Text;

                using (MySqlDataReader oData = oComando.ExecuteReader())
                {
                    if (oData.HasRows)
                    {
                        while (oData.Read())
                        {
                            Category oCategoria = new Category
                            {
                                CategoryId = oData.GetInt32(0),
                                Name = oData.GetString(1),
                                LastUpdate = oData.GetDateTime(2)
                            };

                            oLista.Add(oCategoria);
                        }
                    }
                }
            }

            return oLista.ToList();
        }

        // GET: api/category/5
        public IEnumerable<Category> GetCategory(int id)
        {
            List<Category> oLista = new List<Category>();
            using (MySqlCommand oComando = new MySqlCommand("SELECT * FROM Category WHERE category_id=@id", ConexionDB.Instancia.ObtenerConexion()))
            {
                oComando.CommandType = CommandType.Text;
                oComando.Parameters.AddWithValue("@id", id);

                using (MySqlDataReader oData = oComando.ExecuteReader())
                {
                    if (oData.HasRows)
                    {
                        while (oData.Read())
                        {
                            Category oCategoria = new Category
                            {
                                CategoryId = oData.GetInt32(0),
                                Name = oData.GetString(1),
                                LastUpdate = oData.GetDateTime(2)
                            };

                            oLista.Add(oCategoria);
                        }
                    }
                }
            }

            return oLista.ToList();
        }

        // POST: api/category
        public IHttpActionResult PostCategory(Category category)
        {
            string dml = "INSERT INTO category(name) values (@name)";
            using (MySqlCommand oComando = new MySqlCommand(dml, ConexionDB.Instancia.ObtenerConexion()))
            {
                oComando.Parameters.AddWithValue("@name", category.Name);
                oComando.CommandType = CommandType.Text;
                oComando.ExecuteNonQuery();
            }

            return StatusCode(HttpStatusCode.OK);
        }

        // PUT: api/category/5
        public IHttpActionResult PutCategory(int id, Category category)
        {
            string dml = "UPDATE category SET name = @name WHERE category_id=@id";
            using (MySqlCommand oComando = new MySqlCommand(dml, ConexionDB.Instancia.ObtenerConexion()))
            {
                oComando.Parameters.AddWithValue("@name", category.Name);
                oComando.Parameters.AddWithValue("@id", id);
                oComando.CommandType = CommandType.Text;
                oComando.ExecuteNonQuery();
            }
            return StatusCode(HttpStatusCode.OK);
        }

        // DELETE: api/categories/5
        public IHttpActionResult DeleteCategory(int id)
        {
            string dml = "DELETE FROM category  WHERE category_id = @id";
            using (MySqlCommand oComando = new MySqlCommand(dml, ConexionDB.Instancia.ObtenerConexion()))
            {
                oComando.Parameters.AddWithValue("@id", id);
                oComando.CommandType = CommandType.Text;
                oComando.ExecuteNonQuery();
            }

            return StatusCode(HttpStatusCode.OK);
        }

    }
}