const { DataTypes, UniqueConstraintError } = require('sequelize')
const sequelize = require('../config/db.js')

const Equipo = sequelize.define('Equipo', {
    id_equipo: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    marca: {
        type: DataTypes.STRING(50),
        allowNull: false
    },
    descripcion: {
        type: DataTypes.STRING,
        allowNull: false
    },
    codigoBarras: {
        type: DataTypes.STRING(300),
        allowNull: false,
        UniqueConstraintError  
    },
    usuario_id: {
        type: DataTypes.INTEGER,
        allowNull: false,
        references: {
            model: 'Usuario',
            key: 'id_usuario'
        }
    },
    novedad: {
        type: DataTypes.STRING,
        allowNull: false
    }

}, {
    tableName: 'equipo',
    timestamps: true,
    createdAt: 'fecha_creacion',
    updatedAt: 'fecha_actualizacion'
})

module.exports = Equipo