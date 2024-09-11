const { DataTypes } = require('sequelize');
const sequelize = require('../config/db.js');
const Sede = require('./Sede.js');

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
        allowNull: false,
        unique: true
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
            model: Sede,
            key: 'id_sede'
        },
        onDelete: 'CASCADE',
        onUpdate: 'CASCADE'
    },
    telefono: {
        type: DataTypes.STRING(20),
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
        type: DataTypes.TEXT
    }
}, {
    tableName: 'usuario',
    timestamps: true,
    createdAt: 'fecha_creacion',
    updatedAt: 'fecha_actualizacion'
});

module.exports = Usuario;
