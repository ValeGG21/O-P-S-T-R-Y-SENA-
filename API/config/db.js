const config = require('./config')
const Sequelize = require('sequelize')

const environment =process.env.NODE_ENV || 'desarrollo'
const {username, password, database, host, dialect} = config[environment]

const sequelize = new Sequelize(database, username, password, {
    host,
    dialect
})

module.exports = sequelize