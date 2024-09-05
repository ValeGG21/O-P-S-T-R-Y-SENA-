const express = require("express")
const session = require('express-session')
const rateLimit = require('express-rate-limit')
const helmet = require('helmet')
const morgan = require('morgan')
const authRoutes = require("./routes/authRoutes")
const equipRoutes = require("./routes/equipRoutes")
const sequelize = require('./config/db')

const app = express()

app.use(express.json())
app.use(express.urlencoded({ extended: true }))

app.use(helmet())
app.use(morgan('combined'))

const limiter = rateLimit({
    windowMs: 15 * 60 * 1000,
    max: 100
})
app.use(limiter)

app.use(session({
    secret: process.env.SESSION_SECRET,
    resave: false,
    saveUninitialized: true,
}))

app.use('/auth', authRoutes)
app.use('/equip', equipRoutes)

sequelize.sync().then(() => {
    app.listen(process.env.SERVER_PORT, () => {
        console.log(`Server is running on port ${process.env.PORT}`)
    })
})
