using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace netapi.Models
{
    public class Category
    {
        public int CategoryId { get; set; }
        public string Name { get; set; }
        public DateTime LastUpdate { get; set; }
    }
}