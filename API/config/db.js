const mysql = require("mysql2")


const bd = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
})

bd.connect((err) => {
    if (err) throw err
    console.log("Conectado a la base de datos")
})


module.exports = bd