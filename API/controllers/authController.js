const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");
const bd = require("../config/db");

exports.registerUsuario = (req, res) => {
    const { nombre, contra, rol } = req.body;
    const conEnciptada = bcrypt.hashSync(contra, 10);

    const query = `INSERT INTO usuario (nombre, contra, rol) VALUES (?, ?, ?)`;

    bd.query(query, [nombre, conEnciptada, rol], (err, result) => {
        if (err) {
            console.error(err);
            return res.status(500).json({ error: "Hubo un error al registrar el usuario" });
        }
        res.status(201).json({ message: "Usuario registrado" });
    });
};

exports.login = (req, res) => {
    const { nombre, contra } = req.body;
    const query = `SELECT * FROM usuario WHERE nombre = ?`;

    bd.query(query, [nombre], (err, results) => {
        if (err) {
            console.error(err);
            return res.status(500).json({ error: "Hubo un error al iniciar sesión" });
        }
        if (results.length === 0) {
            return res.status(401).json({ error: "Nombre de usuario no encontrado" });
        }
        const usuario = results[0];
        const contraValida = bcrypt.compareSync(contra, usuario.contra);
        if (!contraValida) {
            return res.status(401).json({ error: "Contraseña incorrecta" });
        }
        const token = jwt.sign({ id: usuario.id, rol: usuario.rol }, process.env.JWT_SECRET, { expiresIn: '1h' });
        res.json({ token });
    });
};

exports.getUsuario = (req, res) => {
    const { id } = req.user;

    const query = `SELECT id, nombre, rol FROM usuario WHERE id = ?`;

    bd.query(query, [id], (err, results) => {
        if (err || results.length === 0) {
            return res.status(404).json({ error: "Usuario no encontrado" });
        }
        res.json(results[0]);
    });
};