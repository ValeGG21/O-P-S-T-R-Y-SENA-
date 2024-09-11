const express = require("express");
const session = require('express-session');
const rateLimit = require('express-rate-limit');
const helmet = require('helmet');
const morgan = require('morgan');
const SequelizeStore = require('connect-session-sequelize')(session.Store);
const authRoutes = require("./routes/authRoutes.js");
const equipRoutes = require("./routes/equipRoutes.js");
const sequelize = require('./config/db.js');
const dotenv = require('dotenv')
const cors = require('cors');

const app = express();

dotenv.config()

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use(cors({
    origin: 'http://localhost:8000' // Ajusta esto según el origen de tu frontend
}));

app.use(helmet());
app.use(morgan('combined'));

const limiter = rateLimit({
    windowMs: 15 * 60 * 1000,
    max: 100
});
app.use(limiter);

app.use(session({
    secret: process.env.SESSION_SECRET || 'TripleSpeed',
    store: new SequelizeStore({
        db: sequelize,
        checkExpirationInterval: 15 * 60 * 1000,
        expiration: 24 * 60 * 60 * 1000
    }),
    resave: false,
    saveUninitialized: false,
    cookie: {
        secure: process.env.NODE_ENV === 'production',  // Usa cookies seguras en producción
        maxAge: 24 * 60 * 60 * 1000  // Duración de la cookie: 1 día
    }
}));

// Rutas
app.use('/auth', authRoutes);
app.use('/equip', equipRoutes);

sequelize.sync({ alter: true })
    .then(() => console.log('Database synced'))
    .catch(err => console.error('Error syncing database:', err));

sequelize.sync().then(() => {
    const port = process.env.SERVER_PORT;
    app.listen(port, () => {
        console.log(`Server is running on port ${port}`);
    });
});
