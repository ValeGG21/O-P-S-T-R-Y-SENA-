const express = require("express")
const cors = require("cors")
const dotenv = require("dotenv")
const mysql = require("mysql2")
const jwt = require("jsonwebtoken")
const bcrypt = require("bcrypt")
const authRoutes = require("./routes/authRoutes")
const equipRoutes = require("./routes/equipRoutes")

dotenv.config()

const app = express()
app.use(express.json())
app.use(cors({
    origin: "la ruta del server de express del front o el server cuando lo subamos a uno",
    methods: ['GET', 'POST', 'PUT', 'DELETE'],
    allowHeaders: ['Content-Type', 'Authorization']
}))

app.use("/api/auth", authRoutes)
app.use("/api/equip", equipRoutes)

const port = process.env.PORT || 3232

app.listen(port, () => {
    console.log(`http//:localhost:3232`);
    
})

// cryptojs, express session, express rate limit, helmet, morgan, sequelize.