const { DataTypes } = require('sequelize')
const sequelize = require('../config/db')

const Usuario = sequelize.define('Usuario', {
    id_usuario: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    tipo_documento: {
        type: DataTypes.STRING(300),
        allowNull: false
    },
    numero_documento: {
        type: DataTypes.INTEGER,
        allowNull: false
    },
    nombre: {
        type: DataTypes.STRING(500),
        allowNull: false
    },
    apellido: {
        type: DataTypes.STRING(600),
        allowNull: false
    },
    sede_id: {
        type: DataTypes.INTEGER,
        allowNull: false,
        references: {
            model: 'Sede',
            key: 'id_sede'
        }
    },
    telefono: {
        type: DataTypes.INTEGER,
        allowNull: false
    },
    contra: {
        type: DataTypes.TEXT,
        allowNull: false
    },
    rol: {
        type: DataTypes.STRING(1000),
        allowNull: false
    },
    novedad: {
        type: DataTypes.TEXT,
        allowNull: false
    },
}, {
    tableName: 'usuario',
    timestamps: true,
    createdAt: 'fecha_creacion',
    updatedAt: 'fecha_actualizacion'
})

module.exports = Usuario