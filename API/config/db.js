const mysql = require("mysql2")
const dotenv = require("dotenv")


const bd = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'opstry',
    port: 3307
})

bd.connect((err) => {
    if (err) throw err
    console.log("Conectado a la base de datos")
})


module.exports = bd