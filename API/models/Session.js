const { DataTypes } = require('sequelize');
const sequelize = require('./config/db.js');

const Session = sequelize.define('Session', {
    sid: {
        type: DataTypes.STRING(36),
        primaryKey: true,
        unique: true
    },
    expires: DataTypes.DATE,
    data: DataTypes.TEXT,
    createdAt: {
        type: DataTypes.DATE,
        allowNull: false
    },
    updatedAt: {
        type: DataTypes.DATE,
        allowNull: false
    }
}, {
    tableName: 'sessions',
    timestamps: true
});

module.exports = Session;
