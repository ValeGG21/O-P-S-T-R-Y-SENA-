const { DataTypes } = require('sequelize')
const sequelize = require('../config/db')

const Movimiento = sequelize.define('Movimiento', {
    id_movimiento: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    equipo_id: {
        type: DataTypes.INTEGER,
        allowNull: false,
        references: {
            model: 'Equipo',
            key: 'id_equipo'
        }
    },
    tipo: {
        type: DataTypes.BOOLEAN,
        allowNull: false
    }
}, {
    tableName: 'movimiento',
    timestamps: true,
    createdAt: 'fecha_creacion',
    updatedAt: 'fecha_actualizacion'
})

module.exports = Movimiento