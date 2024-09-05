const { DataTypes } = require('sequelize')
const sequelize = require('../config/db')

const Sede = sequelize.define('Sede', {
    id_sede: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    departamento: {
        type: DataTypes.STRING(255),
        allowNull: false
    },
    ciudad: {
        type: DataTypes.STRING(255),
        allowNull: false
    }
}, {
    tableName: 'sede',
    timestamps: true,
    createdAt: 'fecha_creacion',
    updatedAt: 'fecha_actualizacion'
})